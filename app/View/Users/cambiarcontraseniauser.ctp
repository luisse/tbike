<?php echo $this->Html->script(array('/js/users/cambiarcontrasenia.js','jquery.toastmessage','validarclave.js'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>		
<?php if(!empty($usersdata)):?>
	<?php echo $this->Form->create('User',array('action'=>'cambiarcontraseniauser',
						'inputDefaults' => array(
										'div' => 'form-group',
										'wrapInput' => false,
										'class' => 'form-control'
										),
						'class' => 'well'
	));?>
	<?php echo $this->Form->hidden('User.id',array('value'=>$usersdata['User']['id']))?>
<fieldset>
	<legend><?php echo __('Por Favor Cambie su Contraseña') ?></legend>
			<?php //echo $this->Form->input('User.id',array('type'=>'hidden','value'=>$usersdata['User']['id']))?>
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
			<?php if(!empty($clientes)):?>
			<?php echo $this->Form->hidden('Cliente.id')?>
	<div class="row">	
		<div class="col-lg-3">
			<?php echo $this->Form->input('Cliente.documento',array('label' => __('Nro de Documento'),
													'size'=>'3',
													'class'=>'form-control input-sm',
													'value'=>$clientes['Cliente']['documento'],
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
			<div class="col-lg-3">
				<label><?php echo __('Fecha de Nacimiento')?></label>
				<div class="form-group">
		            <div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
						<?php echo $this->Form->input('Cliente.fechanac',array('label'=>false,
															'placeholder' => __('Fecha de Nacimiento'),
															'size'=>'7',
															'type'=>'text',
															'value'=>$this->Time->format('d/m/Y',$clientes['Cliente']['fechanac']),						
															'class'=>'form-control input-sm',
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
		                </span>													
					</div>
				</div>
			</div>
	</div>
	<div class="row">	
		<div class="col-lg-5">	
				<?php echo $this->Form->input('Cliente.apellido',array('label'=>__('Apellido'),
														'placeholder' => __('Ingrese Apellido'),
														'size'=>'7',
														'class'=>'form-control input-sm',
														'value'=>$clientes['Cliente']['apellido'],				
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
			</div>
			<div class="col-lg-5">													
				<?php echo $this->Form->input('Cliente.nombre',array('label'=>__('Nombre'),
														'placeholder' => __('Ingrese Nombre'),
														'size'=>'7',
														'value'=>$clientes['Cliente']['nombre'],				
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
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
<?php endif;?>
		
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
	<?php echo $this->Html->image('personanoexistente.jpg', array('alt' => 'WTF usuario?'));?>	
</fieldset>
<?php endif;?>