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
var oId = 5


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
	$('#selbicicleta').click(function(){seleccionarbicicleta();})
	$('#agregarfila').click(function(){
			newrow()
			});
	$('.cantidad').numeric()
	$('.id').numeric()
	$('.precio').attr('readonly',true)
	$('.clprecio').val('0.00')
	//recalcular automativamente cuando cambiamos los importes
	$('.cantidad').change(function(){recalculartotal()})
	$('.precio').change(function(){recalculartotal()})
	$('.clprecio').change(function(){recalculartotal()})
	$('.tiempoalquila').mask('99:99',{placeholder:""})
	$('.tiempoalquila').val('00:00')
	mascaraimporteclass('clprecio')
	$('#guardar').click(guardardatos)
	$('#cancelar').click(function(){window.history.back()})

	$('#agregarcliente').click(function(){
			$('#btsave').show(1)
			$('#btnuevo').hide(1)
			$('#AlquilereNrodocumento').val('')
			$('#AlquilereTelefono').val('')
			$('#AlquilereDireccion').val('')
			$('#AlquilereEmail').val('')
			$('#AlquilereNombre').val('')
			$('#AlquilereApellido').val('')
			$('#selcliente').hide(1)
			$('#clientadd').show(1)
		})
	$('#guardarcliente').click(function(){addclienteajax()})
}

function guardardatos(){
	var cliente_id = $('#SaleClienteId').val()
	if(typeof(cliente_id) == 'undefined' || cliente_id==''){
		$().toastmessage('showErrorToast', "Debe Seleccionar el Cliente");
		return
	}
	EliminarFilasVacias();
	$('form#AlquilereAddForm').submit()
}


function buscarclientes(){
	$('#modalview').modal({
			show: true,
			remote: '/clientes/seleccionarclienteventa/'
	});
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
	$("#alquileredetalles_" +fila).remove();
	recalculartotal()
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
		//variables nulas en bicicleta para alquilere referencia
		if(id == 0){
			$("#Alquileredetalle"+row+'BicicletasparaalquilereId').val('')
		}
	}
}

function recuperarDatosBicicleta(row){
	var id		= $("#Alquileredetalle"+row+'BicicletasparaalquilereId').val()
	var url		= '/bicicletasparaalquileres/bicicletasparaalquilere.json'
	var result	= existeId(row)
	if(!result){
		//if the product exists dont insert a new row for then
		result=false
		if(result == false){
			$.ajax({url:url,
						type:'post',
						dataType:'json',
						headers: {
							'Security-Access-PublicToken':'A33esaSP9skSjasdSfFSssEwS2IksSZxPlA4asSJ4GEW4S'
						},
						data:{id:id},
						success: function(data){
							console.log(data);
							if(typeof(data.error) != 'undefined'){
								$().toastmessage('showSuccessToast', data.error);
								$("#Alquileredetalle"+row+'BicicletasparaalquilereId').val('')
							}else{
								$('#Alquileredetalle'+row+'Detalle').val(data.Bicicleta.nrocuadro+'-'+data.Bicicleta.modelo+'-'+data.Bicicleta.marca)
								//recalculamos el total vendido
								recalculartotal()
								$().toastmessage('showSuccessToast', "Bicicleta Agregada...");
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
				})
		}else{
			//$('#Salesdetail'+row+'Id').val('')
		}
	}else{
		$().toastmessage('showToast', {
			text     : 'Bicicleta Asignada a otro registro',
			sticky   : true,
			position : 'top-right',
			type     : 'error',
			closeText: '',
			close    : function () {
			}
		});
		$('#Alquileredetalle'+row+'BicicletasparaalquilereId').focus()
		$('#Alquileredetalle'+row+'BicicletasparaalquilereId').val('')
	}
}


function recalcularcantidad(row){
	var cantidad = $('#Alquileredetalle'+row+'Cantidad').val()
	var precio =  $('#Alquileredetalle'+row+'Precio').val()
	var horas = $('#Alquileredetalle'+row+'Horasalquila').val()
	var subtotal
	precio = precio.replace('$','')
	precio = precio.trim()
	precioing = Math.round(parseFloat(precio)*100)/100
	//calcular precio por horas y minutoos
	array_horas = horas.split(':')
	int_horas = parseInt(array_horas[0])
	int_minutos = parseInt(array_horas[1])
	if(int_horas > 0){
		horas_minutos = int_horas*60
		if(int_minutos > 0){
			preciominutos = ((int_minutos+horas_minutos)*precioing)/60
			precioing = preciominutos
		}
	}
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

function existeId(row){
	var bicicletaparaalquilere_id=$('#Alquileredetalle'+row+'BicicletasparaalquilereId').val()
	var aux_bicicletaparaalquilere_id=0
	if(typeof(bicicletaparaalquilere_id)!='undefined'){
		var total = 0
		for(i = 1;i<=oId;i++){
				//incrementamos el producto en uno para la cantidad
				aux_bicicletaparaalquilere_id=$('#Alquileredetalle'+i+'BicicletasparaalquilereId').val()
				if(aux_bicicletaparaalquilere_id == bicicletaparaalquilere_id && row != i){
					return true;
				}
		}
	}
	return false
}

function seleccionarbicicleta(row){
	$('#modalview').modal({
			show: true,
			remote: '/bicicletasparaalquileres/seleccionarbicicleta/'+row
	});
}

function selBicicleta(bicicleta_id,row){
	$('#Alquileredetalle'+row+'BicicletasparaalquilereId').val(bicicleta_id)
	recuperarDatosBicicleta(row)
}

function addclienteajax(){
	$.ajax({type:'POST',
			url:'/users/addclientajax.json',
			datatype:'json',
			data:{
						dni:$('#AlquilereNrodocumento').val(),
						telefono:$('#AlquilereTelefono').val(),
						domicilio:$('#AlquilereDireccion').val(),
						email:$('#AlquilereEmail').val(),
						nombre:$('#AlquilereNombre').val(),
						apellido:$('#AlquilereApellido').val()
					},
			success:function(data){
					if(data.error != 'OK' && data.error != ''){
						$().toastmessage('showToast', {
							text     : data.error,
							sticky   : false,
							position : 'top-right',
							type     : 'error',
							closeText: '',
							close    : function () {
							}
						});

					}else{
							$('#btsave').hide(1)

							$('#AlquilereNrodocumento').attr('readonly',true)
							$('#AlquilereTelefono').attr('readonly',true)
							$('#AlquilereDireccion').attr('readonly',true)
							$('#AlquilereEmail').attr('readonly',true)
							$('#AlquilereNombre').attr('readonly',true)
							$('#AlquilereApellido').attr('readonly',true)


							$('#SaleClienteId').val(data.cliente_id);
							//$('#BicicletareparamoUserId').val(data.user_id);
							$().toastmessage('showToast', {
								text     : 'Cliente dado de alta',
								sticky   : false,
								position : 'top-right',
								type     : 'success',
								closeText: '',
								close    : function () {
								}
							});
					}
				}
			}).error(function(){
				$().toastmessage('showToast', {
					text     : 'No se pudo ejecutar el proceso de alta de cliente',
					sticky   : false,
					position : 'top-right',
					type     : 'error',
					closeText: '',
					close    : function () {
					}
				});
			});
}
