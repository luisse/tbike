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
var eliminado= false
$(document).ready(function(){
	IniciarEventos();
})

function IniciarEventos(){
	fechaactual('AlquilereFecha');
	$("#AlquilereFecha").attr('readonly',true)
	$('#SaleClientedoc').attr('readonly',true)
	$('#SaleNomap').attr('readonly',true)
	$('#SaleCredito').attr('readonly',true)
	$('#SaleNrofactura').attr('readonly',true)
	$('#AlquilereTotal').attr('readonly',true)
	$('#selcliente').click(function(){buscarclientes();})
	$('#agregarfila').click(function(){
			newrow()
			});
	$('.cantidad').numeric()
	$('.id').numeric()
	$('.precio').attr('readonly',true)
	$('.clprecio').change(function(){recalculartotal()})
	$('.tiempoalquila').mask('99:99',{placeholder:""})
	$('.tiempoalquila').val('00:00')
	setDecimal()
	mascaraimporteclass('clprecio')
	$('#guardar').click(guardardatos)
	$('#cancelar').click(function(){window.history.back()})
}

function guardardatos(){
	EliminarFilasVacias();
	$('form#AlquilereEditForm').submit()
}

function montototalcredito(){
		var cliente_id = $('#SaleClienteId').val()
		if(typeof(cliente_id) != 'undefined' && cliente_id != 0){
			$.ajax({type:'GET',
				   url:'/movimientos/deudatotalcliente/'+cliente_id,
				   datatype:'html',
				   success:function(data){
						if(data != ''){
							$('#SaleCredito').val(data);
						}
						},
						onerror:function(){
							alert('Error');
						}
				})//close ajax
		}
}

function newrow(){
	oId++
	$.ajax({type:'GET',
		async:false,
		url:'/alquileres/newrow/'+oId,
		datatype:'html',
		success:function(data){
				var strHtml = "<tr id='alquileredetalles_"+oId+"'><tr>"
				$("#salesdetails").append(strHtml)
				$("#alquileredetalles_"+oId).append(data)
				//AJAX COPLEX FOR NEW ROWS
				$('.cantidad').numeric()
				$('.id').numeric()
				$('.precio').attr('readonly',true)
				$('.clprecio').val('0.00')
				$('.clprecio').change(function(){recalculartotal()})
				$('.tiempoalquila').mask('99:99',{placeholder:""})
				$('.tiempoalquila').val('00:00')
				mascaraimporteclass('clprecio')
			}
		})
}


function eliminarFila(fila){
	var alquileredetalle_id = $('#Alquileredetalle'+fila+'id').val()
	eliminado=false
	borrarproducto(alquileredetalle_id)
	if(eliminado){
		$("#alquileredetalles_" +fila).remove();
		recalculartotal()
	}
	return false;
}

//Permite recalcular el total obtenido
function recalculartotal(){
	var total = 0
	for(i = 1;i<=oId;i++){
			//incrementamos el producto en uno para la cantidad
    	  	subtotal = $('#Alquileredetalle'+i+'Subtotal').val()
    	  	if(typeof(subtotal) !='undefined' && subtotal != ''){
    	  		total = Math.round((total + parseFloat(subtotal))*100)/100
    	  	}
	}
	$('#AlquilereTotal').val(total)
}


//Funcion permite determinar las filas vacias
function EliminarFilasVacias(){
	for(row = 1;row <= oId;row++){
		id = $('#Alquileredetalle'+row+'Detalle').val()
		if(typeof(id) != 'undefined' && id == ''){
			eliminarFila(row)
		}
	}
}


