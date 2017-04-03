
/*
 * Funcion: permite mostrar un mensaje por mediode Jquery se debe definir el div error
 * @string mensaje que queremos mostrar
 * @string el titulo a visualizar
 * */
function mensaje(ps_mensage,ps_title,funcion){
	$("#mensaje").text(ps_mensage)
	$('#modalbox').modal()
	
}

/*
 * Funcion: permite mostrar un mensaje con un botón aceptar
 * */
function alerta(ps_mensage,ps_title,funcion){
	//Siempre debe estar el flasnotice creado
	if($("#flash_notice") == 'undefined') return false
	//si no pasamos el texto de mensaje muestra el texto incluido en el div
	if(ps_mensage != ''){
		$("#flash_notice").text(ps_mensage)
	}
	$("#flash_notice").attr('title',ps_title)
	$( "#flash_notice" ).dialog(
			
			{position: "center",
				buttons:{"Aceptar":
						function() {
							
							$(this).dialog("close");
							eval(funcion)
							}
					},
					minWidth:350 });
}