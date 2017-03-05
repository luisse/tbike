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
*    @Fecha 18/12/2011
*    @use Librerias de AJAX para administrar alta de usuarios
*/


$(document).ready(function(){
	IniciarEventos();})

	
function IniciarEventos(){
	$('#UserUsername').attr('readonly',true)
	$('#UserEmail').attr('readonly',true)
	$('#ClienteDocumento').attr('readonly',true)
	$('#ClienteNombre').attr('readonly',true)
	$('#ClienteFechanac').attr('readonly',true)
	$('#ClienteApellido').attr('readonly',true)
	$('#ClienteTelefono').attr('readonly',true)
	$('#ClienteDomicilio').attr('readonly',true)
	$('#ClienteDpto').attr('readonly',true)
	$('#ClientePiso').attr('readonly',true)	
	$('#ClienteBlock').attr('readonly',true)	
	$('#guardar').click(guardardatos)
}

function guardardatos(){
	$('form#UserConfirmarusuarioForm').submit()
}