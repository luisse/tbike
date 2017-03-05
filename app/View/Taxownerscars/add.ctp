<?php echo $this->Html->script(array('/js/taxownerscars/add.js','moment.min','moment-with-locales.min','bootstrap-datetimepicker','fmensajes.js','fgenerales.js','jquery.numeric','jquery.toastmessage'),array('block'=>'scriptjs'));		?>
<?php echo $this->Html->css(array('bootstrap-datetimepicker','message'), null, array('inline' => false))?>
<!-- SCRIPT FOR ERROR -->
<script>
	var error_car_exist="<?php echo __('El auto ya se encuentra asignado. Verifique los datos si el problema persiste contactenos.') ?>"
	var error_licence_exist="<?php echo __('La Licencia Ingresada Existe en Nuestra Base de Datos. Tiene una habilitación provisoria para operar con nuestro software') ?>"
</script>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="panel-body">
				<?php
				echo $this->Form->create('Taxownerscar',array('action'=>'add',
						'type'=>'file',
						'inputDefaults' => array(
								'div' => 'form-group',
								'wrapInput' => false,
								'class' => 'form-control'
						),
						'class' => 'well'));?>

				<legend>
					<?php echo $this->Html->image('TaxiAppLogo.png',
						array ( 'title' =>__('Imagen de '.$this->Session->read('nomape')),'class'=>'img-circle','width'=>'80px','height'=>'80px'));?>

					<?php echo __('Alta de Nuevo Auto'); ?>
				</legend>
				<hr style="width: 100%; color: black; height: 1px; background-color:black;">
				<div class="row">
					<div class="col-lg-2">
						<?php echo $this->Form->input('Taxownerscar.carcode',array('label' => __('Patente *'),
																			'placeholder' => __('Número de Patente'),
																			'size'=>'3',
																			'type'=>'text',
																			'tabindex'=>'1',
																			'class'=>'form-control input-sm',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger'))));?>
					</div>
					<div class="col-lg-4">
						<?php
						echo $this->Form->input('Taxownerscar.registerpermisionorigin',array('label'=>__('*Origen de Licencia del Automovil'),
																	'options'=>$registerpermisionorigin,
																	'tabindex'=>'11',
																	'class'=>'form-control input-sm',
																	'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
					</div>
					<div class="col-lg-2">
						<?php echo $this->Form->input('Taxownerscar.registerpermision',array('label' => __('Registro Nro *'),
																			'placeholder' => __('Número de Registro'),
																			'size'=>'3',
																			'type'=>'text',
																			'maxlength'=>8,
																			'tabindex'=>'2',
																			'class'=>'form-control input-sm',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger'))));?>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-2">
						<?php echo $this->Form->input('Taxownerscar.decreenro',array('label' => __('Nro de Decreto *'),
																			'placeholder' => __('Número de Drecreto'),
																			'size'=>'3',
																			'type'=>'text',
																			'tabindex'=>'3',
																			'class'=>'form-control input-sm',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger')))); ?>
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
				<div class='col-lg-5'>
						<?php echo $this->Form->input('Taxownerscar.picture',array('label'=>__('Foto del Automovil *'),
																'placeholder' => __('Seleccione un Archivo'),
																'class'=>'form-control input-sm',
																'type'=>'file',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>

				</div>
			</div>
				<!-- <div class="row">
					<div class="col-lg-10">
						<?php echo $this->Form->input('Taxownerscar.descriptioncar',array('label' => __('Detalle del Automovil *'),
																			'placeholder' => __('Descripción del Auto'),
																			''=>'3',
																			'type'=>'textarea',
																			'tabindex'=>'6',
																			'class'=>'form-control input-sm',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger')))); ?>
					</div>
				</div> -->
				<div class='row'>
	        <div class="col-lg-3">
	              <?php echo $this->Form->input('Taxownerscar.carbrand_id',array('label'=>__('Marca'),
	                                'class'=>'form-control input-lg',
	                                'onchange'=>"cargardropdown('TaxownerscarCarbrandId','/carmodels/getmodels/','TaxownerscarCarmodelId');",
	                                'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
	        </div>
	        <div class="col-lg-3">
	              <?php echo $this->Form->input('Taxownerscar.carmodel_id',array('label'=>__('Modelo'),
	                                'class'=>'form-control input-lg',
	                                'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
	        </div>
	        <div class="col-lg-3">
	              <?php echo $this->Form->input('Taxownerscar.type',array('label'=>__('Tipo'),
	                                'class'=>'form-control input-lg',
	                                'options'=>['Sedan'=>'Sedan','Coupe'=>'Coupe','Van'=>'Van'],
	                                'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
	        </div>
	      </div>
	      <div class="row">
	        <div class="col-lg-3">
	              <?php echo $this->Form->input('Taxownerscar.aa',array('label'=>__('Aire Acondicionado'),
	                                'class'=>'form-control input-lg',
	                                'options'=>['Si'=>'Si','No'=>'No'],
	                                'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
	        </div>
	        <div class="col-lg-3">
	              <?php echo $this->Form->input('Taxownerscar.transporta',array('label'=>__('Lleva objetos'),
	                                'class'=>'form-control input-lg',
	                                'options'=>['Si'=>'Si','No'=>'No'],
	                                'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
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
