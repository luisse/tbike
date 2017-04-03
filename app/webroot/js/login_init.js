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
*    @Fecha 15/12/2010
*    @use Librerias de AJAX para inicio de sesion
*/
var lb_ctrl = false
$(document).ready(function(){
	cargarEventosLogin();})

function cargarEventosLogin(){
	var login;
	login = $('#UsuarioLogin');
	login.focus(limpiarform)
	login.focus()
	$('#ingresar').click(procesar)
	//miramos si se debe mostrar un mensaje de error
	mostrarMensajeError();
	if($("#flashMessage") == 'undefined'){
		$("#error_login").text('')
	}
	$(document).keypress(procesarEnter)
}


function limpiarform(){
	  var login=$("#UsuarioLogin");
	  var password=$("#UsuarioPasswordusr")
	  login.attr("value","");
	  password.attr("value",'');
}

function procesar(){
	  var login=$("#UserUsername").val();
	  var password=$("#UserPassword").val()
	  if(login =='' || typeof(login)=='undefined'){
		  mensaje('Debe Ingresar un Usuario','Inicio de Sesión')
		  return false
	  }
	  if(password =='' || typeof(password) == 'undefined'){
		  mensaje('Debe Ingresar una ConstraseÃ±a','Inicio de Sesión')
		  return false
	  }
	validarUsuarioAjax()
}

function mostrarMensajeError(){
	//Controlamos que existe el div de error
	if($("#flashMessage") == 'undefined') return false
	$("#flashMessage").attr('title','Error!')
	var buttons = $( "#flashMessage" ).dialog( "option", "buttons");

	//setter
	$( "#flashMessage" ).dialog( {buttons:{"Aceptar":
								function() {
									$(this).dialog("close");
								}
							},minWidth:350 });
}


function mensaje(ps_mensage,ps_title){
	$("#mensaje").text(ps_mensage)
	//$("#error_login").attr('title',ps_title)
	$('#modalbox').modal()
}

function procesarEnter(evento){
	if(evento.which == 13) procesar()
}

function validarUsuarioAjax(){
	serialize=$('#UserLoginForm').serialize()
	$.post('/users/userajaxlogin.json',serialize,function(data){
		if(data.error != ''){
			mensaje(data.error,'Acceso Sistema')
		}else{
			$('form#UserLoginForm').submit();
		}
	}).fail(function(jqXHR, textStatus){alert(textStatus)});
}
