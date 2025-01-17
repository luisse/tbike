$(document).ready(function(){
	IniciarEventos();})

//Inicalizamos los eventos ajax
function IniciarEventos(){
	$('#datetimepicker1').datetimepicker({locale:'es',format: "DD/MM/YYYY"});
	$('#datetimepicker2').datetimepicker({locale:'es',format: "DD/MM/YYYY"});
	$('#TaxownerscarRegisterpermision').numeric();
	$('#TaxownerscarDecreenro').numeric()
	$('#TaxownerscarCarcode').change(function(){
		existscars()
	})
	$('#TaxownerscarRegisterpermision').change(function(){
		existelicence()
	})
	$('#guardar').click(guardardatos)
	$('#cancelar').click(function(){window.history.back()})
	showmessage()
}

//Permite ejecutar el submit del formulario
function guardardatos(){
	$('form#TaxownerscarAddForm').submit()
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

function existscars(){
	$.ajax({url:'/taxownerscars/existeregistercar.json',
			type:'post',
			dataType:'json',
			data:{carcode:$('#TaxownerscarCarcode').val()},
			success: function(data){
			  $.each( data, function( key, val ) {
				  	if(typeof(val.id) != 'undefined'){
						$().toastmessage('showToast', {
							text     : error_car_exist,
							sticky   : false,
							position : 'top-right',
							type     : 'warning',
							closeText: '',
							close    : function () {

							}
						});
						$('#TaxownerscarCarcode').val();

				  	}
			  });
			}
	})
}

function existelicence(){
	$.ajax({url:'/licences/existlicence.json',
		type:'post',
		dataType:'json',
		data:{licence:$('#TaxownerscarRegisterpermision').val()},
		success: function(data){
		  $.each( data, function( key, val ) {
			  	if(typeof(val.records.licence.Licence.id) != 'undefined'){
					$().toastmessage('showToast', {
						text     : error_licence_exist,
						sticky   : false,
						position : 'top-center',
						type     : 'warning',
						closeText: '',
						close    : function () {

						}
					});
					$('#TaxownerscarDecreenro').val(val.records.licence.Licence.dcto)
					$('#TaxownerscarDateactive').val(val.records.licence.Licence.fecha)
					$('#TaxownerscarDecreenro').attr('readonly',true);
					$('#TaxownerscarDateactive').attr('readonly',true);
					formateafecha('TaxownerscarDateactive');
			  	}else{
					$('#TaxownerscarDecreenro').val('')
					$('#TaxownerscarDateactive').val('')
					$('#TaxownerscarDecreenro').attr('readonly',false);
					$('#TaxownerscarDateactive').attr('readonly',false);
			  	}
		  });
		}
})
}
