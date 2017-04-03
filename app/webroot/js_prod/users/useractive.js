$(document).ready(function(){IniciarEventos()})
function IniciarEventos(){$('#UserUsername').attr('readonly',!0)
$('#UserEmail').attr('readonly',!0)
$('#PeopleDocument').attr('readonly',!0)
$('#PeopleFirstname').attr('readonly',!0)
$('#PeopleSecondname').attr('readonly',!0)
$('#PeoplePhonenumber').attr('readonly',!0)
$('#PeopleAddres').attr('readonly',!0)
$('#PeopleAddress').attr('readonly',!0)
$('#PeopleNumber').attr('readonly',!0)
$('#PeopleBirthdate').attr('readonly',!0)
$('#guardar').click(guardardatos)}
function guardardatos(){$('form#UserConfirmarusuarioForm').submit()}