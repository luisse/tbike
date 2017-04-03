<?php echo $this->Html->script(array('/js/users/changepassword.js','validarclave.js'),array('block'=>'scriptjs'));?>
<?php if(!empty($usersdata)):?>
	<?php echo $this->Form->create('User',array('action'=>'changepassword',
						'inputDefaults' => array(
										'div' => 'form-group',
										'wrapInput' => false,
										'class' => 'form-control'
										),
						'class' => 'well'
	));?>
	<?php echo $this->Form->hidden('User.id',array('value'=>$usersdata['User']['id']))?>
<fieldset>
	<legend><?php echo __('Por Favor Ingrese Nueva Contraseña') ?></legend>
			<div class="row">
				<div class="col-lg-3">
					<?php echo $this->Form->input('User.username',array('label' => __('Usuario'),
													'class'=>'form-control input-sm',
													'value'=>$usersdata['User']['username'],
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
				</div>
				<div class="col-lg-3">
					<?php echo $this->Form->input('User.email',array('label' => __('Correo Electrónico'),
													'class'=>'form-control input-sm',
													'value'=>$usersdata['User']['email'],
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
				</div>
			</div>
	<fieldset>
		<div class='row'>
			<div class='col-lg-5'>
					<?php echo $this->Form->input('User.passwordc',array('label'=>__('Ingresa la Contraseña'),
															'placeholder' => '',
															'class'=>'form-control input-sm',
															'type'=>'password',
															'val'=>'',
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>

				<span id='mensajecontrola'></span>
			</div>
		</div>
		<div class='row'>
			 <div  class='col-lg-5'>
					<?php echo $this->Form->input('User.passwordrepit',array('label'=>__('Ingresa nuevamente la Contraseña'),
															'placeholder' => '',
															'class'=>'form-control input-sm',
															'type'=>'password',
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>

			</div>
			<div  class='col-lg-5'>
				<div class="alert alert-success"><?php echo __('Debes repetir la contraseña para evitar errores de tipeo') ?></div>
			</div>
		</div>
	<?php echo $this->Form->end();?>
</fieldset>
	</fieldset>
<div class="row">
	<div class="col-lg-12">
		<center>
		<button type="button" class="btn btn-success btn-lw" id='actualizarpswd'>
		  <span class="glyphicon glyphicon glyphicon-save"></span>&nbsp;<?php echo __('Confirmar Contraseña') ?>
		</button>
		</center>
	</div>
</div>
<?php endif;?>

<?php if(empty($usersdata)):?>
<fieldset>
	<legend><?php echo __('No se encuentra el usuario en el Sistema. Por Favor Contacte con el Administrador')?></legend>
	<?php echo $this->Html->image('personanoexistente.jpg', array('alt' => ''));?>
</fieldset>
<?php endif;?>
