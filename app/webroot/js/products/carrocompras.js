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
var categoria_id =0
var subcategoria_id = 0
var ProductDescripcion= ''

$(document).ready(function(){
        cargarEventoFilas();})


function cargarEventoFilas(){

	$('#buscar').click(function(){ 
		cargarfilter()
		cargarcarro()
	})

		
	$('#ProductCategoriaId').change(function(){
		cargardropcateg('ProductCategoriaId','/categorias/retornalxmlsubcategoria/','ProductSubcategoriaId')
	})	
	//reloadList(link)
	//showmessagelocal();
	
	/**(function() {	  
		window.cart = new window.AcidJs.ShoppingCart({
			currency: "$",
			debug: true,
			paymentProvider: "ExampleProvider",
			cartDataFile: link,
			lang: "es-ar",
			mode: "shop",
			daysToStoreCartDataInCookie: 7,
			colors: ["A7B3C0"],
			thumbs: {
				width: 232,
				height: 232
			}
		});
	})()**/
}
function cargarfilter(){
		categoria_id = $('#ProductCategoriaId').val()
		subcategoria_id = $('#ProductSubcategoriaId').val()
		ProductDescripcion= $('#ProductDescripcion').val()

	
}

function cargarcarro(){
		/**var categoria_id = $('#ProductCategoriaId').val()
		var subcategoria_id = $('#ProductSubcategoriaId').val()
		var ProductDescripcion= $('#ProductDescripcion').val()***/
		(function() {
			if(typeof(window.cart)!='undefined')
				delete window.cart
			if(typeof(window.cart)=='undefined'){
				window.cart = new window.AcidJs.ShoppingCart({
				currency: "$",
				debug: true,
				paymentProvider: "ExampleProvider",
				cartDataFile: link+'/'+categoria_id+'/'+subcategoria_id+'/'+ProductDescripcion,
				lang: "es-ar",
				mode: "shop",
				daysToStoreCartDataInCookie: 7,
				colors: ["A7B3C0"],
				thumbs: {
					width: 232,
					height: 232
				}
				});
			}else{
			//delete window.cart
			//window.cart({cartDataFile:link});
			}
			
		})()		
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




