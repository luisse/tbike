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
	$('#ClienteDocumento').mask('99.999.999',{placeholder:" "});
	//icons GO
	$('.ui-state-default').hover(
			function(){ $(this).addClass('ui-state-hover'); }, 
			function(){ $(this).removeClass('ui-state-hover'); }
	);
	$('#buscar').click(function(){ reloadList(link,1) });
	//Una vez cargado los datos recargamos el link
	Ajaxcargarusuarios()
	showmessage()
}

function reloadList(rlink,tipofiltro){
	var serialize
	serialize=$('#filteruser').serialize()
	
	$('#cargandodatos').show(1)	
	$.post(rlink,serialize,
			function(data) {
				$('#listusers').html(data);
				var divPaginationLinks = '#listusers'+" .pagination a,.sort a";
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


//Permite cargar en el div el ajax
function loadPiece(href,divName) {
	//reloadList();
	$(divName).load(href, $('#filtros').serialize(), function(){
		//AjaxLinkOn(divName)
        var divPaginationLinks = divName+" .pagination a,.sort a";
        $(divPaginationLinks).click(function(){
            var thisHref = $(this).attr("href");
            loadPiece(thisHref,divName);
            //recarmamos el proceso de carga
            return false;
        });
    });
}

function Ajaxcargarusuarios(){
	reloadList(link,0)
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
