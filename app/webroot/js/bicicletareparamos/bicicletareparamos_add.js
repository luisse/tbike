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
*    @Fecha 21/02/2014
*    @use Librerias de AJAX para inicio de sesion
*/
//inicializamos eventos y procesos desde el DOM
var oId = 6
$(document).ready(function(){
	IniciarEventos();}
);


function IniciarEventos(){

  $('#myTab a:last').tab('show')
	$("#BicicletareparamoFechaegreso").datetimepicker({pickTime: false,language:'es'});
	fechaactual('BicicletareparamoFechaingreso');
	fechaactual('BicicletareparamoFechaegreso');
	$('#BicicletareparamoDocumento').mask('99.999.999',{placeholder:" "});
	$('#BicicletareparamoDocumento').change(function(){getclient();})
	//mascara de importes
	inicializaMascara('BicicletareparamoImportetotal')
	mascaraimporte('BicicletareparamoImportetotal')
	$('#BicicletareparamoFechaingreso').attr('readonly',true)
	$('#BicicletareparamoNomap').attr('readonly',true)
	$('#BicicletareparamoImportetotal').attr('readonly',true)
	$('#BicicletareparamoTelefono').attr('readonly',true)
	$('#BicicletareparamoDireccion').attr('readonly',true)
	$('#BicicletareparamoDescuento').numeric()
	$('.clprecio').val('0.00')
	$('.clcantidad').numeric()
	$('.clprecio').change(function(){recalculartotal()})
	$('.clcantidad').change(function(){recalculartotal()})
	mascaraimporteclass('clprecio')
	$('#agregarfila').click(function(){
			filaNueva()
			});
	$('#buscarcliente').click(function(){buscarclientes()})
	Ajaxcargarbicicletas()
	$('#guardar').click(guardardatos)

	$('#agregarbicicleta').click(function(){
		$('#addbicicleta').show(1);
		$('#biciclient').hide(1);
	})
	$('#cancelar').click(function(){window.history.back()})
	$('#agregarcliente').click(function(){
			$('#btsave').show(1)
			//$('#nombreapellido').show(1)
			//$('#btnuevo').hide(1)
			//$('#nombredetalle').hide(1)
			$('#clientselect').hide(1)
			$('#clientadd').show(1)

			$('#BicicletareparamoNomap').attr('readonly',false)
			$('#BicicletareparamoTelefono').attr('readonly',false)
			$('#BicicletareparamoDireccion').attr('readonly',false)
			$('#BicicletareparamoNomap').val('')
			$('#BicicletareparamoTelefono').val('')
			$('#BicicletareparamoDireccion').val('')

		})
	$('#guardarbicicleta').click(function(){addbicicleta()})
	$('#guardarcliente').click(function(){addclienteajax()})
	$('#modalview').on('hidden.bs.modal', function () {
		//$(this).removeData('bs.modal');
		$('#content').empty();
		$(this).data('bs.modal', null); //<---- empty() to clear the modal

	})
}

function guardardatos(){
	var ldt_hoy			= new Date();
	var ls_fechaactual 	= ldt_hoy.format('dd/mm/yyyy');
	var ls_fechaegreso 	= $("#BicicletareparamoFechaegreso").val()
	var li_clienteid 	= $('#BicicletareparamoClienteId').val()
	var li_result 		= 0
	var ls_detalle		= $('#BicicletareparamoDetallereparacion').val()


	if(typeof(ls_fechaegreso)!='undefined'){
		 //alert(ls_fechaegreso+'-'+ls_fechaactual)
		 li_result = validafechasAll(ls_fechaactual,ls_fechaegreso)
		 if(li_result < 0){
			$().toastmessage('showToast', {
					text     : 'La Fecha de Egreso debe ser mayor a la Fecha Actual',
					sticky   : true,
					position : 'top-right',
					type     : 'error',
					closeText: '',
					close    : function () {
						//console.log("toast is closed ...");
					}
				});

			 return
		 }
	}

	if(typeof(li_clienteid)=='undefined' || li_clienteid == ''){
		$().toastmessage('showToast', {
			text     : 'Debe Ingresar un Cliente',
			sticky   : true,
			position : 'top-right',
			type     : 'error',
			closeText: '',
			close    : function () {
				//console.log("toast is closed ...");
			}
		});
		$('#BicicletareparamoDocumento').focus()
		return
	}

	if(typeof(ls_detalle)=='undefined' || ls_detalle==''){
		$().toastmessage('showToast', {
			text     : 'Debe Ingresar el detalle de reparación',
			sticky   : true,
			position : 'top-right',
			type     : 'error',
			closeText: '',
			close    : function () {
				//console.log("toast is closed ...");
			}
		});
		$('#BicicletareparamoDetallereparacion').focus()
		return

	}

	if(!verificarselbicicleta()){
		$().toastmessage('showToast', {
				text     : 'No se selecciono una Bicicleta para reparar',
				sticky   : true,
				position : 'top-right',
				type     : 'error',
				closeText: '',
				close    : function () {
					//console.log("toast is closed ...");
				}
			});
		return
	}

	$('.popup').html('');

	if(!ValidarCargaItem()){
		$().toastmessage('showToast', {
				text     : 'Debe Ingresar al menos una fila con todos los datos en Ingreso de Gastos',
				sticky   : true,
				position : 'top-right',
				type     : 'error',
				closeText: '',
				close    : function () {
					//console.log("toast is closed ...");
				}
			});
		return
	}
	EliminarFilasSinDatos()
	$('form#BicicletareparamoAddForm').submit()
}

