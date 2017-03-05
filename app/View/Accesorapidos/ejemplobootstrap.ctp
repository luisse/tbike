<?php echo $this->Form->create('BoostCake', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well'
)); ?>
	<fieldset>
		<legend>Datos del Cliente</legend>
		<?php echo $this->Form->input('Cliente.Documento', array(
			'label' => 'Nro de Documento',
			'placeholder' => 'Número de Documento'
		)); ?>	
		<?php echo $this->Form->input('Cliente.Apellido', array(
			'label' => 'Apellido',
			'placeholder' => 'Apellido del Cliente'
		)); ?>
		<?php echo $this->Form->input('Cliente.Nombre', array(
			'label' => 'Nombre',
			'placeholder' => 'Nombre del Cliente'
		)); ?>		
		<?php echo $this->Form->input('Cliente.Domicilio', array(
			'label' => 'Domicilio',
			'placeholder' => 'Domiclio del Cliente Con Altura'
		)); ?>			
		<?php echo $this->Form->input('Cliente.sexo', array(
			'label' => 'Sexo',
			'class' => true,
			'type' => 'checkbox'
		)); ?>
	</fieldset>
<div class="row">	
	<div class="col-lg-6">
		<center>
		<button type="button" class="btn btn-default btn-lg">
		  <span class="glyphicon glyphicon glyphicon-save"></span> Guardar
		</button>	
		</center>
	</div>
	<div class="col-lg-6">
		<center>
		<button type="button" class="btn btn-default btn-lg">
		  <span class="glyphicon glyphicon glyphicon-off"></span> Cancelar
		</button>	
		</center>
	</div>
</div>
<?php  echo $this->Form->end(); ?>