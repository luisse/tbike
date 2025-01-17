		<?php echo $this->Html->script(array('/js/helps/edit.js','fmensajes.js','fgenerales.js','jquery.toastmessage','yellow-text'),array('block'=>'scriptjs')); ?>
		<?php echo $this->Html->css(array('message','yellow-text-blue'), null, array('inline' => false))?>
		<?php echo $this->element('flash_message')?>
		<?php echo $this->Form->create('Help',array('action'=>'edit',	
				'inputDefaults' => array(
							'div' => 'form-group',
							'wrapInput' => false,
							'class' => 'form-control'
							),
				'class' => 'well'));?>
<?php echo $this->Form->hidden('id')?>				
<fieldset>
	<legend>		
		<?php echo __('Editar Ayuda') ?></legend>
		<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('controller',array('label' => __('Controlador'),
													'placeholder'=>'Ingrese Controlador',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
					<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('action',array('label' => __('Acción'),
													'placeholder'=>'Ingrese Acción',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
					<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('helpdetail',array('label' => __('Detalle Ayuda'),
													'placeholder'=>'Ingrese Help',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
		</fieldset>
<div class="row">	
	<div class="col-lg-6">
		<center>
		<button type="button" class="btn btn-success btn-lw" id='guardar'>
		  <span class="glyphicon glyphicon glyphicon-save"></span>&nbsp;<?php echo __('Guardar') ?>
		</button>	
		</center>
	</div>
	<div class="col-lg-6">
		<center>
		<button type="button" class="btn btn-danger btn-lw" id='cancelar'>
		  <span class="glyphicon glyphicon glyphicon-off"></span>&nbsp;<?php echo __(' Cancelar')?>
		</button>	
		</center>
	</div>
</div>
<?php echo $this->Form->end();?>