function getclient(){
	var documento = $('#BicicletareparamoDocumento').val()
	//si se modifica el cliente debemos borrar la bicicleta asignada
	$('#BicicletareparamoClienteId').val('')
	$('#BicicletareparamoBicicletaId').val('')
		$.ajax({type:'GET',
			   url:'/clientes/getclient/'+documento,
			   datatype:'xml',
			   success:function(data){
					var xml;
					var options = '';
					xml = data;
					if(data != ''){
						$(xml).find('datos').each(function(){
							//Cargamos el drow dow con las provincias
							var cliente_id = $(this).find('id').text()
							var ls_nomap = $(this).find('nomape').text()
							var ls_telefono  = $(this).find('telefono').text()
							var ls_domicilio  = $(this).find('domicilio').text()
							$('#BicicletareparamoClienteId').val(cliente_id)
							$('#BicicletareparamoNomap').val(ls_nomap)
							$('#BicicletareparamoTelefono').val(ls_telefono)
							$('#BicicletareparamoDireccion').val(ls_domicilio)
							$('#biciclient').show()
							reloadList();
							})//close each
					}else{
						$().toastmessage('showToast', {
							text     : 'No existe el Cliente para el Documento Ingresado',
							sticky   : true,
							position : 'top-right',
							type     : 'error',
							closeText: '',
							close    : function () {
							}
						});

						$('#BicicletareparamoNomap').val('')
						$('#biciclient').hide()
					}
					},
					onerror:function(){
						alert('Error');
					}
			})//close ajax
}

function reloadList(plink){
	var cliente_id = $('#BicicletareparamoClienteId').val()
	plink = rlink+'/'+cliente_id
	$.post(plink,cliente_id,
			function(data) {
				$('#biciclient').html(data);
				var divPaginationLinks = '#biciclient'+" .pagination a,.sort a";
			    $(divPaginationLinks).click(function(){
			        var thisHref = $(this).attr("href");
			        reloadList(thisHref);
			        //recarmamos el proceso de carga
			        return false;
			    });
	})

}

function Ajaxcargarbicicletas(){
	reloadList(rlink)
}


function marcasel(fila){
	var cantbikes = $('#totalbikes').val()
	var bicicleta_id = $('#bicicleta_id'+fila).val()
	$('#BicicletareparamoBicicletaId').val(bicicleta_id)
	for(i=0;i<=cantbikes;i++){
		sel=$('#sel'+i).is(':checked')
		if(typeof(sel)!='undefined' && sel==1 && fila != i){
				$('#sel'+i).removeAttr("checked");
				$().toastmessage('showToast', {
					text     : 'Existe mas de una Bicicleta Seleccionada solo se puede Seleccionar una Bicicleta a reparar',
					sticky   : true,
					position : 'top-right',
					type     : 'error',
					closeText: '',
					close    : function () {
					}
				});

				return;
		}
	}
}

function verificarselbicicleta(){
	var cantbikes = $('#totalbikes').val()
	for(i=0;i<=cantbikes;i++){
		sel=$('#sel'+i).is(':checked')
		if(typeof(sel)!='undefined' && sel==1){
				return true;
		}
	}
	return false
}

function filaNueva(){
	$.ajax({type:'GET',
			url:'/bicicletareparamorepuestos/nuevafila/'+oId,
			datatype:'html',
			success:function(data){
					var strHtml = "<tr id='bicicletareparamorepuesto_"+oId+"'></tr>"
					$("#bicicletareparamorepuesto").append(strHtml)
					$("#bicicletareparamorepuesto_"+oId).append(data)
					//inicializamos el filtro para la nueva fila
					$('.clprecio').val('0.00')
					$('.clcantidad').numeric()
					$('.clprecio').change(function(){recalculartotal()})
					$('.clcantidad').change(function(){recalculartotal()})
					mascaraimporteclass('clprecio')
					oId++
				}
			})
}


/*PROCEDIMIENTOS DE BORRADO-PARA USAR LUEGO CON AJAX*/
function BorrarProductosAsoc(fila){
	eliminarFila(fila)
}

function eliminarFila(fila){
	$("#bicicletareparamorepuesto_" +fila).remove();
	return false;
}

/*
 * Funcion: permite recalcular el importe total
 * */
