IniciarEventos();function IniciarEventos(){$('#btnSubmitPasajero').click(function(e){validarUsuarioAjax()})
$('#btnSubmitPasajero').click(function(e){return!1})
$('#resetpass').click(function(){});$('#alerts').hide(1);lshowmessage()}
function changepassword(){var username=$('#UserUsername').val()
if(typeof(username)!='undefined'&&username!=''){window.location.href='/resetpassword/'+window.md5(username);$('#alerts').hide(1)}else{$('#alerts').show(1)
$('#msg').html('&nbsp;'+error_resetpasswd)}
return!1}
function validarUsuarioAjax(){serialize=$('#UserLoginForm').serialize()
$.ajax({url:'/users/userajaxloginremote.json',type:'post',dataType:'json',headers:{'Security-Access-PublicToken':'A33esaSP9skSjasdSfFSssEwS2IksSZxPlA4asSJ4GEW4S'},data:{user:$('#UserUsername').val(),password:$('#UserPassword').val()},success:function(data){$.each(data,function(key,val){if(val.error!=''){container=''
$('#alerts').show(1)
$('#msg').html(val.error)}else{$('form#UserLoginForm').submit()}})}})}
function lshowmessage(){var message=$('#message').text();if(typeof(message)!='undefined'&&message.trim()!=''){$().toastmessage('showToast',{text:message,sticky:!1,position:'top-right',type:'success',closeText:'',close:function(){}})}}