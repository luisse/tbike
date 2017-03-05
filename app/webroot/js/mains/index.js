$(document).ready(function(){
	IniciarEventos();}
);
function IniciarEventos(){
	$('#modalview').on('hidden.bs.modal', function () {
		$(this).data('bs.modal', null); //<---- empty() to clear the modal
	})	
	$('#viewtarorders').hide(1);
	getorders();
	getcars();
	/**$('#vieworder').click(function(){
		$('#viewtarorders').show(1)
		//vieworders();
		return false;})**/
}


function vieworders(){
	var serialize = null;
	$.post(rtaxorderslink,serialize,
			function(data) {
				$('#viewtarorders').html(data);
	})
}


function getorders(){
	$.ajax({url:'/taxorders/totalorders.json',
		type:'post',
		dataType:'json',
		success: function(data){
		  $.each( data, function( key, val ) {
			    //alert(val.records.error)
			  	if(val.Taxorder.taxorders != ''){
			  		travels
			  		$('#travels').html(val.Taxorder.taxorders)
			  	}
		  });		 
		}
	})	
}

function getcars(){
	$.ajax({url:'/taxownerscars/caractive.json',
		type:'post',
		dataType:'json',
		success: function(data){
		  $.each( data, function( key, val ) {
			    //alert(val.records.error)
			  	if(val.Taxownerscar.carsactive != ''){
			  		$('#cars').html(val.Taxownerscar.carsactive)
			  	}
		  });		 
		}
	})	
	
}