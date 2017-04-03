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
*    @Fecha 18/12/2011
*    @use Librerias de AJAX para administrar alta de usuarios
*/
$(document).ready(function(){
	IniciarEventos();})

//Inicalizamos los eventos ajax
function IniciarEventos(){
	$('#guardar').click(guardardatos)
	$('#UserCountrieId').change(function(){
						cargardropdown('UserCountrieId','/users/retornalxmlprovincias/','UserProvinceId')
						})	

	/***$('form#UserAddForm').validate({		
		invalidHandler: function(e,validator){
		var errors = validador.numberOfInvalids();
		if(errors){
			var message = errors == 1
				?'Existe un campo con error'
				:'Existen '+errors+' campos con error'
				$('div.error span').html(message)
				$('div.error').show()
				alert('Error en Formulario')
		}else{
			alert('No error')
			('div.error').hide()
		}
	},
	onkeyup: false,
	submitHandler: function(){
		$('div.error').hide()
		},
		rules:{
			password:{
				required: true,
				equalTo:"password_repit"
			}
		}
	}
	)**/
}

//Permite ejecutar el submit del formulario
function guardardatos(){
	$('form#UserAddusrnegForm').submit()
	
}

//Permite recuperar las provincias
function recuperarprovincias(){
    var li_countrie = $('#UserCountrieId').val()
    $('#UserProvinceId').val('')
    if(li_countrie == 0 || typeof(li_countrie)=='undefined') return
    $.ajax({type:'GET',
            url:'/users/retornalxmlprovincias/'+li_countrie,
            datatype:'xml',
            success:function(data){
                    var xml;
		var options = '';
                 if (typeof data == "string") {
                   xml = new ActiveXObject("Microsoft.XMLDOM");
                   xml.async = false;
                   xml.loadXML(data);
                 } else {
                   xml = data;
                 }
                    $(xml).find('datos').each(function(){
                            //Cargamos el drow dow con las provincias
			var li_id = $(this).find('id').text()
			var ls_name = $(this).find('name').text()
			options += '<option value="' +li_id+ '">' + ls_name + '</option>'

		});//close each
		//cargamos el drop down
		if(options == '') options = '<option value="0">Desconocido</option>'
  		$('#UserProvinceId').html(options)
  		$('#UserProvinceId').show()
            },
            error:function(xtr,fr,ds){
                    mensaje('No se pudieron recuperar las Provincias Asociadas. Verifique la conexión al server','Plan','')
            }
    })//close ajax

}



