$(document).ready(function(){cargarEventoFilas()})
function cargarEventoFilas(){$('#cancelar').click(function(){window.history.back()})
$('#datetimepicker1').datetimepicker({locale:'es',format:"DD/MM/YYYY"});$('#datetimepicker2').datetimepicker({locale:'es',format:"DD/MM/YYYY"});fechadesde=$('#fecdesde').val()
if(typeof(fechadesde)=='undefined'||fechadesde=='')
fechaactual('fecdesde')
fechasta=$('#fechasta').val()
if(typeof(fechasta)=='undefined'||fechasta=='')
fechaactual('fechasta')
$('#modalview').on('hidden.bs.modal',function(){$('#content').empty();$(this).data('bs.modal',null)})
$('#buscar').click(function(){getorder()});showmessage()}
function showmessage(){var message=$('#message').text();if(typeof(message)!='undefined'&&message.trim()!=''){$().toastmessage('showToast',{text:message,sticky:!1,position:'top-right',type:'success',closeText:'',close:function(){}})}}
function getorder(){$.ajax({url:link+'?fecha_desde='+$('#fecdesde').val()+'&fecha_hasta='+$('#fechasta').val(),type:'get',dataType:'json',success:function(data){if(data){showOrders(data)}},error:function(){alert('Error con la conexion al servidor')}})}
function showOrders(data){$('#view_orders').html('<thead> <tr> <th>Fecha</th> <th>Origen</th> <th>Destino</th> <th>Pasajero</th>  <th>Taxista</th></tr>');var items=[];$.each(data,function(key,val){var row=$("<tr />");$("#view_orders").append(row);var taxistaapellido=val.taxistaapellido||'';var coma=taxistaapellido?',':'';var taxistanombre=val.taxistanombre||'';row.append($("<td>"+val.order_date+"</td>"));row.append($("<td>"+val.direccionorigen+"</td>"));row.append($("<td>"+val.direcciondestino+"</td>"));row.append($("<td>"+val.pasajeroapellido+", "+val.pasajeronombre+"</td>"));row.append($("<td>"+taxistaapellido+coma+taxistanombre+"</td>"))})}