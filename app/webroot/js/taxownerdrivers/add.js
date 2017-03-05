$(document).ready(function(){
	IniciarEventos();})

//Inicalizamos los eventos ajax
function IniciarEventos(){
	$('#PeopleDocument').numeric();
	$('#PeopleDpto').numeric()
	$('#PeoplePiso').numeric()
	$('#PeoplePhonenumber').numeric()
	$('#datetimepicker1').datetimepicker({locale:'es',format: "DD/MM/YYYY"});
	$('#datetimepicker2').datetimepicker({locale:'es',format: "DD/MM/YYYY"});
	$('#TaxownerdriverLicencenumber').numeric()
	$('#PeopleCountrieId').change(function(){
		cargardropdown('PeopleCountrieId','/provinces/retornalxmlprovinces/','PeopleProvinceId')
	})
	$('#PeopleProvinceId').change(function(){
		cargardropdown('PeopleProvinceId','/departments/retornalxmldepartments/','PeopleDepartmentId')
	})

	$('#PeopleDepartmentId').change(function(){
		cargardropdown('PeopleDepartmentId','/locations/retornalxmllocations/','PeopleLocationId')
	})
	$('#TaxownerdriverImage').change(function(){
			mostrarVistaPrevia('TaxownerdriverImage','getfoto','TaxownerdriverPicture','img-circle')
			$('#getfoto').show(1)
		})

	$('#PeopleSecondname').change(function(){
		var apellido = $('#PeopleFirstname').val()
		var nombre = $('#PeopleSecondname').val()
		var nombre_array = nombre.split(' ')
		var cicly = nombre_array.length
		var username=''
		for(i=0;i < cicly;i++){
			username = username+nombre_array[i][0]
		}
		if(typeof(apellido)!='undefined' && apellido != ''){
			username = username+apellido
			$('#UserUsername').val(username.replace(/\s/g,""))
		}

	})

	$('#PeopleDocument').change(function(){getpeopledata()})

	if($('#TaxownerdriverNewuser').is(":checked"))
		$('#users').hide(1)

	$('#TaxownerdriverNewuser').change(function() {
        if($(this).is(":checked")) {
            $('#users').hide(1)
        }else{
        	$('#users').show(1)
        }
    });
	showmessage()

	$('#TaxownerdriverNewuser').click(function() {
					if($("#TaxownerdriverNewuser").is(':checked')) {
							$('#UserUsername').val('')
							$('#UserEmail').val('')
							$('#UserPassword').val('')
							$('#UserPasswordRepit').val('')
				}
	})


	$('#getfoto').hide(1)
	$('#guardar').click(guardardatos)
	$('#cancelar').click(function(){window.history.back()})
}

//Permite ejecutar el submit del formulario
function guardardatos(){
	var password = $('#UserPassword').val()
	var password_repit = $('#UserPasswordRepit').val()
	var country_id = $('#PeopleCountrieId').val()
	var province_id = $('#PeopleProvinceId').val()
	var department_id = $('#PeopleDepartmentId').val()
	var location_id = $('#PeopleLocationId').val()
/***
	if(typeof(country_id)=='undefined' || country_id == '' || country_id == null){
		$().toastmessage('showToast', {
			text     : 'Debe Ingresar el país',
			sticky   : false,
			position : 'top-right',
			type     : 'success',
			closeText: '',
			close    : function () {

			}
		});
		return
	}
	if(typeof(province_id)=='undefined' || province_id == ''  || province_id == null){
		$().toastmessage('showToast', {
			text     : 'Debe Ingresar la Provincia',
			sticky   : false,
			position : 'top-right',
			type     : 'success',
			closeText: '',
			close    : function () {

			}
		});
		return

	}
	if(typeof(department_id)=='undefined' || department_id == ''  || department_id == null){
		$().toastmessage('showToast', {
			text     : 'Debe Ingresar el Departamento',
			sticky   : false,
			position : 'top-right',
			type     : 'success',
			closeText: '',
			close    : function () {

			}
		});
		return

	}

	if(typeof(location_id)=='undefined' || location_id == ''   || location_id == null){
		$().toastmessage('showToast', {
			text     : 'Debe Ingresar la Localidad',
			sticky   : false,
			position : 'top-right',
			type     : 'success',
			closeText: '',
			close    : function () {

			}
		});
		return
	}
***/

	if(password != password_repit){
		$().toastmessage('showToast', {
			text     : 'Los password deben ser Iguales',
			sticky   : false,
			position : 'top-right',
			type     : 'success',
			closeText: '',
			close    : function () {

			}
		});
		return
	}

	var edad = diasfecha($('#PeopleBirthdate').val())/365
	if(edad < 18){
			$().toastmessage('showToast', {
				text     : 'El conductor debe ser mayor de 18 años',
				sticky   : true,
				position : 'top-center',
				type     : 'error',
				closeText: '',
				close    : function () {}
			});
			return false
	}

	$('form#TaxownerdriverAddForm').submit()
}


