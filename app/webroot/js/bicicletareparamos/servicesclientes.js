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
	//Una vez cargado los datos recargamos el link
	//CLOSE AND CLEAR MODAL
	$('#modalview').on('hidden.bs.modal', function () {
		$('#content').empty();
		$(this).data('bs.modal', null); //<---- empty() to clear the modal
	})	
	Ajaxcargarbicicletas()
}

function reloadList(rlink,tipofiltro){
	var serialize=null
	$.post(rlink,serialize,
			function(data) {
				$('#listbicicletareparo').html(data);
				var divPaginationLinks = '#listbicicletareparo'+" .pagination a, .sort a";
			    $(divPaginationLinks).click(function(){
			        var thisHref = $(this).attr("href");
			        reloadList(thisHref);
			        //recarmamos el proceso de carga
			        return false;
			    });
	})
}


function Ajaxcargarbicicletas(){
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