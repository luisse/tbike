var geocoder;var map;var gl_lat;var gl_lng;var idcancelpedido
var idstatusorder
var idubication
var idreloj
var markers=[]
var LatLngList=[]
var centerone=!1
var newData=[];var cancel;var callto;var preferences='';var carcode;var taxownercar_id;var descriptioncar;var ant_lat;var ant_lng;var gl_ref=new Firebase("https://tst-taxiseguro.firebaseio.com/");var gl_rmk='';var gl_picture='';var gl_firstname='';var gl_secondname='';$(document).ready(function(){IniciarEventos()});function IniciarEventos(){geocoder=new google.maps.Geocoder();MostrarPosicionActual()
$('#takeacar').click(function(){preferences=''
$("input:checkbox:checked").each(function(){preferences=preferences+$(this).val()+','});createorder()})
$('#destino').hide(1)
$('#saveplace').click(function(){saveplace()})
$('#cancelplace').click(function(){$('#destino').hide(1)
$('#takeforms').show(1)})
myplaces()
firebaspush()
$('#listadopedidos').hide(1)}
function MostrarPosicionActual(){if(navigator.geolocation){var options={enableHighAccuracy:!0,timeout:5000,maximumAge:0};navigator.geolocation.getCurrentPosition(agregarUbicacionActual,showError,options)}else{$('#takeacar').attr('disabled',!0)
$().toastmessage('showToast',{text:'No se pudo establecer la ubicación. El track del GPS no se realizara por lo tanto no puede realizar un pedido en este momento',sticky:!1,position:'top-right',type:'error',closeText:'',close:function(){}})}}
function agregarUbicacionActual(position){if(typeof(position)!='undefined'){var mapOptions={zoom:16,center:new google.maps.LatLng(position.coords.latitude,position.coords.longitude),mapTypeId:google.maps.MapTypeId.ROADMAP,};map=new google.maps.Map(document.getElementById('map-canvas'),mapOptions);var marker=new google.maps.Marker({position:new google.maps.LatLng(position.coords.latitude,position.coords.longitude),icon:'https://taxiar-files.s3.amazonaws.com/img/gps_blue.png',map:map,title:'Ubicación Actual',draggable:!0});getAddress(position.coords.latitude,position.coords.longitude)
gl_lat=position.coords.latitude
gl_lng=position.coords.longitude
google.maps.event.addListener(marker,'dragend',function(){position=marker.getPosition()
gl_lat=position.lat()
gl_lng=position.lng()
getAddress(position.lat(),position.lng())});LatLngList.push(new google.maps.LatLng(gl_lat,gl_lng))}}
function showError(error)
{switch(error.code)
{case error.PERMISSION_DENIED:error_msg="El usuario Denego el acceso para localización"
break;case error.POSITION_UNAVAILABLE:error_msg="La información de la localización es invalida"
break;case error.TIMEOUT:error_msg="El tiempo de para localización demoro demasiado tiempo"
break;case error.UNKNOWN_ERROR:error_msg="No se pudo determinar el error de localización"
break}
if(error_msg!=''){$('#takeacar').attr('disabled',!0)
$().toastmessage('showToast',{text:error_msg,sticky:!1,position:'top-right',type:'error',closeText:'',close:function(){}})}}
function getAddress(lat,lon){var latlng=new google.maps.LatLng(lat,lon);error='';geocoder=new google.maps.Geocoder();geocoder.geocode({"latLng":latlng},function(results,status)
{if(status==google.maps.GeocoderStatus.OK){if(results[0]){if(typeof(results[0].address_components[0].long_name)!='undefined'&&typeof(results[0].address_components[1].short_name)!='undefined'){direccion=results[0].address_components[1].short_name+' '+results[0].address_components[0].long_name}else{direccion=results[0].formatted_address}
$('#TaxorderDirectiodetails').val(direccion)}
else error="No se ha podido obtener ninguna dirección en esas coordenadas."}
else{if(status=="OVER_QUERY_LIMIT"){setTimeout(function(){console.log('A la espera')},3000)}else{error="El Servicio de Codificación Geográfica ha fallado con el siguiente error: "+status}}});if(error!=''){$().toastmessage('showToast',{text:error,sticky:!1,position:'top-right',type:'error',closeText:'',close:function(){}})}}
function createorder(){markers=[];taxownercar_id=null;carcode=null;descriptioncar=null;$.ajax({url:'/taxorders/neworder.json',type:'post',data:{key:glb_k,lat:gl_lat,lng:gl_lng,directiodetails:$('#TaxorderDirectiodetails').val(),travelto:$('#TaxorderTravelto').val(),preference:preferences},dataType:'json',success:function(data){$.each(data,function(key,val){if(val.error!=''){$().toastmessage('showToast',{text:val.error,sticky:!1,position:'top-right',type:'error',closeText:'',close:function(){}})}else{$('#takeforms').hide(10)
var fObj=new Date();$('#pedidos').html('<a class="list-group-item"><i class="fa fa-cog fa-spin"></i>&nbsp;Procesando pedido...<span class="pull-right text-muted small"><button title="Cancelar pedido" type="button" class="btn btn-danger btn-circle btn-sm" id="cancelpedido"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></span></a>'+'<a class="list-group-item"><i class="fa fa-map-marker"></i>&nbsp;Ubicación actual:<span class="pull-right text-muted small">'+$('#TaxorderDirectiodetails').val()+'</span></a>'+'<a class="list-group-item"><i class="fa fa-clock-o"></i>&nbsp;Fecha pedido:<span class="pull-right text-muted small">'+fObj.getHours()+':'+fObj.getMinutes()+':'+fObj.getSeconds()+'</span></a>'+'<a class="list-group-item"><i class="fa fa-clock-o fa-spin"></i>&nbsp;Tiempo Transcurrido:<span class="pull-right text-muted small"><p id="timeview">00:00:00</p></span></a>')
$('#takeacar').attr('disabled',!0)
$('#listadopedidos').show(1)
$('#cancelpedido').click(function(){cancelorders()})
var entry={ViewCronogo:'#timeview',ObjectButtonStop:'#start_stop'};Cronogo.initclock(entry);Cronogo.pauseClock();idcancelpedido=setTimeout("cancelpedido()",300000)}})}}).error(function(){$().toastmessage('showToast',{text:'No se pudo ejecutar el proceso de pedidos',sticky:!1,position:'top-right',type:'error',closeText:'',close:function(){}})})}
function getstatusorder(){$.ajax({url:'/taxorders/getmyorderstate.json',type:'post',data:{key:glb_k},dataType:'json',success:function(data){if(data.records.Taxorder.state==2){$().toastmessage('showToast',{text:'Orden Cancelada',sticky:!1,position:'top-right',type:'error',closeText:'',close:function(){}});$('#listadopedidos').hide(1)
$('#takeforms').show(10)
$('#takeacar').attr('disabled',!1)
cancel=!0
sendmsgcarcancel()
setMapOnAll(null,null);deleteinterval()
Cronogo.pauseClock()}else{if(data.records.Taxorder.state==1){getdriverinfo(data.records.Taxorder.taxturn_id)}}}}).error(function(){$().toastmessage('showToast',{text:'No se pudo ejecutar el proceso de consulta de estado de orden',sticky:!1,position:'top-right',type:'error',closeText:'',close:function(){}})})}
function getdriverinfo(taxturn_id){$.ajax({url:'/taxownerdrivers/getdriverinfo.json',type:'post',data:{key:glb_k,taxturn_id:taxturn_id},dataType:'json',success:function(data){clearInterval(idstatusorder)
viewdata(data)}}).error(function(){$().toastmessage('showToast',{text:'No se pudo ejecutar el proceso de consulta de estado de orden',sticky:!1,position:'top-right',type:'error',closeText:'',close:function(){}})})}
function getubicationcar(){$.ajax({url:'/taxubications/getubication.json',type:'post',data:{key:glb_k,id:taxownercar_id},dataType:'json',success:function(data){if(typeof(data)!='undefined'&&ant_lat!=data.lat&&ant_lng!=data.lng){ant_lat=data.lat;ant_lng=data.lng;setMapOnAll(null,carcode);MapsShow(data.lat,data.lng,carcode,descriptioncar)
viewmapscenter()}}}).error(function(){$().toastmessage('showToast',{text:'No se pudo ejecutar el proceso de consulta de estado de orden',sticky:!1,position:'top-right',type:'error',closeText:'',close:function(){}})})}
function cancelpedido(){$().toastmessage('showToast',{text:'No se hicieron carreras para el pedido intente nuevamente mas tarde.',sticky:!1,position:'top-right',type:'error',closeText:'',close:function(){}});cancelorders()}
function cancelorders(){$.ajax({url:'/taxorders/taxordercancel.json',type:'post',data:{key:glb_k},dataType:'json',success:function(data){$.each(data,function(key,val){if(val.error!=''){$().toastmessage('showToast',{text:val.error,sticky:!1,position:'top-right',type:'error',closeText:'',close:function(){}})}else{closeActivityRequest()
sendmsgcarcancel()}})}}).error(function(){$().toastmessage('showToast',{text:'No se pudo ejecutar el proceso de pedidos',sticky:!1,position:'top-right',type:'error',closeText:'',close:function(){}})})}
function closeActivityRequest(){$('#listadopedidos').hide(1)
$('#takeforms').show(10)
$('#takeacar').attr('disabled',!1)
cancel=!0
taxownercar_id=null;carcode=null;descriptioncar=null;gl_rmk='';gl_picture='';gl_firstname='';gl_secondname='';setMapOnAll(null,null);deleteinterval()
Cronogo.pauseClock()}
function sendmsgcarcancel(){gl_ref.child('firebase').child('neworder-get').child(glb_k).on('value',function(snapshot){if(cancel==!0){cancel=!1;data=snapshot.val()
gl_ref.child('firebase').child('neworder-get').child(glb_k).remove()
gl_ref.child('firebase').child('neworder-get').child(gl_rmk)}})}
function firebaspush(){gl_ref.child('firebase').child('carinfo-get').child(glb_k).remove()
gl_ref.child('firebase').child('driverinfo-get').child(glb_k).remove()
gl_ref.child('firebase').child('cancel-order').child(glb_k).remove()
gl_ref.child('firebase').child('driverinfo-get').child(glb_k).on('value',function(snapshot){data=snapshot.val()
if(data!=null&&typeof(data)!='undefined'){if(typeof(data.firstname)!='undefined')
gl_firstname=data.firstname
if(typeof(data.secondname)!='undefined')
gl_secondname=data.secondname
if(typeof(data.picture)!='undefined'){gl_picture=data.picture}}});gl_ref.child('firebase').child('carinfo-get').child(glb_k).on('value',function(snapshot){viewdata(snapshot.val())});gl_ref.child('firebase').child('cancel-order').child(glb_k).on('value',function(snapshot){data=snapshot.val()})}
function viewdata(data){if(typeof(data)!='undefined'&&data!=null){taxownercar_id=data.id;carcode=data.carcode;descriptioncar=data.descriptioncar
if(data.carcode!=''){passcar=!0
deleteinterval()
$('#pedidos').html('<a class="list-group-item  list-group-item-success"><i class="fa fa-cog fa-spin"></i>&nbsp;Pedido Aceptado<span class="pull-right text-muted small"><button title="Cancelar Carrera" type="button" class="btn btn-danger btn-circle btn-sm" id="cancelpedido"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></span></a>'+'<a class="list-group-item"><img width="60px" height="60px" class="img-circle" src="'+gl_picture+'"/><span class="pull-right text-muted small">'+gl_firstname+', '+gl_secondname+'</span></a>')
$('#cancelpedido').click(function(){cancelorders()})
html=$('#pedidos').html()
$('#pedidos').html(html+'<a class="list-group-item"><i class="fa fa-taxi"></i>&nbsp;Patente Automovil:<span class="pull-right text-muted small">'+data.carcode+'</span></a>'+'<a class="list-group-item"><i class="fa fa-taxi"></i>&nbsp;Licencia Nro:<span class="pull-right text-muted small">'+data.registerpermision+'</span></a>'+'<a class="list-group-item"><i class="fa fa-taxi"></i>&nbsp;Detalle:<span class="pull-right text-muted small">'+data.descriptioncar+'</span></a>')
$('#cancelpedido').click(function(){cancelorders()})
gl_rmk=data.usrkey
idubication=setInterval('getubicationcar()',30000)
gl_ref.child('firebase').child('journeys-init').child(gl_rmk).on('value',function(snapshot){if(snapshot.val()!=null&&snapshot.val()!=''&&typeof(snapshot.val())!='undefined'){closeActivityRequest()
$().toastmessage('showToast',{text:'Ya se encuentra el movil en la puerta',sticky:!0,position:'top-center',type:'success',closeText:'',close:function(){}})}})}}}
function deleteinterval(){clearInterval(idcancelpedido)
clearInterval(idstatusorder)
clearInterval(idubication)}
function tracecar(carcode){if(typeof(carcode)!='undefined'){gl_ref.child('firebase').child('carubication-get').child(gl_rmk).remove()
gl_ref.child('firebase').child('carubication-get').child(gl_rmk).on('value',function(snapshot){data=snapshot.val()
if(data!=null){if(typeof(data.Taxubication.lat)!='undefined'){setMapOnAll(null,data.Taxubication.carcode);MapsShow(data.Taxubication.lat,data.Taxubication.lng,data.Taxubication.carcode,data.Taxubication.descriptioncar)
viewmapscenter()}else{}}})}}
function MapsShow(lat,lng,carcode,descriptioncar){var ultpos=new google.maps.LatLng(lat,lng)
var marker=new google.maps.Marker({position:new google.maps.LatLng(lat,lng),icon:'https://taxiar-files.s3.amazonaws.com/img/gpscar.png',map:map,title:carcode+' - '+descriptioncar,carcode:carcode});var content=carcode+' - '+descriptioncar
var infowindow=new google.maps.InfoWindow()
markers.push(marker)
LatLngList.push(new google.maps.LatLng(lat,lng))
google.maps.event.addListener(marker,'click',(function(marker,content,infowindow){return function(){infowindow.setContent(content);infowindow.open(map,marker)}})(marker,content,infowindow))}
function setMapOnAll(map,carcode){for(var i=0;i<markers.length;i++){if(typeof(carcode)!='undefined'){if(markers[i].carcode==carcode){markers[i].setMap(map)}}else{markers[i].setMap(map)}}}
function viewmapscenter(){if(!centerone){var bounds=new google.maps.LatLngBounds();for(var i=0;i<LatLngList.length;i++){bounds.extend(LatLngList[i])}
map.fitBounds(bounds)}}
function addfavplace(option){if(option==2){if($('#TaxorderTravelto').val()!=''&&typeof($('#TaxorderTravelto').val())!='undefined'){$('#destino').show(1)
$('#takeforms').hide(1)
$('#TaxorderDestino').val('')}else{$('#TaxorderTravelto').focus()
$().toastmessage('showToast',{text:'Debe Ingresar el Destino',sticky:!1,position:'top-right',type:'error',closeText:'',close:function(){}})}}
if(option==1){$('#TaxorderDestino').val('')
$('#destino').show(1)
$('#takeforms').hide(1)}
callto=option}
function saveplace(){var destino=$('#TaxorderDestino').val()
if(callto==2)
direccion=$('#TaxorderTravelto').val()
else direccion=$('#TaxorderDirectiodetails').val()
if(destino!=''&&typeof(destino)!='undefined'){$.ajax({url:'/userfavplaces/addfavplace.json',type:'post',headers:{'Security-Access-Token':glb_k,'Security-Access-PublicToken':'A33esaSP9skSjasdSfFSssEwS2IksSZxPlA4asSJ4GEW4S'},data:{lat:gl_lat,lng:gl_lng,destino:direccion,detalle:$('#TaxorderDestino').val()},dataType:'json',success:function(data){$.each(data,function(key,val){if(val.records.error.trim()!=''){$().toastmessage('showToast',{text:val.error,sticky:!1,position:'top-right',type:'error',closeText:'',close:function(){}})}else{$().toastmessage('showToast',{text:'Se Agrego la posicion a Favoritos',sticky:!1,position:'top-right',type:'success',closeText:'',close:function(){}})}})}})
$('#takeforms').show(1)
$('#destino').hide(1)}else{$('#TaxorderDestino').focus()
$().toastmessage('showToast',{text:'Debe Ingresar Descripción el Destino',sticky:!1,position:'top-right',type:'error',closeText:'',close:function(){}})}
return!1}
function myplaces(){$.ajax({url:'/userfavplaces/getfavplace.json',type:'post',headers:{'Security-Access-Token':glb_k,'Security-Access-PublicToken':'A33esaSP9skSjasdSfFSssEwS2IksSZxPlA4asSJ4GEW4S'},data:{lat:gl_lat,lng:gl_lng,destino:$('#TaxorderTravelto').val(),detalle:$('#TaxorderDestino').val()},dataType:'json',success:function(data){$.each(data,function(key,val){if(typeof(val.Userfavplace.destino)!='undefined'){if(val.Userfavplace.destino!=''&&val.Userfavplace.destino!=null)
newData.push({'destino':val.Userfavplace.destino,'detalle':val.Userfavplace.detalle})}})}}).done(function(){$("#TaxorderTravelto").typeahead({items:8,minLength:3,source:function(query,process){var result=[];for(i=0;i<newData.length;i++){if(newData[i].destino.search(query)>=0)
result.push(newData[i].destino.trim())}
return result}})})
return!1}