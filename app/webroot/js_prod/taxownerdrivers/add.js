$(document).ready(function(){IniciarEventos()})
function IniciarEventos(){$('#PeopleDocument').numeric();$('#PeopleDpto').numeric()
$('#PeoplePiso').numeric()
$('#PeoplePhonenumber').numeric()
$('#datetimepicker1').datetimepicker({locale:'es',format:"DD/MM/YYYY"});$('#datetimepicker2').datetimepicker({locale:'es',format:"DD/MM/YYYY"});$('#TaxownerdriverLicencenumber').numeric()
$('#PeopleCountrieId').change(function(){cargardropdown('PeopleCountrieId','/provinces/retornalxmlprovinces/','PeopleProvinceId')})
$('#PeopleProvinceId').change(function(){cargardropdown('PeopleProvinceId','/departments/retornalxmldepartments/','PeopleDepartmentId')})
$('#PeopleDepartmentId').change(function(){cargardropdown('PeopleDepartmentId','/locations/retornalxmllocations/','PeopleLocationId')})
$('#TaxownerdriverImage').change(function(){mostrarVistaPrevia('TaxownerdriverImage','getfoto','TaxownerdriverPicture','img-circle')
$('#getfoto').show(1)})
$('#PeopleSecondname').change(function(){var apellido=$('#PeopleFirstname').val()
var nombre=$('#PeopleSecondname').val()
var nombre_array=nombre.split(' ')
var cicly=nombre_array.length
var username=''
for(i=0;i<cicly;i++){username=username+nombre_array[i][0]}
if(typeof(apellido)!='undefined'&&apellido!=''){username=username+apellido
$('#UserUsername').val(username.replace(/\s/g,""))}})
$('#PeopleDocument').change(function(){getpeopledata()})
if($('#TaxownerdriverNewuser').is(":checked"))
$('#users').hide(1)
$('#TaxownerdriverNewuser').change(function(){if($(this).is(":checked")){$('#users').hide(1)}else{$('#users').show(1)}});showmessage()
$('#TaxownerdriverNewuser').click(function(){if($("#TaxownerdriverNewuser").is(':checked')){$('#UserUsername').val('')
$('#UserEmail').val('')
$('#UserPassword').val('')
$('#UserPasswordRepit').val('')}})
$('#getfoto').hide(1)
$('#guardar').click(guardardatos)
$('#cancelar').click(function(){window.history.back()})}
function guardardatos(){var password=$('#UserPassword').val()
var password_repit=$('#UserPasswordRepit').val()
var country_id=$('#PeopleCountrieId').val()
var province_id=$('#PeopleProvinceId').val()
var department_id=$('#PeopleDepartmentId').val()
var location_id=$('#PeopleLocationId').val()
if(typeof(country_id)=='undefined'||country_id==''||country_id==null){$().toastmessage('showToast',{text:'Debe Ingresar el país',sticky:!1,position:'top-right',type:'success',closeText:'',close:function(){}});return}
if(typeof(province_id)=='undefined'||province_id==''||province_id==null){$().toastmessage('showToast',{text:'Debe Ingresar la Provincia',sticky:!1,position:'top-right',type:'success',closeText:'',close:function(){}});return}
if(typeof(department_id)=='undefined'||department_id==''||department_id==null){$().toastmessage('showToast',{text:'Debe Ingresar el Departamento',sticky:!1,position:'top-right',type:'success',closeText:'',close:function(){}});return}
if(typeof(location_id)=='undefined'||location_id==''||location_id==null){$().toastmessage('showToast',{text:'Debe Ingresar la Localidad',sticky:!1,position:'top-right',type:'success',closeText:'',close:function(){}});return}
if(password!=password_repit){$().toastmessage('showToast',{text:'Los password deben ser Iguales',sticky:!1,position:'top-right',type:'success',closeText:'',close:function(){}});return}
var edad=diasfecha($('#PeopleBirthdate').val())/365
if(edad<18){$().toastmessage('showToast',{text:'El conductor debe ser mayor de 18 años',sticky:!0,position:'top-center',type:'error',closeText:'',close:function(){}});return!1}
$('form#TaxownerdriverAddForm').submit()}
function hasGetUsermedia(){return!!(navigator.getUserMedia||navigator.webkitGetUserMedia||navigator.mozGetUserMedia||navigator.msGetUserMedia)}
function getpeopledata(){$.ajax({url:'/peoples/getpersonsdata.json',type:'post',dataType:'json',data:{document:$('#PeopleDocument').val()},success:function(data){$.each(data,function(key,val){if(val.records.error.trim()==''){if(typeof(val.records.people.People)!='undefined'){$('#PeopleBirthdate').val(val.records.people.People.birthdate);$('#PeopleFirstname').val(val.records.people.People.firstname);$('#PeopleSecondname').val(val.records.people.People.secondname);$('#PeopleAddress').val(val.records.people.People.address);$('#PeopleNumber').val(val.records.people.People.number);$('#PeopleDepto').val(val.records.people.People.depto);$('#PeopleBlock').val(val.records.people.People.block);$('#PeopleGender').val(val.records.people.People.gender);$('#PeoplePhonenumber').val(val.records.people.People.phonenumber);$('#PeopleCountrieId').val(val.records.people.People.countrie_id)
$('#PeopleProvinceId').val(val.records.people.People.province_id)
$('#PeopleDepartmentId').val(val.records.people.People.department_id)
$('#PeopleLocationId').val(val.records.people.People.location_id)
$('#PeopleId').val(val.records.people.People.id)
formateafecha('PeopleBirthdate');cargardropdown('PeopleCountrieId','/provinces/retornalxmlprovinces/','PeopleProvinceId')
cargardropdown('PeopleProvinceId','/departments/retornalxmldepartments/','PeopleDepartmentId')
cargardropdown('PeopleDepartmentId','/locations/retornalxmllocations/','PeopleLocationId')
$('#PeopleProvinceId').attr('selectedIndex',val.records.people.People.province_id);$('#PeopleDepartmentId').attr('selectedIndex',val.records.people.People.department_id);$('#PeopleLocationId').attr('selectedIndex',val.records.people.People.location_id);$('#PeopleBirthdate').attr('readonly',!0);$('#PeopleFirstname').attr('readonly',!0);$('#PeopleSecondname').attr('readonly',!0);$('#PeopleAddress').attr('readonly',!0);$('#PeopleNumber').attr('readonly',!0);$('#PeopleDepto').attr('readonly',!0);$('#PeopleBlock').attr('readonly',!0);$('#PeopleGender').attr('readonly',!0);$('#PeoplePhonenumber').attr('readonly',!0);$('#PeopleCountrieId').attr('readonly',!0);$('#PeopleProvinceId').attr('readonly',!0);$('#PeopleLocationId').attr('readonly',!0);$('#PeopleDepartmentId').attr('readonly',!0)}else{$('#PeopleBirthdate').attr('readonly',!1);$('#PeopleFirstname').attr('readonly',!1);$('#PeopleSecondname').attr('readonly',!1);$('#PeopleAddress').attr('readonly',!1);$('#PeopleNumber').attr('readonly',!1);$('#PeopleDepto').attr('readonly',!1);$('#PeopleBlock').attr('readonly',!1);$('#PeopleGender').attr('readonly',!1);$('#PeoplePhonenumber').attr('readonly',!1);$('#PeopleCountrieId').attr('readonly',!1);$('#PeopleProvinceId').attr('readonly',!1);$('#PeopleLocationId').attr('readonly',!1);$('#PeopleDepartmentId').attr('readonly',!1);$('#PeopleId').val()
$('#PeopleBirthdate').val();$('#PeopleFirstname').val();$('#PeopleSecondname').val();$('#PeopleAddress').val();$('#PeopleNumber').val();$('#PeopleDepto').val();$('#PeopleBlock').val();$('#PeopleGender').val();$('#PeoplePhonenumber').val();$('#PeopleCountrieId').val()
$('#PeopleProvinceId').val()
$('#PeopleLocationId').val()
$('#PeopleDepartmentId').val()}}})}})}
function showmessage(){var message=$('#message').text();if(typeof(message)!='undefined'&&message.trim()!=''){$().toastmessage('showToast',{text:message,sticky:!1,position:'top-right',type:'success',closeText:'',close:function(){}})}}