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
*    @Fecha 23/11/2013
*    @use Librerias de AJAX para inicio de sesion
*/
//inicializamos eventos y procesos desde el DOM
var geocoder;
var map;

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
	MapsShow()
	MostrarPosicionActual()
	$('#cancelar').click(function(){window.history.back()})
}

function MapsShow(){
	var infowindow = new google.maps.InfoWindow({
		  content: infocliente,
		  maxWidth: 500
	  });
  geocoder.geocode({'address':direccion},function(results,status){
	if(status == google.maps.GeocoderStatus.OK){
		map.setCenter(results[0].geometry.location);
		var marker= new google.maps.Marker({map:map,
					position:results[0].geometry.location,
					icon: '../../img/house.png', 
					title:'Ubicación de Envió'
			});
		  google.maps.event.addListener(marker, 'click', function() {
			infowindow.open(map,marker);
		  });			
	}else{
		alert('No se pudo determinar la direccion. Disculpe las molestias');
	}
   });
}

function MostrarPosicionActual(){
	if(navigator.geolocation){
		navigator.geolocation.getCurrentPosition(agregarUbicacionActual,showError);
	}else{
		alert('No se pudo establecer la ubicación. El track del GPS no se realizara');
	}	
}

function agregarUbicacionActual(position){
	var mapOptions = {
			zoom: 16,
			center: new google.maps.LatLng(position.coords.latitude, position.coords.longitude ),
			mapTypeId: google.maps.MapTypeId.ROADMAP
			};
	//var ultpos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude)			
	var marker = new google.maps.Marker({ 
		position: new google.maps.LatLng(position.coords.latitude,position.coords.longitude), 
           icon: '../../img/gps_blue.png', 
           map: map,     
           title: 'Ubicación Actual'
    }); 
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