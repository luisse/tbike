<?php		
	echo $this->Html->script(array('/js/tipomovimientos/edit.js','fmensajes.js','fgenerales.js','jquery.numeric'),array('block'=>'scriptjs'));		?>

			
<?php echo $this->Form->create('Tipomovimiento',array('action'=>'edit',	
				'inputDefaults' => array(
									'div' => 'form-group',
									'wrapInput' => false,
									'class' => 'form-control'
									),
				'class' => 'well'));?>
<?php echo $this->Form->hidden('id')?>
<fieldset>
	<legend>Nuevo Tipo de Movimiento</legend>
	<div class="row">	
		<div class="col-lg-10">
					<?php echo $this->Form->input('descripcion',array('label' => 'Descripción del Movimiento',
													'placeholder' => 'Descripción',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-3">
					<?php echo $this->Form->input('signo',array('label' => 'Signo',
													'placeholder' => '',
													'options'=>$str_estados,
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-3">
					<?php echo $this->Form->input('estado',array('label' => 'Activo',
													'type'=>'checkbox',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
</fieldset>
<br>
<div class="row">	
	<div class="col-xs-6 col-sm-6">
		<center>
		<button type="button" class="btn btn-success btn-lw" id='guardar'>
		  <span class="glyphicon glyphicon glyphicon-save"></span> Actualizar
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
