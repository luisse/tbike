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
$(document).ready(function(){
	IniciarEventos();}
);

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

	showmessage()
	//Ajaxcargarusuarios()
}

function reloadList(rlink,tipofiltro){
	var serialize
	if(tipofiltro == 1)
		serialize=$('#filterclient').serialize()
	$('#cargandodatos').show(1)		
	$.post(rlink,serialize,
			function(data) {
				$('#listarclientesaldos').html(data);
				var divPaginationLinks = '#listarclientesaldos'+" .pagination a, .sort a";
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