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
*    @Fecha 05/09/2014
*    @use Librerias de AJAX para validar fortaleza de contraseña
*	 @password: password a ingresar
*	 @objectresultname: objeto span a visualizar el error
* 	 Read more: http://mrbool.com/how-to-validate-password-strength-using-jquery/26760#ixzz3CRlnvLSw
*/

function validarpassword(password,objectresultname){
	//initial strength
    var strength = 0
	var response=''
    //if the password length is less than 6, return message.
    if (password.length < 6) {
        $('#'+objectresultname).removeClass()
        $('#'+objectresultname).addClass('label label-danger')
        return 'Demasiado Corta'
    }
 
    //length is ok, lets continue.
 
    //if length is 8 characters or more, increase strength value
    if (password.length > 7) strength += 1
 
    //if password contains both lower and uppercase characters, increase strength value
    if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  strength += 1
 
    //if it has numbers and characters, increase strength value
    if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  strength += 1 
 
    //if it has one special character, increase strength value
    if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))  strength += 1
 
    //if it has two special characters, increase strength value
    if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,",%,&,@,#,$,^,*,?,_,~])/)) strength += 1
 
    //now we have calculated strength value, we can return messages
 
    //if value is less than 2
    if (strength < 2 ) {
        $('#'+objectresultname).removeClass()
        $('#'+objectresultname).addClass('label label-danger')
        return 'Debil'
    } else if (strength == 2 ) {
        $('#'+objectresultname).removeClass()
        $('#'+objectresultname).addClass('label label-warning')
        return 'Buena'
    } else {
        $('#'+objectresultname).removeClass()
        $('#'+objectresultname).addClass('label label-success')
        return 'Fuerte'
    }
}