
var accept=false;
var row_car_html = '';
var row_driver_html = '';


$(document).ready(function(){
	IniciarEventos();})
$("#guardar").addClass("disabled")

//Inicalizamos los eventos ajax
function IniciarEventos(){
	row_car_html = $("#row1").html();
	row_driver_html = $("#driver_row1").html();
	$('#myTab a:last').tab('show')
	showtab(0);
	$('#datetimepicker1').datetimepicker({locale:'es',format: "DD/MM/YYYY"});
	$('.date').datetimepicker({locale:'es',format: "DD/MM/YYYY"});
  $('#datetimepicker2').datetimepicker({locale:'es',format: "DD/MM/YYYY"});
	$('#PeopleDocument').numeric();
  $('#TaxownerdriverLicencenumber').numeric()
  $('#TaxownerscarRegisterpermision').numeric()
	$('.numeric').numeric()

	$('#UserUsername').attr('readonly',true);
	$('#agregar_auto').click(function(){add_row()})
	$('#agregar_chofer').click(function(){add_row('driver')})

	$('#PeopleDocument').change(function(){
		var dni = $('#PeopleDocument').val()
		$('#TaxownerdriverLicencenumber').val(dni)

	})

	$("#UserAcceptar").click(function() {
			if($("#UserAcceptar").is(':checked')) {
					$("#guardar").removeClass("disabled")
					accept = true
			} else {
					$("#guardar").addClass("disabled")
					accept = false
			}
	});

	$('#TaxownerscarRegisterpermision').change(function(){
		//existelicence()
	})

	$('#guardar').click(guardardatos)

	lshowmessage();
	loaddropdowncars();
}

function showtab(tab_id){
	$('#myTab li:eq('+tab_id+') a').tab('show')
}

//Permite ejecutar el submit del formulario
function guardardatos(){
	var password 				= $('#UserPassword').val();
	var password_repit 	= $('#UserPasswordRepit').val();
  //drivers info
	var licencenumber 	= $('#TaxownerdriverLicencenumber').val();
	var fecvenclicence 	= $('#TaxownerdriverFecvenclicence').val();
	var document 				= $('#PeopleDocument').val();
	var edad 						= diasfecha($('#PeopleBirthdate').val())/365;
  var checkbox 				= $('#UserAcceptar').val();
	//
	var firstname 			= $('#PeopleFirstname').val();
	var secondname 			= $('#PeopleSecondname').val();
	var phonenumber 		= $('#PeoplePhonenumber').val();
	//
	var email 					= $('#UserEmail').val()

	if(typeof(document)=='undefined' || document == '' || document == null){
		$().toastmessage('showToast', {
			text     : 'Debe Ingresar el número de Documento',
			sticky   : true,
			position : 'top-right',
			type     : 'error',
			closeText: '',
			close    : function () {

			}
		});
		showtab(0);
		$('#PeopleDocument').focus()
		return
	}



	if(edad < 18){
			$().toastmessage('showToast', {
				text     : msg_people,
				sticky   : true,
				position : 'top-center',
				type     : 'error',
				closeText: '',
				close    : function () {}
			});
			showtab(0);
			$('#PeopleBirthdate').focus()
			return false
	}

	if(typeof(firstname)=='undefined' || firstname == '' || firstname == null){
		$().toastmessage('showToast', {
			text     : 'Debe Ingresar el Nombre',
			sticky   : true,
			position : 'top-right',
			type     : 'error',
			closeText: '',
			close    : function () {

			}
		});
		showtab(0);
		$('#PeopleFirstname').focus()
		return false
	}

	if(typeof(secondname)=='undefined' || secondname == '' || secondname == null){
		$().toastmessage('showToast', {
			text     : 'Debe Ingresar el Apellido',
			sticky   : true,
			position : 'top-right',
			type     : 'error',
			closeText: '',
			close    : function () {

			}
		});
		showtab(0);
		$('#PeopleSecondname').focus()
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
		showtab(0);
		$('#PeoplePhonenumber').focus()
		return
	}

	if(email == undefined || email == '' || email == null){
		$().toastmessage('showToast', {
			text     : 'Debe Ingresar un email valido',
			sticky   : true,
			position : 'top-right',
			type     : 'error',
			closeText: '',
			close    : function () {

			}
		});
		showtab(0);
		$('#UserEmail').focus()
		return
	}

	if(!accept){
		$().toastmessage('showToast', {
			text     : 'Debe Aceptar Terminos y Condiciones',
			sticky   : false,
			position : 'top-right',
			type     : 'error',
			closeText: '',
			close    : function () {

			}
		});
		showtab(0);
		return false
	}
	if(!validacars()) return false;
	if(!validadrivers()) return false;
	$('form#UserRegisterForm').submit()
}


