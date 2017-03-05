//inicializamos eventos y procesos desde el DOM
$(document).ready(function(){
	IniciarEventos();}
);

function IniciarEventos(){
	//reloadList('/taxorders/indexlisttaxorders')
}


function eliminarfavorito(id){
  $.ajax({url:'/favcars/delete.json',
		type:'post',
		data:{key:glb_k,favcar_id:id},
		dataType:'json',
		success: function(data){
		  $.each( data, function( key, val ) {
			  if(val.error != ''){
					$().toastmessage('showToast', {
						text     : val.error,
						sticky   : false,
						position : 'top-right',
						type     : 'error',
						closeText: '',
						close    : function () {
						}
					});

			  }else{
            $('#favcar'+id).hide(1)
			  }
		  });
		}
	}).error(function(){
		$().toastmessage('showToast', {
			text     : 'No se pudo ejecutar el proceso de pedidos',
			sticky   : false,
			position : 'top-right',
			type     : 'error',
			closeText: '',
			close    : function () {
			}
		});
	})
  return false;
}
