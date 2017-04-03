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


function IniciarEventos(){
	//inicializaMascara('SaleTotalsalev')

	
	inicializaMascara('abonado')
	mascaraimporte('abonado')
	//


	$("#SaleTotalsalev").attr('readonly',true)
	$('#vuelto').attr('readonly',true)
	var totalsale = $("#SaleTotalsale").val()
	//agregamos las comas decimales
	if(totalsale.indexOf('.') <= 0) totalsale = totalsale+'.00'
	$("#SaleTotalsalev").val(totalsale)
	mascaraimporte('SaleTotalsalev')	
	//$('#guardar').click(guardardatos);
	$( "#radio" ).buttonset();
	$( "#aceptar" ).button().click(function( event ) {
		 	var lf_vuelto = parseFloat($('#vuelto').val().replace('$',''))
		 	//si encontramos deuda y la confirmacion guardamos la deuda para generar el movimiento para el cliente
		 	if(lf_vuelto < 0 && typeof(lf_vuelto) != 'undefined'){
		 		lf_vuelto = lf_vuelto* -1
		 		$('#SaleMontodeuda').val(lf_vuelto)
		 	}
		 	guardardatos();
		 	
	 });
	 $( "#cancelar" ).button().click(function( event ) {
		 //alert('Cancelar')
	 });
	 //Al Agregar el total calculamos el vuelto
	 $('#abonado').change(function(){vuelto()})
	 //Fila Donw
	 $('#radio').css("display", "none"); ;
}

function vuelto(){
	var totalsale =$("#SaleTotalsalev").val()
	var abonado = $("#abonado").val()
	var vuelto = 0
	if(typeof(totalsale) != 'undefined' || typeof(abonado) != 'undefined'){
		totalsale = totalsale.replace('$','')
		abonado = abonado.replace('$','')
		vuelto = Math.round((parseFloat(abonado) - parseFloat(totalsale))*100)/100
		if(vuelto < 0 ){
			$('#radio').css("display", "inline"); ;
			vuelto = vuelto
		}
		
		$('#vuelto').val('$ '+vuelto)
	}
	
}

/*AJAX Para dar de alta u determinar la existencia de la cuenta corriente del cliente*/
/***
 function ctaprocesar(){
	var cliente_id = $('#SaleClienteId').val()
	if(typeof(cliente_id) != 'undefined'){
		if(cliente_id != 0){
			$.ajax({type:'GET',
				url:'/sales/salepagesave/'+cliente_id,
				datatype:'html',
				success:function(data){
						if(data != ''){
							//error

							$().toastmessage('showErrorToast', "No se Pudo recuperar la Cuenta Corriente. Proceso Cancelado: ");
							
						}else{
							//ok procesar
								
					 									
							return false
						}
					},
			          error:function(xtr,fr,ds){
			        	  $().toastmessage('showErrorToast', "Error en Procesamiento remoto para asignación de Cuenta");
		          }
				})
		}
	}
	return true
}
***/