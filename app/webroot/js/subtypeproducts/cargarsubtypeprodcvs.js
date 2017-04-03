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
*    @use Librerias de AJAX para administrar datos de negocio
*/


$(document).ready(function(){
	IniciarEventos();
})

function IniciarEventos(){
	$(document).ready(function(){
	    var button = $('#upload_button'), interval;
	    new AjaxUpload('#upload_button', {
	        action: 'subtypeproducts/cargarsubtypeprodcvs',
	        onSubmit : function(file , ext){
	        if (! (ext && /^(cvs|txt)$/.test(ext))){
	            // extensiones permitidas
	            alert('Solo se pueden Ingresar archivos con formato CVS(cvs,txt)');
	            // cancela upload
	            return false;
	        } else {
	            //Cambio el texto del boton y lo deshabilito
	            button.text('Cargando');
	            this.disable();
	        }
	        },
	        onComplete: function(file, response){
	            button.text('Cargar');
	            // habilito upload button                      
	            this.enable();         
	            // Agrega archivo a la lista
	            $('#lista').appendTo('.files').text(file);
	        }  
	    });
	});
}

function guardardatos(){
	$('form#SubtypeproductProcesarcvsForm').submit()	
}