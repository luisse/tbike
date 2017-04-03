<?php		
echo $this->Html->script(array('/js/proveedores/edit.js','fmensajes.js','fgenerales.js','jquery.numeric','jquery.toastmessage','jquery.maskedinput'),array('block'=>'scriptjs'));		?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>			
<?php echo $this->element('flash_message')?>

<?php echo $this->Form->create('Proveedore',array('action'=>'edit',	
				'inputDefaults' => array(
									'div' => 'form-group',
									'wrapInput' => false,
									'class' => 'form-control'
									),
				'class' => 'well'));?>
<?php echo $this->Form->hidden('id')?>				
<fieldset>
	<legend><?php echo __('Actualizar Proveedor')?></legend>
	<div class="row">	
		<div class="col-lg-5">
					<td><?php echo $this->Form->input('CUIT',array('label' => __('CUIT'),
													'placeholder' => __('CUIT'),
													'class'=>'form-control input-sm',
													'type'=>'text',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>					
		<div class="col-lg-5">
			<?php echo $this->Form->input('denominacion',array('label' => __('Denominacion'),
													'placeholder' => __('Denominacion'),
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-5">		
			<?php echo $this->Form->input('mail',array('label' => __('Correo Electrónico'),
													'placeholder' => __('Correo Electrónico'),
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-5">
			<?php echo $this->Form->input('url',array('label' => __('Página Web'),
													'placeholder' => __('Página Web'),
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-10">
			<?php //echo $this->Form->input('imagen',array('label'=>false,'class'=>'inputboxl','size'=>'5'))?>
		</div>	
	</div>
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
			