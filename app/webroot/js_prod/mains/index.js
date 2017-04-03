$(document).ready(function(){IniciarEventos()});function IniciarEventos(){$('#modalview').on('hidden.bs.modal',function(){$(this).data('bs.modal',null)})
$('#viewtarorders').hide(1);getorders();getcars()}
function vieworders(){var serialize=null;$.post(rtaxorderslink,serialize,function(data){$('#viewtarorders').html(data)})}
function getorders(){$.ajax({url:'/taxorders/totalorders.json',type:'post',dataType:'json',success:function(data){$.each(data,function(key,val){if(val.Taxorder.taxorders!=''){travels
$('#travels').html(val.Taxorder.taxorders)}})}})}
function getcars(){$.ajax({url:'/taxownerscars/caractive.json',type:'post',dataType:'json',success:function(data){$.each(data,function(key,val){if(val.Taxownerscar.carsactive!=''){$('#cars').html(val.Taxownerscar.carsactive)}})}})}