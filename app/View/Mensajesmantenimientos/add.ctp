<div id='formreturn'>
<?php echo $this->element('modalboxcabecera',array('title'=>__('Mensajes de Mantenimiento'),'paneltipo'=>'panel-primary'));?>
<?php	echo $this->Html->script(array('bootstrap-datetimepicker','fmensajes.js','dateformat.js','fgenerales.js','jquery.numeric','mensajesmantenimientos/add.js'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css('bootstrap-datetimepicker', null, array('inline' => false))?>
<?php echo $this->Form->create('Mensajesmantenimiento',array('action'=>'add',	
					'inputDefaults' => array(
						'div' => 'form-group',
						'wrapInput' => false,
						'class' => 'form-control'
						),
				'class' => 'well'));?>
<fieldset>
	<div class="row">	
		<div class="col-lg-3">
					<label><?php echo __('Fecha Envío Mensaje')?></label>
			<div class="form-group">
				<div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
					<?php echo $this->Form->input('Mensajesmantenimiento.fechacontrol',array('label' =>false,
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
		<div class="col-lg-2">
				<?php echo $this->Form->input('Mensajesmantenimiento.enviarcorreo',array('label' =>'Enviar correo',
													'placeholder' => false,
													'class'=>'form-control input-sm',
													'options'=>$str_estadossino,
													'value'=>'1',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-5">
				<?php echo $this->Form->input('Mensajesmantenimiento.objetorevisar',array('label' =>'Componente a Revisar',
													'placeholder' => 'Ingrese Componente a Revisar',
													'class'=>'form-control input-sm',
													'type'=>'text',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>	
	</div>
	<div class="row">
		<div class="col-lg-10">
					<?php echo $this->Form->input('Mensajesmantenimiento.observaciones',array('label' =>'Observaciones',
													'placeholder' => 'Ingrese Observaciones',
													'class'=>'form-control input-sm',
													'type'=>'text',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
</fieldset>
<?php echo $this->Form->end();?>
<?php 
$buttons['Button']['title']=' Aceptar';
$buttons['Button']['nameid']='aceptar';
$buttons['Button']['class'] = 'btn-success';
$buttons['Button']['icons'] = 'glyphicon-save';
?>
<?php echo $this->element('modalboxpie',array('buttons'=>$buttons)); ?>
</div>