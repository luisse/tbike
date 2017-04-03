<?php echo $this->Html->script(array('/js/contacts/add.js','fgenerales.js','jquery.numeric','jquery.toastmessage'),array('block'=>'scriptjs'));		?>
<?php echo $this->Html->css(array('message'), null, array('inline' => false))?>
<!-- SCRIPT FOR ERROR -->
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="panel-body">
				<?php
				echo $this->Form->create('Contact',array('action'=>'contact',
						'inputDefaults' => array(
								'div' => 'form-group',
								'wrapInput' => false,
								'class' => 'form-control'
						),
						'class' => 'well'));?>

				<legend>
					<?php echo $this->Html->image('TaxiAppLogo.png',
						array ( 'title' =>'Contacto','class'=>'img-circle','width'=>'80px','height'=>'80px'));?>
					<?php echo __('Gracias por contactarnos. Deje su consulta u dudas.'); ?>
				</legend>
				<hr style="width: 100%; color: black; height: 1px; background-color:black;">
				<div class="row">
					<div class="col-lg-3">
						<?php echo $this->Form->input('Contact.name',array('label' => __('Nombre'),
																			'placeholder' => __('Ingresa tu Nombre'),
																			'size'=>'40',
																			'type'=>'text',
																			'maxlength'=>50,
																			'tabindex'=>'1',
																			'value'=>$nomape,
																			'class'=>'form-control input-sm',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger'))));?>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-5">
						<?php echo $this->Form->input('Contact.email',array('label' => __('E-Mail'),
																			'placeholder' => __('Ingresa Correo electrónico'),
																			'size'=>'3',
																			'type'=>'text',
																			'maxlength'=>100,
																			'tabindex'=>'2',
																			'value'=>$email,
																			'class'=>'form-control input-sm',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger'))));?>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-8">
						<?php echo $this->Form->input('Contact.message',array('label' => __('Mensaje'),
																			'placeholder' => __('Ingresa mensaje'),
																			//'size'=>'3',
																			'type'=>'textarea',
																			'tabindex'=>'6',
																			'tabindex'=>'3',
																			'class'=>'form-control input-sm',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger')))); ?>
					</div>
				</div>
				<hr style="width: 100%; color: black; height: 1px; background-color:black;">
				<div class="row">
					<div class="col-xs-6 col-sm-6">
						<center>
							<button type="button" class="btn btn-success btn-lw" id='guardar'>
							<span class="glyphicon glyphicon glyphicon-save"></span>&nbsp;<?php echo __('Guardar')?>
							</button>
						</center>
					</div>
					<div class="col-xs-6 col-sm-6">
						<center>
						<button type="button" class="btn btn-danger btn-lw" id='cancelar'>
							<span class="glyphicon glyphicon glyphicon-off"></span>&nbsp;<?php echo __('Cancelar')?>
						</button>
						</center>
					</div>
				</div>
				<?php echo $this->Form->end();?>
			</div>
		</div>
	</div>
</div>
<?php echo $this->element('flash_message')?>
