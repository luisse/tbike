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
*    @Fecha 23/11/2013
*    @use Librerias de AJAX para inicio de sesion
*/
//inicializamos eventos y procesos desde el DOM
$(document).ready(function(){
	IniciarEventos();}
);

function IniciarEventos(){
	$('#myTab a:last').tab('show')
	$('#buscar').click(function(){
		reloadListBicicleta(bicicletalink) });
	//Una vez cargado los datos recargamos el link
	//Ajaxcargarclientes()
}

function reloadListBicicleta(rlink){
	var serialize=$('#filterbicicletas').serialize()
	$('#cargandodatosm').show(1)
	$.post(rlink,serialize,
			function(data) {
				$('#listarbicicletas').html(data);
				var divPaginationLinks = '#listarbicicletas'+" .pagination a,.sort a";
			    $(divPaginationLinks).click(function(){
			        var thisHref = $(this).attr("href");
			        reloadListCliente(thisHref);
			        return false;
			    });
	}).always(function() {
		$('#cargandodatosm').hide(1)
	});
}

function seleccionarcliente(fila){
	var ClienteId = $('#ClienteId'+fila).val()
	var ClienteDocumento = $('#ClienteDocumento'+fila).val()
	var ClienteNomApe = $('#ClienteNomApe'+fila).val()
	if(typeof(ClienteId) != 'undefined' && typeof(ClienteDocumento) != 'undefined'){
		//hack the return data of client
		if(typeof(clienmodalnameset)!='undefined'){
			$(clienmodalnameset[0]).val(ClienteDocumento)
			$(clienmodalnameset[1]).val(ClienteId)
			$(clienmodalnameset[2]).val(ClienteNomApe)
		}else{
			$('#BicicletareparamoDocumento').val(ClienteDocumento)
			$('#BicicletareparamoClienteId').val(ClienteId)
			$('#BicicletareparamoNomap').val(ClienteNomApe)
			reloadList()
		}
		$('#modalview').modal('hide');
	}

}
