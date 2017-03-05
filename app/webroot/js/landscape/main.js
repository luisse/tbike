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
*    @author Oppe Luis Sebastian
*    @Fecha 18/03/2014
*    @use Librerias de AJAX para inicio de sesion
*/
//inicializamos eventos y procesos desde el DOM
$(document).ready(function(){
	IniciarEventos();}
);

function IniciarEventos(){
  $('#enviar').click(function(){
    contact_form = $('#contact-form').serialize()
    $.ajax({type:'GET',
         url:'/senderlogs/sendmsg.json',
         datatype:'json',
         data:contact_form,
         success:function(data){
          if(data.error != ''){
            $().toastmessage('showToast', {
                text     : data.error,
                sticky   : false,
                position : 'top-right',
                type     : 'success',
                closeText: '',
                close    : function () {
                }
              });
							if(data.cod_error == 0){
								$('#name').val('')
								$('#surname').val('')
								$('#email').val('')
								$('#message').val('')
							}
          }else{
            $().toastmessage('showToast', {
                text     : 'Error al enviar el correo intente de nuevo mas tarde. Disculpe las molestias',
                sticky   : false,
                position : 'top-right',
                type     : 'success',
                closeText: '',
                close    : function () {
                }
              });

          }
          },
          onerror:function(){
            alert('Error');
          }
      }).always(function() {
        //$('#enviandomail'+mensaje_id).hide(1)
      });//close ajax
  })
}
