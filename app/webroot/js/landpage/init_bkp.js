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
			  }
		}
	}).error(function(){
    alert('No se pudo enviar el correo');
	})

}