function recuperarDatosBicicleta(row){
	var id = $("#Alquileredetalle"+row+'BicicletasparaalquilereId').val()
	var url='/bicicletasparaalquileres/bicicletasparaalquilerexml/'+id
	//if the product exists dont insert a new row for then
	result=false
	if(result == false){
		$.ajax({type:'GET',
				url:url,
				datatype:'xml',
				success:function(data){
						var xml;
						var options = '';
						var encontrado = false;
						xml = data;
						$(xml).find('datos').each(function(){
								//Cargamos el drow dow con las provincias
								var li_id = $(this).find('id').text()
								var ls_marca = $(this).find('marca').text()
								var ls_modelo = $(this).find('modelo').text()
								var ls_nrocuadro = $(this).find('nrocuadro').text()
								var ls_estado = $(this).find('estado').text()
								encontrado = true
								if(ls_estado == 0){
									$('#Alquileredetalle'+row+'Detalle').val(ls_nrocuadro+'-'+ls_modelo+'-'+ls_marca)
									//recalculamos el total vendido
									recalculartotal()
									$().toastmessage('showSuccessToast', "Bicicleta Agregada...");
								}else{
										if(ls_estado == 2){
											$().toastmessage('showSuccessToast', "Bicicleta alquilada no se puede asignar...");
											$("#Alquileredetalle"+row+'BicicletasparaalquilereId').val('')
										}
									}
								}
						});//close each
						if(!encontrado){
							$().toastmessage('showErrorToast', "No se pudo recuperar la bicicleta para asociar");
						}
				},
				error:function(xtr,fr,ds){
					$().toastmessage('showToast', {
						text     : 'No se pudieron cargar los datos de Bicicleta. Verifique la conexión al server',
						sticky   : true,
						position : 'top-right',
						type     : 'error',
						closeText: '',
						close    : function () {
						}
					});
				}
		})//close ajax
	}else{
		//$('#Salesdetail'+row+'Id').val('')
	}

}


function recalcularcantidad(row){
	var cantidad = $('#Alquileredetalle'+row+'Cantidad').val()
	var precio =  $('#Alquileredetalle'+row+'Precio').val()
	var subtotal
	precio = precio.replace('$','')
	precio = precio.trim()
	precioing = Math.round(parseFloat(precio)*100)/100
	subtotal = parseInt(cantidad)*parseFloat(precioing)
	$('#Alquileredetalle'+row+'Subtotal').val(subtotal)
	recalculartotal()
}

function recalculartotal(){
	var total = 0
	for(i = 1;i<=oId;i++){
			//incrementamos el producto en uno para la cantidad
    	  	subtotal = $('#Alquileredetalle'+i+'Subtotal').val()
    	  	if(typeof(subtotal) !='undefined' && subtotal != ''){
    	  		total = Math.round((total + parseFloat(subtotal))*100)/100
    	  	}
	}
	$('#AlquilereTotal').val(total)
}


function setDecimal(){
	var i=0;
	for(i = 0;i<oId;i++){
		//incrementamos el producto en uno para la cantidad
	  	precio = $('#Alquileredetalle'+i+'Precio').val()
	  	if((typeof(precio) != 'undefined' || precio != '')){
	  		precio=decimales(precio)
	  		$('#Alquileredetalle'+i+'Precio').val(precio)
	  	}
	}
}


function borrarproducto(alquileresdetalle_id){
	if(typeof(alquileresdetalle_id) != 'undefined'){
	    $.ajax({
	        url:'/alquileres/eliminardetalle/'+alquileresdetalle_id, //URL del archivo php que procesa la petición. Se explica mas adelante
	        type:'post', // Los datos se envían mediante el método POST
	        dataType:'html', // La respuesta se obtiene como HTML
	        async: false
	    }).done(function(respuesta){
	        //Condición para verificar si se guardaron o no los datos
	        if( respuesta == '' ){
	    		$().toastmessage('showToast', {
						text     : 'Item Eliminado Satisfactoriamente',
						sticky   : false,
						position : 'top-right',
						type     : 'success',
						closeText: '',
						close    : function () {}
					});
	        	eliminado=true
	        }else{
	    		$().toastmessage('showToast', {
						text     : respuesta,
						sticky   : true,
						position : 'top-right',
						type     : 'error',
						closeText: '',
						close    : function () {}
					});
        		eliminado=true
	    	}
	    });
	}

}
