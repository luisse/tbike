var geocoder;var map;var infowindow;var localgps;var inicial=!0;var markers=[];var LatLngList=[];$(document).ready(function(){IniciarEventos()})
function IniciarEventos(){$('#datetimepicker1').datetimepicker({locale:'es',format:"DD/MM/YYYY"});$('#datetimepicker2').datetimepicker({locale:'es',format:"DD/MM/YYYY"});fechaactual('fecdesde')
fechaactual('fechasta')
geocoder=new google.maps.Geocoder();var latlng=new google.maps.LatLng(-26.816750,-65.226801);var mapOptions={zoom:16,maxZoom:18,center:latlng}
map=new google.maps.Map(document.getElementById('map-canvas'),mapOptions);$('#verpuntos').click(function(){reloadList(rlink)
getpoint()})}
function MapsShow(lat,lng,carcode,descriptioncar){var marker=new google.maps.Marker({position:new google.maps.LatLng(lat,lng),icon:'https://taxiar-files.s3.amazonaws.com/img/gpscar.png',map:map,title:carcode+' - '+descriptioncar,carcode:carcode});var content=carcode+' - '+descriptioncar
var infowindow=new google.maps.InfoWindow()
markers.push(marker)
LatLngList.push(new google.maps.LatLng(lat,lng))
google.maps.event.addListener(marker,'click',(function(marker,content,infowindow){return function(){infowindow.setContent(content);infowindow.open(map,marker)}})(marker,content,infowindow))}
function makeMarker(position,icon,title){new google.maps.Marker({position:position,map:map,icon:icon,title:title})}
function setMapOnAll(map,carcode){for(var i=0;i<markers.length;i++){if(typeof(carcode)!='undefined'){if(markers[i].carcode==carcode){markers[i].setMap(map)}}else{markers[i].setMap(map)}}}
function getpoint(){$.ajax({url:'/taxorders/getmyorders.json',type:'post',data:{fechadesde:$('#fecdesde').val(),fechasta:$('#fechasta').val(),taxownerscar_id:$('#taxownerscar_id').val()},dataType:'json',success:function(data){LatLngList=[]
setMapOnAll(null);$.each(data,function(key,val){if(val.taxorder.lat!=''){MapsShow(val.taxorder.lat,val.taxorder.lng,val.Taxownerscar.carcode+'-'+val.Taxorder.travelto,val.Taxorder.date)}else{}});viewmapscenter()}})}
function viewmapscenter(){var bounds=new google.maps.LatLngBounds();for(var i=0;i<LatLngList.length;i++){bounds.extend(LatLngList[i])}
map.fitBounds(bounds)}
function reloadList(link){serialize=$('#filter').serialize()
$('#listpedidos').show(1)
$.post(link,serialize,function(data){$('#listpedidos').html(data);var divPaginationLinks='#listpedidos'+" .pagination a,.sort a";$(divPaginationLinks).click(function(){var thisHref=$(this).attr("href");reloadList(thisHref);return!1})}).always(function(){$('#cargandodatos').hide(1)})}