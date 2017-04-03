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
*    @author Oppe Luis Sebastian
*    @Fecha 21/02/2014
*    @use Librerias de AJAX para inicio de sesion
*/
//inicializamos eventos y procesos desde el DOM


IniciarEventos();


function IniciarEventos(){
	$("#MensajeserviceFechaaprox").datetimepicker({pickTime: false,language:'es'});
	fechaactual('MensajeserviceFechaaprox');		
	$('#MensajeserviceCantmensajes').numeric();
	$('#aceptar').click(function(){GuardarDatos()})
}

function GuardarDatos(){
	serialize=$('#MensajeserviceAddForm').serialize()
	$.post('/mensajeservices/add/'+$('#MensajeserviceBicicletaId').val(),serialize,
			function(data) {
				$('#formreturn').html(data);
	})

}