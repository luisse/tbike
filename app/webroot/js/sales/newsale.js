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
$(document).ready(function(){
	IniciarEventos();}
);
var oId = 5
var stockval = false

function IniciarEventos(){
	//fecha actual para la venta
	//$("#SaleFecha").datetimepicker({pickTime: false,language:'es'});
	fechaactual('SaleFecha');

	$('#SaleClientedoc').attr('readonly',true)
	$('#SaleNomap').attr('readonly',true)
	$('#SaleCredito').attr('readonly',true)
	$('#SaleNrofactura').attr('readonly',true)
	$("#SaleFecha").attr('readonly',true)

	$('#myTab a:last').tab('show')
	//mascaras de tiempo
	$('.cantidad').numeric()
	$('.id').numeric()
	$('.subtotal').attr('readonly',true)
	$('.detail').attr('readonly',true)
	$('.precio').attr('readonly',true)
	//al seleccionar un usuario debemos recuperar el id del cliente
	$('#agregarfila').click(function(){
			newrow()
			});
	$('#selcliente').click(function(){buscarclientes();})

	$('#ProductCategoriaId').change(function(){
		cargardropcateg('ProductCategoriaId','/categorias/retornalxmlsubcategoria/','ProductSubcategoriaId')
	})

	$('#modalview').on('hidden.bs.modal', function () {
		//$(this).removeData('bs.modal');
		$('#content').empty();
		$(this).data('bs.modal', null); //<---- empty() to clear the modal

	})

	$('#buscarproductos').click(function(){ reloadList(link) });
	$('#aceptarventa').click(function(){guardardatos()})
	showmessagelocal()

	$('#agregarcliente').click(function(){
			$('#btsave').show(1)
			$('#selcliente').hide(1)
			$('#clientadd').show(1)
		})
	$('#guardarcliente').click(function(){addclienteajax()})

}

function guardardatos(){
	if(!ValidarExistStock()){
  		$().toastmessage('showErrorToast', "Fallo en el control de stock de producto valida los datos y su stock");
  		return
	}

	if(!ValidarExistProduct()){
  		$().toastmessage('showErrorToast', "Debe Existir al menos un Producto cargado para la venta");
  		return
	}
	EliminarFilasVacias();
	//AgregarPago()
	$('form#SaleNewsaleForm').submit()
}

function buscarclientes(){
	$('#modalview').modal({
			show: true,
			remote: '/clientes/seleccionarclienteventa/'
	});
}



//Agregar una nueva fila
function newrow(){
	oId++
	$.ajax({type:'GET',
		async:false,
		url:'/sales/newrow/'+oId,
		datatype:'html',
		success:function(data){
				var strHtml = "<tr id='salesdetails_"+oId+"'><tr>"
				$("#salesdetails").append(strHtml)
				$("#salesdetails_"+oId).append(data)
				//AJAX COPLEX FOR NEW ROWS
				$('#Salesdetail'+oId+'Cantidad').numeric()
				$('#Salesdetail'+oId+'Price').attr('readonly',true)
				$('#Salesdetail'+oId+'Productdetail').attr('readonly',true)
				$('#Salesdetail'+oId+'Subtotal').attr('readonly',true)

			}
		})
}

function productstock(row){
	var id = $("#Salesdetail"+row+'ProductId').val()
	var cantidad = $("#Salesdetail"+row+'Cantidad').val()
	if(typeof(id)!= 'undefined' && id !=''){
		$.ajax({type:'GET',
				  url:'/products/existecantidad/'+id+'/'+cantidad,
				  async:false,
				  datatype:'xml',
				  success:function(data){
					  if(data == 0){
						 $().toastmessage('showErrorToast', "No existe la cantidad solicitada");
						 $("#Salesdetail"+row+'Cantidad').val('1')
			 			stockval=false
					  }else{
						  stockval=true
					  }
				  },
				  error:function(xtr,fr,ds){
					  $().toastmessage('showErrorToast', "No se pudo establecer el stock del producto");
				}
		  })//close ajax
	}
}

function eliminarFila(fila){
	$("#salesdetails_" +fila).remove();
	recalculartotal()
	return false;
}

