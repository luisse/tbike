$(document).ready(function(){IniciarEventos()});function IniciarEventos(){$('.ui-state-default').hover(function(){$(this).addClass('ui-state-hover')},function(){$(this).removeClass('ui-state-hover')});$('#buscar').click(function(){reloadList(link,1)});showmessage()}
function reloadList(rlink,tipofiltro){var serialize
serialize=$('#filtercar').serialize()
$('#cargandodatos').show(1)
$.post(rlink,serialize,function(data){$('#listcars').html(data);var divPaginationLinks='#listcars'+" .pagination a,.sort a";$(divPaginationLinks).click(function(){var thisHref=$(this).attr("href");reloadList(thisHref);return!1})}).always(function(){$('#cargandodatos').hide(1)})}
function loadcars(){reloadList(link,0)}
function showmessage(){var message=$('#message').text();if(typeof(message)!='undefined'&&message.trim()!=''){$().toastmessage('showToast',{text:message,sticky:!1,position:'top-right',type:'success',closeText:'',close:function(){}})}}
function changestate(id){$.ajax({url:'/radiotaxicars/changestate.json',type:'post',dataType:'json',data:{id:id},success:function(data){if(data.message!=''){$().toastmessage('showToast',{text:data.message,sticky:!1,position:'top-right',type:'error',closeText:'',close:function(){}})}else{loadcars()}}})}