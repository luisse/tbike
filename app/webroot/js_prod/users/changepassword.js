$(document).ready(function(){IniciarEventos()})
function IniciarEventos(){$('#UserUsername').attr('readonly',!0)
$('#UserEmail').attr('readonly',!0)
$('#UserPasswordc').keyup(function(){$('#mensajecontrola').html(validarpassword($('#UserPasswordc').val(),'mensajecontrola'))})
$('#actualizarpswd').click(function(){var passwordc=$('#UserPasswordc').val()
var passwordr=$('#UserPasswordrepit').val()
var contraseniafortaliza=validarpassword($('#UserPasswordc').val(),'mensajecontrola')
if(contraseniafortaliza=='Debil'){alert('La Contraseña debe tener una fortaleza superior a Debil, para ello debe Ingresar Letras y Números')
return}
if(passwordc!=passwordr){alert('La Contraseña Ingresada no coinciden');return}
$('form#UserChangepasswordForm').submit()})}