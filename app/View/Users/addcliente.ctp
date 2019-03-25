<?php echo $this->Html->script(array('/js/users/addcliente.js','jquery.maskedinput','bootstrap-datetimepicker','fmensajes.js','fgenerales.js','jquery.numeric'),array('block'=>'scriptjs'));		?>
<?php echo $this->Html->css('bootstrap-datetimepicker', null, array('inline' => false))?>
<?php echo $this->Form->create('User',array('url'=>array('action'=>'addcliente'),
		'inputDefaults' => array(
							'div' => 'form-group',
							'wrapInput' => false,
							'class' => 'form-control'
							),
		'class' => 'well'
			));?>
<fieldset>
	<legend><?php echo __('Alta de Usuario')?></legend>
	<div class="row">
		<div class="col-lg-2">
			<?php echo $this->Form->input('Cliente.documento',array('label' => __('Nro de Documento'),
													'placeholder' => __('Número de Documento'),
													'size'=>'3',
													'type'=>'text',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-2">
			<label>Fecha de Nacimiento</label>
			<div class="form-group">
	            <div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
					<?php echo $this->Form->input('Cliente.fechanac',array('label'=>false,
														'placeholder' => __('Fecha de Nacimiento'),
														'size'=>'7',
														'type'=>'text',
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
	                </span>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-2">
			<?php echo $this->Form->input('Cliente.apellido',array('label'=>__('Apellido *'),
													'placeholder' => __('Ingrese Apellido'),
													'size'=>'7',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-4">
			<?php echo $this->Form->input('Cliente.nombre',array('label'=>__('Nombre *'),
													'placeholder' => __('Ingrese Nombre'),
													'size'=>'7',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-2">
		<?php
		$options = array('0' => 'Femenino', '1' => 'Masculino');
		echo $this->Form->input('sexo',array('label'=>__('Sexo'),
													'options'=>$options,
													'value'=>1,
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-2">
		<?php echo $this->Form->input('Cliente.telefono',array('label'=>__('Telefono *'),
													'placeholder' => __('Ingrese Telefono'),
													'size'=>'2',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-3">
					<?php echo $this->Form->input('Cliente.provincia_id',array('label'=>__('Provincia *'),
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-3">
				<?php echo $this->Form->input('Cliente.departamento_id',array('label'=>__('Departamento *'),
														'placeholder' => 'Ingrese Departamento',
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-3">
					<?php echo $this->Form->input('Cliente.localidade_id',array('label'=>__('Localidad *'),
														'placeholder' => 'Ingrese Localidad',
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-4">

			<?php echo $this->Form->input('Cliente.domicilio',array('label'=>__('Domiclio *'),
													'placeholder' => __('Ingrese Domiclio'),
													'size'=>'10',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-1">
			<?php echo $this->Form->input('Cliente.dpto',array('label'=>__('Dpto'),
														'placeholder' => __('Departamento'),
														'size'=>'2',
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-1">
		<?php echo $this->Form->input('Cliente.piso',array('label'=>__('Piso'),
														'placeholder' => __('Piso'),
														'size'=>'2',
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-1">
		<?php echo $this->Form->input('Cliente.block',array('label'=>__('Block'),
														'placeholder' => __('Block'),
														'size'=>'2',
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-3">
			<?php echo $this->Form->input('User.email',array('label'=>'E-Mail',
													'placeholder' => 'E-Mail',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-3">
					<?php echo $this->Form->input('User.username',array('label'=>__('Usuario'),
													'placeholder' => __('Ingrese Usuario'),
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-3">
				<?php echo $this->Form->input('User.password',array('label'=>__('Contraseña'),
													'class'=>'form-control input-sm',
													'value'=>'123456',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-3">
					<?php echo $this->Form->input('User.password_repit',array('label'=>__('Repetir Contraseña'),
													'class'=>'form-control input-sm',
													'type'=>'password',
													'value'=>'123456',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
</fieldset>
<div class="row">
	<div class="col-xs-6 col-sm-6">
		<center>
		<button type="button" class="btn btn-success btn-lw" id='guardar'>
		  <span class="glyphicon glyphicon glyphicon-save"></span> <?php echo __('Guardar')?>
		</button>
		</center>
	</div>
	<div class="col-xs-6 col-sm-6">
		<center>
		<button type="button" class="btn btn-danger btn-lw" id='cancelar'>
		  <span class="glyphicon glyphicon glyphicon-off"></span><?php echo __(' Cancelar')?>
		</button>
		</center>
	</div>
</div>

<?php echo $this->Form->end();?>
