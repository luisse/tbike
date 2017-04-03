var geocoder;var map;var bounds;var markers=[];var LatLngList=[];var infowindow;var config={apiKey:"AIzaSyBUqT8fwSZHsvLzbAHQaHH-w9EJIAUO3fk",authDomain:"tst-taxiar.firebaseapp.com",databaseURL:"https://tst-taxiseguro.firebaseio.com",};firebase.initializeApp(config);$(document).ready(function(){IniciarEventos()});var initialTimeLeft=30;var timeLeft=initialTimeLeft;var kpi_json='';var panic_json='';var kpi_selected=0;function IniciarEventos(){firebase.database().ref('firebase/panic').on('value',function(data){refreshNow()});get_kpi();get_panic();initmaps();setInterval(decrementTimer,1000);$('#alert').hide(1);$('#btn_refrescar').click(refreshNow);$('#link_kpi_ocupado').click(function(){kpi_selected=1;showDetails();return!1});$('#link_alarm').click(function(){kpi_selected=2;showDetails();return!1});livesession()}
function initmaps(){geocoder=new google.maps.Geocoder();var latlng=new google.maps.LatLng(-26.816750,-65.226801);var mapOptions={zoom:16,maxZoom:18,center:latlng}
map=new google.maps.Map(document.getElementById('map-canvas'),mapOptions)}
function viewmapscenter(){var bounds=new google.maps.LatLngBounds();for(var i=0;i<LatLngList.length;i++){bounds.extend(LatLngList[i])}
map.fitBounds(bounds)}
function MapsShow(lat,lng,carcode,descriptioncar){var ultpos=new google.maps.LatLng(lat,lng)
var marker=new google.maps.Marker({position:new google.maps.LatLng(lat,lng),icon:'https://taxiar-files.s3.amazonaws.com/img/gpscar.png',map:map,title:carcode+' - '+descriptioncar,carcode:carcode});var content=carcode+' - '+descriptioncar
var infowindow=new google.maps.InfoWindow()
markers.push(marker)
LatLngList.push(new google.maps.LatLng(lat,lng))
google.maps.event.addListener(marker,'click',(function(marker,content,infowindow){return function(){infowindow.setContent(content);infowindow.open(map,marker)}})(marker,content,infowindow))}
function setMapOnAll(map,carcode){for(var i=0;i<markers.length;i++){if(typeof(carcode)!='undefined'){if(markers[i].carcode==carcode){markers[i].setMap(map)}}else{markers[i].setMap(map)}}}
function refreshNow(){timeLeft=1}
function decrementTimer(){timeLeft--;$('#time_left').html('<span>Actualizando información en '+timeLeft+'</span>');if(timeLeft<=0){get_kpi();get_panic();timeLeft=initialTimeLeft}}
function showDetails(){if(kpi_selected==1){view_kpi('kpi_ocupado_list','success','Ocupado');return}
if(kpi_selected==2){view_panic('kpi_ocupado_list','danger','Alarma Activada');return}}
function show_live_panic(){get_panic();setInterval(show_live_panic,10000)}
function view_panic(data,css_class,kpi_name){$('#view_detail_kpi').html('<thead> <tr> <th>Apellido y Nombre</th><th>Teléfono</th> <th>Patente</th> <th>Licencia</th> </tr>');$('#detail_kpi').html('<h3><span class="label label-'+css_class+'">'+kpi_name+'</span></h3>');var items=[];$.each(panic_json.panics,function(key,val){var row=$("<tr />");$("#view_detail_kpi").append(row);row.append($("<td>"+val.apellido+", "+val.nombre+"</td>"));row.append($("<td>"+val.phonenumber+"</td>"));row.append($("<td>"+val.carcode+"</td>"));row.append($("<td>"+val.licencenumber+"</td>"));MapsShow(val.lat,val.lng,val.carcode,val.licencenumber)});viewmapscenter()}
function view_kpi(data,css_class,kpi_name){$('#view_detail_kpi').html('<thead> <tr> <th>Apellido y Nombre</th> <th>Patente</th> <th>Licencia</th> <th>Ver en Mapa</th> </tr>');$('#detail_kpi').html('<h3><span class="label label-'+css_class+'">'+kpi_name+'</span></h3>');var items=[];$.each(kpi_json[data],function(key,val){var row=$("<tr />");$("#view_detail_kpi").append(row);row.append($("<td>"+val.apellido+", "+val.nombre+"</td>"));row.append($("<td>"+val.carcode+"</td>"));row.append($("<td>"+val.licencenumber+"</td>"));row.append($("<td>"+generateGoogleMapLink(val.carcode,val.lat,val.lng)+"</td>"))})}
function generateGoogleMapLink(label,lat,lng){if(!label)return;if(!lat)return;if(!lng)return;var link='http://maps.google.com/?q='+label+'@'+lat+','+lng;var htmllink='<a href="'+link+'" target="_blank">Ver</a>';return htmllink}
function get_kpi(){var is_test=!1;var myUrl='/kpis/kpis_count.json?is_test='+is_test;$('#alert').hide(1);$('#pingpong').html("<span class='label label-alert'>Enviando</span>");$.ajax({url:myUrl,type:'get',dataType:'json',success:function(data){if(data){$('#pingpong').html("<span class='label label-success'>Recibido</span>");$('#kpi_libre').html(data.kpi_libre);$('#kpi_ocupado').html(data.kpi_ocupado);$('#kpi_en_camino').html(data.kpi_en_camino);$('#kpi_fuera_de_servicio').html(data.kpi_fuera_servicio);kpi_json=data;setTimeout(function(){$('#pingpong').html("")},2500)}
showDetails()},error:function(){$('#alert').show(1);$('#msg').html('&nbsp;Error con la conexion al servidor. Verifique su conexión al servidor')}})}
function get_panic(){var myUrl='/taxpanics/getpanic.json?is_test='+test;setMapOnAll(null);$.ajax({url:myUrl,type:'get',dataType:'json',success:function(data){if(data){$('#panico_activado').html(data.total_panics);if(parseInt(data.total_panics)>0){playSound();kpi_selected=2}
panic_json=data}
showDetails()},error:function(){$('#alert').show(1);$('#msg').html('&nbsp;Error con la conexion al servidor. Verifique su conexión al servidor')}})}
function playSound(filename){document.getElementById("sound").innerHTML='<audio autoplay="autoplay">\
																<source src="/files/sound/alert.mp3" type="audio/mpeg" />\
																<source src="/files/sound/alert.mp3.ogg" type="audio/ogg" />\
																<embed hidden="true" autostart="true" loop="false" src="/files/sound/alert.mp3" />\
																</audio>'}
