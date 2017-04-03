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
*    @Fecha 15/12/2010
*    @use Librerias de AJAX para inicio de sesion
*/
//inicializamos eventos y procesos desde el DOM
$(document).ready(function(){
	IniciarEventos();})
	
function IniciarEventos(){
	var detalle;
	detalle = $('#NumeradorDetalle');
	detalle.focus()	
	$('#guardar').click(guardardatos)
	$('#NumeradoreRangodesde').numeric();
	$('#NumeradoreRangohasta').numeric();
	$('#NumeradoreRangohasta').change(function(){
		validarNumeradores();
	});
}

function validarNumeradores(){
	var rangodesde = parseInt($('#NumeradoreRangodesde').val())
	var rangohasta = parseInt($('#NumeradoreRangohasta').val())
	if(rangodesde > rangohasta){
		ls_error = 'El Rango desde debe ser menor al rango hasta'
		mensaje(ls_error,'Alta de Numerador','NumeradoreRangodesde')
		return false
	}
	return true
}

function guardardatos(){
	var result =validarNumeradores()
	if(result)	$('form#NumeradoreEditForm').submit();
}