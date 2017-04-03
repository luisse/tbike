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
*    @author Luis Sebastian oppe
*    @Fecha 28/04/2012
*    @use Librerias de AJAX para administrar alta de entrenamientos
*/

$(document).ready(function(){
	IniciarEventos();})

//Inicalizamos los eventos ajax
function IniciarEventos(){
	$('#guardar').click(guardardatos)
	$('#cancelar').click(function(){window.history.back()})
	showmessage();
}

function guardardatos(){
	var valor = $('#FormulaimporteValor').val()
	var porcentaje = $('#FormulaimporteEsporcentaje').val()
	if( porcentaje == 1)
		if(valor > 100){
			$().toastmessage('showToast', {
					text     : 'El Porcentaje debe ser menor al 100%',
					sticky   : true,
					position : 'top-center',
					type     : 'error',
					closeText: '',
					close    : function () {
						//console.log("toast is closed ...");
					}
				});			
			return
		}
	$('form#FormulaimporteAddForm').submit()	
}

function showmessage(){
	var message = $('#message').text();
	if(typeof(message) != 'undefined' && message.trim() != ''){
		$().toastmessage('showToast', {
				text     : message,
				sticky   : true,
				position : 'top-center',
				type     : 'error',
				closeText: '',
				close    : function () {
					//console.log("toast is closed ...");
				}
			});	
	}
}