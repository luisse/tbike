<div id='formreturn'>
<?php echo $this->element('modalboxcabecera',array('title'=>'Mensaje de Servivio Técnico','paneltipo'=>'panel-primary'));?>
<?php echo $this->Html->script(array('bootstrap-datetimepicker','dateformat.js','fgenerales.js','jquery.numeric','mensajeservices/add.js'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css('bootstrap-datetimepicker', null, array('inline' => false))?>
<?php echo $this->Form->create('Mensajeservice',array('action'=>'add',	
					'inputDefaults' => array(
						'div' => 'form-group',
						'wrapInput' => false,
						'class' => 'form-control'
						),
				'class' => 'well'
			));?>
<?php echo $this->Form->hidden('bicicleta_id',array('value'=>$bicicleta_id)) ?>
<fieldset>
	<div class="row">	
		<div class="col-lg-4">
					<label><?php echo __('Fecha de Mensaje')?></label>
			<div class="form-group">
				<div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
					<?php echo $this->Form->input('Mensajeservice.fechaaprox',array('label' =>false,
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
		<div class="col-lg-5">
			<?php echo $this->Form->input('Mensajeservice.detalleservice',array('label' =>__('Mensaje Detalle'),
													'placeholder' => 'Ingrese Mensaje',
													'class'=>'form-control input-sm',
													'type'=>'text',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<div class="row">	
		<div class="col-lg-6">
			<?php echo $this->Form->input('Mensajeservice.enviarcorreo',array('label' =>__('Enviar Correo Electrónico'),
													'placeholder' => false,
													'class'=>'form-control input-sm',
													'type'=>'checkbox',
													'value'=>'1',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-3">
			<?php echo $this->Form->input('Mensajeservice.cantmensajes',array('label' =>__('Mensajes a Enviar'),
													'placeholder' => false,
													'class'=>'form-control input-sm',
													'type'=>'text',
													'value'=>'3',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
</fieldset>
<?php echo $this->Form->end();?>
</div>
<?php 
$buttons['Button']['title']=' Aceptar';
$buttons['Button']['nameid']='aceptar';
$buttons['Button']['class'] = 'btn-success';
$buttons['Button']['icons'] = 'glyphicon-save';
?>
<?php echo $this->element('modalboxpie',array('buttons'=>$buttons)); ?>
</div>
