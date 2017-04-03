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
*    @author oppeluis@gmail.com
*    @Fecha 31/03/2015
*    @use Biblioteca base para edicion de correos
*/

$(document).ready(function(){
	IniciarEventos();
})

function IniciarEventos(){
	formateafecha('MensajeFechasendauto');
	$("#MensajeFechasendauto").datetimepicker({pickTime: false,language:'es'});
	fechaactual('MensajeFechaactual');
	$('#MensajeDetalle').YellowText();
	$('#guardar').click(guardardatos)
	$('#cancelar').click(function(){window.history.back()})	
}

function guardardatos(){
	var result = validafechas('#MensajeFechaactual','#MensajeFechasendauto')
	if(result == -5){
		$().toastmessage('showToast', {
			text     : 'La Fecha de Envió debe ser mayor u igual a la Fecha Actual.',
			sticky   : true,
			position : 'top-center',
			type     : 'error',
			closeText: '',
			close    : function () {}
		});			

		return false
	}
	
	$('form#MensajeEditForm').submit()	
}