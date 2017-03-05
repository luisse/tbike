var map;

$(document).ready(function(){
	IniciarEventos();}
);

function IniciarEventos(){

  //CLOSE AND CLEAR MODAL
	var latlng = new google.maps.LatLng(lat,lng);
  	var mapOptions = {
    		zoom: 16,
    		maxZoom:18,
    		center: latlng
  	}
  	map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

    var marker = new google.maps.Marker({
      position: new google.maps.LatLng(lat,lng),
            //icon: 'https://taxiar-files.s3.amazonaws.com/img/gpscar.png',
            map: map,
            title:'Ubicacion del Movil'
        });
    marker.setMap(map)
    $('#volveratras').click(function(){
      window.history.back()
    })
}
