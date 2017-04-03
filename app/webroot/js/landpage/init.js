function sendmail(){
  var formdata=$('form#contact').serialize()
  $.ajax({url:'/contactmail.json',
		type:'post',
		data:formdata,
		dataType:'json',
		success: function(data){
			  if(data.error != ''){
          alert(data.error)
			  }else{
          $('#name').val('')
          $('#email').val('')
          $('#message').val('')
          $('#phonenumber').val('')
          alert('Su mensaje a sido enviado con éxito. Gracias por su consulta')
			  }
		}
	}).error(function(){
    alert('No se pudo enviar el correo electronico. Disculpe las molestias.');
	})

}
