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
	var funcclose=$('#MovimientoFuncerrar').val()
	var cuenta_id=$('#MovimientoCuentaid').val()
	if(funcclose.search('CERRAR') > 0 ){
		$('#modalview').modal('hide');
	}

	if(typeof(cuenta_id) == 'undefined' || parseFloat(cuenta_id) == 0){
		$('#ctacte').hide(1);
	}

	
	$('#MovimientoVuelto').attr('readonly',true)
	$('#MovimientoDeuda').attr('readonly',true)
	inicializaMascara('MovimientoAbonacon')
	mascaraimporte('MovimientoAbonacon')
	inicializaMascara('MovimientoAbonaconcred')
	mascaraimporte('Movimientoabonaconcred')
	mascaraimporteclass('clprecio')
	$('#MovimientoNrocomprobante').numeric()
	$('#MovimientoNrocomprobantetarjeta').numeric()
	

	$('#modalview').on('hidden.bs.modal', function () {
		$(this).data('bs.modal', null); //<---- empty() to clear the modal
	})			

	$('#MovimientoAbonacon').change(function(){calculartotales('MovimientoAbonacon')})
	$('#MovimientoAbonaconcred').change(function(){calculartotales('MovimientoAbonaconcred')})
	$('#aceptar').click(function(){
		if($('#MovimientoLlamadodesde').val() == 1){
			//FUNCION DE bicicletaentrega.js
			cambiarestado($('#MovimientoComprobanteint').val());
		}else
			if($('#MovimientoLlamadodesde').val() == 2){
				aceptarventa()
			}else{
				AceptarMovimiento()
			}
			
	})
	
	
	VerFuncion(1)
}



function VerFuncion(funcion){
	//MovimientoTipomovimientoid
	$('#alerta').hide(1)
	$('#pagocontado').hide(1)
	$('#cuentacorriente').hide(1)
	$('#tarjeta').hide(1)
	$("#contado").css("background-color","#C4CAC7");
	$("#ctacte").css("background-color","#C4CAC7");
	$("#creditcard").css("background-color","#C4CAC7");
	$('#aceptar').removeAttr("disabled")
	
	if(funcion == 1){
		$('#MovimientoTipomovimientoid').val(5)
		$("#contado").css("background-color","#57C46B");
		$('#pagocontado').show(1)
	
	}
	if(funcion == 2){
		$('#MovimientoTipomovimientoid').val(2)
		$("#ctacte").css("background-color","#57C46B");
		$('#cuentacorriente').show(1)
		calculartotales('MovimientoAbonaconcred')
	}
	if(funcion == 3){
		$('#MovimientoTipomovimientoid').val(6)		
		$("#creditcard").css("background-color","#57C46B");
		$('#tarjeta').show(1)
	}
}

function calculartotales(objectval){
	var abonacon = $('#'+objectval).val()
	var importetotal = $('#MovimientoImporte').val()
	var vuelto = 0;
	$('#alerta').hide(1)
	abonacon = abonacon.replace('$','')
	abonacon = abonacon.trim()
	ImporteAbonado = Math.round(parseFloat(abonacon)*100)/100
	$('#aceptar').removeAttr("disabled")
	if(ImporteAbonado < importetotal && objectval !='MovimientoAbonaconcred'){
		$('#alerta').show(1)
		$('#mensaje').html('El Importe Abonado es menor al importe total')
		$('#aceptar').attr("disabled", "disabled");
	}

	vuelto = Math.round((ImporteAbonado - importetotal)*100)/100
	
	if(objectval == 'MovimientoAbonaconcred'){
		totalcredito = $('#totalcredito').val()
		maxdeuda=$('#maxdeuda').val()
		totalcredito = Math.round(parseFloat(totalcredito)*100)/100
		maxdeuda = Math.round(parseFloat(maxdeuda)*100)/100
		totalcredito = totalcredito + (vuelto * -1)
		if(totalcredito > maxdeuda && maxdeuda>0){
			$('#alerta').show(1)
			$('#mensaje').html('El cliente no puede seguir operando con el crédito ya que excede el limite de deuda')
			$('#aceptar').attr("disabled", "disabled");
		}
		if(ImporteAbonado > importetotal){
			$('#alerta').show(1)
			$('#mensaje').html('La venta con crédito solo es posible si el importe de abono es menor al importe de pago')
			$('#aceptar').attr("disabled", "disabled");
		}
	}
	if(vuelto < 0) vuelto = vuelto* -1
	if(objectval != 'MovimientoAbonaconcred')
		$('#MovimientoVuelto').val(vuelto)
	else
		$('#MovimientoDeuda').val(vuelto)
}

function AceptarMovimiento(){
	var Tipomovimientoid = $('#MovimientoTipomovimientoid').val()
	var llamadodesde =  $('#MovimientoLlamadodesde').val()
	var tarjeta = 0
	var abonacon = 0
	var ImporteAbonado = 0
	var result  = false
	
	//TARJETA
	if(Tipomovimientoid==6){
		tarjeta = $('#MovimientoNrocomprobantetarjeta').val()
		if(typeof(tarjeta) =='undefined' || tarjeta == ''){
			$('#alerta').show(1)
			$('#mensaje').html('Debe Ingresar Número de Transacción de la Tarjeta')			
			return
		}
	}
	if(Tipomovimientoid == 5){
		abonacon = $('#MovimientoAbonacon').val()
		abonacon = abonacon.replace('$','')
		abonacon = abonacon.trim()
		ImporteAbonado = Math.round(parseFloat(abonacon)*100)/100	
		if(ImporteAbonado <= 0){
			$('#alerta').show(1)
			$('#mensaje').html('El Importe abonado debe ser mayor a cero para ventas al contado')			
			return		
		}
	}
	
	serialize=$('#MensajeserviceAddForm').serialize()
	$.post('/movimientos/pagos/'+$('#MensajeserviceBicicletaId').val(),serialize,
			function(data) {
					$('#formreturn').html(data);
	})
}
