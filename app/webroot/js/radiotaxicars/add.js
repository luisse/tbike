$(document).ready(function(){
	IniciarEventos();})

//Inicalizamos los eventos ajax
function IniciarEventos(){
	$('#datetimepicker1').datetimepicker({locale:'es',format: "DD/MM/YYYY"});
	$('#datetimepicker2').datetimepicker({locale:'es',format: "DD/MM/YYYY"});
	//init state
	$('#TaxownerscarRegisterpermision').focus();
	$('#TaxownerscarRegisterpermision').numeric();
	$('#TaxownerscarCarcode').attr('readonly',true);
  $('#TaxownerscarDateactive').attr('readonly',true);
  $('#TaxownerscarDecreenro').attr('readonly',true);
  $('#TaxownerscarDateexpire').attr('readonly',true);
  $('#TaxownerscarDescriptioncar').attr('readonly',true);

	$('#TaxownerscarRegisterpermision').change(function(){
		existscars();
	});

	$('#guardar').click(guardardatos)
	$('#cancelar').click(function(){window.history.back()})

	showmessage()
}

//Permite ejecutar el submit del formulario
function guardardatos(){
	var taxownerscar_id = $('#RadiotaxicarTaxownerscarId').val();
	if(taxownerscar_id == undefined || taxownerscar_id == ''){
		$().toastmessage('showToast', {
			 text     : 'Debe Ingresar una licencia valida para asociar',
			 sticky   : false,
			 position : 'top-right',
			 type     : 'error',
			 closeText: '',
			 close    : function () {
			 }
		 });
		 $('#TaxownerscarRegisterpermision').focus();
		return;
	}
	$('form#RadiotaxicarAddForm').submit();
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
			data:{ carcode: $('#TaxownerscarCarcode').val(),registerpermision:$('#TaxownerscarRegisterpermision').val()},
			success: function(data){
			  $.each( data, function( key, val ) {
				  	if(typeof(val.id) != 'undefined'){
							$('#RadiotaxicarTaxownerscarId').val(val.id);
							$('#TaxownerscarCarcode').val(val.carcode);
							$('#TaxownerscarDateactive').val(val.dateactive);
							$('#TaxownerscarDateexpire').val(val.dateexpire);
							$('#TaxownerscarDescriptioncar').val(val.descriptioncar);
							existevinculo();
							formateafecha('TaxownerscarDateactive');
							formateafecha('TaxownerscarDateexpire');
				  	}
			  });

				if(data.length <= 0){
					$().toastmessage('showToast', {
						 text     : 'No existe registrada la licencia ingresada',
						 sticky   : false,
						 position : 'top-right',
						 type     : 'error',
						 closeText: '',
						 close    : function () {
						 }
					 });
					 cleardata();
				}
			}
	})
}


function existevinculo(){
	$.ajax({url:'/radiotaxicars/exists.json',
		type:'post',
		dataType:'json',
		data:{ taxownerscar_id: $('#RadiotaxicarTaxownerscarId').val()},
		success: function(data){
			if(data.existe_asig != 0){
				$().toastmessage('showToast', {
					 text     : 'El auto ya se encuentra asociado.',
					 sticky   : false,
					 position : 'top-right',
					 type     : 'error',
					 closeText: '',
					 close    : function () {
					 }
				 });
				 cleardata();
			}
		}
	})
}

function cleardata(){
	$('#RadiotaxicarTaxownerscarId').val('');
	$('#TaxownerscarRegisterpermision').val('');
	$('#TaxownerscarCarcode').val('');
	$('#TaxownerscarDateactive').val('');
	$('#TaxownerscarDateexpire').val('');
	$('#TaxownerscarDescriptioncar').val('');
	$('#TaxownerscarRegisterpermision').focus();
}
