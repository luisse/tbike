<?php echo $this->Html->script(array('/js/users/resetearcontrasenia.js'),array('block'=>'scriptjs'));?>
<div class="container">
     <h1 class="text-center login-title"><?php echo __('Resetear Contraseña')?></h1>
    <div class="row">
        <div class="col-sm-10 col-md-10 col-md-offset-1">
            <div class="jumbotron">
            <div class="row">
            	<div class='container'>
            		<h4><?php echo __('Para resetear la contraseña enviaremos un email a tu casilla de correo')?></h4>
            	</div>
            </div>
            	<?php if(empty($users['User']['picture'])):?>
                	<img class="profile-img" src="https://taxiar-files.s3.amazonaws.com/img/user_not.jpeg" alt="">
                <?php endif;?>
            	<?php if(!empty($users['User']['picture'])):?>
                	<img width='100px' height='100px' class="profile-img" src="<?php echo $users['User']['picture'];?>"/>
                <?php endif;?>
				<?php echo $this->Form->create('User',array('action'=>'resetpassword',
							'inputDefaults' => array(
											'div' => 'form-group',
											'wrapInput' => false,
											'class' => 'form-control'
											),
								'class' => 'form-signin'
				));?>
				<div class="row">
					<?php if(!empty($users['User']['email'])):?>
					<label><?php echo __('Correo Electrónico')?></label>
	    			<?php echo $this->Form->input('User.email',array('label'=>'E-Mail',
    													'placeholder' => 'E-Mail',
    													'class'=>'form-control',
	    												'value'=>$users['User']['email'],
	    												'label'=>false,
    													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
                	<?php endif;?>
                </div>
                <div class="row top-buffer">
	                <button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo __('Enviar Correo')?></button>
	                <?php echo $this->Form->end();?>
                </div>
            </div>
        </div>
    </div>
</div>
