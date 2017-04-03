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
*    @Fecha 11/03/2015
*    @use Librerias de AJAX para la vista detallada de productos
*/


//inicializamos eventos y procesos desde el DOM
$(document).ready(function(){
        cargarEventoFilas();})


function cargarEventoFilas(){
	$('#ProductTab a:last').tab('show')
	$('#ProductTab li:eq(0) a').tab('show')
}