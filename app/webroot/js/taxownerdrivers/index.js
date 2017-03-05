//inicializamos eventos y procesos desde el DOM
$(document).ready(function(){
	IniciarEventos();}
);

function IniciarEventos(){
	showmessage()
	//CLOSE AND CLEAR MODAL
	$('#modalview').on('hidden.bs.modal', function () {
		$('#content').empty();
		$(this).data('bs.modal', null); //<---- empty() to clear the modal
	})
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



function viewPeople(id){
	$('#modalview').modal({
			show: true,
			remote: '/peoples/view/'+id
	});
	return false
}


function reloadList(link){
	$('#cargandodatos').show(1)
	var serialize=''
	$.post(link,serialize,
			function(data) {
				$('#listtaxownerdriver').html(data);
				var divPaginationLinks = '#listtaxownerdriver'+" .pagination a,.sort a";
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
