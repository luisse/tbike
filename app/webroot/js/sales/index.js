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
var result=true;
$(document).ready(function(){
	IniciarEventos();}
);

function IniciarEventos(){
	//$( "#tabs" ).tabs()
	//Datos para las fechas
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

	$("#tipofactura").change(function(){
		reloadList(link)
	})
	$('#modalview').on('hidden.bs.modal', function () {
		$('#content').empty();
		$(this).data('bs.modal', null); //<---- empty() to clear the modal
	})

	$('#mostrar').click(function(){ reloadList(link) });
	//Una vez cargado los datos recargamos el link
	Ajaxcargarsales()
}

function reloadList(rlink){
	$('#cargandodatos').show(1)
	$.post(rlink,$('#filter').serialize(),
			function(data) {

				$('#listsales').html(data);
				var divPaginationLinks = '#listsales'+" .pagination a,.sort a";
			    $(divPaginationLinks).click(function(){
			        var thisHref = $(this).attr("href");
			        reloadList(thisHref);
			        //recarmamos el proceso de carga
			        return false;
			    });
	}).always(function() {
		$('#exportar').click(function(){exportdata()})
		$('#cargandodatos').hide(1)
	});
}


function Ajaxcargarsales(){
	reloadList(link)
}

function verCliente(id){
	$('#modalview').modal({
			show: true,
			remote: '/clientes/view/'+id
	});
	return false
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

function AgregarPago(row){
	var clienteid = $('#Sale'+row+'clienteId').val()
	var importetotal = $('#Sale'+row+'totalsale').val()
	var SaleNrofactura = $('#Sale'+row+'nrofactura').val()
	var estado = $('#Sale'+row+'estadopago').val()
	$("#Sale"+row+"estadopago").prop("disabled", true)
	if(typeof(clienteid)=='undefined' || clienteid=='')clienteid=0
	if(estado == 1)
		$('#modalview').modal({show:true,
									remote:'/movimientos/pagos/'+clienteid+'/'+SaleNrofactura+'/'+importetotal+'/1/SAL'})
}


function cambiarestado(sale_id){
	if(typeof(sale_id)!='undefined' && sale_id != ''){
				$.ajax({
				url:'/sales/marcaentregado/'+sale_id,
				datatype:'html',
				success:function(data){
					data=data.trim()
					if(typeof(data)!='undefined' && data != ''){
						$().toastmessage('showToast', {
								text     : data,
								sticky   : true,
								position : 'top-center',
								type     : 'error',
								closeText: '',
								close    : function () {
								}
							});
						result = false;
					}else{
						//funcion pagos.js
						//enabled checkbox
						AceptarMovimiento()
					}
				},
				error:function(){
					alert('Error Mother of God');
				}
			});
		}
	return result;
}


function verFactura(id){
	$('#modalview').modal({
			show: true,
			remote: '/sales/verdetalleventa/'+id
	});
	return false

}

function exportdata(){
	$.ajax({
			url:'/sales/exportsalesincvs/', //URL del archivo php que procesa la petición. Se explica mas adelante
			data:$('#filter').serialize(),
			type:'post', // Los datos se envían mediante el método POST
			dataType:'text', // La respuesta se obtiene como HTML
			async: false
	}).done(function(respuesta){
	$('#downloadFile').remove();
	$('<a></a>')
    .attr('id','downloadFile')
    .attr('href','data:text/csv;charset=utf8,' + encodeURIComponent(respuesta))
    .attr('download','misventas.csv')
    .appendTo('body');
		//execute
		$('#downloadFile').ready(function() {
		    $('#downloadFile').get(0).click();
		});
	});
}
