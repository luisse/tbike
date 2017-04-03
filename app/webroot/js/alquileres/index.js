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

//inicializamos eventos y procesos desde el DOM
$(document).ready(function(){
	cargarEventoFilas();})

function cargarEventoFilas(){
	$('#cancelar').click(function(){window.history.back()})
	$("#fecdesde").datetimepicker({pickTime: false,language:'es'});
	$("#fechasta").datetimepicker({pickTime: false,language:'es'});;
	$('#SaleClientedoc').attr('readonly',true)
	$('#SaleNomap').attr('readonly',true)
	$('#SaleCredito').attr('readonly',true)
	$('#selcliente').click(function(){buscarclientes();})
	//fechas por defecto
	fechadesde = $('#fecdesde').val()
	if(typeof(fechadesde) == 'undefined' || fechadesde == '')
		fechaactual('fecdesde')
	fechasta = $('#fechasta').val()
	if(typeof(fechasta) =='undefined' || fechasta == '')
		fechaactual('fechasta')
	$('#modalview').on('hidden.bs.modal', function () {
		$('#content').empty();
		$(this).data('bs.modal', null); //<---- empty() to clear the modal
	})
	$('#mostrar').click(function(){ reloadList(link) });
	showmessage();
}


function showmessage(){
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

function reloadList(rlink){
	$('#cargandodatos').show(1)
	$.post(rlink,$('#filter').serialize(),
			function(data) {

				$('#listalquileres').html(data);
				var divPaginationLinks = '#listalquileres'+" .pagination a,.sort a";
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

function verCliente(id){
	$('#modalview').modal({
		show: true,
		remote: '/clientes/view/'+id
	});
	return false
}

function verdetallealquileres(id){
	$('#modalview').modal({
		show: true,
		remote: '/alquileres/verdetallealquileres/'+id
	});
	return false
}

/*
*Function: permite marcar el producto como entregado
*/
function MarcaEntregado(alquilere_id,alquileredetalle_id){
	if(typeof(alquilere_id) != 'undefined'){
		$.ajax({type:'POST',
			   url:'/alquileres/marcarentregado.json',
			   data:{alquileredetalle_id:alquileredetalle_id,alquilere_id:alquilere_id},
			   datatype:'json',
			   success:function(data, textStatus){
				   $.each( data, function( key, val ) {
					   	//obj =jQuery.parseJSON(val);
					    if(typeof(val.records.error)!='undefined' && val.records.error != ''){
							$().toastmessage('showToast', {
								text     : val.records.error,
								sticky   : false,
								position : 'top-right',
								type     : 'error',
								closeText: '',
								close    : function () {
								}
							});

						}else{
							reloadList(link)
						}
				   });
				},
				onerror:function(){
					alert('Error');
				}
			})

	}
}

/*
*Function: permite agregar un nuevo pago
*/
function AgregarPago(row){
	var clienteid = $('#clienteid'+row).val()
	var importetotal = $('#importetotal'+row).val()
	var alquilere_id = $('#alquilereid'+row).val()
	$('#modalview').modal({show:true,
					remote:'/movimientos/pagos/'+clienteid+'/'+alquilere_id+'/'+importetotal+'/1/ALQ'})
	return false;
}

/*
* Function: permite cambiar el estado cuando finaSettinglizamos el proceso  pago
*/
function cambiarestado(alquilere_id){
	if(typeof(alquilere_id) != 'undefined'){
		$.ajax({type:'POST',
			   url:'/alquileres/marcarpagado.json',
			   data:{alquilere_id:alquilere_id},
			   datatype:'json',
			   success:function(data, textStatus){
				   $.each( data, function( key, val ) {
					   	//obj =jQuery.parseJSON(val);
					    if(typeof(val.records.error)!='undefined' && val.records.error != ''){
							$().toastmessage('showToast', {
								text     : val.records.error,
								sticky   : false,
								position : 'top-right',
								type     : 'error',
								closeText: '',
								close    : function () {
								}
							});

						}else{
							reloadList(link)
							AceptarMovimiento()
						}
				   });
				},
				onerror:function(){
					alert('Error al ejecutar AJAX remoto');
				}
			})
	}
}
