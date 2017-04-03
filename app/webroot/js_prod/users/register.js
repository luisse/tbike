var accept=!1;var row_car_html='';var row_driver_html='';$(document).ready(function(){IniciarEventos()})
$("#guardar").addClass("disabled")
function IniciarEventos(){row_car_html=$("#row1").html();row_driver_html=$("#driver_row1").html();$('#myTab a:last').tab('show')
showtab(0);$('#datetimepicker1').datetimepicker({locale:'es',format:"DD/MM/YYYY"});$('.date').datetimepicker({locale:'es',format:"DD/MM/YYYY"});$('#datetimepicker2').datetimepicker({locale:'es',format:"DD/MM/YYYY"});$('#PeopleDocument').numeric();$('#TaxownerdriverLicencenumber').numeric()
$('#TaxownerscarRegisterpermision').numeric()
$('.numeric').numeric()
$('#UserUsername').attr('readonly',!0);$('#agregar_auto').click(function(){add_row()})
$('#agregar_chofer').click(function(){add_row('driver')})
$('#PeopleDocument').change(function(){var dni=$('#PeopleDocument').val()
$('#TaxownerdriverLicencenumber').val(dni)})
$("#UserAcceptar").click(function(){if($("#UserAcceptar").is(':checked')){$("#guardar").removeClass("disabled")
accept=!0}else{$("#guardar").addClass("disabled")
accept=!1}});$('#TaxownerscarRegisterpermision').change(function(){})
$('#guardar').click(guardardatos)
lshowmessage()}
function showtab(tab_id){$('#myTab li:eq('+tab_id+') a').tab('show')}
function guardardatos(){var password=$('#UserPassword').val();var password_repit=$('#UserPasswordRepit').val();var licencenumber=$('#TaxownerdriverLicencenumber').val();var fecvenclicence=$('#TaxownerdriverFecvenclicence').val();var document=$('#PeopleDocument').val();var edad=diasfecha($('#PeopleBirthdate').val())/365;var checkbox=$('#UserAcceptar').val();var firstname=$('#PeopleFirstname').val();var secondname=$('#PeopleSecondname').val();var phonenumber=$('#PeoplePhonenumber').val();var email=$('#UserEmail').val()
if(typeof(document)=='undefined'||document==''||document==null){$().toastmessage('showToast',{text:'Debe Ingresar el número de Documento',sticky:!0,position:'top-right',type:'error',closeText:'',close:function(){}});showtab(0);$('#PeopleDocument').focus()
return}
if(edad<18){$().toastmessage('showToast',{text:msg_people,sticky:!0,position:'top-center',type:'error',closeText:'',close:function(){}});showtab(0);$('#PeopleBirthdate').focus()
return!1}
if(typeof(firstname)=='undefined'||firstname==''||firstname==null){$().toastmessage('showToast',{text:'Debe Ingresar el Nombre',sticky:!0,position:'top-right',type:'error',closeText:'',close:function(){}});showtab(0);$('#PeopleFirstname').focus()
return!1}
if(typeof(secondname)=='undefined'||secondname==''||secondname==null){$().toastmessage('showToast',{text:'Debe Ingresar el Apellido',sticky:!0,position:'top-right',type:'error',closeText:'',close:function(){}});showtab(0);$('#PeopleSecondname').focus()
return!1}
if(typeof(phonenumber)=='undefined'||phonenumber==''||phonenumber==null){$().toastmessage('showToast',{text:'Debe Ingresar el Telefono',sticky:!0,position:'top-right',type:'error',closeText:'',close:function(){}});showtab(0);$('#PeoplePhonenumber').focus()
return}
if(email==undefined||email==''||email==null){$().toastmessage('showToast',{text:'Debe Ingresar un email valido',sticky:!0,position:'top-right',type:'error',closeText:'',close:function(){}});showtab(0);$('#UserEmail').focus()
return}
if(!accept){$().toastmessage('showToast',{text:'Debe Aceptar Terminos y Condiciones',sticky:!1,position:'top-right',type:'error',closeText:'',close:function(){}});showtab(0);return!1}
if(!validacars())return!1;if(!validadrivers())return!1;$('form#UserRegisterForm').submit()}
function validacars(){var found=!1;for(i=1;i<=current_row;i++){var carcode=$('#Taxownerscar'+i+'Carcode').val()
var registerpermision=$('#Taxownerscar'+i+'Registerpermision').val()
var descriptioncar=$('#Taxownerscar'+i+'Descriptioncar').val()
if(carcode!=undefined&&registerpermision!=undefined&&descriptioncar!=undefined){found=!0;if(typeof(carcode)=='undefined'||carcode==''||carcode==null){$().toastmessage('showToast',{text:'Debe Ingresar la patente del automovil',sticky:!0,position:'top-right',type:'error',closeText:'',close:function(){}});showtab(1);$('#Taxownerscar'+i+'Carcode').focus()
return!1}
if(typeof(registerpermision)=='undefined'||registerpermision==''||registerpermision==null){$().toastmessage('showToast',{text:'Debe Ingresar el número de Licencia del automovil',sticky:!0,position:'top-right',type:'error',closeText:'',close:function(){}});showtab(1);$('#Taxownerscar'+i+'Registerpermision').focus()
return!1}
if(typeof(descriptioncar)=='undefined'||descriptioncar==''||descriptioncar==null){$().toastmessage('showToast',{text:'Debe Ingresar una descripcion del automovil Modelo/Marca/Con aire/Sin Aire etc',sticky:!0,position:'top-right',type:'error',closeText:'',close:function(){}});showtab(1);$('#Taxownerscar'+i+'Descriptioncar').focus()
return!1}}}
if(!found){$().toastmessage('showToast',{text:'Debe Ingresar al menos un automovil',sticky:!0,position:'top-right',type:'error',closeText:'',close:function(){}});add_row('');showtab(1);return!1}
return!0}
function validadrivers(){var found=!1;for(i=1;i<=current_row;i++){var document=$('#Taxownerdriver'+i+'Document').val()
var birthdate=$('#Taxownerdriver'+i+'Birthdate').val()
var secondname=$('#Taxownerdriver'+i+'Secondname').val()
var firstname=$('#Taxownerdriver'+i+'Firstname').val()
var phonenumber=$('#Taxownerdriver'+i+'Phonenumber').val()
var licencenumber=$('#Taxownerdriver'+i+'Licencenumber').val()
var fecvenclicence=$('#Taxownerdriver'+i+'Fecvenclicence').val()
var edad=diasfecha(birthdate)/365
var diaslic=diasfecha(fecvenclicence)/365
if(document!=undefined&&birthdate!=undefined&&secondname!=undefined&&firstname!=undefined&&phonenumber!=undefined&&licencenumber!=undefined&&fecvenclicence!=undefined){found=!0;val=(document==$('#PeopleDocument').val())?!0:!1;if(typeof(document)=='undefined'||document==''||document==null){$().toastmessage('showToast',{text:'Debe Ingresar el número de Documento del chofer',sticky:!0,position:'top-right',type:'error',closeText:'',close:function(){}});showtab(2);$('#Taxownerdriver'+i+'Document').focus();return!1}
if(edad<18&&!val){$().toastmessage('showToast',{text:msg_people,sticky:!0,position:'top-center',type:'error',closeText:'',close:function(){}});showtab(2);$('#Taxownerdriver'+i+'Birthdate').focus()
return!1}
if((typeof(firstname)=='undefined'||firstname==''||firstname==null)&&!val){$().toastmessage('showToast',{text:'Debe Ingresar el Nombre del chofer',sticky:!0,position:'top-right',type:'error',closeText:'',close:function(){}});showtab(2);$('#Taxownerdriver'+i+'Firstname').focus()
return!1}
if((typeof(secondname)=='undefined'||secondname==''||secondname==null)&&!val){$().toastmessage('showToast',{text:'Debe Ingresar el Apellido del chofer',sticky:!0,position:'top-right',type:'error',closeText:'',close:function(){}});showtab(2);$('#Taxownerdriver'+i+'Secondname').focus()
return!1}
if((typeof(phonenumber)=='undefined'||phonenumber==''||phonenumber==null)&&!val){$().toastmessage('showToast',{text:'Debe Ingresar el Telefono del chofer',sticky:!0,position:'top-right',type:'error',closeText:'',close:function(){}});showtab(2);$('#Taxownerdriver'+i+'Phonenumber').focus()
return!1}
if(typeof(licencenumber)=='undefined'||licencenumber==''||licencenumber==null){$().toastmessage('showToast',{text:'Debe Ingresar Nro de Licencia del chofer',sticky:!0,position:'top-right',type:'error',closeText:'',close:function(){}});showtab(2);$('#Taxownerdriver'+i+'Licencenumber').focus()
return!1}
if(typeof(fecvenclicence)=='undefined'||fecvenclicence==''||fecvenclicence==null){$().toastmessage('showToast',{text:'Debe Ingresar Fech de Venc. de Licencia del chofer',sticky:!0,position:'top-right',type:'error',closeText:'',close:function(){}});showtab(2);$('#Taxownerdriver'+i+'Fecvenclicence').focus()
return!1}
if(diaslic>0){$().toastmessage('showToast',{text:'La Fecha de Venc. de Licencia de chofer debe ser mayor a la fecha actual',sticky:!0,position:'top-right',type:'error',closeText:'',close:function(){}});showtab(2);$('#Taxownerdriver'+i+'Fecvenclicence').focus()
return!1}}}
if(!found){$().toastmessage('showToast',{text:'Debe Ingresar al menos un chofer',sticky:!0,position:'top-right',type:'error',closeText:'',close:function(){}});add_row('driver');showtab(2);return!1}
return!0}
function existelicence(row){$.ajax({url:'/taxownerscars/existeregistercar.json',type:'post',dataType:'json',data:{carcode:$('#Taxownerscar'+row+'Carcode').val(),registerpermision:$('#Taxownerscar'+row+'Registerpermision').val()},success:function(data){$.each(data,function(key,val){if(typeof(val.id)!='undefined'){$().toastmessage('showToast',{text:'Existe un auto registrado para la licencia y patente',sticky:!1,position:'top-right',type:'error',closeText:'',close:function(){}});$('#Taxownerscar'+row+'Carcode').val('');$('#Taxownerscar'+row+'Registerpermision').val('')}})}})}
function lshowmessage(){var message=$('#message').text();if(typeof(message)!='undefined'&&message.trim()!=''){$().toastmessage('showToast',{text:message,sticky:!0,position:'top-right',type:'warning',closeText:'',close:function(){}})}}
function delete_row(row){$('#row'+row).html("")}
function delete_drow(row){$('#driver_row'+row).html("")}
function escapeRegExp(str){return str.replace(/([.*+?^=!:${}()|\[\]\/\\])/g,"\\$1")}
function replaceAll(str,find,replace){return str.replace(new RegExp(escapeRegExp(find),'g'),replace)}
function add_row(type){var new_row=current_row+1;if(type!='driver'){html_row=replaceAll(row_car_html,'(1)','('+new_row+')');html_row=replaceAll(html_row,'[1]','['+new_row+']');html_row=replaceAll(html_row,'Taxownerscar1Carcode','Taxownerscar'+new_row+'Carcode');html_row=replaceAll(html_row,'Taxownerscar1Registerpermisionorigin','Taxownerscar'+new_row+'Registerpermisionorigin');html_row=replaceAll(html_row,'Taxownerscar1Registerpermision','Taxownerscar'+new_row+'Registerpermision');html_row=replaceAll(html_row,'Taxownerscar1Descriptioncar','Taxownerscar'+new_row+'Descriptioncar');$('#rows').append('<div id="row'+new_row+'"  class="row">'+html_row+'</div>');$('html, body').animate({scrollTop:$("#row"+new_row).offset().top},2000)}else{html_row=row_driver_html;html_row=replaceAll(html_row,'(1)','('+new_row+')');html_row=replaceAll(html_row,'[1]','['+new_row+']');html_row=replaceAll(html_row,'Taxownerdriver1Document','Taxownerdriver'+new_row+'Document');html_row=replaceAll(html_row,'Taxownerdriver1Birthdate','Taxownerdriver'+new_row+'Birthdate');html_row=replaceAll(html_row,'Taxownerdriver1Secondname','Taxownerdriver'+new_row+'Secondname');html_row=replaceAll(html_row,'Taxownerdriver1Firstname','Taxownerdriver'+new_row+'Firstname');html_row=replaceAll(html_row,'Taxownerdriver1Gender','Taxownerdriver'+new_row+'Gender');html_row=replaceAll(html_row,'Taxownerdriver1Fecvenclicence','Taxownerdriver'+new_row+'Fecvenclicence');html_row=replaceAll(html_row,'Taxownerdriver1Licencenumber','Taxownerdriver'+new_row+'Licencenumber');html_row=replaceAll(html_row,'Taxownerdriver1Phonenumber','Taxownerdriver'+new_row+'Phonenumber');$('#driver_rows').append('<div id="driver_row'+new_row+'"  class="row">'+html_row+'</div>');$('.date').datetimepicker({locale:'es',format:"DD/MM/YYYY"});$('numeric').numeric();$('html, body').animate({scrollTop:$("#driver_row"+new_row).offset().top},2000)}
current_row++}