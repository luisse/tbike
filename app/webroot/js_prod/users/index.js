$(document).ready(function(){IniciarEventos()});function IniciarEventos(){ocultaroption(1);$('.ui-state-default').hover(function(){$(this).addClass('ui-state-hover')},function(){$(this).removeClass('ui-state-hover')});$('#buscar').click(function(){reloadList(link,1)});$('#UserGroupId').change(function(){ocultaroption($('#UserGroupId').val())})
Ajaxcargarusuarios();showmessage()}
function ocultaroption(val){$('.userfilter').hide(1);$('.radiotaxifilter').hide(1);if(val==1||val==2||val==3||val==4)
$('.userfilter').show(1);if(val==6)
$('.radiotaxifilter').show(1)}
function reloadList(rlink,tipofiltro){var serialize
serialize=$('#filteruser').serialize()
$('#cargandodatos').show(1)
$.post(rlink,serialize,function(data){$('#listusers').html(data);var divPaginationLinks='#listusers'+" .pagination a,.sort a";$(divPaginationLinks).click(function(){var thisHref=$(this).attr("href");reloadList(thisHref);return!1})}).always(function(){$('#cargandodatos').hide(1)})}
function loadPiece(href,divName){$(divName).load(href,$('#filtros').serialize(),function(){var divPaginationLinks=divName+" .pagination a,.sort a";$(divPaginationLinks).click(function(){var thisHref=$(this).attr("href");loadPiece(thisHref,divName);return!1})})}
function Ajaxcargarusuarios(){reloadList(link,0)}
function showmessage(){var message=$('#message').text();if(typeof(message)!='undefined'&&message.trim()!=''){$().toastmessage('showToast',{text:message,sticky:!1,position:'top-right',type:'success',closeText:'',close:function(){}})}}