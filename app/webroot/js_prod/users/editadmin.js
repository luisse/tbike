$(document).ready(function(){IniciarEventos()})
function IniciarEventos(){$('#myTab a:last').tab('show')
$('#guardar').click(guardardatos)
$('#cancelar').click(function(){window.history.back()})
formateafecha('PeopleBirthdate');$('#datetimepicker1').datetimepicker({locale:'es',format:"DD/MM/YYYY"});$('#actualizarfoto').click(function(){$('form#UserEditimageForm').submit()})
$('#actualizarpref').click(function(){$('form#UserpreferenceAdminprefForm').submit()})
$('#UserPasswordc').keyup(function(){$('#mensajecontrola').html(validarpassword($('#UserPasswordc').val(),'mensajecontrola'))})
$('#actualizarpswd').click(function(){var passwordc=$('#UserPasswordc').val()
var passwordr=$('#UserPasswordrepit').val()
var contraseniafortaliza=validarpassword($('#UserPasswordc').val(),'mensajecontrola')
if(passwordc!=passwordr){$().toastmessage('showToast',{text:'Las Contraseñas ingresadas no coinciden',sticky:!1,position:'top-right',type:'error',closeText:'',close:function(){}});return}
$('form#UserChangepasswordForm').submit()})
showmessage_loc()
$('#myTab li:eq(0) a').tab('show')}
function showmessage_loc(){var message=$('#message').text();if(typeof(message)!='undefined'&&message.trim()!=''){$().toastmessage('showToast',{text:message,sticky:!1,position:'top-right',type:'success',closeText:'',close:function(){}})}}
function guardardatos(){$('form#UserEditadminForm').submit()}