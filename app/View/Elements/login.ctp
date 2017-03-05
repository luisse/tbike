<?php
echo $this->Html->script(array('/js/users/login.js','md5.min'),array('block'=>'scriptjs'));
echo $this->Form->create("User",array('action'=>'login','class'=>'form-horizontal','role'=>'form'));
?>
<script>
var error_resetpasswd = "<?php echo __('Para recuperar su contraseña debe ingresar un usuario válido')?>"
</script>
    <div class="alert alert-danger" role="alerts" id='alerts'>
		    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span id="msg"></span><span class="sr-only"></span>
  	</div>
  <div class="form-group" id="formUsernameP">
    <label id="emailP" class="control-label" for="emailP"><span class="glyphicon glyphicon-envelope"></span>&nbsp;<?php echo __('Usuario')?> </label>
    <?php echo $this->Form->input('User.username',array('label'=>false,
          'class'=>'form-control',
          'placeholder'=>__("Ingresar Usuario u Email ..."),
          'ng-model'=>'formData.usernameP',
          'autofocus','size'=>15,'div'=>false));?>
  </div>
  <div class="form-group" id="formPasswordP">
    <label id="passwordP" class="control-label" for="passwordP"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;<?php echo __('Contraseña')?></label>
    <?php echo $this->Form->input('User.password',array('label'=>false,
          'class'=>'form-control',
          'placeholder'=>__("Ingresar Contraseña"),
          'ng-model'=>"formData.passwordP",
          'autofocus','size'=>15,'div'=>false));?>
  </div>
  <div class="form-group">
          <button type="submit" class="btn btn-block btn-lg btn-success btn-loading" id="btnSubmitPasajero"
        data-loading-text="<span class='fa fa-spin fa-spinner'></span><?php echo __('Por favor espere..')?>><span class="glyphicon glyphicon-log-in"></span> <?php echo __('Ingresar')?> </button>
  </div>
  </br>
  <!--SOCIAL BUTTONS-->
  <div class="form-group" id="fb-LoginDiv">
	<a id="fb-login" href="/users/social_login/Facebook" role="button" class="btn btn-block btn-social btn-lg btn-primary btn-facebook" ><i class="fa fa-facebook-official"></i>&nbsp;<?php echo __('Ingresar con Facebook') ?></a>
	<a id="fb-login" href="/users/social_login/Google" role="button" class="btn btn-block btn-social btn-lg btn-danger btn-google" ><i class="fa fa-google-plus-square"></i>&nbsp;<?php echo __('Ingresar con Google+') ?></a>
   </div>
<?php echo $this->Form->end();?>
