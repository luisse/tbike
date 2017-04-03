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
*    @author oppeluis@gmail.com
*    @Fecha 01/04/2015	
*    @use Biblioteca estandar de funciones indice de mensajes
*/

//inicializamos eventos y procesos desde el DOM
$(document).ready(function(){
	cargarEventoFilas();})

function cargarEventoFilas(){
	$('#MensajeFechasendautodesde').datetimepicker({pickTime: false,language:'es'});
	$('#MensajeFechasendautohasta').datetimepicker({pickTime: false,language:'es'});
	$('#ClienteDocumento').mask('99.999.999',{placeholder:" "});
	$('#buscar').click(function(){ reloadList(link,1) });	
	$('#cancelar').click(function(){window.history.back()})
	//CLOSE AND CLEAR MODAL
	$('#modalview').on('hidden.bs.modal', function () {
		$('#content').empty();
		$(this).data('bs.modal', null); //<---- empty() to clear the modal
	})		
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


function reloadList(rlink,tipofiltro){
	var serialize
	if(tipofiltro == 1)
		serialize=$('#filterclient').serialize()
	$('#cargandodatos').show(1)		
	$.post(rlink,serialize,
			function(data) {
				$('#listmensajes').html(data);
				var divPaginationLinks = '#listmensajes'+" .pagination a, .sort a";
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

function verCliente(client_id){
	$('#modalview').modal({
			show: true,
			remote: '/clientes/view/'+client_id
	});			
	return false
}


function enviarmensaje(mensaje_id){
	$('#enviandomail'+mensaje_id).show(1)
	$.ajax({type:'GET',
		   url:'/senderlogs/Sendallmsj/'+mensaje_id,
		   datatype:'html',
		   success:function(data){
				if(data != ''){
					$().toastmessage('showToast', {
							text     : 'No se pudo enviar el correo. Verifique Configuración y trazabilidad',
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
		}).always(function() {
			$('#enviandomail'+mensaje_id).hide(1)
		});//close ajax	
	return false;
}