function recuperarDatosProduct(row,llamado){
	//puede ser llamado desde el change u desde la ventana de seleccion

	if(llamado == 'id'){
		var id = $("#Salesdetail"+row+'ProductId').val()
		var url='/products/productdetailxml/'+id+'/'+0+'/'+0
		row = filaId(id)
		var result = existeid(id,row,llamado)
		//if the product exists dont insert a new row for then
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
									var ls_descripction = $(this).find('descripcion').text()
									var ls_codgen =$(this).find('codgen').text()
									var li_precio = $(this).find('precio').text()
									$('#Salesdetail'+row+'Productdetail').val(ls_descripction)
									$('#Salesdetail'+row+'ProductId').val(li_id)
									$('#Salesdetail'+row+'Price').val(li_precio)
									$('#Salesdetail'+row+'ProductsId').val(li_id)
									$('#Salesdetail'+row+'Cantidad').val('1')
									subtotal = parseFloat(li_precio)
									$('#Salesdetail'+row+'Subtotal').val(subtotal)
									//recalculamos el total vendido
									recalculartotal()
									encontrado = true
									$().toastmessage('showSuccessToast', "Producto Agregado...");
						  });//close each
						  if(!encontrado){
							  $("#Salesdetail"+row+'ProductId').val('')
							  $('#Salesdetail'+row+'Price').val('')
							  $('#Salesdetail'+row+'Productdetail').val('')
							  $('#Salesdetail'+row+'ProductsId').val('')
							  $('#Salesdetail'+row+'Cantidad').val('')
							  $('#Salesdetail'+row+'Subtotal').val('')
							  $().toastmessage('showErrorToast', "No se Pudo recuperar el Producto");
						  }
				  },
				  error:function(xtr,fr,ds){
						$().toastmessage('showToast', {
							text     : 'No se pudieron cargar los datos del Producto. Verifique la conexión al server',
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

	}else{
		var id = $("#Product"+row+'id').val()
		row_s = filaId(id)
		var result = existeid(id,row_s,llamado)
		if(!result){
			var li_id = $('#Product'+row+'id').val()
			var li_precio =  $('#Product'+row+'precio').val()
			var ls_descripction =  $('#Product'+row+'descripcion').val()
			$('#Salesdetail'+row_s+'ProductId').val(li_id)
			$('#Salesdetail'+row_s+'Price').val(li_precio)
			$('#Salesdetail'+row_s+'Productdetail').val(ls_descripction)
			$('#Salesdetail'+row_s+'ProductsId').val(li_id)
			$('#Salesdetail'+row_s+'Cantidad').val('1')
			subtotal = parseFloat(li_precio)
			$('#Salesdetail'+row_s+'Subtotal').val(subtotal)
			$().toastmessage('showSuccessToast', "Producto Agregado");
			recalculartotal()
		}
	}
}


function recalcularcantidad(row){
	var cantidad = $('#Salesdetail'+row+'Cantidad').val()
	var precio =  $('#Salesdetail'+row+'Price').val()
	productstock(row)
	var subtotal = parseInt(cantidad)*parseFloat(precio)
	$('#Salesdetail'+row+'Subtotal').val(subtotal)
	recalculartotal()
}

function filaId(idnew){
	//si el id existe no agrega la nueva fila
	for(i = 1;i<=oId;i++){
		id = $('#Salesdetail'+i+'ProductId').val()
		if(id == idnew) return i
	}
	//si encuentra un undefined no hay mas filas vacias agrega una nueva fila
	for(i = 1;i<=oId;i++){
		id = $('#Salesdetail'+i+'ProductId').val()
		if((typeof(id) == 'undefined')){
			//agregamos nueva fila si la ultima fila se encuentra ocupada con datos
			newrow()
			break
		}
	}
	for(i = 1;i<=oId;i++){
		id = $('#Salesdetail'+i+'ProductId').val()
		if(id == '') return i
	}

	return 0
}

function existeid(idnew,row,llamado){
	//fila donde se encuentra el id solo la
	//recuperamos la fila en que se encuentra el id caso contrario
	for(i = 1;i<=oId;i++){
		id = $('#Salesdetail'+i+'ProductId').val()
		if(typeof(id) != 'undefined'){
			if(id == idnew && i != row){
				//incrementamos el producto en uno para la cantidad
    	  		cantidad = $('#Salesdetail'+i+'Cantidad').val()
    	  		cantidad = parseInt(cantidad) + 1
    	  		$('#Salesdetail'+i+'Cantidad').val(cantidad)
				recalcularcantidad(i)
				return true
			}
		}
	}
	return false
}

//Permite recalcular el total obtenido
function recalculartotal(){
	var total = 0
	for(i = 1;i<=oId;i++){
			//incrementamos el producto en uno para la cantidad
    	  	subtotal = $('#Salesdetail'+i+'Subtotal').val()
    	  	if(typeof(subtotal) !='undefined' && subtotal != ''){
    	  		total = Math.round((total + parseFloat(subtotal))*100)/100
    	  	}
	}
	$('#SaleTotalsale').val(total)
}

/*
 * Funcion: permite captar el evento clicked sobre un link para luego
 * cargarlo en el div respectivo
 * */
function loadPiece(href,divName) {
	$('#cargandodatos').show(1)
	$(divName).load(href, {}, function(){
        var divPaginationLinks = divName+" #pagination a,#order a";
        $(divPaginationLinks).click(function(){
            var thisHref = $(this).attr("href");
            loadPiece(thisHref,divName);
            //recarmamos el proceso de carga
            return false;
        });
        //si el evento es necesario lo disparamos aqui
        JsNextExecute()
    }).always(function() {
		$('#cargandodatos').hide(1)
	});
}

function buscarproductos(links){
	var typeproduct = $('#typeproduct_id').val()
	var subtypeproduct = $('#subtype_id').val()
	var rubro = $('#rubro_id').val()
	links = links+'/'+typeproduct+'/'+subtypeproduct+'/'+rubro
	loadPiece(links,"#listproduct");
}

function AgregarProductoBuscador(row){

}
//Generamos la reasignación de facebox
function JsNextExecute(){
    $('a[rel*=productfacebox]').facebox()
    $(document).bind('loading.facebox', function() {
            $(document).unbind('keydown.facebox');
            $('#facebox_overlay').unbind('click');
        });
}

//Funcion permite determinar las filas vacias
function EliminarFilasVacias(){
	for(row = 1;row <= oId;row++){
		id = $('#Salesdetail'+row+'ProductId').val()
		if(typeof(id) != 'undefined' && id == ''){
			eliminarFila(row)
		}
	}
}

//Funcion Permite validar si existe al menos un producto valido para vender
function ValidarExistProduct(){
	var existe = false
	for(row = 1;row <= oId;row++){
		id = $('#Salesdetail'+row+'ProductId').val()
		if(typeof(id) != 'undefined' && id != ''){
			return true
		}
	}
	return false
}

function ValidarExistStock(){
	var idvalstock='';
	var cantidadstock=''
	stockval=false
	for(row = 1;row <= oId;row++){
		id = $('#Salesdetail'+row+'ProductId').val()
		cantidad = $('#Salesdetail'+row+'Cantidad').val()
		if(typeof(id) != 'undefined' && id != ''){
			stockval=false
			productstock(row)
			if(stockval==false)
				return false
		}
	}
	return true
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

function reloadList(rlink){
	var serialize = $('#filterproduct').serialize()
	$('#cargandodatos').show(1)
	$.post(rlink,serialize,
			function(data) {
				$('#listproduct').html(data);
				var divPaginationLinks = '#listproduct'+" .pagination a, .sort a";
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
				}
			});
	}
}

