$(document).ready(function(){IniciarEventos()})
function IniciarEventos(){$('#PeopleDocument').numeric();$('#PeopleDpto').numeric()
$('#PeoplePiso').numeric()
$('#PeoplePhonenumber').numeric()
$('#TaxownerdriverLicencenumber').numeric()
formateafecha('PeopleBirthdate');formateafecha('TaxownerdriverFecvenclicence');$('#datetimepicker1').datetimepicker({locale:'es',format:"DD/MM/YYYY"});$('#datetimepicker2').datetimepicker({locale:'es',format:"DD/MM/YYYY"});$('#PeopleCountrieId').change(function(){cargardropdown('PeopleCountrieId','/provinces/retornalxmlprovinces/','PeopleProvinceId')})
$('#PeopleProvinceId').change(function(){cargardropdown('PeopleProvinceId','/departments/retornalxmldepartments/','PeopleDepartmentId')})
$('#PeopleDepartmentId').change(function(){cargardropdown('PeopleDepartmentId','/locations/retornalxmllocations/','PeopleLocationId')})
$('#TaxownerdriverImage').change(function(){mostrarVistaPrevia('TaxownerdriverImage','getfoto','TaxownerdriverPictureNot','img-circle')
$('#getfoto').show(1)})
$('.button-checkbox').each(function(){var $widget=$(this),$button=$widget.find('button'),$checkbox=$widget.find('input:checkbox'),color=$button.data('color'),settings={on:{icon:'glyphicon glyphicon-check'},off:{icon:'glyphicon glyphicon-unchecked'}};$button.on('click',function(){$checkbox.prop('checked',!$checkbox.is(':checked'));$checkbox.triggerHandler('change');updateDisplay()});$checkbox.on('change',function(){updateDisplay()});function updateDisplay(){var isChecked=$checkbox.is(':checked');$button.data('state',(isChecked)?"on":"off");$button.find('.state-icon').removeClass().addClass('state-icon '+settings[$button.data('state')].icon);if(isChecked){$button.removeClass('btn-default').addClass('btn-'+color+' active')}
else{$button.removeClass('btn-'+color+' active').addClass('btn-default')}}
function init(){updateDisplay();if($button.find('.state-icon').length==0){$button.prepend('<i class="state-icon '+settings[$button.data('state')].icon+'"></i> ')}}
init()});lshowmessage()
$('#getfoto').hide(1)
$('#guardar').click(guardardatos)
$('#cancelar').click(function(){window.history.back()})}
function lshowmessage(){var message=$('#message').text();if(typeof(message)!='undefined'&&message.trim()!=''){$().toastmessage('showToast',{text:message,sticky:!1,position:'top-right',type:'success',closeText:'',close:function(){}})}}
function guardardatos(){var edad=diasfecha($('#PeopleBirthdate').val())/365
if(edad<18){$().toastmessage('showToast',{text:msg_people,sticky:!0,position:'top-center',type:'error',closeText:'',close:function(){}});return!1}
$('form#TaxownerdriverEditForm').submit()}
function hasGetUsermedia(){return!!(navigator.getUserMedia||navigator.webkitGetUserMedia||navigator.mozGetUserMedia||navigator.msGetUserMedia)}