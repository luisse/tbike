<?php	echo $this->Html->script(array('/js/rubros/add.js','fmensajes.js','fgenerales.js','jquery.numeric','jquery.toastmessage'),array('block'=>'scriptjs'));	?>
<?php $str_estadossino[0]='No';
$str_estadossino[1]='Si'; 
?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>			
<?php echo $this->element('flash_message')?>
			
			
<?php echo $this->Form->create('Rubro',array('action'=>'add',	
				'inputDefaults' => array(
									'div' => 'form-group',
									'wrapInput' => false,
									'class' => 'form-control'
									),
				'class' => 'well'));?>
<fieldset>
	<legend><?php echo __('Alta de Rubro') ?></legend>
	<div class="row">
			<div class="col-lg-10">
				<?php echo $this->Form->input('descripcion',array('label' => __('Descripción'),
													'placeholder' => __('Agregar Descripción'),
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
			</div>
			<div class="col-lg-3">
				<?php echo $this->Form->input('sintetico',array('label' => __('Sintetico'),
													'placeholder' => __('Agregar Sintetico'),
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
			</div>
			<div class="col-lg-3">
				<?php echo $this->Form->input('estado',array('label' => __('Estado'),
													'class'=>'form-control input-sm',
													'options'=>$str_estadossino,
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
			</div>			
	</div>
</fieldset>
<div class="row">	
	<div class="col-xs-6 col-sm-6">
		<center>
		<button type="button" class="btn btn-success btn-lw" id='guardar'>
		  <span class="glyphicon glyphicon glyphicon-save"></span>&nbsp;<?php echo __('Guardar') ?>
		</button>	
		</center>
	</div>
	<div class="col-xs-6 col-sm-6">
		<center>
		<button type="button" class="btn btn-danger btn-lw" id='cancelar'>
		  <span class="glyphicon glyphicon glyphicon-off"></span>&nbsp;<?php echo __(' Cancelar')?>
		</button>	
		</center>
	</div>
</div>
<?php echo $this->Form->end();?>			
