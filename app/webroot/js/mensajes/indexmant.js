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
*    @Fecha 16/04/2015
*    @use Librerias de AJAX para visualizacion de service de mantenimiento
*/

var fl_fila_seleccionada=-1
//inicializamos eventos y procesos desde el DOM
$(document).ready(function(){
	cargarEventoFilas();})

function cargarEventoFilas(){
	$('#MensajeFecdesde').datetimepicker({pickTime: false,language:'es'});
	$('#MensajeFechasta').datetimepicker({pickTime: false,language:'es'});
	fechaactual('MensajeFecdesde');		
	fechaactual('MensajeFechasta');	
	$('#buscar').click(function(){ reloadList(link) });
	$('#modalview').on('hidden.bs.modal', function () {
		//$(this).removeData('bs.modal');
		$('#content').empty();
		$(this).data('bs.modal', null); //<---- empty() to clear the modal
		
	})			
}
	
	
function reloadList(rlink){
	var serialize
	serialize=$('#mensajesmantenimientos').serialize()
	$('#cargandodatos').show(1)	
	$.post(rlink,serialize,
			function(data) {
				$('#listmensajesmantenimientos').html(data);
				var divPaginationLinks = '#listmensajesmantenimientos'+" .pagination a, .sort a";
			    $(divPaginationLinks).click(function(){
			        var thisHref = $(this).attr("href");
			        reloadList(thisHref);
			        return false;
			    });
	}).always(function() {
		$('#cargandodatos').hide(1)
	});
}

function verBicicleta(id){
	$('#modalview').modal({
		show: true,
		remote: '/bicicletas/view/'+id
	});			
	return false
}

function verCliente(id){
	$('#modalview').modal({
		show: true,
		remote: '/clientes/view/'+id
	});			
	return false
}