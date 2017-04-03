<?php echo $this->Html->script(array('/js/radiotaxicars/add.js','moment.min','moment-with-locales.min','bootstrap-datetimepicker','fmensajes.js','fgenerales.js','jquery.numeric','jquery.toastmessage'),array('block'=>'scriptjs'));		?>
<?php echo $this->Html->css(array('bootstrap-datetimepicker','message'), null, array('inline' => false))?>
<!-- SCRIPT FOR ERROR -->
<script>
	var error_car_exist="<?php echo __('El auto ya se encuentra asignado. Verifique los datos si el problema persiste contactenos.') ?>"
</script>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="panel-body">
				<?php
				echo $this->Form->create('Radiotaxicar',array('action'=>'add',
						'type'=>'file',
						'inputDefaults' => array(
								'div' => 'form-group',
								'wrapInput' => false,
								'class' => 'form-control'
						),
						'class' => 'well'));
						echo $this->Form->input('Radiotaxicar.taxownerscar_id',array('type'=>'hidden'));
						?>

				<legend>
					<?php echo $this->Html->image('TaxiAppLogo.png',
						array ( 'title' =>__('Imagen de '.$this->Session->read('nomape')),'class'=>'img-circle','width'=>'80px','height'=>'80px'));?>
					<?php echo __('Asociar Auto'); ?>
				</legend>
				<hr style="width: 100%; color: black; height: 1px; background-color:black;">
				<div class="row">
					<div class="col-lg-2">
						<?php echo $this->Form->input('Taxownerscar.registerpermision',array('label' => __('Licencia Nro *'),
																			'placeholder' => __('Número de Licencia'),
																			'size'=>'3',
																			'type'=>'text',
																			'maxlength'=>8,
																			'tabindex'=>'2',
																			'class'=>'form-control input-sm',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger'))));?>
					</div>
					<div class="col-lg-2">
						<?php echo $this->Form->input('Taxownerscar.carcode',array('label' => __('Patente *'),
																			'placeholder' => __('Número de Patente'),
																			'size'=>'3',
																			'type'=>'text',
																			'tabindex'=>'1',
																			'class'=>'form-control input-sm',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger'))));?>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-3">
							<label><?php echo __('Fecha Inicio Actividad *') ?></label>
							<div class="form-group">
				            <div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
								<?php echo $this->Form->input('Taxownerscar.dateactive',array('label'=>false,
																				'placeholder' => __('Fecha Inicio de Actividad'),
																				'size'=>'7',
																				'type'=>'text',
																				'tabindex'=>'4',
																				'class'=>'form-control input-sm',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
				                </span>
								</div>
							</div>
					</div>
					<div class="col-lg-2">
							<label><?php echo __('Fecha Vencimiento') ?></label>
							<div class="form-group">
					            <div class='input-group date' id='datetimepicker2' data-date-format="DD/MM/YYYY">
									<?php echo $this->Form->input('Taxownerscar.dateexpire',array('label'=>false,
																				'placeholder' => __('Fecha de Vencimiento'),
																				'size'=>'7',
																				'type'=>'text',
																				'tabindex'=>'5',
																				'class'=>'form-control input-sm',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
				                </span>
								</div>
							</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-10">
						<?php echo $this->Form->input('Taxownerscar.descriptioncar',array('label' => __('Detalle del Automovil *'),
																			'placeholder' => __('Descripción del Auto'),
																			''=>'3',
																			'type'=>'textarea',
																			'tabindex'=>'6',
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
