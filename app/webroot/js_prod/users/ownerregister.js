var accept=!1;$(document).ready(function(){IniciarEventos()})
$("#guardar").addClass("disabled")
function IniciarEventos(){$('#datetimepicker1').datetimepicker({locale:'es',format:"DD/MM/YYYY"});$('#PeopleDocument').numeric();$('#PeopleDpto').numeric()
$('#PeoplePiso').numeric()
$('#PeopleNumber').numeric()
$('#PeopleSecondname').change(function(){var apellido=$('#PeopleFirstname').val()
var nombre=$('#PeopleSecondname').val()
var nombre_array=nombre.split(' ')
var cicly=nombre_array.length
var username=''
for(i=0;i<cicly;i++){username=username+nombre_array[i][0].trim()}
if(typeof(apellido)!='undefined'&&apellido!=''){username=username+apellido.trim()
$('#UserUsername').val(username)}})
$("#UserAcceptar").click(function(){if($("#UserAcceptar").is(':checked')){$("#guardar").removeClass("disabled")
accept=!0}else{$("#guardar").addClass("disabled")
accept=!1}});$('#guardar').click(guardardatos)
$('#cancelar').click(function(){window.history.back()})}
function guardardatos(){var password=$('#UserPassword').val()
var password_repit=$('#UserPasswordRepit').val()
var country_id=$('#PeopleCountrieId').val()
var province_id=$('#PeopleProvinceId').val()
var department_id=$('#PeopleDepartmentId').val()
var location_id=$('#PeopleLocationId').val()
var checkbox=$('#UserAcceptar').val()
if(password!=password_repit){$().toastmessage('showToast',{text:'Los password deben ser Iguales',sticky:!1,position:'top-right',type:'error',closeText:'',close:function(){}});return}
var edad=diasfecha($('#PeopleBirthdate').val())/365
if(edad<18){$().toastmessage('showToast',{text:msg_people,sticky:!0,position:'top-center',type:'error',closeText:'',close:function(){}});return!1}
if(!accept){$().toastmessage('showToast',{text:'Debe Aceptar Terminos y Condiciones',sticky:!1,position:'top-right',type:'error',closeText:'',close:function(){}});return!1}
$('form#UserOwnerregisterForm').submit()}