//Permite cargar los drop down si existe seleccionado un campo en brand
function loaddropdowncars(){
	for(i=1;i <= current_row; i++){
		var val = $('#Taxownerscar'+i+'Carmodel').val();
		cargardropdown('Taxownerscar'+i+'CarbrandId','/carmodels/getmodels/','Taxownerscar'+i+'CarmodelId');
		$('#Taxownerscar'+i+'CarmodelId').val(val);
	}
}

//function permite validar los datos son correctos
function validacars(){
	var found = false;
	for(i=1;i <= current_row; i++){
		//
		var carcode 					= $('#Taxownerscar'+i+'Carcode').val();
		var registerpermision = $('#Taxownerscar'+i+'Registerpermision').val();
	  var descriptioncar 		= $('#Taxownerscar'+i+'Descriptioncar').val();

		var carmodel 					= $('#Taxownerscar'+i+'CarmodelId').val();
		var brand 						= $('#Taxownerscar'+i+'CarbrandId').val();
		var type  						= $('#Taxownerscar'+i+'Type').val();



		if(carcode != undefined && registerpermision != undefined ){
			found = true;
			if(typeof(carcode) == 'undefined' || carcode == ''  || carcode == null){
				$().toastmessage('showToast', {
					text     : 'Debe Ingresar la patente del automovil',
					sticky   : true,
					position : 'top-right',
					type     : 'error',
					closeText: '',
					close    : function () {

					}
				});
				showtab(1);
				$('#Taxownerscar'+i+'Carcode').focus()
				return false;
			}

			if(typeof(registerpermision)=='undefined' || registerpermision == ''   || registerpermision == null){
				$().toastmessage('showToast', {
					text     : 'Debe Ingresar el número de Licencia del automovil',
					sticky   : true,
					position : 'top-right',
					type     : 'error',
					closeText: '',
					close    : function () {

					}
				});
				showtab(1);
				$('#Taxownerscar'+i+'Registerpermision').focus()
				return false;
			}


			/***
		  if(typeof(descriptioncar)=='undefined' || descriptioncar == ''   || descriptioncar == null){
				$().toastmessage('showToast', {
					text     : 'Debe Ingresar una descripcion del automovil Modelo/Marca/Con aire/Sin Aire etc',
					sticky   : true,
					position : 'top-right',
					type     : 'error',
					closeText: '',
					close    : function () {

					}
				});
				showtab(1);
				$('#Taxownerscar'+i+'Descriptioncar').focus()
				return false;
			}***/

			if(typeof(carmodel)=='undefined' || carmodel == ''   || carmodel == null){
				$().toastmessage('showToast', {
					text     : 'Debe Ingresar el modelo del automovil',
					sticky   : true,
					position : 'top-right',
					type     : 'error',
					closeText: '',
					close    : function () {

					}
				});
				showtab(1);
				$('#Taxownerscar'+i+'CarmodelId').focus()
				return false;
			}

			if(typeof(brand)=='undefined' || brand == ''   || brand == null){
				$().toastmessage('showToast', {
					text     : 'Debe Ingresar la marca del automovil',
					sticky   : true,
					position : 'top-right',
					type     : 'error',
					closeText: '',
					close    : function () {

					}
				});
				showtab(1);
				$('#Taxownerscar'+i+'CarbrandId').focus()
				return false;
			}

			if(typeof(brand)=='undefined' || brand == ''   || brand == null){
				$().toastmessage('showToast', {
					text     : 'Debe Ingresar la marca del automovil',
					sticky   : true,
					position : 'top-right',
					type     : 'error',
					closeText: '',
					close    : function () {

					}
				});
				showtab(1);
				$('#Taxownerscar'+i+'CarbrandId').focus()
				return false;
			}

			if(typeof(type)=='undefined' || type == ''   || type == null){
				$().toastmessage('showToast', {
					text     : 'Debe Ingresar el tipo de automovil',
					sticky   : true,
					position : 'top-right',
					type     : 'error',
					closeText: '',
					close    : function () {

					}
				});
				showtab(1);
				$('#Taxownerscar'+i+'Type').focus()
				return false;
			}
		}
	}

	if(!found){
		$().toastmessage('showToast', {
			text     : 'Debe Ingresar al menos un automovil',
			sticky   : true,
			position : 'top-right',
			type     : 'error',
			closeText: '',
			close    : function () {
			}
		});
		add_row('');
		showtab(1);
		return false;
	}
	return true;
}

