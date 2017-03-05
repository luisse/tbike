//inicializamos eventos y procesos desde el DOM
$(document).ready(function(){
	IniciarEventos();}
);

function IniciarEventos(){
  $('#datetimepicker1').datetimepicker({locale:'es',format: "DD/MM/YYYY"});
	$('#datetimepicker2').datetimepicker({locale:'es',format: "DD/MM/YYYY"});
	fechaactual('fecdesde')
	fechaactual('fechasta')

	reloadList(rlink)
  $('#viewfaults').click(function(){
    //call API changed state
    reloadList(rlink)
  })

  $('#modalview').on('hidden.bs.modal', function () {
    $('#content').empty();
    $(this).data('bs.modal', null); //<---- empty() to clear the modal
  })  
}

function reloadList(link){
  serialize=$('#filter').serialize()
	$('#cargandodatos').show(1)
	$.post(link,serialize,
			function(data) {
				$('#listfaultcars').html(data);
				var divPaginationLinks = '#listfaultcars'+" .pagination a,.sort a";
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

function changestate(id){
  if(typeof(id) != 'undefined'){
    $.ajax({url:'/faultcars/faultcarschangedstatenj.json',
  			type:'post',
  			dataType:'json',
  			headers: {
  				'Security-Access-PublicToken':'A33esaSP9skSjasdSfFSssEwS2IksSZxPlA4asSJ4GEW4S'
  			},
  			data:{id:id,state:1},
  			success: function(data){
  			  $.each( data, function( key, val ) {
  				  	if(val.error != ''){
                alert('Error: '+val.error)
  				  	}else{
  				  		$('#faultend'+id).hide(1)
  				  	}
  			  });
  			}
  	})
  }
}

function getubication(lat,lng){
  $('#modalview').modal({
      show: true,
      remote: '/faultcars/getubicationmaps/'+lat+'/'+lng
  });
  return false
}
