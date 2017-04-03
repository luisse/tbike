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

var filadel=0

$(document).ready(function(){
	IniciarEventos();}
);


function IniciarEventos(){
	$('#myTab a:last').tab('show')
	formateafecha('BicicletareparamoFechaegreso');
	formateafecha('BicicletareparamoFechaingreso');
	$('#BicicletareparamoFechaegreso').datetimepicker({pickTime: false,language:'es'});
	$('#BicicletareparamoDocumento').mask('99.999.999',{placeholder:" "});
	//mascara de importes
	//
	total = $('#BicicletareparamoImportetotal').val()
	total = decimales(total)
	$('#BicicletareparamoImportetotal').val(total)
	$('#BicicletareparamoDescuento').numeric()
	$('.clcantidad').numeric()

	$('#BicicletareparamoDocumento').attr('readonly',true)
	$('#BicicletareparamoFechaingreso').attr('readonly',true)
	$('#BicicletareparamoNomap').attr('readonly',true)
	$('#BicicletareparamoImportetotal').attr('readonly',true)
	//mascaraimporte('BicicletareparamoImportetotal')


	$('#agregarfila').click(function(){
			filaNueva()
			});
	//SETEAMOS EL TOTAL DE FILAS DE REPUESTOS
	oId = parseInt($('#BicicletareparamoTotalrows').val())
	//CARGAMOS EL CLIENTE
	getclient()
	//SETEO VALORES DECIMALES
	setDecimal()
	Ajaxcargarbicicletas()
	mascaraimporteclass('clprecio')
	$('#modalview').on('hidden.bs.modal', function () {
		$('#content').empty();
		$(this).data('bs.modal', null); //<---- empty() to clear the modal
	})
	$('.clprecio').change(function(){recalculartotal()})
	$('.clcantidad').change(function(){recalculartotal()})
	$('#guardar').click(guardardatos)
	$('#cancelar').click(function(){window.history.back()})
}

function guardardatos(){
	var ldt_hoy			= new Date();
	var ls_fechaactual 	= ldt_hoy.format('dd/mm/yyyy');
	var ls_fechaegreso 	= $("#BicicletareparamoFechaegreso").val()
	var li_result 		= 0

	if(typeof(ls_fechaegreso)!='undefined'){
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

	if(!verificarselbicicleta()){
			$().toastmessage('showToast', {
					text     : 'No se selecciono una bicicleta para el ingreso',
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
	$('form#BicicletareparamoEditForm').submit()
}

function getclient(){
	var cliente_id = $('#BicicletareparamoClienteId').val()
	//si se modifica el cliente debemos borrar la bicicleta asignada
	$('#BicicletareparamoClienteId').val('')
		$.ajax({type:'GET',
			   url:'/clientes/getclient/'+cliente_id,
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
							$('#BicicletareparamoClienteId').val(cliente_id)
							$('#BicicletareparamoNomap').val(ls_nomap)
							$('#biciclient').show()
							reloadList();
							})//close each
					}else{
						mensaje('No existe el Cliente para el Documento Ingresado','Asignación de Cliente')
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
				MarcarBicicletaAnt()
				var divPaginationLinks = '#biciclient'+" .pagination a,.sort a";
			    $(divPaginationLinks).click(function(){
			        var thisHref = $(this).attr("href");
			        reloadList(thisHref);
			        //recarmamos el proceso de carga
			        return false;
			    });
	})
}


//Permite cargar en el div el ajax
function loadPiece(href,divName) {
	//reloadList();
	$(divName).load(href, cliente_id = $('#BicicletareparamoClienteId').val(), function(){
		//AjaxLinkOn(divName)
        var divPaginationLinks = divName+" .pagination a,.sort a";
        $(divPaginationLinks).click(function(){
            var thisHref = $(this).attr("href");
            loadPiece(thisHref,divName);
            //recarmamos el proceso de carga
            return false;
        });
    });
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
				mensaje('Existe mas de una Bicicleta Seleccionada solo se puede seleccionar una bicicleta','Seleción de Bicicleta')
				return;
		}
	}
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

function BorrarProductosAsoc(fila){
	filadel = fila //GLOBAL DELETE
	var bicicletareparamorepuesto_id = $('#Bicicletareparamorepuesto'+fila+'Id').val()
	if(typeof(bicicletareparamorepuesto_id) != 'undefined' && bicicletareparamorepuesto_id != ''){
		$.ajax({
			url:'/bicicletareparamorepuestos/delete/'+bicicletareparamorepuesto_id,
			datatype:'html',
			success:function(data){
				data=data.trim()
				if(typeof(data)!='undefined' && data != ''){
					mensaje(data)
				}else{
					eliminarFila(filadel)
					recalculartotal()
					$('#cancelar').hide()
				}
			}
		});
	}
}

function eliminarFila(fila){
	$("#bicicletareparamorepuesto_" +fila).remove();
	recalculartotal();
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
	var cantidad=0;
	var descripcion='';
	for(i = 0;i <= oId;i++){
			//incrementamos el producto en uno para la cantidad
    	  descripcion = $('#Bicicletareparamorepuesto'+i+'Repuestodescr').val()
			cantidad = $('#Bicicletareparamorepuesto'+i+'Cantidad').val()
    	  if((typeof(descripcion) == 'undefined' || descripcion == '') || (typeof(cantidad)=='undefined' || cantidad=='' || cantidad=='0')){
				eliminarFila(i)
    	  }
	}
}

function setDecimal(){
	var i=0;
	for(i = 0;i<oId;i++){
		//incrementamos el producto en uno para la cantidad
	  	precio = $('#Bicicletareparamorepuesto'+i+'Precio').val()
	  	if((typeof(precio) != 'undefined' || precio != '')){
	  		precio=decimales(precio)
	  		$('#Bicicletareparamorepuesto'+i+'Precio').val(precio)
	  	}
	}
}

function MarcarBicicletaAnt(){
	var bicicleta_id=$('#BicicletareparamoBicicletaId').val()
	for(i=0;i<=10;i++){
		lt_bicicleta_id=$('#bicicleta_id'+i).val()
		if(typeof(lt_bicicleta_id)!='undefined' && lt_bicicleta_id!='' && bicicleta_id ==lt_bicicleta_id){
				$('#sel'+i).attr("checked",true);
				return;
		}
	}
}

function verBicicleta(id){
	$('#modalview').modal({
			show: true,
			remote: '/bicicletas/view/'+id
	});
	return false
}

function buscarproductosmodal(row){
	$('#modalview').modal({
		show: true,
		remote: '/products/seleccionarproducto/'+row
	});
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
