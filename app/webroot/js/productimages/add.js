/*
*    This program is free software: you can redistribute it and/or modify
*    it under the terms of the GNU General Public License as published by
*    the Free Software Foundation, either version 3 of the License, or
*    (at your option) any later version.
*
*    This program is distributed in the hope that it will be useful,
*    but WITHOUT ANY WARRANTY; without even the implied warranty of
*    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*    GNU General Public License for more details.
*
*    You should have received a copy of the GNU General Public License
*    along with this program.  If not, see <http://www.gnu.org/licenses/>
*    @author Luis Sebastian oppe
*    @Fecha 18/12/2011
*    @use Librerias de AJAX para administrar datos del rubro
*/


$(document).ready(function(){
	IniciarEventos();
})

function IniciarEventos(){
showmessagelocal();
/***
	$('#ProductimagePathimg').uploadify({
		'uploader'  : '/img/uploadify.swf',
		'script'    : '/productimages/cargarimagen',
		'cancelImg' : '/img/notice-alert.png',
		'auto'      : true,
		'folder'    : '/tmp/',
		'scriptData' : {'texto': $("#ProductimagePathimagen").val()},
		'onComplete': function(event, queueID, fileObj, response, data) {
 		    $('#resultadoCarga').append(response);
		}
	});
	***/	
	/***
    var button = $('#botonArchivo'), interval;
    new AjaxUpload('#botonArchivo', {
        action: '/productimages/cargarimagen',
        onSubmit : function(file , ext){
        if (! (ext && /^(jpg|png)$/.test(ext))){
	            // extensiones permitidas
	            alert('Solo se pueden Ingresar archivos con formato (jpg,png)');
	            return false;
        } else {
	            //Cambio el texto del boton y lo deshabilito
	            button.text('Cargando');
	            this.disable();
        }
        },
        onComplete: function(file, response){
            button.text('Nueva Imagen '+response);
	            // habilito upload button                      
	            this.enable();         
	            // Agrega archivo a la lista
	            $('#lista').appendTo('.files').text(file);
        }  
    });	****/	
	$('#ProductimageImagen').change(function(){
		mostrarVistaPrevia('ProductimageImagen','gallery','')
	})

	//guardar los datos
	$('#guardar').click(guardardatos)
	$('#cancelar').click(function(){window.history.back()})
}

function guardardatos(){
	$('form#ProductimageAddForm').submit()	
}



function showmessagelocal(){
	var message = $('#message').text();
	if(typeof(message) != 'undefined' && message.trim() != ''){
		$().toastmessage('showToast', {
				text     : message,
				sticky   : false,
				position : 'top-right',
				type     : 'success',
				closeText: '',
				close    : function () {
					//console.log("toast is closed ...");
				}
			});	
	}
}




