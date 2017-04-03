//inicializamos eventos y procesos desde el DOM
var geocoder;
var map;
var infowindow;
var localgps;
var inicial=true;
var markers = [];
var taxownercars = [];
var LatLngList=[];
var ant_lat;
var ant_lng;
var carcode;
var descriptioncar;
//create firebase response read
//var gl_ref= new Firebase("https://taxiup.firebaseio.com");;

//inicializamos icono de position actual
var icons={start: new google.maps.MarkerImage(
		   // URL
		   'https://taxiar-files.s3.amazonaws.com/img/workoffice.png',
		   // (width,height)
		   new google.maps.Size( 44, 32 ),
		   // The origin point (x,y)
		   new google.maps.Point( 0, 0 ),
		   // The anchor point (x,y)
		   new google.maps.Point( 22, 32 )
		  )}

$(document
		).ready(function(){
	IniciarEventos();}
);


function IniciarEventos(){
	geocoder = new google.maps.Geocoder();

	var latlng = new google.maps.LatLng(-26.816750, -65.226801);
  	var mapOptions = {
    		zoom: 16,
    		maxZoom:18,
    		center: latlng
  	}
  	map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
  	getpoint()
 		$('#cancelar').click(function(){window.history.back()})
}

/*Inicializa punto GPS del local/taller*/
function LocalizeLocal(){
	geocoder.geocode({'address':'Argentina,Tucuman,San Miguel de Tucuman'},function(results,status){
		if(status == google.maps.GeocoderStatus.OK){
			localgps= results[0].geometry.location
		}else{
			alert('No se pudo determinar la direccion del Local. Disculpe las molestias');
		}
	})
}


function MapsShow(lat,lng,carcode,descriptioncar,id){
		var ultpos = new google.maps.LatLng(lat,lng)
		var marker = new google.maps.Marker({
			position: new google.maps.LatLng(lat,lng),
            icon: 'https://taxiar-files.s3.amazonaws.com/img/gpscar.png',
            map: map,
            title: carcode+' - '+descriptioncar,
            carcode: carcode
        });
		var content = carcode+' - '+descriptioncar //change next for best view
		var infowindow = new google.maps.InfoWindow()
		markers.push(marker)
		LatLngList.push(new google.maps.LatLng (lat,lng))
		google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){
	        return function() {
	           infowindow.setContent(content);
	           infowindow.open(map,marker);
	        };
	    })(marker,content,infowindow));
			//for trace car position on live moment
			//pusherpoint(id)
			google.maps.event.addDomListener(window, "resize", function() {
			 var center = map.getCenter();
			 google.maps.event.trigger(map, "resize");
			 map.setCenter(center);
			});
}

function makeMarker( position, icon, title ) {
	 new google.maps.Marker({
	  position: position,
	  map: map,
	  icon: icon,
	  title: title
	 });
}

function setMapOnAll(map,carcode){
	for (var i = 0; i < markers.length; i++) {
		if(typeof(carcode)!='undefined'){
			//only flush data of a car with recibe de call
			if(markers[i].carcode == carcode){
				markers[i].setMap(map);
			}
		}else{
			markers[i].setMap(map);
		}
	}
}


/*
* Function: recupera los puntos almacenados para ser vistos.
*/
function getpoint(){
	$.ajax({url:'/taxownerscars/whereismycarjson.json',
			type:'get',
			dataType:'json',
			success: function(data){
			  setMapOnAll(null);
			  $.each( data, function( key, val ) {
				  	if(val.taxubication.lat != ''){
							valanterior=$('#pedidos').html()
				  		if(typeof(valanterior)=='undefined') valanterior=''
				  			s_estado=''
				  		if(val.Taxownerscar.state == 2)
				  			s_estado = 'Ocupado'
				  		else
				  			s_estado = 'Libre'

							var descriptioncar = val.People.firstname+", "+val.People.secondname;
							MapsShow(val.taxubication.lat,val.taxubication.lng,
							val.Taxownerscar.registerpermision, descriptioncar);

							taxownercars.push({id:val.Taxownerscar.id,ids:val.Rsesion.sessionkey,descriptioncar:descriptioncar,carcode:val.Taxownerscar.registerpermision});



			  			/**$('#pedidos').html(valanterior+'<a class="list-group-item  list-group-item-success"></i>&nbsp;Activo - '+s_estado+'<span class="pull-right text-muted small"></span></a>'+
					  			'<a class="list-group-item">&nbsp;<label>Patente:</label><span class="pull-right text-muted small">'+val.Taxownerscar.carcode+'</span></a>'+
					  			'<a class="list-group-item">&nbsp;<label>Detalle:</label><span class="pull-right text-muted small">'+val.Taxownerscar.descriptioncar+'</span></a>'+
									'<a class="list-group-item">&nbsp;<label>Chofer:</label><span class="pull-right text-muted small">'+val.People.firstname+", "+val.People.secondname+'</span></a>')**/
				  	}else{
				  	}
			  });
			  //ajustar mapa a la cantidad de marcas registradas en el mapa
			  viewmapscenter()
				setInterval("getubicationcar()",30000);
			}
	})
}

function viewmapscenter(){
	var bounds = new google.maps.LatLngBounds ();
	for (var i = 0; i < LatLngList.length; i++) {
		bounds.extend (LatLngList[i]);
	}
	map.fitBounds (bounds);
}


function getubicationcar(){

		for (var i = 0; i < taxownercars.length; i++) {
			carcode = taxownercars[i].carcode
			ids = taxownercars[i].ids
			descriptioncar = taxownercars[i].descriptioncar
			$.ajax({url:'/taxubications/getubicationnt.json',
				type:'post',
				data:{key:glb_k,id:taxownercars[i].id},
				dataType:'json',
				success: function(data){
					//solo refresca el mapa si no se encuentra en la misma lat y lng anterior
					if(typeof(data) != 'undefined' && ant_lat != data.records.lat && ant_lng != data.records.lng){
						ant_lat = data.records.lat;
						ant_lng = data.records.lng;
						//setMapOnAll(null,carcode);
						MapsShow(data.records.lat,data.records.lng,carcode,descriptioncar,ids)
						viewmapscenter()
					}
					//si recuperamos datos mostramos os datos del driver
				}
			}).error(function(){
				$().toastmessage('showToast', {
					text     : 'No se pudo ejecutar el proceso de consulta de estado de orden',
					sticky   : false,
					position : 'top-right',
					type     : 'error',
					closeText: '',
					close    : function () {
					}
				});
			})
		}
}
