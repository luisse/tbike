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
	$('#buscar').click(function(){ 
		var porcentaje = parseFloat($('#ProductPorcentaje').val())
		if(porcentaje<=0 || porcentaje >100 || typeof(porcentaje)=='undefined' || isNaN(porcentaje)){
			$().toastmessage('showToast', {
					text     : 'El porcentaje debe estar comprendido entre el 1 y el 100%',
					sticky   : true,
					position : 'top-center',
					type     : 'error',
					closeText: '',
					close    : function () {
						//console.log("toast is closed ...");
					}
				});	
			
		}else{
			reloadList(link) 

		}
	});
	
	$('#actualizar').click(function(){
		$('form#ProductActualizarprecioForm').submit()
	})	
	$('#regactualizar').hide(1)
	$('#ProductPorcentaje').numeric()
	$('#ProductCategoriaId').change(function(){
		cargardropcateg('ProductCategoriaId','/categorias/retornalxmlsubcategoria/','ProductSubcategoriaId')
	})
	//reloadList(link)
	showmessagelocal();
}



function reloadList(rlink){
	var serialize = $('#filterproduct').serialize()
	$('#cargandodatos').show(1)	
	$.post(rlink,serialize,
			function(data) {
				$('#listproductos').html(data);
				$('#regactualizar').show(1)
				mascaraimporteclass('clprecio')
				var divPaginationLinks = '#listproductos'+" .pagination a, .sort a";
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



function showmessagelocal(){
	var message = $('#message').text();
	if(typeof(message) != 'undefined' && message.trim() != ''){
		$().toastmessage('showToast', {
				text     : message,
				sticky   : false,
				position : 'top-right',
				type     : 'success',
				closeText: '',
				close    : function () {
					//console.log("toast is closed ...");
				}
			});	
	}
}




