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
*    @Fecha 23/04/2014
*    @use Librerias de AJAX  user control library
*/

$(document).ready(function(){
	IniciarEventos();}
);

function IniciarEventos(){
	$('#modalview').on('hidden.bs.modal', function () {
		$(this).data('bs.modal', null); //<---- empty() to clear the modal
	})	
	$('#centaller').hide(1);
	$('#cespera').hide(1);
	$('#cconfirma').hide(1);
	$('#mensajesmant').hide(1);
	$('#viewinformation').hide(1);
	
	$('#modalview').on('hidden.bs.modal', function () {
		$(this).data('bs.modal', null); //<---- empty() to clear the modal
	})
	
	$('#confirmar').click(function(){
							$('#viewinformation').show(1)
							$('#centaller').hide(1);
							$('#cespera').hide(1);
							$('#cconfirma').show(1);
							$('#mensajesmant').hide(1);
							$('#mensajeservice').hide(1);
							CargarBicicletas('informacion',2);
							return false;})
							
	$('#entaller').click(function(){
			$('#viewinformation').show(1)		
			$('#centaller').show(1);
			$('#cespera').hide(1);
			$('#cconfirma').hide(1);
			$('#mensajesmant').hide(1);
			$('#mensajeservice').hide(1);
			CargarBicicletas('informacion',1);
			return false;})
			
	$('#espera').click(function(){
		$('#viewinformation').show(1)		
		$('#centaller').hide(1);
		$('#cespera').show(1);
		$('#cconfirma').hide(1);
		$('#mensajesmant').hide(1);
		$('#mensajeservice').hide(1);
		CargarBicicletas('informacion',0); 
		return false;})
		
		$('#mantenimiento').click(function(){
			$('#viewinformation').show(1)
			$('#centaller').hide(1);
			$('#cespera').hide(1);
			$('#cconfirma').hide(1);
			$('#mensajesmant').show(3);
			$('#mensajeservice').show(3);
			CargarMensajes(rmensajesmantenimiento);
			//mensajes de servicio tecnico			
			MostrarMensajes();
			return false;})
	//Enviamos mensajes en caso que no envio nada durante 1 hs
	if(useradmin == 1)
		enviarmensajes()
}


function verBicicleta(id){
	$('#modalview').modal({
			show: true,
			remote: '/bicicletas/view/'+id
	});			
	return false
}

function CargarBicicletas(iddiv,estado){
	var serialize = null;
	$.post(rbicicletaslink+'/'+estado,serialize,
			function(data) {
				$('#'+iddiv).html(data);
	})
}

function CargarMensajes(rlink){
	var serialize
	$.post(rlink,serialize,
			function(data) {
		$('#informacion').html(data);
		var divPaginationLinks = '#informacion '+" .pagination a"; 
		$(divPaginationLinks).click(function(){
			var thisHref = $(this).attr("href");
			CargarMensajes(thisHref);
			//recarmamos el proceso de carga
			return false;
		});
	})
	
}

function MostrarMensajes(){
	var serialize = null;
	if($('#mensajes').length){
		$.post('/mensajes/mostrarmensajecliente/',serialize,
				function(data) {
					$('#mensajes').html(data);
		})
	}
}

function verCliente(id){
		$('#modalview').modal({
			show: true,
			remote: '/clientes/view/'+id
		});			
		return false
}

/*
*Funcion: Permite determinar si enviamos mensajes dependiendo de los minutos pasados desde que se envió el mensaje desde la base de datos
*/
function enviarmensajes(){
		$.ajax({type:'GET',
			   url:'/senderlogs/maxdateprocesada/',
			   datatype:'html',
			   success:function(data){
						if(data == '1'){
							senderAutomatico();		
						}
					},
					onerror:function(){
						alert('Error');
					}
			})//close ajax
}
/*
*Funcion: dispara el proceso de envió de mensajes de mantenimiento y service que sean de la fecha
*/
function senderAutomatico(){
		$.ajax({type:'GET',
			   url:'/senderlogs/Sendallmsj/',
			   datatype:'html',
			   success:function(data){
					if(data != ''){
						$().toastmessage('showToast', {
								text     : 'Fallo el proceso de envió de mensajes automático',
								sticky   : false,
								position : 'top-right',
								type     : 'success',
								closeText: '',
								close    : function () {
								}
							});											
					}
					},
					onerror:function(){
						alert('Error');
					}
			})//close ajax
}

