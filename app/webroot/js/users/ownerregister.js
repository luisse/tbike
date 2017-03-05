
var accept=false;
$(document).ready(function(){
	IniciarEventos();})
$("#guardar").addClass("disabled")
//Inicalizamos los eventos ajax
function IniciarEventos(){
	$('#datetimepicker1').datetimepicker({locale:'es',format: "DD/MM/YYYY"});
	$('#PeopleDocument').numeric();

	//$('#ClienteDocumento').numeric()
	$('#PeopleDpto').numeric()
	$('#PeoplePiso').numeric()
	$('#PeopleNumber').numeric()


	$('#PeopleSecondname').change(function(){
		var apellido = $('#PeopleFirstname').val()
		var nombre = $('#PeopleSecondname').val()
		var nombre_array = nombre.split(' ')
		var cicly = nombre_array.length
		var username=''
		for(i=0;i < cicly;i++){
			username = username+nombre_array[i][0].trim()
		}
		if(typeof(apellido)!='undefined' && apellido != ''){
			username = username+apellido.trim()
			$('#UserUsername').val(username)
		}

	})

  /***
	$('#PeopleCountrieId').change(function(){
		cargardropdown('PeopleCountrieId','/provinces/retornalxmlprovinces/','PeopleProvinceId')
	})

	$('#PeopleProvinceId').change(function(){
		cargardropdown('PeopleProvinceId','/departments/retornalxmldepartments/','PeopleDepartmentId')
	})

	$('#PeopleDepartmentId').change(function(){
		cargardropdown('PeopleDepartmentId','/locations/retornalxmllocations/','PeopleLocationId')
	})
	****/

	$("#UserAcceptar").click(function() {
			if($("#UserAcceptar").is(':checked')) {
					$("#guardar").removeClass("disabled")
					accept = true
			} else {
					$("#guardar").addClass("disabled")
					accept = false
			}
	});

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
	var checkbox = $('#UserAcceptar').val()


/***
	if(typeof(country_id)=='undefined' || country_id == '' || country_id == null){
		$().toastmessage('showToast', {
			text     : 'Debe Ingresar el país',
			sticky   : false,
			position : 'top-right',
			type     : 'error',
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
			type     : 'error',
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
			type     : 'error',
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
			type     : 'error',
			closeText: '',
			close    : function () {

			}
		});
		return
	}******/


	if(password != password_repit){
		$().toastmessage('showToast', {
			text     : 'Los password deben ser Iguales',
			sticky   : false,
			position : 'top-right',
			type     : 'error',
			closeText: '',
			close    : function () {

			}
		});
		return
	}

	var edad = diasfecha($('#PeopleBirthdate').val())/365
	if(edad < 18){
			$().toastmessage('showToast', {
				text     : msg_people,
				sticky   : true,
				position : 'top-center',
				type     : 'error',
				closeText: '',
				close    : function () {}
			});
			return false
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
		return false
	}
	$('form#UserOwnerregisterForm').submit()

}
