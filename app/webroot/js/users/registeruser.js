
$(document).ready(function(){
	IniciarEventos();})

//Inicalizamos los eventos ajax
function IniciarEventos(){
	$('#datetimepicker1').datetimepicker({locale:'es',format: "DD/MM/YYYY"});
	$('#PeopleDocument').numeric();
	$('#PeopleDpto').numeric()
	$('#PeoplePiso').numeric()
	$('#PeopleNumber').numeric()
	$('#PeoplePhonenumber').numeric()
	
   $('.button-checkbox').each(function () {
        // Settings
        var $widget = $(this),
            $button = $widget.find('button'),
            $checkbox = $widget.find('input:checkbox'),
            color = $button.data('color'),
            settings = {
                on: {
                    icon: 'glyphicon glyphicon-check'
                },
                off: {
                    icon: 'glyphicon glyphicon-unchecked'
                }
            };

        // Event Handlers
        $button.on('click', function () {
            $checkbox.prop('checked', !$checkbox.is(':checked'));
            $checkbox.triggerHandler('change');
            updateDisplay();
        });
        $checkbox.on('change', function () {
            updateDisplay();
        });

        // Actions
        function updateDisplay() {
            var isChecked = $checkbox.is(':checked');

            // Set the button's state
            $button.data('state', (isChecked) ? "on" : "off");

            // Set the button's icon
            $button.find('.state-icon')
                .removeClass()
                .addClass('state-icon ' + settings[$button.data('state')].icon);

            // Update the button's color
            if (isChecked) {
                $button
                    .removeClass('btn-default')
                    .addClass('btn-' + color + ' active');
            }
            else {
                $button
                    .removeClass('btn-' + color + ' active')
                    .addClass('btn-default');
            }
        }

        // Initialization
        function init() {
            updateDisplay();
            // Inject the icon if applicable
            if ($button.find('.state-icon').length == 0) {
                $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
            }
        }
        init();
    });
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
			$('#UserUsername').val(username)
		}

	})

  $('#PeopleCountrieId').change(function(){
		cargardropdown('PeopleCountrieId','/provinces/retornalxmlprovinces/','PeopleProvinceId')
	})

	$('#PeopleProvinceId').change(function(){
		cargardropdown('PeopleProvinceId','/departments/retornalxmldepartments/','PeopleDepartmentId')
	})

	$('#PeopleDepartmentId').change(function(){
		cargardropdown('PeopleDepartmentId','/locations/retornalxmllocations/','PeopleLocationId')
	})

	$('#registrarse').click(guardardatos)
	$('#cancelar').click(function(){window.history.back()})
}

//Permite ejecutar el submiht del formulario
function guardardatos(){
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
	
	terminos = $('#aceptterm').val() 
	if(terminos){
		$('form#UserRegisteruserForm').submit()
	}else{
		$().toastmessage('showToast', {
			text     : msg_term,
			sticky   : true,
			position : 'top-center',
			type     : 'error',
			closeText: '',
			close    : function () {
				//console.log("toast is closed ...");
			}
		});			
	}

}