function recalculartotal(){
	var total = 0
	var Importe = $('#BicicletareparamoImportetotal').val()
	var importeinicial=0
	var totalgeneral = 0
	var subtotal=''
	Importe = Importe.replace('$','')
	Importe = Importe.trim()
	Importeinicial = Math.round(parseFloat(Importe)*100)/100
	for(i = 0;i<=oId;i++){
			//incrementamos el producto en uno para la cantidad
    	  	subtotal = $('#Bicicletareparamorepuesto'+i+'Precio').val()
    	  	if(typeof(subtotal) !='undefined' && subtotal != ''){
        	  	subtotal = subtotal.replace('$','')
        	  	subtotal.trim()
					cantidad = $('#Bicicletareparamorepuesto'+i+'Cantidad').val()
					if( typeof(cantidad) == 'undefined' || cantidad == '' || parseFloat(cantidad)==0){
						cantidad = 1
					}
    	  		totalgeneral = Math.round((totalgeneral + parseFloat(subtotal)*parseFloat(cantidad))*100)/100
    	  	}
	}
	$('#BicicletareparamoImportetotal').val(totalgeneral)
}

function EliminarFilasSinDatos(){
	var i=0;
	for(i = 0;i<=oId;i++){
			//incrementamos el producto en uno para la cantidad
    	  	descripcion = $('#Bicicletareparamorepuesto'+i+'Repuestodescr').val()
				cantidad = $('#Bicicletareparamorepuesto'+i+'Cantidad').val()
    	  	if((typeof(descripcion) == 'undefined' || descripcion == '') || (typeof(cantidad)=='undefined' || cantidad=='' || cantidad=='0')){
				eliminarFila(i)
    	  	}
	}
}

function buscarclientes(){
	$('#modalview').modal({
			show: true,
			remote: '/clientes/seleccionarcliente/'
	});
}

function buscarproductosmodal(row){
	$('#modalview').modal({
		show: true,
		remote: '/products/seleccionarproducto/'+row
	});
}

function verBicicleta(id){
	$('#modalview').modal({
			show: true,
			remote: '/bicicletas/view/'+id
	});
	return false
}

//Funcion Permite validar si existe al menos un producto valido para vender
function ValidarCargaItem(){
	var existe = false
	for(row = 0; row <= oId;row++){
		repuestodesc = $('#Bicicletareparamorepuesto'+row+'Repuestodescr').val()
		cantidad 	 = $('#Bicicletareparamorepuesto'+row+'Cantidad').val()
		precio		 = $('#Bicicletareparamorepuesto'+row+'Precio').val()
		if((typeof(repuestodesc) != 'undefined' && repuestodesc != '') &&
				(typeof(cantidad) != 'undefined' && cantidad != '') &&
				(typeof(precio) != 'undefined' && precio != '')){
			return true
		}
	}
	return false
}

function addclienteajax(){
	var serialize = $('#clientinfo').serialize()
	$.ajax({type:'POST',
			url:'/users/addclientajax.json',
			datatype:'json',
			data:{
						dni:$('#BicicletareparamoNrodocumento').val(),
						telefono:$('#BicicletareparamoTelefono').val(),
						domicilio:$('#BicicletareparamoDireccion').val(),
						email:$('#BicicletareparamoEmail').val(),
						nombre:$('#BicicletareparamoNombre').val(),
						apellido:$('#BicicletareparamoApellido').val()
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

							$('#BicicletareparamoNrodocumento').attr('readonly',true)
							$('#BicicletareparamoTelefono').attr('readonly',true)
							$('#BicicletareparamoDireccion').attr('readonly',true)
							$('#BicicletareparamoEmail').attr('readonly',true)
							$('#BicicletareparamoNombre').attr('readonly',true)
							$('#BicicletareparamoApellido').attr('readonly',true)


							$('#BicicletareparamoClienteId').val(data.cliente_id);
							$('#BicicletareparamoUserId').val(data.user_id);
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


function addbicicleta(){
	var cliente_id = $('#BicicletareparamoClienteId').val()
	if(typeof(cliente_id)!='undefined' && cliente_id != ''){
		$.ajax({type:'POST',
				url:'/bicicletas/addjson.json',
				datatype:'json',
				data:{
							cliente_id:$('#BicicletareparamoClienteId').val(),
							marca:$('#BicicletareparamoMarca').val(),
							modelo:$('#BicicletareparamoModelo').val(),
							detalles:$('#BicicletareparamoEmail').val(),
							equipodetalle:$('#BicicletareparamoNombre').val(),
							nrocuadro:$('#BicicletareparamoApellido').val()
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

							$('#BicicletareparamoMarca').val('')
							$('#BicicletareparamoModelo').val('')
							$('#BicicletareparamoEmail').val('')
							$('#BicicletareparamoNombre').val('')
							$('#BicicletareparamoApellido').val('')
							$('#addbicicleta').hide(1);
							$('#biciclient').show(1);
							$('BicicletareparamoClienteId').val(data.cliente_id);
							$('BicicletareparamoUserId').val(data.user_id);
							reloadList()
							$().toastmessage('showToast', {
									text     : 'Bicicleta dada de alta',
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
						text     : 'No se pudo ejecutar el proceso de alta de bicicletas',
						sticky   : false,
						position : 'top-right',
						type     : 'error',
						closeText: '',
						close    : function () {
						}
					});
				});
		}else{
			$().toastmessage('showToast', {
				text     : 'No se selecciono un cliente',
				sticky   : false,
				position : 'top-right',
				type     : 'error',
				closeText: '',
				close    : function () {
				}
			});

		}
}
