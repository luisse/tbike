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
*    @Fecha 23/11/2013
*    @use Librerias de AJAX para inicio de sesion
*/
//inicializamos eventos y procesos desde el DOM
var bounderror=0;

$(document).ready(function(){
	IniciarEventos();}
);
var result = false;

function IniciarEventos(){
	//$( "#tabs" ).tabs()
	$('#ClienteDocumento').mask('99.999.999',{placeholder:" "});
	$('#buscar').click(function(){ reloadList(link,1) });
	//Una vez cargado los datos recargamos el link
	//CLOSE AND CLEAR MODAL
	$('#modalview').on('hidden.bs.modal', function () {
		$('#content').empty();
		$(this).data('bs.modal', null); //<---- empty() to clear the modal
	})
	Ajaxcarga()
}

function reloadList(rlink,tipofiltro){
	var serialize
	if(tipofiltro == 1)
		serialize=$('#filterclient').serialize()
	$('#cargandodatos').show(1)
	$.post(rlink,serialize,
			function(data) {
				$('#listbicicletaentrega').html(data);
				var divPaginationLinks = '#listbicicletaentrega'+" .pagination a, .sort a";
			    $(divPaginationLinks).click(function(){
			        var thisHref = $(this).attr("href");
			        reloadList(thisHref);
			        //recarmamos el proceso de carga
			        return false;
			    });
	}).fail(function() {
			//recall function for server low
			reloadList(link,1)
	}).always(function() {
		$('#cargandodatos').hide(1)
	});
}


function Ajaxcarga(){
	reloadList(link,0)
}

function verImagen(id){
	$('#modalview').modal({
			show: true,
			remote: '/bicicletas/view/'+id
	});
	return false
}

function verCliente(id){
	$('#modalview').modal({
			show: true,
			remote: '/clientes/view/'+id
	});
	return false
}

/*
*FUNCTION: permite ralizar el cambio de estado de la bicicleta entregada
*/
function cambiarestado(bicicletareparamo_id){
	if(typeof(bicicletareparamo_id)!='undefined' && bicicletareparamo_id != ''){
				$.ajax({
				url:'/bicicletareparamos/marcanentregado/'+bicicletareparamo_id,
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
					alert('No se pudo conectar al servicio');
				}
			});
		}
	return result;
}

/*
*Function: permite agregar un nuevo pago al realizar la entrega
*/
function AgregarPago(row){
	var clienteid = $('#clienteid'+row).val()
	var importetotal = $('#importetotal'+row).val()
	var estado = $('#estado'+row).val()
	var bicicletareparamo_id = $('#bicicletareparamoid'+row).val()
	$("#estado"+row).prop("disabled", true)
	if(estado == 1)
		$('#modalview').modal({show:true,
									remote:'/movimientos/pagos/'+clienteid+'/'+bicicletareparamo_id+'/'+importetotal+'/1/REP'})
}

/*
* FUNCTION: permite agregar una alerta de mantenimiento para la bicicleta
*/
function AgregarAlertaMantenimiento(bicicleta_id){
	if(typeof(bicicleta_id) !='undefined' && bicicleta_id != 0){
		$('#modalview').modal({
				show: true,
				//remote: '/mensajesmantenimientos/add/'+bicicleta_id
				remote: '/mensajes/addmensajeservice/'+bicicleta_id
		});
	}
	return false;
}

/*
*FUNCTION: permite visualizar en un mapa las rutas de las entregas
*/
function VerMapa(id){
		$('#modalview').modal({
				show: true,
				remote: '/bicicletareparamos/mapsbicicletaentrega/'+id
		});
}
/*
* FUNCTION: permite ralizar la impresion de un ticket
*/
function imprimirticked(id){
	if(typeof(id)!='undefined'){
		$('#modalview').modal({
				show: true,
				remote: '/impresiones/imprimir/0/'+id
		});
	}
}
