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
*    @Fecha 18/03/2014
*    @use Librerias de AJAX para inicio de sesion
*/
//inicializamos eventos y procesos desde el DOM
$(document).ready(function(){
	IniciarEventos();}
);

function IniciarEventos(){
	$('#SenderlogFecdesde').datetimepicker({pickTime: false,language:'es'});
	$('#SenderlogFechasta').datetimepicker({pickTime: false,language:'es'});
	fechaactual('SenderlogFecdesde');		
	fechaactual('SenderlogFechasta');	


	$('#mostrar').click(function(){
		var result = validafechas('#SenderlogFecdesde','#SenderlogFechasta')
		var mensaje = ''
		if(result == -1 || result == -2){
			mensaje = 'Debe Ingresar las Fechas';
		}
		if(result == -5){
			mensaje = 'La Fecha Hasta debe ser mayor o igual a la Fecha Desde'
		}
		
		if(mensaje != ''){
			showmessage(mensaje,'error')
			$('#SenderlogFechasta').focus();
			return
		}
		reloadList(link) 
	});
	
	$('#modalview').on('hidden.bs.modal', function () {
		$(this).data('bs.modal', null); //<---- empty() to clear the modal
	})		
	
	$('#selcliente').click(function(){buscarclientes();
											return false;})
	//Ajaxcargaringresos()
}


function reloadList(rlink){
	var serialize
		serialize=$('#senderlogs').serialize()
		$('#cargandodatos').show(1)
		$.post(rlink,serialize,
			function(data) {
				$('#listsenderlogs').html(data);
				var divPaginationLinks = '#listsenderlogs'+" .pagination a, .sort a";
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

function buscarclientes(){
	$('#modalview').modal({
			show: true,
			remote: '/clientes/seleccionarclientemov/'
	});
}

