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
*    @use Librerias de AJAX para  habilitar las ventanas emergentes en el index
*/


//inicializamos eventos y procesos desde el DOM
$(document).ready(function(){
        cargarEventoFilas();})


function cargarEventoFilas(){
	$('#buscar').click(function(){ reloadList(productslink) });
	//$("#ProductCategoriaId").prop("selectedIndex",0);
	$('#ProductCategoriaId').change(function(){
		cargardropcateg('ProductCategoriaId','/categorias/retornalxmlsubcategoria/','ProductSubcategoriaId')
	})	
	reloadList(productslink)
}


/*Permite asignar un producto a la ventana determinada*/
function agregarproducto(row){
	console.log('Agregando producto fila: '+row)
	console.log('Agregando producto fila remota: '+rowpos)
	if(typeof(rowpos)!='undefined'){
		ProductId = $('#ProductId'+row).val();
		ProductDescripcion = $('#ProductDescripcion'+row).val();
		ProductPrecio = $('#ProductPrecio'+row).val();
		$('#Bicicletareparamorepuesto'+rowpos+'Cantidad').val('1')
		$('#Bicicletareparamorepuesto'+rowpos+'Repuestodescr').val(ProductDescripcion)
		$('#Bicicletareparamorepuesto'+rowpos+'Precio').val(ProductPrecio)		
		recalculartotal()
		$('#modalview').modal('hide');
	}
}

function reloadList(rlink){
	var serialize = $('#filterproduct').serialize()
	$.post(rlink,serialize,
			function(data) {
				$('#listproductos').html(data);
				var divPaginationLinks = '#listproductos'+" .pagination a, .sort a";
			    $(divPaginationLinks).click(function(){
			        var thisHref = $(this).attr("href");
			        reloadList(thisHref);
			        //recarmamos el proceso de carga
			        return false;
			    });
	})
}




