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
*    @Fecha 02/09/2014
*    @use Librerias de AJAX para inicio de sesion
*/

var geocoder;
var map;
var usermarker;

$(document).ready(function(){
	IniciarEventos();}
);


function IniciarEventos(){
	$('#BicicletareparamoClinomape').attr('readonly',true)
	$('#BicicletareparamoLatitude').attr('readonly',true)
	$('#BicicletareparamoLongitude').attr('readonly',true)
	MostrarPosicion()
	$('#guardar').click(guardardatos)
	$('#gpsubi').click(ubicarmapa)
	$('#cancelar').click(function(){window.history.back()})
}

function guardardatos(){
	var lat=$('#BicicletareparamoLatitude').val()
	var lng=$('#BicicletareparamoLongitude').val()
	if((typeof(lat)=='undefined' || lat=='') ||
		(typeof(lng)=='undefined' || lng=='')){
		alert('Debe Ingresar latitud y longitud');
	}else{
		$('form#BicicletareparamoGetlocalizeForm').submit()
	}
}

function MostrarPosicion(){
	if(navigator.geolocation){
		navigator.geolocation.getCurrentPosition(ShowPosition,showError);
	}else{
		alert('No se pudo establecer la ubicación. El track del GPS no se realizara');
	}	
}

function ShowPosition(position){
  if(navigator.onLine){
  	geocoder = new google.maps.Geocoder();
	 //Set the height of the div containing the Map to rest of the screen
  		if(clat != 0 && clng != 0){
			var mapOptions = {
					zoom: 16,
					center: new google.maps.LatLng(clat, clng),
					mapTypeId: google.maps.MapTypeId.ROADMAP
					};
					$('#BicicletareparamoLatitude').val(clat)
					$('#BicicletareparamoLongitude').val(clng)
  			
  		}else{
			if(navigator.geolocation){
					var mapOptions = {
										zoom: 16,
										center: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
										mapTypeId: google.maps.MapTypeId.ROADMAP
										};
					$('#BicicletareparamoLatitude').val(position.coords.latitude)
					$('#BicicletareparamoLongitude').val(position.coords.longitude)
										
			}else{
					//Argentina por defecto
					$('#BicicletareparamoLatitude').val('-26.816750')
					$('#BicicletareparamoLongitude').val('-65.226801')
					var latlng = new google.maps.LatLng(-26.816750, -65.226801);
					var mapOptions = {
									zoom: 16,
									center: latlng
									}	
			}
  		}	
		map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);	
		//Permite guardar la posición seleccionada por el usuario
		google.maps.event.addListener(map, 'click', function(event) {
			if(typeof(usermarker) !='undefined') usermarker.setMap(null);
			usermarker = new google.maps.Marker({
					position: event.latLng,
					
					map: map
					})
			$('#BicicletareparamoLatitude').val(event.latLng.lat())
			$('#BicicletareparamoLongitude').val(event.latLng.lng())
		  });		
		  
		//Ubicación actual
		if(clat != 0 && clng!= 0){
			var marker = new google.maps.Marker({
				position: new google.maps.LatLng(clat, clng),
			icon: '../../img/house.png', 
			map: map,    
			title: 'Punto Inicial GPS'          
			});
			var infowindow = new google.maps.InfoWindow({
			  content: infocliente,
			  maxWidth: 500
			});
			google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map,marker);
			  });		
			map.setCenter(marker.getPosition());
		}
	}else{
		alert('No existe conexión a internet no se muestran los mapas')
	}
}

function ubicarmapa() {
	  var address = $('#BicicletareparamoUbicacionmanual').val()
	  geocoder.geocode( { 'address': address}, function(results, status) {
	    if (status == google.maps.GeocoderStatus.OK) {
	      map.setCenter(results[0].geometry.location);
	      var marker = new google.maps.Marker({
	          map: map,
	          position: results[0].geometry.location
	      });
	    } else {
	      alert('No se pudo ubicar el mapa por el siguiente motivo: ' + status);
	    }
	  });
}


function GoogleMapsRun(){
	MapsShow()
	$('#cancelar').click(function(){window.history.back()})
}


function showError(error)
  {
  switch(error.code) 
    {
    case error.PERMISSION_DENIED:
      alert("El usuario Denego el acceso para localización")
      break;
    case error.POSITION_UNAVAILABLE:
      alert("La información de la localización es invalida")
      break;
    case error.TIMEOUT:
      alert("El tiempo de para localización demoro demasiado tiempo")
      break;
    case error.UNKNOWN_ERROR:
      alert("No se pudo determinar el error de localización")
      break;
    }
  }
