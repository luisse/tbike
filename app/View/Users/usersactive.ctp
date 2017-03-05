<?php	echo $this->Html->script('/js/users/useractive.js',array('block'=>'scriptjs'));?>
<?php echo $this->Form->create('User',array('action'=>'confirmarusuario',	
		'inputDefaults' => array(
						'div' => 'form-group',
						'wrapInput' => false,
						'class' => 'form-control'
						),
			'class' => 'well'
));?>
<?php if(!empty($usersdata)):?>
<fieldset>
	<legend><?php echo __('Confirmar Datos de Usuario')?></legend>
			<?php echo $this->Form->input('User.id',array('type'=>'hidden','value'=>$usersdata['User']['id']))?>
			<div class="row">
				<div class="col-lg-3">			
					<?php echo $this->Form->input('User.username',array('label' => __('Usuario'),
													'class'=>'form-control input-sm',
													'value'=>$usersdata['User']['username'],
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
				</div>
			</div>
			<div class="row">
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
				<label>Fecha de Nacimiento</label>
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
		<div class="row">	
			<div class="col-lg-2">	
			<?php echo $this->Form->input('Cliente.telefono',array('label'=>__('Telefono'),
														'placeholder' => __('Ingrese Telefono'),
														'size'=>'2',
														'value'=>$clientes['Cliente']['telefono'],			
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
			</div>
		</div>
		<div class="row">	
			<div class="col-lg-4">
														
				<?php echo $this->Form->input('Cliente.domicilio',array('label'=>__('Domiclio'),
														'placeholder' => __('Ingrese Domiclio'),
														'size'=>'10',
														'class'=>'form-control input-sm',
														'value'=>$clientes['Cliente']['domicilio'],				
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
			</div>
			<div class="col-lg-2">
				<?php echo $this->Form->input('Cliente.dpto',array('label'=>__('Dpto'),
															'placeholder' => __('Departamento'),
															'size'=>'2',
															'class'=>'form-control input-sm',
															'value'=>$clientes['Cliente']['dpto'],				
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
			</div>
			<div class="col-lg-2">
			<?php echo $this->Form->input('Cliente.piso',array('label'=>__('Piso'),
															'placeholder' => __('Piso'),
															'size'=>'2',
															'class'=>'form-control input-sm',
															'value'=>$clientes['Cliente']['piso'],			
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
			</div>
			<div class="col-lg-2">																																																
			<?php echo $this->Form->input('Cliente.block',array('label'=>__('Block'),
															'placeholder' => __('Block'),
															'size'=>'2',
															'class'=>'form-control input-sm',
															'value'=>$clientes['Cliente']['block'],			
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
			</div>
		</div>
		<?php endif;?>
	</fieldset>
<div class="row">	
	<div class="col-lg-12">
		<center>
		<button type="button" class="btn btn-success btn-lw" id='guardar'>
		  <span class="glyphicon glyphicon glyphicon-save"></span>&nbsp;<?php echo __('Confirmar Registración') ?>
		</button>	
		</center>
	</div>
</div>
<?php echo $this->Form->end();?>
<?php endif;?>

<?php if(empty($usersdata)):?>
<fieldset>
	<legend><?php echo __('No se encuentra el usuario en el Sistema. Por Favor Contacte con el Administrador')?></legend>
	<?php echo $this->Html->image('personanoexistente.jpg', array('alt' => 'WTF usuario?'));?>	
</fieldset>
<?php endif;?>