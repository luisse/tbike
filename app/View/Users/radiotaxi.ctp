<?php echo $this->Html->script(array('/js/users/radiotaxi.js','jquery.maskedinput','moment.min','moment-with-locales.min','bootstrap-datetimepicker','fmensajes.js','fgenerales.js','jquery.numeric','jquery.toastmessage'),array('block'=>'scriptjs'));		?>
<?php echo $this->Html->css(array('bootstrap-datetimepicker','message'), null, array('inline' => false))?>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="panel-body">
				<?php echo $this->Form->create('User',array('action'=>'radiotaxi',
																	'inputDefaults' => array(
																	'div' => 'form-group',
																	'wrapInput' => false,
																	'class' => 'form-control'
																	),
																'autocomplete'=>"off",
																'class' => 'well')); ?>
				<legend><?php echo __('Nuevo Radio Taxi'); ?></legend>
				<hr style="width: 100%; color: black; height: 1px; background-color:black;">
					<div class="row">
						<div class="col-lg-2">
							<?php echo $this->Form->hidden('Radiotaxi.id')?>
							<?php echo $this->Form->input('Radiotaxi.cuit',array('label' => __('CUIT *'),
																			'placeholder' => __('Número de CUIT'),
																			'size'=>'3',
																			'type'=>'text',
																			'tabindex'=>'1',
																			'maxlength'=>11,
																			'class'=>'form-control input-sm',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						</div>
						<div class="col-lg-3">
							<?php echo $this->Form->input('Radiotaxi.name',array('label'=>__('Razon Social *'),
																			'placeholder' => __('Razon Social'),
																			'size'=>'20',
																			'type'=>'text',
																			'tabindex'=>'2',
																			'class'=>'form-control input-sm',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>

							</div>
					</div>
					<div class="row">
						<div class="col-lg-2">
							<?php echo $this->Form->input('Radiotaxi.telefono',array('label'=>__('Telefono *'),
																				'placeholder' => __('Telefono'),
																				'size'=>'12',
																				'tabindex'=>'3',
																				'class'=>'form-control input-sm',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						</div>
						<div class="col-lg-4">
							<?php echo $this->Form->input('Radiotaxi.domicilio',array('label'=>__('Domicilio *'),
																				'placeholder' => __('Ingrese Domicilio'),
																				'size'=>'20',
																				'tabindex'=>'4',
																				'class'=>'form-control input-sm',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						</div>
					</div>
					<div id='users'>
							<div class="row">
								<div class="col-lg-3">
											<?php echo $this->Form->input('User.username',array('label'=>__('Nombre de Usuario'),
																			'placeholder' => __('Ingrese Usuario'),
																			'class'=>'form-control input-sm',
																			'tabindex'=>'20',
																			'value'=>'',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
								</div>
								<div class="col-lg-3">
											<?php echo $this->Form->input('User.email',array('label'=>__('Correo Electrónico'),
																			'class'=>'form-control input-sm',
																			'type'=>'text',
																			'tabindex'=>'21',
																			'autocomplete'=>'false',
																			'value'=>'',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3">
										<?php echo $this->Form->input('User.password',array('label'=>__('Contraseña'),
																			'class'=>'form-control input-sm',
																			'tabindex'=>'22',
																			'value'=>'',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3">
											<?php echo $this->Form->input('User.password_repit',array('label'=>__('Repetir Contraseña'),
																			'class'=>'form-control input-sm',
																			'type'=>'password',
																			'tabindex'=>'23',
																			'value'=>'',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
								</div>
							</div>
					</div>
				<hr style="width: 100%; color: black; height: 1px; background-color:black;">
				<div class="row">
					<div class="col-xs-6 col-sm-6">
						<center>
							<button type="button" class="btn btn-success btn-lw" id='guardar' tabindex='23'>
							  <span class="glyphicon glyphicon glyphicon-save"></span> <?php echo __('Guardar')?>
							</button>
						</center>
					</div>
					<div class="col-xs-6 col-sm-6">
						<center>
						<button type="button" class="btn btn-danger btn-lw" id='cancelar' tabindex='24'>
							<span class="glyphicon glyphicon glyphicon-off"></span><?php echo __(' Cancelar')?>
						</button>
						</center>
					</div>
					</div>
					<?php echo $this->Form->end();?>
				</div>
			</div>
		</div>
</div>
