var geocoder;var map;var gl_lat;var gl_lng;var idcancelpedido
var idstatusorder
var idubication
var idreloj
var markers=[]
var LatLngList=[]
var centerone=!1
var newData=[];var gpsPoints=[];var cancel;var callto;var preferences='';var carcode;var taxownercar_id;var descriptioncar;var ant_lat;var ant_lng;var gl_rmk='';var gl_picture='';var gl_firstname='';var gl_secondname='';var directionsDisplay;var address_from_number='';var address_to_number='';var Cronogo_run=[];var crono_run=[];var config={apiKey:"AIzaSyBUqT8fwSZHsvLzbAHQaHH-w9EJIAUO3fk",authDomain:"tst-taxiseguro.firebaseapp.com",databaseURL:"https://tst-taxiseguro.firebaseio.com",};firebase.initializeApp(config);firebase.auth().signInWithCustomToken(glb_fbk).catch(function(error){newtokenjwt()});var icons={start:new google.maps.MarkerImage('https://taxiar-files.s3.amazonaws.com/img/gps_blue.png',new google.maps.Size(44,32),new google.maps.Point(0,0),new google.maps.Point(22,32))}
$(document).ready(function(){IniciarEventos()});function IniciarEventos(){$('#filter').hide(1);$('#search').click(function(){$('#filter').hide(1);getmyorders()});geocoder=new google.maps.Geocoder();directionsDisplay=new google.maps.DirectionsRenderer({suppressMarkers:!0});MostrarPosicionActual();$('#createorder').click(function(){$('#createorder').prop('disabled',!0);createorder(!1)});$('#TaxorderNumberFrom').numeric();$('#TaxorderNumberTo').numeric();$('#destino').hide(1);$('#saveplace').click(function(){saveplace()});livesession()}
function MostrarPosicionActual(){if(navigator.geolocation){var options={enableHighAccuracy:!0,timeout:5000,maximumAge:0};navigator.geolocation.getCurrentPosition(agregarUbicacionActual,showError,options)}else{$('#takeacar').attr('disabled',!0)
$().toastmessage('showToast',{text:'No se pudo establecer la ubicación. El track del GPS no se realizara por lo tanto no puede realizar un pedido en este momento',sticky:!1,position:'top-right',type:'error',closeText:'',close:function(){}})}}
function agregarUbicacionActual(position){if(typeof(position)!='undefined'){var mapOptions={zoom:16,center:new google.maps.LatLng(position.coords.latitude,position.coords.longitude),mapTypeId:google.maps.MapTypeId.ROADMAP,};map=new google.maps.Map(document.getElementById('map-canvas'),mapOptions);var marker=new google.maps.Marker({position:new google.maps.LatLng(position.coords.latitude,position.coords.longitude),icon:'https://taxiar-files.s3.amazonaws.com/img/radiotaxi_home.png',map:map,title:'Radio Taxi Ubicación',draggable:!0});getAddress(position.coords.latitude,position.coords.longitude)
gl_lat=position.coords.latitude
gl_lng=position.coords.longitude
google.maps.event.addListener(marker,'dragend',function(){position=marker.getPosition()
gl_lat=position.lat()
gl_lng=position.lng()
getAddress(position.lat(),position.lng())});LatLngList.push(new google.maps.LatLng(gl_lat,gl_lng))
markers.push(marker);autocompleteaddress();getmyorders();setInterval(function(){self.getmyorders()},50000)}}
function showError(error)
{switch(error.code)
{case error.PERMISSION_DENIED:error_msg="El usuario Denego el acceso para localización"
break;case error.POSITION_UNAVAILABLE:error_msg="La información de la localización es invalida"
break;case error.TIMEOUT:error_msg="El tiempo para localización demoro demasiado tiempo"
break;case error.UNKNOWN_ERROR:error_msg="No se pudo determinar el error de localización"
break}
if(error_msg!=''){$('#takeacar').attr('disabled',!0)
$().toastmessage('showToast',{text:error_msg,sticky:!0,position:'top-right',type:'error',closeText:'',close:function(){}})}}
function autocompleteaddress(){var defaultBounds=new google.maps.LatLngBounds(new google.maps.LatLng(-26.813394,-65.229190),new google.maps.LatLng(-26.777223,-65.234503),new google.maps.LatLng(-26.777223,-65.234503),new google.maps.LatLng(-26.778337,-65.198534),new google.maps.LatLng(gl_lat,gl_lng));var address_from=document.getElementById('TaxorderDirectiodetails');var address_to=document.getElementById('TaxorderTravelto');var options={types:['address'],componentRestrictions:{country:'ar'}};autocomplete_from=new google.maps.places.Autocomplete(address_from,options);autocomplete_from.bindTo('bounds',map);autocomplete_to=new google.maps.places.Autocomplete(address_to,options);autocomplete_to.bindTo('bounds',map)}
function getAddress(lat,lon){var latlng=new google.maps.LatLng(lat,lon);error='';geocoder=new google.maps.Geocoder();geocoder.geocode({"latLng":latlng},function(results,status)
{if(status==google.maps.GeocoderStatus.OK){if(results[0]){if(typeof(results[0].address_components[0].long_name)!='undefined'&&typeof(results[0].address_components[1].short_name)!='undefined'){direccion=results[0].address_components[1].short_name+' '+results[0].address_components[0].long_name}else{direccion=results[0].formatted_address}}
else error="No se ha podido obtener ninguna dirección en esas coordenadas."}
else{if(status=="OVER_QUERY_LIMIT"){setTimeout(function(){console.log('A la espera')},3000)}else{error="El Servicio de Codificación Geográfica ha fallado con el siguiente error: "+status}}});if(error!=''){$().toastmessage('showToast',{text:error,sticky:!1,position:'top-right',type:'error',closeText:'',close:function(){}})}}
function clearform(){$('#TaxorderDirectiodetails').val('');$('#TaxorderNumberFrom').val('');$('#TaxorderTravelto').val('');$('#TaxorderNumberTo').val('');$('#TaxorderOrderDetails').val('');$('#TaxorderDirectiodetails').focus()}
function address_convert(){var address_from=$('#TaxorderDirectiodetails').val().split(",");var address_number_from=$('#TaxorderNumberFrom').val();var address_to=$('#TaxorderTravelto').val().split(",");var address_number_to=$('#TaxorderNumberTo').val();var error_msg='';address_from_number='';address_to_number='';if(address_from.length<=0||$('#TaxorderDirectiodetails').val()==''){error_msg='Debe Ingresar la dirección de inicio de viaje'}
if((address_number_from==undefined||address_number_from=='')&&error_msg==''){error_msg='Debe Ingresar la altura del domicilio'}
if(error_msg!=''){$().toastmessage('showToast',{text:error_msg,sticky:!1,position:'top-right',type:'error',closeText:'',close:function(){}});$('#TaxorderDirectiodetails').focus();return}
address_from.forEach(function(val,index){if(index==0)val=val+' '+address_number_from;address_from_number=address_from_number+val+','});address_to.forEach(function(val,index){if(index==0)val=val+' '+address_number_to;address_to_number=address_to_number+val+','})}
function view_address_on_map(){gpsPoints=[];address_convert();var infowindow=new google.maps.InfoWindow();setMapOnAll(null,null);directionsDisplay.setDirections({routes:[]});GeocoderAddPoint(address_from_number,infowindow,!0,address_from_number);if($('#TaxorderTravelto').val()!=undefined&&$('#TaxorderTravelto').val()!=''){GeocoderAddPoint(address_to_number,infowindow,!0,address_to_number);RouteMap()}}
function setMapOnAll(map,carcode){directionsDisplay.setMap(null);for(var i=0;i<markers.length;i++){if(carcode!=undefined){if(markers[i].carcode==carcode){markers[i].setMap(map)}}else{markers[i].setMap(map)}}}
function viewmapscenter(){var bounds=new google.maps.LatLngBounds();for(var i=0;i<LatLngList.length;i++){bounds.extend(LatLngList[i])}
map.fitBounds(bounds)}
function GeocoderAddPoint(direccionget,infowindow,addpoint,content){geocoder.geocode({'address':direccionget},function(results,status){if(status==google.maps.GeocoderStatus.OK){map.setCenter(results[0].geometry.location);if(addpoint==!0){var marker=new google.maps.Marker({map:map,position:results[0].geometry.location});google.maps.event.addListener(marker,'click',(function(marker,content,infowindow){return function(){infowindow.setContent(content);infowindow.open(map,marker)}})(marker,content,infowindow));markers.push(marker);gpsPoints.push(results[0].geometry.location);RouteMap()}}else{alert('No se pudo determinar la direccion. Disculpe las molestias. Verifique los domicilios sen correctos')}})}
function RouteMap(){directionsDisplay.setMap(map);if(gpsPoints.length>1){var request={origin:gpsPoints[0],destination:gpsPoints[1],travelMode:google.maps.TravelMode.DRIVING};var directionsService=new google.maps.DirectionsService();directionsService.route(request,function(response,status){if(status==google.maps.DirectionsStatus.OK){var leg=response.routes[0].legs[0];makeMarker(leg.start_location,icons.start,"Inicio Viaje");directionsDisplay.setDirections(response);icons={start:new google.maps.MarkerImage('',new google.maps.Size(44,32),new google.maps.Point(0,0),new google.maps.Point(22,32))}}})}}
function makeMarker(position,icon,title){markers.push(new google.maps.Marker({position:position,map:map,icon:icon,title:title}))}
function createorder(resend){var lat=gl_lat='';var lng=gl_lng='';if(!resend)address_convert();if(address_from_number==undefined||address_from_number==''){$('#createorder').prop('disabled',!1);return}
geocoder.geocode({'address':address_from_number},function(results,status){if(status==google.maps.GeocoderStatus.OK){lat=results[0].geometry.location.lat();lng=results[0].geometry.location.lng()}
$.ajax({url:'/taxorders/neworder.json',type:'post',data:{key:glb_k,lat:lat,lng:lng,directiodetails:address_from_number,travelto:address_to_number,preference:preferences,order_details:$('#TaxorderOrderDetails').val()},dataType:'json',success:function(data){$.each(data,function(key,val){if(val.error!=''){$().toastmessage('showToast',{text:val.error,sticky:!1,position:'top-right',type:'error',closeText:'',close:function(){}})}else{clearform();$().toastmessage('showToast',{text:'Orden Enviada con exito',sticky:!1,position:'top-right',type:'success',closeText:'',close:function(){}});show_changed(val.order_id);getmyorders()}});$('#createorder').prop('disabled',!1)}}).error(function(){$('#createorder').prop('disabled',!1);$().toastmessage('showToast',{text:'No se pudo ejecutar el proceso de pedidos',sticky:!1,position:'top-right',type:'error',closeText:'',close:function(){}})})})}
function cancelorders(order_id){$.ajax({url:'/taxorders/taxordercancel.json',type:'post',data:{key:glb_k,order_id:order_id},dataType:'json',success:function(data){$.each(data,function(key,val){if(val.error!=''){$().toastmessage('showToast',{text:val.error,sticky:!1,position:'top-right',type:'error',closeText:'',close:function(){}})}else{getmyorders()}})}}).error(function(){$().toastmessage('showToast',{text:'No se pudo ejecutar el proceso de pedidos',sticky:!1,position:'top-right',type:'error',closeText:'',close:function(){}})})}
function newtokenjwt(){$.ajax({url:'/users/newtokenjwt.json',type:'post',dataType:'json',success:function(data){$.each(data,function(key,val){if(val.fbtoken!=''){glb_fbk=val.fbtoken;firebase.auth().signInWithCustomToken(glb_fbk).catch(function(error){})}})}}).error(function(){$().toastmessage('showToast',{text:'No se pudo ejecutar el proceso para recuperar permisos de base de datos.',sticky:!1,position:'top-right',type:'error',closeText:'',close:function(){}})})}
function getmyorders(){crono_run=[];$.ajax({url:'/taxorders/myorders.json',type:'post',data:{from:$('#TaxorderFrom').val(),to:$('#TaxorderTo').val(),state:$('#TaxorderState').val()},dataType:'json',success:function(data){itemsview=''
$.each(data,function(key,val){if(val.date!=undefined){var firstname=val.firstname==undefined?'':val.firstname;var secondname=val.secondname==undefined?'':val.secondname;var picture=val.picture==undefined?'/img/user_not.jpeg':val.picture;var date=val.date==undefined?'':val.date;var directiodetails=val.directiodetails==undefined?'':val.directiodetails.split(',');var travelto=val.travelto==undefined?'':val.travelto.split(',');var nomap=firstname==''||firstname==undefined?'':firstname+', '+secondname;var label_css='';var label_text='';var bt_accept='';var bt_cancel='';switch(val.state){case 0:label_css='danger';label_text='En Espera';bt_accept='<button id="btn_refrescar" class="btn btn-success btn-xs" onclick="resend_order('+val.id+',\''+val.directiodetails+'\',\''+val.travelto+'\')"><i class="fa fa-reply fa-fw"></i>&nbsp;Reenviar Pedido</button>';bt_cancel='<button id="btn_refrescar" class="btn btn-danger btn-xs" onclick="cancelorders('+val.id+')"><i class="fa fa-times fa-fw"></i>&nbsp;Cancelar Pedido</button>';fecha=retornaFechaHora(val.date);crono_run.push({date:fecha,id:val.id,state:val.state});break;case 1:label_css='success';label_text='Aceptado';break;case 2:label_css='danger';label_text='Cancelado';break;case 3:label_css='danger';label_text='Candelado por el Taxista'}
itemsview=itemsview+'<li class="list-group-item clearfix">\
																				<table class=".table-striped">\
																				  <tr class="success">\
																					<td width="70px" rowspan="5">\
																					 <img width="60px" height="60px" alt="'+nomap+'" class="img-circle" src="'+picture+'">\
																					 </td>\
																					</tr>\
																					<tr  class="success">\
																						<td  width="100px"><strong>Chofer:</strong></td>\
																						<td>'+nomap+'</td>\
																					</tr>\
																					<tr  class="success">\
																						<td width="100px"><strong>Viaje Desde:</strong></td>\
																						<td>'+directiodetails[0]+'</td>\
																					</tr>\
																					<tr  class="success">\
																						<td width="100px"><strong>Viaje Hasta:</strong></td>\
																						<td>'+travelto[0]+'</td>\
																					</tr>\
																					<tr  class="success">\
																						<td width="100px"><strong>Fecha Pedido:</strong></td>\
																						<td>'+retornaFechaHora(date).format('dd/mm/yyyy HH:MM:ss')+'</td>\
                                            <td>&nbsp;</td>\
																						<td><strong><span id="timeview'+val.id+'"></span></strong></td>\
																					</tr>\
																					<tr>\
																					<td><span class="label label-'+label_css+'">'+label_text+'</td>\
																					<td>'+bt_accept+'</td>\
																					<td>'+bt_cancel+'</td>\
																					</tr>\
																				</table>\
																				</li>'}});$('#listpedidos').html(''+itemsview+'')
init_crono()}}).error(function(){$().toastmessage('showToast',{text:'No se pudo ejecutar el proceso para recuperar las ordenes',sticky:!1,position:'top-right',type:'error',closeText:'',close:function(){}})})}
function init_crono(){var cron;var time_aux=new Date();var time_now=new Date();var time_old=new Date();var cronos=[];crono_run.forEach(function(val,index){time_aux.setTime(0);time_aux.setHours(0,0,0);time_aux.setTime(time_now.getTime()-val.date.getTime());ls_seconds=(time_aux.getSeconds().toString());ls_minutes=(time_aux.getMinutes().toString());ls_hours=(time_aux.getHours().toString());if(ls_hours.length<=1)ls_hours='0'+ls_hours;if(ls_minutes.length<=1)ls_minutes='0'+ls_minutes;if(ls_seconds.length<=1)ls_seconds='0'+ls_seconds;$('#timeview'+val.id).text('00:'+ls_minutes+':'+ls_seconds)})}
function get_car_active(){$.ajax({url:'/kpis/kpis_count.json?is_test=false',type:'get',dataType:'json',success:function(data){$.each(data,function(key,val){if($.isArray(val)){$.each(val,function(k,v){MapsShow(v.lat,v.lng,v.licencenumber+' - '+v.apellido+', '+v.nombre,v.status)})}});viewmapscenter()}})}
function MapsShow(lat,lng,carcode,descriptioncar){var marker=new google.maps.Marker({position:new google.maps.LatLng(lat,lng),icon:getIconName(descriptioncar),map:map,title:carcode+' - '+descriptioncar,carcode:carcode});var content=carcode+' - '+descriptioncar;var infowindow=new google.maps.InfoWindow();markers.push(marker)
LatLngList.push(new google.maps.LatLng(lat,lng));google.maps.event.addListener(marker,'click',(function(marker,content,infowindow){return function(){infowindow.setContent(content);infowindow.open(map,marker)}})(marker,content,infowindow))}
function getIconName(descriptioncar){var urlBase='https://taxiar-files.s3.amazonaws.com/img/'
if(descriptioncar=='Libre')
{return urlBase+'pin_libre.png'}
if(descriptioncar=='Fuera de servicio')
{return urlBase+'pin_fuera_de_servicio.png'}
if(descriptioncar=='Ocupado')
{return urlBase+'pin_ocupado.png'}
if(descriptioncar=='En camino')
{return urlBase+'pin_en_camino.png'}}
function show_changed(order_id){firebase.database().ref('firebase/orders/'+order_id).on('child_added',function(data){var ref=data.ref.parent.toString();var ref_parse=ref.split('/');getmyorders()})}
function resend_order($order_id,order_from,order_to){cancelorders();address_from_number=order_from;address_to_number=order_to;createorder(!0)}
function view_filter(){$('#filter').show(1)}