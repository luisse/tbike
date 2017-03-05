<?php echo $this->Html->script(array('/js/mensajes/add.js','fmensajes.js','fgenerales.js','jquery.toastmessage','jquery.maskedinput','bootstrap-datetimepicker','dateformat.js','yellow-text'),array('block'=>'scriptjs')); ?>
<?php echo $this->Html->css(array('message','bootstrap-datetimepicker','yellow-text-blue'), null, array('inline' => false))?>
<?php echo $this->element('flash_message')?>
<?php echo $this->Form->create('Mensaje',array('action'=>'add',	
				'inputDefaults' => array(
							'div' => 'form-group',
							'wrapInput' => false,
							'class' => 'form-control'
							),
				'class' => 'well'));?>
<?php echo $this->Form->hidden('Mensaje.fechaactual') ?>				
			<legend><?php echo __('Nuevo Mensaje') ?></legend>
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
				<div class="col-lg-2">
				<?php echo $this->Form->input('Mensaje.mailauto',array('label' => __('Envió Automático'),
													'options'=>$str_sino,
													'value'=>'1',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
				<div class="col-lg-3">
				<?php echo $this->Form->input('Mensaje.tipomen_id',array('label' => __('Tipo de Mensaje'),
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
			<div class="row">
					<div class="col-lg-1">
						<div class="btn-group">
							<a class="btn btn-app" href="#" id='selcliente'><i class="fa  fa-user"></i> Sel. Cliente</a>
						</div>	
					</div>						
					<div class="col-lg-2">
								<?php echo $this->Form->hidden('Mensaje.userrec_id')?>
								<?php echo $this->Form->input('Mensaje.documento',array('label' => 'Doc Cliente',
															'class'=>'form-control input-sm',
															'type'=>'text',
															'maxlength'=>'10',
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
					</div>											
					<div class="col-lg-3">
					<?php echo $this->Form->input('Mensaje.nomap',array('label' => 'Nombre y Apellido',
						'class'=>'form-control input-sm',
						'type'=>'text',
						'maxlength'=>'10',
						'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
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
				<?php echo $this->Form->input('Mensaje.detalle',array('label' => false,
													'type'=>'textarea',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
<?php echo $this->Form->end();?>
<div class="row">	
	<div class="col-lg-6">
		<center>
		<button type="button" class="btn btn-success btn-lw" id='guardar'>
		  <span class="glyphicon glyphicon glyphicon-save"></span>&nbsp;<?php echo __('Enviar') ?>
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

<?php echo $this->element('modalbox')?>