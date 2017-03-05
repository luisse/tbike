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
*    @Fecha 27/01/2014
*    @use Librerias de AJAX para administrar alta de usuarios
*/


$(document).ready(function(){
	IniciarEventos();})

//Inicalizamos los eventos ajax
function IniciarEventos(){
	$('#BicicletaModelo').numeric()
	$('#guardar').click(guardardatos)

	$('#cancelar').click(function(){window.history.back()})

	$('#sacarfoto').click(function(){
		$('.trigger').click()
	})
	$('#example').photobooth().on("image",function( event, dataUrl ){
		$( "#gallery" ).html('');
		$( "#gallery" ).append( '<img src="' + dataUrl + '" >');
		//$("#BicicletaImagen").val(dataUrl.substr(22,dataUrl.lenght))
	});
	$('#BicicletaImage').change(function(){
		mostrarVistaPrevia('BicicletaImage','gallery','BicicletaImagen')
	})

}

//Permite ejecutar el submit del formulario
function guardardatos(){
	$('form#BicicletaAddForm').submit()
}
