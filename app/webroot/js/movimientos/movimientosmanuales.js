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
*    @Fecha 14/05/2014
*    @use Librerias de AJAX para inicio de sesion
*/

$(document).ready(function(){
	IniciarEventos();}
);

function IniciarEventos(){
	VerFuncion(1)
	inicializaMascara('MovimientoImporte')
	mascaraimporte('MovimientoImporte')
	$('#MovimientoClientedoc').mask('99.999.999',{placeholder:" "});
	$('#MovimientoClientedoc').attr('readonly',true)
	$('#MovimientoNomap').attr('readonly',true)	
	mascaraimporteclass('clprecio')
	$('#MovimientoNrocomprobante').numeric()
	$('#MovimientoNrocomprobantetarjeta').numeric()	
	$('#selcliente').click(function(){buscarclientes();
											return false;})
	$('#aceptar').click(function(){
				var tipomovimiento = $('#MovimientoTipomovimientoId').val()
				var importe = $('#MovimientoImporte').val()
				var cuentaid=$('#MovimientoCuentaId').val()
				var deudatotal = Math.round(parseFloat($('#MovimientoDeudatotal').val())*100)/100
				importe = importe.replace('$','')
				importe = importe.trim()
				ImporteMov = Math.round(parseFloat(importe)*100)/100
				
				
				if(typeof(tipomovimiento) =='undefined' || tipomovimiento == 0){
							$().toastmessage('showToast', {
								text     : 'Debe Seleccionar el tipo de movimiento',
								sticky   : true,
								position : 'top-center',
								type     : 'error',
								closeText: '',
								close    : function () {
									//console.log("toast is closed ...");
								}
							});			
						return;
				}
				
				if(ImporteMov <= 0){
							$().toastmessage('showToast', {
								text     : 'El Importe debe ser mayor a cero',
								sticky   : true,
								position : 'top-center',
								type     : 'error',
								closeText: '',
								close    : function () {
									//console.log("toast is closed ...");
								}
							});			
							return;
				}
				
				if(tipomovimiento == 1){
					if(typeof(cuentaid)=='undefined' || cuentaid == 0){
							$().toastmessage('showToast', {
								text     : 'Debe seleccionar un cliente para generar Pagos',
								sticky   : true,
								position : 'top-center',
								type     : 'error',
								closeText: '',
								close    : function () {
									//console.log("toast is closed ...");
								}
							});			
						return
					}
					if(ImporteMov > deudatotal){
							$().toastmessage('showToast', {
								text     : 'El importe ingresado es mayor al adeudado',
								sticky   : true,
								position : 'top-center',
								type     : 'error',
								closeText: '',
								close    : function () {
									//console.log("toast is closed ...");
								}
							});			
						return
					
					}
				}
				
				$('form#MovimientosMovimientosmanualesForm').submit()
			});
	showmessage();
}

function VerFuncion(funcion){
	//MovimientoTipomovimientoid
	//$('#pagocontado').hide(1)
	
	$("#contado").css("background-color","#C4CAC7");
	$("#ctacte").css("background-color","#C4CAC7");
	$('#aceptar').removeAttr("disabled")

	$('#MovimientoTipomovimientoId').attr('readonly',false)
	//$('#MovimientoTipomovimientoId').prop("disabled",false)
	if(funcion == 1){
		$('#cuentacorriente').hide(1)
		$('#MovimientoTipomovimientoid').val(5)
		$("#contado").css("background-color","#57C46B");
	}
	if(funcion == 2){
		$('#MovimientoTipomovimientoId').val(1)
		//$('#MovimientoTipomovimientoId').prop("disabled",true)
		$('#MovimientoTipomovimientoId').attr('readonly',true)
		$("#ctacte").css("background-color","#57C46B");
		$('#cuentacorriente').show(1)
	}
}

function buscarclientes(){
	$('#modalview').modal({
			show: true,
			remote: '/clientes/seleccionarclientemov/'
	});
}

function montototalcredito(){
		var cliente_id = $('#MovimientoClienteId').val()
		if(typeof(cliente_id) != 'undefined' && cliente_id != 0){
			$.ajax({type:'GET',
				   url:'/movimientos/deudatotalcliente/'+cliente_id,
				   datatype:'html',
				   success:function(data){
						if(data != ''){
							$('#montodeuda').html(data);
							$('#MovimientoDeudatotal').val(data);
						}
						},
						onerror:function(){
							alert('Error');
						}
				})//close ajax
		}
}
