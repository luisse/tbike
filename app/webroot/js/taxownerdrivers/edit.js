
$(document).ready(function(){
	IniciarEventos();})

//Inicalizamos los eventos ajax
function IniciarEventos(){
	$('#PeopleDocument').numeric();
	$('#PeopleDpto').numeric()
	$('#PeoplePiso').numeric()
	$('#PeoplePhonenumber').numeric()
	$('#TaxownerdriverLicencenumber').numeric()
	formateafecha('PeopleBirthdate');
	formateafecha('TaxownerdriverFecvenclicence');
	$('#datetimepicker1').datetimepicker({locale:'es',format: "DD/MM/YYYY"});
	$('#datetimepicker2').datetimepicker({locale:'es',format: "DD/MM/YYYY"});

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
			mostrarVistaPrevia('TaxownerdriverImage','getfoto','TaxownerdriverPictureNot','img-circle')
			$('#getfoto').show(1)
		})

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
	lshowmessage()
	$('#getfoto').hide(1)
	$('#guardar').click(guardardatos)
	$('#cancelar').click(function(){window.history.back()})
}

function lshowmessage(){
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


//Permite ejecutar el submit del formulario
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
	$('form#TaxownerdriverEditForm').submit()
}


function hasGetUsermedia(){
	return !!(navigator.getUserMedia ||
				navigator.webkitGetUserMedia  ||
				navigator.mozGetUserMedia ||
				navigator.msGetUserMedia);
}
