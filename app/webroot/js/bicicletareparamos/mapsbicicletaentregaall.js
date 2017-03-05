/*
*    This program is free software: you can redistribute it and/or modify
*    it under the terms of the GNU General Public License as published by
*    the Free Software Foundation, either version 3 of the License, or
*    (at your option) any later version.
*
*    This program is distributed in the hope that it will be useful,
*    but WITHOUT ANY WARRANTY; without even the implied warranty of
*    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*    GNU General Public License for more details.
*
*    You should have received a copy of the GNU General Public License
*    along with this program.  If not, see <http://www.gnu.org/licenses/>
*    @author Oppe Luis Sebastian
*    @Fecha 10/04/2015
*    @use Librerias de AJAX para inicio de sesion
*/
//inicializamos eventos y procesos desde el DOM
var geocoder;
var map;
var infowindow;
var localgps;
var inicial=true;

//inicializamos icono de position actual
var icons={start: new google.maps.MarkerImage(
		   // URL
		   '../../img/workoffice.png',
		   // (width,height)
		   new google.maps.Size( 44, 32 ),
		   // The origin point (x,y)
		   new google.maps.Point( 0, 0 ),
		   // The anchor point (x,y)
		   new google.maps.Point( 22, 32 )
		  )}

$(document).ready(function(){
	IniciarEventos();}
);


function IniciarEventos(){
	geocoder = new google.maps.Geocoder();
	
	var latlng = new google.maps.LatLng(-26.816750, -65.226801);
  	var mapOptions = {
    		zoom: 16,
    		center: latlng
  	}
  	map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	LocalizeLocal()
	//MapsShow()

	$('#cancelar').click(function(){window.history.back()})
}

function MapsShow(){

	var domiciliosgps = direccion.length
	var coordgpscount = coordgps.length
	var direccionant=''
	ultpoint=null
	//var initialpoint=

	for(i=0;i<domiciliosgps;i++){
		var infowindow = new google.maps.InfoWindow()
		direccionget=direccion[i].direccionclie+','+direccion[i].provincia+','+direccion[i].localidad+','+direccion[i].pais
		if(direccionant != direccionget){
			direccionant = direccionget
			GeocoderAddPoint(direccionant,infowindow,true,infocliente[i].infoclient)
		}
	}

	for(i=0;i<coordgpscount;i++){
		var ultpos = new google.maps.LatLng(coordgps[i].lat, coordgps[i].lng)
		var marker = new google.maps.Marker({
			position: new google.maps.LatLng(coordgps[i].lat, coordgps[i].lng),
            icon: '../../img/house.png',
            map: map,
            title: coordgps[i].nomap
        });
		var content = infocliente[i].infoclient
		var infowindow = new google.maps.InfoWindow()
		RouteMap(ultpos)
		//ultimo punto GPS CARGADO
		localgps=ultpos
		google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){
	        return function() {
	           infowindow.setContent(content);
	           infowindow.open(map,marker);
	        };
	    })(marker,content,infowindow));
	}
}

function GeocoderAddPoint(direccionget,infowindow,addpoint,content){
			geocoder.geocode({'address':direccionget},function(results,status){
				if(status == google.maps.GeocoderStatus.OK){
					map.setCenter(results[0].geometry.location);
					if(addpoint == true){
						var marker= new google.maps.Marker({map:map,
									position:results[0].geometry.location
							});

						google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){
					        return function() {
					           infowindow.setContent(content);
					           infowindow.open(map,marker);
					        };
					    })(marker,content,infowindow));
						RouteMap(results[0].geometry.location)
						localgps=results[0].geometry.location
					  }
				}else{
					alert('No se pudo determinar la direccion. Disculpe las molestias');
				}
			});
}

/*Inicializa punto GPS del local/taller*/
function LocalizeLocal(){
	geocoder.geocode({'address':direccionlocal},function(results,status){
		if(status == google.maps.GeocoderStatus.OK){
			//alert(results[0])
			localgps= results[0].geometry.location
			MapsShow()
		}else{
			alert('No se pudo determinar la direccion del Local. Disculpe las molestias');
		}
		})
}

function RouteMap(pointto){
    var directionsDisplay = new google.maps.DirectionsRenderer( {
        suppressMarkers: true
    });// also, constructor can get "DirectionsRendererOptions" object
    directionsDisplay.setMap(map); // map should be already initialized.
	if(typeof(localgps)!='undefined'){
		var request = {
			origin : localgps,
			destination : pointto,
			travelMode : google.maps.TravelMode.DRIVING
		};
		var directionsService = new google.maps.DirectionsService();
		directionsService.route(request, function(response, status) {
			if (status == google.maps.DirectionsStatus.OK) {
				var leg = response.routes[ 0 ].legs[ 0 ];
				makeMarker( leg.start_location, icons.start, "Local de Taller" );
				directionsDisplay.setDirections(response);
				//mostramos solo una ves el punto de inicio que es el del local
				if(inicial){
					icons={start: new google.maps.MarkerImage(
						   // URL
						   '',
						   // (width,height)
						   new google.maps.Size( 44, 32 ),
						   // The origin point (x,y)
						   new google.maps.Point( 0, 0 ),
						   // The anchor point (x,y)
						   new google.maps.Point( 22, 32 )
						  )}
					inicial=false
				}
			}
		});
	}
}

function makeMarker( position, icon, title ) {
	 new google.maps.Marker({
	  position: position,
	  map: map,
	  icon: icon,
	  title: title
	 });
}
