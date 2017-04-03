var geocoder;var map;var infowindow;var localgps;var inicial=!0;var markers=[];var taxownercars=[];var LatLngList=[];var ant_lat;var ant_lng;var carcode;var descriptioncar;var icons={start:new google.maps.MarkerImage('https://taxiar-files.s3.amazonaws.com/img/workoffice.png',new google.maps.Size(44,32),new google.maps.Point(0,0),new google.maps.Point(22,32))}
$(document).ready(function(){IniciarEventos()});function IniciarEventos(){geocoder=new google.maps.Geocoder();var latlng=new google.maps.LatLng(-26.816750,-65.226801);var mapOptions={zoom:16,maxZoom:18,center:latlng}
map=new google.maps.Map(document.getElementById('map-canvas'),mapOptions);getpoint()
$('#cancelar').click(function(){window.history.back()})}
function LocalizeLocal(){geocoder.geocode({'address':'Argentina,Tucuman,San Miguel de Tucuman'},function(results,status){if(status==google.maps.GeocoderStatus.OK){localgps=results[0].geometry.location}else{alert('No se pudo determinar la direccion del Local. Disculpe las molestias')}})}
function getIconName(descriptioncar){var urlBase='https://taxiar-files.s3.amazonaws.com/img/'
if(descriptioncar=='Libre')
{return urlBase+'pin_libre.png'}
if(descriptioncar=='Fuera de servicio')
{return urlBase+'pin_fuera_de_servicio.png'}
if(descriptioncar=='Ocupado')
{return urlBase+'pin_ocupado.png'}
if(descriptioncar=='En camino')
{return urlBase+'pin_en_camino.png'}}
function MapsShow(lat,lng,carcode,descriptioncar){var marker=new google.maps.Marker({position:new google.maps.LatLng(lat,lng),icon:getIconName(descriptioncar),map:map,title:carcode+' - '+descriptioncar,carcode:carcode});var content=carcode+' - '+descriptioncar;var infowindow=new google.maps.InfoWindow();markers.push(marker)
LatLngList.push(new google.maps.LatLng(lat,lng));google.maps.event.addListener(marker,'click',(function(marker,content,infowindow){return function(){infowindow.setContent(content);infowindow.open(map,marker)}})(marker,content,infowindow))}
function makeMarker(position,icon,title){new google.maps.Marker({position:position,map:map,icon:icon,title:title})}
function getpoint(){$.ajax({url:'/kpis/kpis_count.json?is_test=false',type:'get',dataType:'json',success:function(data){$.each(data,function(key,val){if($.isArray(val)){$.each(val,function(k,v){MapsShow(v.lat,v.lng,v.carcode,v.status)})}});viewmapscenter()}})}
function viewmapscenter(){var bounds=new google.maps.LatLngBounds();for(var i=0;i<LatLngList.length;i++){bounds.extend(LatLngList[i])}
map.fitBounds(bounds)}