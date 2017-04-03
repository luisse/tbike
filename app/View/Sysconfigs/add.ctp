<?php			
echo $this->Html->script(array('/js/sysconfigs/add.js','fgenerales','fmensajes.js','jquery.maskedinput','jquery.numeric','jquery.toastmessage'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>		
<?php echo $this->element('flash_message')?>
<?php echo $this->Form->create('Sysconfig',array('action'=>'add',
		'inputDefaults' => array(
							'div' => 'form-group',
							'wrapInput' => false,
							'class' => 'form-control'
							),
		'class' => 'well'
			));?>
<?php echo $this->Form->hidden('Sysconfig.id')?>
<fieldset>
	<legend><?php echo __('Configuraciones del Sistema')?></legend>
	<div class="row">	
		<div class="col-lg-3">
					<?php echo $this->Form->input('Sysconfig.stockrestrict',array('label'=>'Sotck Restricto',
														'class'=>'form-control input-sm',
														'options'=>$str_estadossino,
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>			
	</div>
	<div class="row">	
		<div class="col-lg-5">
			<?php echo $this->Form->input('Sysconfig.tokenmp',array('label'=>'Mercado Pago Token',
														'placeholder' => 'Ingrese el Token Mercado Pago',
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-3">
			<?php echo $this->Form->input('Sysconfig.usermp',array('label'=>'Marcado Libre Usuario',
														'placeholder' => 'Usuario Mercado Pago',
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<div class="row">	
		<div class="col-lg-3">
			<?php echo $this->Form->input('Sysconfig.mailtransport',array('label'=>'Transport',
														'placeholder' => 'Ingrese Transport',
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-3">
					<?php echo $this->Form->input('Sysconfig.mailfrom',array('label'=>'Email de',
														'placeholder' => 'Ingrese Correo Electrónico',
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<div class="row">	
		<div class="col-lg-3">
					<?php echo $this->Form->input('Sysconfig.mailhost',array('label'=>'E-Mail Host',
														'placeholder' => 'Ingrese Host E-Mail',
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-3">
				<?php echo $this->Form->input('Sysconfig.mailport',array('label'=>'Puerto',
														'placeholder' => 'Ingrese Puerto',
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-3">
					<?php echo $this->Form->input('Sysconfig.mailuser',array('label'=>'User E-Mail',
														'placeholder' => 'Ingrese User E-Mail',
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-3">
					<?php echo $this->Form->input('Sysconfig.mailpassword',array('label'=>'Contraseña',
														'options'=>$str_estadossino,
														'class'=>'form-control input-sm',
														'type'=>'password',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>		
	</div>
</fieldset>
<div class="row">	
	<div class="col-xs-6 col-sm-4">
		<button type="button" class="btn btn-success btn-lw" id='guardar'>
		  <span class="glyphicon glyphicon glyphicon-save"></span>&nbsp;<?php echo __('Guardar')?>
		</button>	
	</div>
</div>
<?php echo $this->Form->end();?>