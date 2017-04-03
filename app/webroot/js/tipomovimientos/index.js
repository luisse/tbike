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
*    @use Librerias de AJAX para seleccion de usuarios
*/

var fl_fila_seleccionada=-1
//inicializamos eventos y procesos desde el DOM
$(document).ready(function(){
	cargarEventoFilas();})

function cargarEventoFilas(){
	//cargamos el facebox para el filtro de datos
    /***$('a[rel*=facebox]').facebox()
    $(document).bind('loading.facebox', function() {
   	    $(document).unbind('keydown.facebox');
   	    $('#facebox_overlay').unbind('click');
   	});***/
}

/***
function reloadList(rlink,tipofiltro){
	var serialize
	if(tipofiltro == 1)
		serialize=$('#filterclient').serialize()
	$.post(rlink,serialize,
			function(data) {
				$('#listbicicletareparo').html(data);
				var divPaginationLinks = '#listbicicletareparo'+" .pagination a, .sort a";
				$('a[rel*=facebox]').facebox() 
			    $(divPaginationLinks).click(function(){
			        var thisHref = $(this).attr("href");
			        reloadList(thisHref);
			        //recarmamos el proceso de carga
			        return false;
			    });
	})
}

***/


