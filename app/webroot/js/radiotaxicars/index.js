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
	//icons GO
	$('.ui-state-default').hover(
			function(){ $(this).addClass('ui-state-hover'); },
			function(){ $(this).removeClass('ui-state-hover'); }
	);
	$('#buscar').click(function(){ reloadList(link,1) });
	//Una vez cargado los datos recargamos el link
	//loadcars();
	showmessage();
}

function reloadList(rlink,tipofiltro){
	var serialize
	serialize=$('#filtercar').serialize()

	$('#cargandodatos').show(1)
	$.post(rlink,serialize,
			function(data) {
				$('#listcars').html(data);
				var divPaginationLinks = '#listcars'+" .pagination a,.sort a";
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


function loadcars(){
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


function changestate(id){
	$.ajax({url:'/radiotaxicars/changestate.json',
		type:'post',
		dataType:'json',
		data:{ id: id},
		success: function(data){
			if(data.message != ''){
				$().toastmessage('showToast', {
					 text     : data.message,
					 sticky   : false,
					 position : 'top-right',
					 type     : 'error',
					 closeText: '',
					 close    : function () {
					 }
				 });
			}else{
				loadcars();
			}
		}
	})
}
