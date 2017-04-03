function mensaje(ps_mensage,ps_title,funcion){$("#mensaje").text(ps_mensage)
$('#modalbox').modal()}
function alerta(ps_mensage,ps_title,funcion){if($("#flash_notice")=='undefined')return!1
if(ps_mensage!=''){$("#flash_notice").text(ps_mensage)}
$("#flash_notice").attr('title',ps_title)
$("#flash_notice").dialog({position:"center",buttons:{"Aceptar":function(){$(this).dialog("close");eval(funcion)}},minWidth:350})}