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
*    @use Biblioteca base para envios de mensajes correos
*/
var clienmodalnameset=['#MensajeDocumento','#MensajeUserrecId','#MensajeNomap']
$(document).ready(function(){
	IniciarEventos();
})

function IniciarEventos(){
	$("#MensajeFechasendauto").datetimepicker({pickTime: false,language:'es'});
	$('#MensajeDetalle').YellowText();
	fechaactual('MensajeFechasendauto');
	fechaactual('MensajeFechaactual');	
	$('#MensajeDocumento').attr('readonly',true)
	$('#MensajeNomap').attr('readonly',true)	
	$('#selcliente').click(function(){buscarclientes();
										return false;})
	$('#modalview').on('hidden.bs.modal', function () {
		$('#content').empty();
		$(this).data('bs.modal', null); //<---- empty() to clear the modal
	})										
	$('#guardar').click(guardardatos)
	$('#cancelar').click(function(){window.history.back()})
}

function guardardatos(){
	var result = validafechas('#MensajeFechaactual','#MensajeFechasendauto')
	var userrec_id = $('#MensajeUserrecId').val()
	if(result == -5){
		$().toastmessage('showToast', {
			text     : 'La Fecha de Envió debe ser mayor a la Fecha Actual.',
			sticky   : false,
			position : 'top-center',
			type     : 'error',
			closeText: '',
			close    : function () {}
		});			
		$('#MensajeFechaactual').focus()
		return false
	}
	
	if(typeof(userrec_id)=='undefined' || userrec_id ==''){
		$().toastmessage('showToast', {
			text     : 'Debe Seleccionar el cliente para enviar el mensaje.',
			sticky   : true,
			position : 'top-center',
			type     : 'error',
			closeText: '',
			close    : function () {}
		});		
		return false
	}
	$('form#MensajeAddForm').submit()	
}


function buscarclientes(){
	$('#modalview').modal({
			show: true,
			remote: '/clientes/seleccionarcliente/'
	});
}

function reloadList(){
	
}
