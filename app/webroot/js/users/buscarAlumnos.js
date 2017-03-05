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
*    @author
*    @Fecha 15/12/2010
*    @use Librerias de AJAX para seleccion de usuarios
*/

var fl_fila_seleccionada=-1



function cargarEventoFilas(){
	var filas=$("#talumnos tr");
	filas.mouseover(resaltafilacolor);
	filas.mouseout(salemouse);
	filas.dblclick(seleccionarfila)
	filas.click(guardarfila)
	$('#buscaralumnos').mouseover(cambiarcursor);
	$("#aceptar").click(devolverfila)

}

function resaltafilacolor(){
	var fila;
	fila = $(this);
	fila.css('cursor','pointer');

}

function salemouse(){
	var fila;
	fila = $(this);
	fila.css('background-color','');
}

function seleccionarfila(){
	var fl_fila_seleccionada = $(this).parent().children().index($(this))
	var li_id=$('#idalumno'+fl_fila_seleccionada).val();
	
	agregarusuario(li_id)	
	$('#facebox').hide(10)
	$('#facebox_overlay').hide(10)
	$('#facebox').trigger('close.facebox')
}

function seleccionacliente(){
	var li_id=$('#idalumno'+fl_fila_seleccionada).val();
	$('#idalumno').val(li_id);
}

function guardarfila(){
	fl_fila_seleccionada = $(this).parent().children().index($(this))
}

function devolverfila(){
	if(fl_fila_seleccionada >=0 )
		alert('Fila que debo recuperar los datos: '+fl_fila_seleccionada)
	else
		alert('nada para devolver')
}

/*
 * Funcion: permite captar el evento clicked sobre un link para luego
 * cargarlo en el div respectivo
 * */
function loadPiece(href,divName) {
	 //$("#espera").css("display", "inline");
	$(divName).load(href, {}, function(){
        var divPaginationLinks = divName+" #pagination a,#order a";
        $(divPaginationLinks).click(function(){
            var thisHref = $(this).attr("href");
            loadPiece(thisHref,divName);
            return false;
        });
        cargarEventoFilas();
    });
} 


function fbuscaralumnos(ps_path){
	var ls_usuario = $('#nombreapellido').val()
	ps_path = ps_path+'/'+ls_usuario
	loadPiece(ps_path,'#content')
}

//cambiar la forma del cursor
function cambiarcursor(){
	$('#buscaralumnos').css('cursor','pointer')
}
