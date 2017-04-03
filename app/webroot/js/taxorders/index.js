//inicializamos eventos y procesos desde el DOM
$(document).ready(function(){
	IniciarEventos();}
);

function IniciarEventos(){
	reloadList('/taxorders/indexlisttaxorders')
}

function reloadList(link){
	$('#cargandodatos').show(1)
	$.post(link,'',
			function(data) {
				$('#listorders').html(data);
				var divPaginationLinks = '#listorders'+" .pagination a,.sort a";
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