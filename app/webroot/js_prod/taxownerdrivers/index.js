$(document).ready(function(){IniciarEventos()});function IniciarEventos(){showmessage()
$('#modalview').on('hidden.bs.modal',function(){$('#content').empty();$(this).data('bs.modal',null)})
reloadList(rlink)}
function showmessage(){var message=$('#message').text();if(typeof(message)!='undefined'&&message.trim()!=''){$().toastmessage('showToast',{text:message,sticky:!1,position:'top-right',type:'success',closeText:'',close:function(){}})}}
function viewPeople(id){$('#modalview').modal({show:!0,remote:'/peoples/view/'+id});return!1}
function reloadList(link){$('#cargandodatos').show(1)
var serialize=''
$.post(link,serialize,function(data){$('#listtaxownerdriver').html(data);var divPaginationLinks='#listtaxownerdriver'+" .pagination a,.sort a";$(divPaginationLinks).click(function(){var thisHref=$(this).attr("href");reloadList(thisHref);return!1})}).always(function(){$('#cargandodatos').hide(1)})}