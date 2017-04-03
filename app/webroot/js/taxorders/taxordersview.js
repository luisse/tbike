$(document).ready(function(){
	IniciarEventos();}
);

function IniciarEventos(){
	getmyorders()
}

function getmyorders(){
	$.ajax({url:'/taxorders/myorders.json',
		type:'post',
		dataType:'json',
		success: function(data){
			itemsview=''
		  $.each( data, function( key, val ) {
			  if(typeof(val.Taxorder.date) != 'undefined'){
	        		itemsview = itemsview+'<li class="list-group-item clearfix"><div class="pull-left mr15"><img width="60px" height="60px" alt="'+val.People.firstname+', '+val.People.secondname+'" class="img-circle" src="'+val.Taxownerdriver.picture+'"></div><p class="text-ellipsis"><span>Chofer:</span><span class="name strong">'+val.People.firstname+', '+val.People.secondname+'</span></p><span class="date text-muted small pull-left">'+val.Taxorder.date+'</span><a class="see-more small pull-right" href="#">View comment</a></li>'
			  }
		  });		 
			$('#listpedidos').html(itemsview)
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
}