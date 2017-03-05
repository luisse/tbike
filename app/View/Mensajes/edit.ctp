<?php echo $this->Html->script(array('/js/mensajes/edit.js','bootstrap-datetimepicker','dateformat.js','fmensajes.js','fgenerales.js','jquery.toastmessage','yellow-text'),array('block'=>'scriptjs')); ?>
<?php echo $this->Html->css(array('message','bootstrap-datetimepicker','yellow-text-blue'), null, array('inline' => false))?>
<?php echo $this->element('flash_message')?>
<?php echo $this->Form->create('Mensaje',array('action'=>'edit',	
				'inputDefaults' => array(
							'div' => 'form-group',
							'wrapInput' => false,
							'class' => 'form-control'
							),
				'class' => 'well'));?>
	<legend>		<?php echo __('Actualizar Mensaje') ?></legend>

		
<?php echo $this->Form->hidden('Mensaje.id') ?>
<?php echo $this->Form->hidden('Mensaje.fechaactual') ?>

			<div class="row">
				<div class="col-lg-3">
							<label><?php echo __('Fecha Envío Mensaje')?></label>
					<div class="form-group">
						<div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
							<?php echo $this->Form->input('Mensaje.fechasendauto',array('label' =>false,
															'placeholder' => false,
															'class'=>'form-control input-sm',
															'type'=>'text',
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>																										
						</div>
					</div>
				</div>	
			</div>
			<div class="row">
				<div class="col-lg-7">
				<?php echo $this->Form->input('Mensaje.asunto',array('label' => __('Asunto'),
													'placeholder'=>'Asunto',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('Mensaje.detalle',array('label' => __('Detalle'),
													'type'=>'textarea',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
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