function hasGetUsermedia(){
	return !!(navigator.getUserMedia ||
				navigator.webkitGetUserMedia  ||
				navigator.mozGetUserMedia ||
				navigator.msGetUserMedia);
}

function getpeopledata(){
	$.ajax({url:'/peoples/getpersonsdata.json',
			type:'post',
			dataType:'json',
			data:{document:$('#PeopleDocument').val()},
			success: function(data){
			  $.each( data, function( key, val ) {
				    //alert(val.records.error)
				  	if(val.records.error.trim() == ''){
				  		if(typeof(val.records.people.People) != 'undefined'){
					  		$('#PeopleBirthdate').val(val.records.people.People.birthdate);
					  		$('#PeopleFirstname').val(val.records.people.People.firstname);
					  		$('#PeopleSecondname').val(val.records.people.People.secondname);
					  		$('#PeopleAddress').val(val.records.people.People.address);
					  		$('#PeopleNumber').val(val.records.people.People.number);
					  		$('#PeopleDepto').val(val.records.people.People.depto);
					  		$('#PeopleBlock').val(val.records.people.People.block);
					  		$('#PeopleGender').val(val.records.people.People.gender);
					  		$('#PeoplePhonenumber').val(val.records.people.People.phonenumber);
					  		$('#PeopleCountrieId').val(val.records.people.People.countrie_id)
					  		$('#PeopleProvinceId').val(val.records.people.People.province_id)
					  		$('#PeopleDepartmentId').val(val.records.people.People.department_id)
					  		$('#PeopleLocationId').val(val.records.people.People.location_id)
					  		$('#PeopleId').val(val.records.people.People.id)
					  		formateafecha('PeopleBirthdate');
					  		//cargamos los datos de paises

					  		cargardropdown('PeopleCountrieId','/provinces/retornalxmlprovinces/','PeopleProvinceId')
					  		cargardropdown('PeopleProvinceId','/departments/retornalxmldepartments/','PeopleDepartmentId')
					  		cargardropdown('PeopleDepartmentId','/locations/retornalxmllocations/','PeopleLocationId')

								$('#PeopleProvinceId').attr('selectedIndex',val.records.people.People.province_id);
					  		$('#PeopleDepartmentId').attr('selectedIndex',val.records.people.People.department_id);
					  		$('#PeopleLocationId').attr('selectedIndex',val.records.people.People.location_id);

					  		//Inhabilitamos los controles
					  		$('#PeopleBirthdate').attr('readonly',true);
					  		$('#PeopleFirstname').attr('readonly',true);
					  		$('#PeopleSecondname').attr('readonly',true);
					  		$('#PeopleAddress').attr('readonly',true);
					  		$('#PeopleNumber').attr('readonly',true);
					  		$('#PeopleDepto').attr('readonly',true);
					  		$('#PeopleBlock').attr('readonly',true);
					  		$('#PeopleGender').attr('readonly',true);
					  		$('#PeoplePhonenumber').attr('readonly',true);
					  		$('#PeopleCountrieId').attr('readonly',true);
					  		$('#PeopleProvinceId').attr('readonly',true);
					  		$('#PeopleLocationId').attr('readonly',true);
					  		$('#PeopleDepartmentId').attr('readonly',true);

				  		}else{

					  		$('#PeopleBirthdate').attr('readonly',false);
					  		$('#PeopleFirstname').attr('readonly',false);
					  		$('#PeopleSecondname').attr('readonly',false);
					  		$('#PeopleAddress').attr('readonly',false);
					  		$('#PeopleNumber').attr('readonly',false);
					  		$('#PeopleDepto').attr('readonly',false);
					  		$('#PeopleBlock').attr('readonly',false);
					  		$('#PeopleGender').attr('readonly',false);
					  		$('#PeoplePhonenumber').attr('readonly',false);
					  		$('#PeopleCountrieId').attr('readonly',false);
					  		$('#PeopleProvinceId').attr('readonly',false);
					  		$('#PeopleLocationId').attr('readonly',false);
					  		$('#PeopleDepartmentId').attr('readonly',false);
					  		//set empty
					  		$('#PeopleId').val()
					  		$('#PeopleBirthdate').val();
					  		$('#PeopleFirstname').val();
					  		$('#PeopleSecondname').val();
					  		$('#PeopleAddress').val();
					  		$('#PeopleNumber').val();
					  		$('#PeopleDepto').val();
					  		$('#PeopleBlock').val();
					  		$('#PeopleGender').val();
					  		$('#PeoplePhonenumber').val();
					  		$('#PeopleCountrieId').val()
					  		$('#PeopleProvinceId').val()
					  		$('#PeopleLocationId').val()
					  		$('#PeopleDepartmentId').val()
				  		}
				  	}
			  });
			}
	})
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
