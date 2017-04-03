$(document).ready(function(){
	IniciarEventos();}
);

function IniciarEventos(){
	showmessage()
	reloadList(rlink)
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


function reloadList(link){
	$('#cargandodatos').show(1)
	var serialize=''
	$.post(link,serialize,
			function(data) {
				$('#listtaxownerscars').html(data);
				var divPaginationLinks = '#listtaxownerscars'+" .pagination a,.sort a";
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
