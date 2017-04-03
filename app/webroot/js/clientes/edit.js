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
*    @Fecha 07/11/2013
*    @use Librerias de AJAX para administrar edicion de usuarios
*/


$(document).ready(function(){
	IniciarEventos();})

//Inicalizamos los eventos ajax
function IniciarEventos(){
	$("#ClienteFechanac").datetimepicker({pickTime: false,language:'es'});
	$('#ClienteDocumento').mask('99.999.999',{placeholder:" "});
	formateafecha('ClienteFechanac');
	//$('#ClienteDocumento').numeric()
	$('#ClienteDpto').numeric()
	$('#ClientePiso').numeric()
	$('#ClienteDepartamentoId').change(function(){
		cargardropdown('ClienteDepartamentoId','/localidades/retornalxmllocalidades/','ClienteLocalidadeId')
	})
	$('#ClienteProvinciaId').change(function(){
		cargardropdown('ClienteProvinciaId','/departamentos/retornalxmldepartamentos/','ClienteDepartamentoId')
	})
	
	$('#guardar').click(guardardatos)
	$('#cancelar').click(function(){window.history.back()})
}

//Permite ejecutar el submit del formulario
function guardardatos(){
	$('form#ClienteEditForm').submit()
}