function validadrivers(){
	var found = false;

	for(i = 1; i <= current_row; i++){
		var document       = $('#Taxownerdriver'+i+'Document').val()
		var birthdate      = $('#Taxownerdriver'+i+'Birthdate').val()
		var secondname     = $('#Taxownerdriver'+i+'Secondname').val()
		var firstname      = $('#Taxownerdriver'+i+'Firstname').val()
		var phonenumber    = $('#Taxownerdriver'+i+'Phonenumber').val()
		var licencenumber  = $('#Taxownerdriver'+i+'Licencenumber').val()
		var fecvenclicence = $('#Taxownerdriver'+i+'Fecvenclicence').val()
		var edad = diasfecha(birthdate)/365
		var diaslic = diasfecha(fecvenclicence)/365

		if(document != undefined &&
				birthdate != undefined &&
				secondname != undefined &&
				firstname != undefined &&
				phonenumber != undefined &&
				licencenumber != undefined &&
				fecvenclicence != undefined){
					found = true;
			val = (document == $('#PeopleDocument').val()) ? true : false;

			if(typeof(document)=='undefined' || document == '' || document == null){
				$().toastmessage('showToast', {
					text     : 'Debe Ingresar el número de Documento del chofer',
					sticky   : true,
					position : 'top-right',
					type     : 'error',
					closeText: '',
					close    : function () {

					}
				});
				showtab(2);
				$('#Taxownerdriver'+i+'Document').focus();
				return false;
			}

			if(edad < 18 && !val){
					$().toastmessage('showToast', {
						text     : msg_people,
						sticky   : true,
						position : 'top-center',
						type     : 'error',
						closeText: '',
						close    : function () {}
					});
					showtab(2);
					$('#Taxownerdriver'+i+'Birthdate').focus()
					return false;
			}

			if((typeof(firstname)=='undefined' || firstname == '' || firstname == null ) && !val){
				$().toastmessage('showToast', {
					text     : 'Debe Ingresar el Nombre del chofer',
					sticky   : true,
					position : 'top-right',
					type     : 'error',
					closeText: '',
					close    : function () {

					}
				});
				showtab(2);
				$('#Taxownerdriver'+i+'Firstname').focus()
				return false;
			}

			if((typeof(secondname)=='undefined' || secondname == '' || secondname == null)  && !val){
				$().toastmessage('showToast', {
					text     : 'Debe Ingresar el Apellido del chofer',
					sticky   : true,
					position : 'top-right',
					type     : 'error',
					closeText: '',
					close    : function () {

					}
				});
				showtab(2);
				$('#Taxownerdriver'+i+'Secondname').focus()
				return false;
			}

			if((typeof(phonenumber)=='undefined' || phonenumber == '' || phonenumber == null)  && !val){
				$().toastmessage('showToast', {
					text     : 'Debe Ingresar el Telefono del chofer',
					sticky   : true,
					position : 'top-right',
					type     : 'error',
					closeText: '',
					close    : function () {

					}
				});
				showtab(2);
				$('#Taxownerdriver'+i+'Phonenumber').focus()
				return false;
			}

			if(typeof(licencenumber)=='undefined' || licencenumber == '' || licencenumber == null){
				$().toastmessage('showToast', {
					text     : 'Debe Ingresar Nro de Licencia del chofer',
					sticky   : true,
					position : 'top-right',
					type     : 'error',
					closeText: '',
					close    : function () {

					}
				});
				showtab(2);
				$('#Taxownerdriver'+i+'Licencenumber').focus()
				return false;
			}

			if(typeof(fecvenclicence)=='undefined' || fecvenclicence == '' || fecvenclicence == null){
				$().toastmessage('showToast', {
					text     : 'Debe Ingresar Fech de Venc. de Licencia del chofer',
					sticky   : true,
					position : 'top-right',
					type     : 'error',
					closeText: '',
					close    : function () {

					}
				});
				showtab(2);
				$('#Taxownerdriver'+i+'Fecvenclicence').focus()
				return false;
			}

			if(diaslic > 0){
				$().toastmessage('showToast', {
					text     : 'La Fecha de Venc. de Licencia de chofer debe ser mayor a la fecha actual',
					sticky   : true,
					position : 'top-right',
					type     : 'error',
					closeText: '',
					close    : function () {

					}
				});
				showtab(2);
				$('#Taxownerdriver'+i+'Fecvenclicence').focus()
				return false;
			}
	}

}//end for

	if(!found){
		$().toastmessage('showToast', {
			text     : 'Debe Ingresar al menos un chofer',
			sticky   : true,
			position : 'top-right',
			type     : 'error',
			closeText: '',
			close    : function () {
			}
		});
		add_row('driver');
		showtab(2);
		return false;
	}
	return true;
}

