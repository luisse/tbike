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
*    @Fecha 09/11/2013
*    @use Librerias de AJAX para inicio de sesion
*/

/*
 * Function: permite ejecutar una validacion por medio de ajax
 * 	Se debe tener una funcion en la libreria base llamadas
 * 	procesok() si se puede continuar con el borrado
 *  procesdenied() si no se puede eliminar
 *  //url ejemplo
 *  var url='/clientes/retornarclientexml/'+nombreapellido
 *  //La url debe retornar 1 si todo esta ok y 0 si hay problemas al borrar
 * */

var result = false;
function todeletevalidate(url){ 
	$.ajax({type:'GET',
          url:url,
          async:true,
          datatype:'html',
          success:function(data){
                  var xml;
                  var options = '';
                  xml = data;
                  if(data == 1)
                	  result = true
                  else
                	  result = false
          },
          error:function(xtr,fr,ds){
                  mensaje('No se pudo validar el borrado de datos. Verifique la conexión al server','Error de Sistema','')
          }
	  })//close ajax
	  return result
}