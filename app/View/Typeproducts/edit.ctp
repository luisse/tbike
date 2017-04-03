<?php	echo $this->Html->script(array('/js/typeproducts/add.js','fmensajes.js','fgenerales.js','jquery.numeric','jquery.toastmessage'),array('block'=>'scriptjs'));	?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>			
<?php echo $this->element('flash_message')?>
<?php echo $this->Form->create('Typeproduct',array('action'=>'add',	
				'inputDefaults' => array(
									'div' => 'form-group',
									'wrapInput' => false,
									'class' => 'form-control'
									),
				'class' => 'well'));?>
<fieldset>
	<legend><?php echo __('Actualizar Tipo de Producto')?></legend>
	<div class="row">
			<div class="col-lg-12">
				<?php echo $this->Form->input('descripction',array('label' => __('Descripción'),
													'placeholder' => __('Agregar Descripción'),
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger')))); ?></td>
				<?php echo $this->Form->hidden('id')?>
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