function existelicence(row){
	$.ajax({url:'/taxownerscars/existeregistercar.json',
			type:'post',
			dataType:'json',
			data:{ carcode: $('#Taxownerscar'+row+'Carcode').val(),registerpermision:$('#Taxownerscar'+row+'Registerpermision').val()},
			success: function(data){
			  $.each( data, function( key, val ) {
				  	if(typeof(val.id) != 'undefined'){
							$().toastmessage('showToast', {
								 text     : 'Existe un auto registrado para la licencia y patente',
								 sticky   : false,
								 position : 'top-right',
								 type     : 'error',
								 closeText: '',
								 close    : function () {
								 }
							 });
							 $('#Taxownerscar'+row+'Carcode').val('');
							 $('#Taxownerscar'+row+'Registerpermision').val('');
				  	}
			  });

			}
	});
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


function delete_row(row){
	$('#row'+row).html("");
}

function delete_drow(row){
	$('#driver_row'+row).html("");
}


function escapeRegExp(str) {
    return str.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
}

function replaceAll(str, find, replace) {
  return str.replace(new RegExp(escapeRegExp(find), 'g'), replace);
}

function add_row(type){
	var new_row = current_row + 1;
	if(type != 'driver'){
		html_row = replaceAll(row_car_html,'(1)','('+new_row+')');
		html_row = replaceAll(html_row,'[1]','['+new_row+']');
		html_row = replaceAll(html_row,'Taxownerscar1Carcode','Taxownerscar'+new_row+'Carcode');
		html_row = replaceAll(html_row,'Taxownerscar1Registerpermisionorigin','Taxownerscar'+new_row+'Registerpermisionorigin');
		html_row = replaceAll(html_row,'Taxownerscar1Registerpermision','Taxownerscar'+new_row+'Registerpermision');
		html_row = replaceAll(html_row,'Taxownerscar1Descriptioncar','Taxownerscar'+new_row+'Descriptioncar');
		html_row = replaceAll(html_row,'Taxownerscar1CarbrandId','Taxownerscar'+new_row+'CarbrandId');
		html_row = replaceAll(html_row,'Taxownerscar1CarmodelId','Taxownerscar'+new_row+'CarmodelId');
		html_row = replaceAll(html_row,'Taxownerscar1Type','Taxownerscar'+new_row+'Type');
		html_row = replaceAll(html_row,'Taxownerscar1Aa','Taxownerscar'+new_row+'Aa');
		html_row = replaceAll(html_row,'Taxownerscar1Transporta','Taxownerscar'+new_row+'Transporta');



		$('#rows').append('<div id="row'+new_row+'"  class="row">'+html_row+'</div>');
		$('html, body').animate({
				scrollTop: $("#row"+new_row).offset().top
		}, 2000);

	}else{
		html_row = row_driver_html;

		html_row = replaceAll(html_row,'(1)','('+new_row+')');
		html_row = replaceAll(html_row,'[1]','['+new_row+']');

		html_row = replaceAll(html_row,'Taxownerdriver1Document','Taxownerdriver'+new_row+'Document');
		html_row = replaceAll(html_row,'Taxownerdriver1Birthdate','Taxownerdriver'+new_row+'Birthdate');
		html_row = replaceAll(html_row,'Taxownerdriver1Secondname','Taxownerdriver'+new_row+'Secondname');
		html_row = replaceAll(html_row,'Taxownerdriver1Firstname','Taxownerdriver'+new_row+'Firstname');
		html_row = replaceAll(html_row,'Taxownerdriver1Gender','Taxownerdriver'+new_row+'Gender');
		html_row = replaceAll(html_row,'Taxownerdriver1Fecvenclicence','Taxownerdriver'+new_row+'Fecvenclicence');
		html_row = replaceAll(html_row,'Taxownerdriver1Licencenumber','Taxownerdriver'+new_row+'Licencenumber');
		html_row = replaceAll(html_row,'Taxownerdriver1Phonenumber','Taxownerdriver'+new_row+'Phonenumber');



		$('#driver_rows').append('<div id="driver_row'+new_row+'"  class="row">'+html_row+'</div>');
		$('.date').datetimepicker({locale:'es',format: "DD/MM/YYYY"});
		$('numeric').numeric();
		$('html, body').animate({
				scrollTop: $("#driver_row"+new_row).offset().top
		}, 2000);

	}
	current_row++;
}
