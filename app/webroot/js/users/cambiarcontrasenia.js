 /*
*    This program is free software: you can redistribute it and/or modify
*    it under the terms of the GNU General Public License as published by
*    the Free Software Foundation, either version 3 of the License, or
*    (at your option) any later version.
*
*    This program is distributed in the hope that it will be useful,
*    but WITHOUT ANY WARRANTY; without even the implied warranty of
*    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*    GNU General Public License for more details.
*
*    You should have received a copy of the GNU General Public License
*    along with this program.  If not, see <http://www.gnu.org/licenses/>
*    @author
*    @Fecha 05/09/2014
*    @use Librerias de AJAX para actualizar contraseña del usuario
*/


$(document).ready(function(){
	IniciarEventos();})

	
function IniciarEventos(){
	$('#UserUsername').attr('readonly',true)
	$('#UserEmail').attr('readonly',true)
	$('#ClienteDocumento').attr('readonly',true)
	$('#ClienteNombre').attr('readonly',true)
	$('#ClienteFechanac').attr('readonly',true)
	$('#ClienteApellido').attr('readonly',true)
	$('#ClienteTelefono').attr('readonly',true)
	$('#ClienteDomicilio').attr('readonly',true)
	$('#ClienteDpto').attr('readonly',true)
	$('#ClientePiso').attr('readonly',true)	
	$('#ClienteBlock').attr('readonly',true)	
    $('#UserPasswordc').keyup(function(){
        $('#mensajecontrola').html(validarpassword($('#UserPasswordc').val(),'mensajecontrola'))
    })	
	
	$('#actualizarpswd').click(function(){
		var passwordc	= $('#UserPasswordc').val()
		var passwordr	= $('#UserPasswordrepit').val()
		var contraseniafortaliza = validarpassword($('#UserPasswordc').val(),'mensajecontrola')
		if(contraseniafortaliza == 'Debil'){
			$().toastmessage('showToast', {
					text     : 'La Contraseña debe tener una fortaleza superior a Debil. para ello debe Ingresar letras y números',
					sticky   : true,
					position : 'top-center',
					type     : 'error',
					closeText: '',
					close    : function () {
						//console.log("toast is closed ...");
					}
				});	
		
			return;
		}
		
		if(passwordc != passwordr){
			$().toastmessage('showToast', {
					text     : 'Las Contraseñas ingresadas no coinciden',
					sticky   : false,
					position : 'top-right',
					type     : 'error',
					closeText: '',
					close    : function () {
						//console.log("toast is closed ...");
					}
				});	
			return;
		}
		$('form#UserCambiarcontraseniauserForm').submit()
	})
	
	
}

