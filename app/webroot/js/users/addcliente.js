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
*    @Fecha 24/01/2014
*    @use Librerias de AJAX para administrar alta de usuarios
*/


$(document).ready(function(){
	IniciarEventos();})

//Inicalizamos los eventos ajax
function IniciarEventos(){
	$("#ClienteFechanac").datetimepicker({pickTime: false,language:'es'});
	$('#ClienteDocumento').mask('99.999.999',{placeholder:" "});
	
	//$('#ClienteDocumento').numeric()
	$('#ClienteDpto').numeric()
	$('#ClientePiso').numeric()
	
	$('#ClienteNombre').change(function(){
		var nombre = $('#ClienteNombre').val()
		var apellido = $('#ClienteApellido').val()
		var nombre_array = nombre.split(' ')
		var cicly = nombre_array.length
		var username=''
		for(i=0;i < cicly;i++){
			username = username+nombre_array[i][0]
		}
		if(typeof(apellido)!='undefined' && apellido != ''){
			username = username+apellido
			$('#UserUsername').val(username)
		}
		
	})
	$('#ClienteProvinciaId').change(function(){
		cargardropdown('ClienteProvinciaId','/departamentos/retornalxmldepartamentos/','ClienteDepartamentoId')
	})		
	$('#ClienteDepartamentoId').change(function(){
		cargardropdown('ClienteDepartamentoId','/localidades/retornalxmllocalidades/','ClienteLocalidadeId')
	})
	$('#guardar').click(guardardatos)
	$('#guardar').click(guardardatos)
	$('#cancelar').click(function(){window.history.back()})
}

//Permite ejecutar el submit del formulario
function guardardatos(){
	$('form#UserAddclienteForm').submit()
	
}

