<?php echo $this->Html->script(array('/js/clientes/add.js','bootstrap-datetimepicker','jquery.numeric','fgenerales.js'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css('bootstrap-datetimepicker', null, array('inline' => false))?>
		
<?php echo $this->Form->create('Cliente',array('action'=>'add',	
		'inputDefaults' => array(
							'div' => 'form-group',
							'wrapInput' => false,
							'class' => 'form-control'
							),
		'class' => 'well'
			)
		);?>
<fieldset>
	<legend>Nuevo Cliente</legend>
	<div class="row">	
		<div class="col-lg-3">
			<?php echo $this->Form->input('documento',array('label' => 'Nro de Documento',
													'placeholder' => 'Número de Documento',
													'size'=>'3',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-3">
			<label>Fecha de Nacimiento</label>
			<div class="form-group">
	            <div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
					<?php echo $this->Form->input('fechanac',array('label'=>false,
														'placeholder' => 'Fecha de Nacimiento',
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
		<div class="col-lg-5">	
			<?php echo $this->Form->input('apellido',array('label'=>'Apellido',
													'placeholder' => 'Ingrese Apellido',
													'size'=>'7',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-5">													
			<?php echo $this->Form->input('nombre',array('label'=>'Nombre',
													'placeholder' => 'Ingrese Nombre',
													'size'=>'7',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>	
	<div class="row">	
		<div class="col-lg-2">	
		<?php 
		$options = array('0' => 'Femenino', '1' => 'Masculino');
		$attributes = array('legend' => false);
		echo $this->Form->radio('sexo',$options,array('legend'=>'False',
													'value' => '1',
													'size'=>'2',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>	
	<div class="row">	
		<div class="col-lg-2">	
		<?php echo $this->Form->input('telefono',array('label'=>'Telefono',
													'placeholder' => 'Ingrese Telefono',
													'size'=>'2',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<div class="row">	
		<div class="col-lg-3">
					<?php echo $this->Form->input('Cliente.provincia_id',array('label'=>'Provincia',
														'placeholder' => 'Ingrese Provincia',
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-3">
				<?php echo $this->Form->input('Cliente.departamento_id',array('label'=>'Departamento',
														'placeholder' => 'Ingrese Departamento',
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-3">
					<?php echo $this->Form->input('Cliente.localidade_id',array('label'=>'Localidad',
														'placeholder' => 'Ingrese Localidad',
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<div class="row">	
		<div class="col-lg-4">
			<?php echo $this->Form->input('Cliente.domicilio',array('label'=>'Domiclio',
													'placeholder' => 'Ingrese Domiclio',
													'size'=>'10',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-2">
			<?php echo $this->Form->input('Cliente.dpto',array('label'=>'Dpto',
														'placeholder' => 'Departamento',
														'size'=>'2',
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-2">
		<?php echo $this->Form->input('Cliente.piso',array('label'=>'Piso',
														'placeholder' => 'Piso',
														'size'=>'2',
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-2">																																																
		<?php echo $this->Form->input('Cliente.block',array('label'=>'Block',
														'placeholder' => 'Block',
														'size'=>'2',
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
</fieldset>
<div class="row">	
	<div class="col-xs-6 col-sm-6">
		<center>
		<button type="button" class="btn btn-success btn-lw" id='guardar'>
		  <span class="glyphicon glyphicon glyphicon-save"></span> Guardar
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
