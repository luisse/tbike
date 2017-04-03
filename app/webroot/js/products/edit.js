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
*    @use Librerias de AJAX para administrar datos de producto
*/


$(document).ready(function(){
	IniciarEventos();
	})


function IniciarEventos(){
	$('#guardar').click(guardardatos)
	//Mascaras
	$('#ProductCodgen').mask('aaa999',{placeholder:""});
	$('#ProductCodbarra').numeric()
	$('#ProductsdetailStock').numeric()
	inicializaMascara('ProductsdetailPrecio')
	mascaraimporte('ProductsdetailPrecio')
	$('#ProductsdetailDetails').YellowText();
	$('#ProductCategoriaId').change(function(){
		cargardropcateg('ProductCategoriaId','/categorias/retornalxmlsubcategoria/','ProductSubcategoriaId')
	})	
	$("#ProductProveedoreId").typeahead({
		   source: function (query, process) {
				return $.getJSON(
					'/proveedores/autocompletarpv/'+query,
					function (data) {
						var newData = [];
						$.each(data, function(){
							newData.push(this.name);
						});
						return process(newData);
					});
			}

		})		
	showmessagelocal()
		$('#cancelar').click(function(){window.history.back()})
}

function guardardatos(ejecform){
	$('form#ProductEditForm').submit()
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




