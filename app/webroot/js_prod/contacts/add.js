$(document).ready(function(){IniciarEventos()})
function IniciarEventos(){$('#guardar').click(guardardatos)
$('#cancelar').click(function(){window.history.back()})}
function guardardatos(){$('form#ContactContactForm').submit()}