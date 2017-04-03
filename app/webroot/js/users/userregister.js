$(document).ready(function(){
	IniciarEventos();})

//Inicalizamos los eventos ajax
function IniciarEventos(){
	$('#guardar').click(guardardatos)
	$('#guardar').click(guardardatos)
	$('#cancelar').click(function(){window.history.back()})
}

//Permite ejecutar el submit del formulario
function guardardatos(){
	$('form#UserUserregisterForm').submit()

}
