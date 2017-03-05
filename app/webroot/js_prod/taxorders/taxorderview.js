$(document).ready(function(){IniciarEventos()})
function IniciarEventos(){$('#datetimepicker1').datetimepicker({locale:'es',format:"DD/MM/YYYY"});$('#datetimepicker2').datetimepicker({locale:'es',format:"DD/MM/YYYY"});fechaactual('fecdesde')
fechaactual('fechasta')
$('#verpedidos').click(function(){reloadList(link)})}
function reloadList(rlink){serialize=$('#filter').serialize()
$('#cargandodatos').show(1)
$.post(rlink,serialize,function(data){$('#listpedidos').html(data);var divPaginationLinks='#listpedidos'+" .pagination a,.sort a";$(divPaginationLinks).click(function(){var thisHref=$(this).attr("href");reloadList(thisHref);return!1})}).always(function(){$('#cargandodatos').hide(1)})}