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
*    @author <author>
*    @Fecha <fecha>
*    @use <USE DESCRIPCION>
*/
var oId = 6

$(document).ready(function(){
	IniciarEventos();
})

function IniciarEventos(){
	$('#guardar').click(guardardatos)
	$('#agregarfila').click(function(){
			filaNueva()
	});

	$('#cancelar').click(function(){window.history.back()})
}

function guardardatos(){
	EliminarFilasSinDatos()
	$('form#CategoriaAddsubForm').submit()	
}

function filaNueva(){
	$.ajax({type:'GET',
			url:'/categorias/nuevafila/'+oId,
			datatype:'html',
			success:function(data){
					var strHtml = "<tr id='categorias_"+oId+"'></tr>"
					$("#categorias").append(strHtml)
					$("#categorias_"+oId).append(data)
					//inicializamos el filtro para la nueva fila
					oId++
				}
			})
}

function eliminarFila(fila){
	$("#categorias_" +fila).remove();	
	return false;
}

function EliminarFilasSinDatos(){
	var i=0;
	for(i = 0;i<=oId;i++){
			//incrementamos el producto en uno para la cantidad
    	  	descripcion = $('#Categoria'+i+'Descripcion').val()
    	  	if((typeof(descripcion) == 'undefined' || descripcion == '')){
				eliminarFila(i)
    	  	}
	}
}