function mostrarproduct(row){
	var product_id = $("#Product"+row+'id').val()
	if(typeof(product_id)!='undefined'){
		$('#modalview').modal({
				show: true,
				remote: '/products/view/'+product_id
		});
	}else{
		$().toastmessage('showToast', {
				text     : 'No se pudo encontrar el producto',
				sticky   : false,
				position : 'top-right',
				type     : 'success',
				closeText: '',
				close    : function () {
				}
			});
	}
}

/*
*Agregar nuevo cliente en ajax
*/
function addclienteajax(){
	$.ajax({type:'POST',
			url:'/users/addclientajax.json',
			datatype:'json',
			data:{
						dni:$('#SaleNrodocumento').val(),
						telefono:$('#SaleTelefono').val(),
						domicilio:$('#SaleDireccion').val(),
						email:$('#SaleEmail').val(),
						nombre:$('#SaleNombre').val(),
						apellido:$('#SaleApellido').val()
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
							$('#SaleNrodocumento').attr('readonly',true)
							$('#SaleTelefono').attr('readonly',true)
							$('#SaleDireccion').attr('readonly',true)
							$('#SaleEmail').attr('readonly',true)
							$('#SaleNombre').attr('readonly',true)
							$('#SaleApellido').attr('readonly',true)
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
