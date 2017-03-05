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


$(document).ready(function(){
	IniciarEventos();
})

function IniciarEventos(){
	$("#MensajeFechasendauto").datetimepicker({pickTime: false,language:'es'});
	//$('#MensajeDetalle').YellowText();
	fechaactual('MensajeFechasendauto');
	fechaactual('MensajeFechaactual');
	$('#aceptar').click(function(){GuardarDatos()})	
}

function GuardarDatos(){
	var result = validafechas('#MensajeFechaactual','#MensajeFechasendauto')
	if(result == -5){
		$().toastmessage('showToast', {
			text     : 'La Fecha de Envió debe ser menor a la Fecha Actual.',
			sticky   : true,
			position : 'top-center',
			type     : 'error',
			closeText: '',
			close    : function () {}
		});			

		return false
	}

	serialize=$('#MensajeAddmensajeserviceForm').serialize()
	//alert('/mensajes/addmensajeservice/'+$('#MensajeBicicletaId').val())
	$.post('/mensajes/addmensajeservicetecnico/'+$('#MensajeBicicletaId').val(),serialize,
			function(data) {
				$('#formreturn').html(data);
	})

}