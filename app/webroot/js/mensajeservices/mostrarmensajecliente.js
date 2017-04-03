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
*    @Fecha 23/04/2014
*    @use Librerias de AJAX  user control library
*/

IniciarEventos();

function IniciarEventos(){
	//$('#confirmar').click(function(){alert('hello kitty')})
}


function confirmarmensaje(row){
	var Mensajeservice_Id = $('#MensajeserviceId'+row).val()
	result = confirm('¿Desea Confirmar el Mensaje?')
	if(result){
		if(typeof(Mensajeservice_Id)!='undefined' && Mensajeservice_Id != ''){
				$.ajax({
				url:'/mensajeservices/cambiarestado/'+Mensajeservice_Id+'/1',
				datatype:'html',
				success:function(data){
					if(typeof(data)!='undefined' && data != ''){
						mensaje(data)
					}else{
						//WARNING: BIBLIOTECA INDEX.js de serviciomensaje
						MostrarMensajes()
					}					
				}
			});
		}
	}
	return result
}