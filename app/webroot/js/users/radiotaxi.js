
var accept=false;
$(document).ready(function(){
	IniciarEventos();})

//Inicalizamos los eventos ajax
function IniciarEventos(){
	$('#RadiotaxiCuit').numeric();
	//$('#UserUsername').attr('readonly',true);

	$('#RadiotaxiCuit').change(function(){
		existecuit()
	})

	$('#guardar').click(guardardatos)
	lshowmessage()
	//$('#cancelar').click(function(){window.history.back()})
}

//Permite ejecutar el submit del formulario
function guardardatos(){
	var password = $('#UserPassword').val()
	var password_repit = $('#UserPasswordRepit').val()
	//
	var name = $('#RadiotaxiName').val()
	var phonenumber = $('#RadiotaxiTelefono').val()
  var domicilio = $('#RadiotaxiDomicilio').val()

	if(name ==  undefined || name == ''){
		$().toastmessage('showToast', {
			text     : 'Debe Ingresar la razón social',
			sticky   : true,
			position : 'top-right',
			type     : 'error',
			closeText: '',
			close    : function () {

			}
		});
		$('#RadiotaxiName').focus()
		return false
	}

	if(typeof(phonenumber)=='undefined' || phonenumber == '' || phonenumber == null){
		$().toastmessage('showToast', {
			text     : 'Debe Ingresar el Telefono',
			sticky   : true,
			position : 'top-right',
			type     : 'error',
			closeText: '',
			close    : function () {

			}
		});
		$('#RadiotaxiTelefono').focus()
		return
	}


  if(typeof(domicilio) == 'undefined' || domicilio == '' || domicilio == null){
		$().toastmessage('showToast', {
			text     : 'Debe Ingresar el Domicilio',
			sticky   : true,
			position : 'top-right',
			type     : 'error',
			closeText: '',
			close    : function () {

			}
		});
		$('#RadiotaxiDomicilio').focus()
		return
	}

	$('form#UserRadiotaxiForm').submit()
}


function existecuit(){
	$.ajax({url:'/radiotaxis/view.json',
		type:'get',
		dataType:'json',
		data:{ cuit: $('#RadiotaxiCuit').val() },
		success: function(data){
		  $.each( data, function( key, val ) {
					$().toastmessage('showToast', {
							text     : 'El CUIT que desea vincular ya se encuentra registrado',
							sticky   : true,
							position : 'top-center',
							type     : 'warning',
							closeText: '',
							close    : function () {

							}
						});
						$('#RadiotaxiCuit').val('')
		  });
		}
})
}

function lshowmessage(){
	var message = $('#message').text();
	if(typeof(message) != 'undefined' && message.trim() != ''){
		$().toastmessage('showToast', {
				text     : message,
				sticky   : true,
				position : 'top-right',
				type     : 'warning',
				closeText: '',
				close    : function () {

				}
			});
	}
}
