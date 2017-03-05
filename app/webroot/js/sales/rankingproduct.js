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
var result=true;
$(document).ready(function(){
	IniciarEventos();}
);

function IniciarEventos(){
	fechaactual('ProductFecdesde');
	fechaactual('ProductFechasta');
	$("#ProductFecdesde").datetimepicker({pickTime: false,language:'es'});
	$("#ProductFechasta").datetimepicker({pickTime: false,language:'es'});;

	$('#ProductCategoriaId').change(function(){
		cargardropcateg('ProductCategoriaId','/categorias/retornalxmlsubcategoria/','ProductSubcategoriaId')
	})	
	$('#listarrank').click(function(){ reloadList(link) });
}

function reloadList(rlink){
	$('#cargandodatos').show(1)
	$.post(rlink,$('#filterproduct').serialize(),
			function(data) {
				$('#listproduct').html(data);
				var divPaginationLinks = '#listproduct'+" .pagination a,.sort a";
			    $(divPaginationLinks).click(function(){
			        var thisHref = $(this).attr("href");
			        reloadList(thisHref);
			        //recarmamos el proceso de carga
			        return false;
			    });
	}).always(function() {
		$('#cargandodatos').hide(1)
	});
}
