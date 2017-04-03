$(document).ready(function(){cargarEventoFilas()})
function cargarEventoFilas(){$('#enviar').click(function(){sendmsg()})}
function sendmsg(){$('form#MainSendmsgactivecarForm').submit()}