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
*    @Fecha 18/12/2011
*    @use Librerias de AJAX para administrar datos del rubro
*/


$(document).ready(function(){
	IniciarEventos();
})

function IniciarEventos(){
	$('#guardar').click(guardardatos)
	$('#cancelar').click(function(){window.history.back()})
}

function guardardatos(){
	$('form#RubroAddForm').submit()	
}