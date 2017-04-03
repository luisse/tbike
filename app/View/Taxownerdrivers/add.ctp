<?php echo $this->Html->script(array('/js/taxownerdrivers/add.js','jquery.maskedinput','moment.min','moment-with-locales.min','bootstrap-datetimepicker','fmensajes.js','fgenerales.js','jquery.numeric','jquery.toastmessage'),array('block'=>'scriptjs'));		?>
<?php echo $this->Html->css(array('bootstrap-datetimepicker','message'), null, array('inline' => false))?>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="panel-body">
				<?php echo $this->Form->create('Taxownerdriver',array('action'=>'add',
																	'inputDefaults' => array(
																	'div' => 'form-group',
																	'wrapInput' => false,
																	'class' => 'form-control'
																	),
																'autocomplete'=>"off",
																'type'=>'file',
																'class' => 'well')); ?>
				<legend><?= !empty($taxowner_id) ? __('Asociar Taxista a ').$username : __('Nuevo Chofer') ?></legend>
				<hr style="width: 100%; color: black; height: 1px; background-color:black;">
					<div class="row">
						<div class="col-lg-2">
							<?php echo $this->Form->hidden('People.id')?>
							<?php echo $this->Form->input('People.document',array('label' => __('Nro de Documento *'),
																			'placeholder' => __('Número de Documento'),
																			'size'=>'3',
																			'type'=>'text',
																			'tabindex'=>'1',
																			'maxlength'=>8,
																			'class'=>'form-control input-sm',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						</div>
						<div class="col-lg-3">
							<label><?php echo __('Fecha de Nacimiento *') ?></label>
							<div class="form-group">
				            <div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
							<?php echo $this->Form->input('People.birthdate',array('label'=>false,
																			'placeholder' => __('Fecha de Nacimiento'),
																			'size'=>'7',
																			'type'=>'text',
																			'tabindex'=>'2',
																			'class'=>'form-control input-sm',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
			                </span>
							</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-2">
							<?php echo $this->Form->input('People.firstname',array('label'=>__('Apellidos *'),
																				'placeholder' => __('Ingrese Apellido'),
																				'size'=>'7',
																				'tabindex'=>'3',
																				'class'=>'form-control input-sm',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						</div>
						<div class="col-lg-4">
							<?php echo $this->Form->input('People.secondname',array('label'=>__('Nombres *'),
																				'placeholder' => __('Ingrese Nombre'),
																				'size'=>'7',
																				'tabindex'=>'4',
																				'class'=>'form-control input-sm',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-2">
							<?php
								$options = array('0' => __('Femenino'), '1' => 'Masculino *');
								echo $this->Form->input('People.gender',array('label'=>__('Sexo'),
																							'options'=>$options,
																							'value'=>1,
																							'tabindex'=>'5',
																							'class'=>'form-control input-sm',
																							'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-2">
							<?php echo $this->Form->input('People.phonenumber',array('label'=>__('Telefono'),
																					'placeholder' => __('Ingrese Telefono'),
																					'size'=>'2',
																					'type'=>'text',
																					'tabindex'=>'6',
																					'class'=>'form-control input-sm',
																					'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						</div>
					</div>
					<div class="row">
					    <div class="col-lg-3">
							<?php echo $this->Form->input('People.countrie_id',array('label'=>__('País *'),
																				'class'=>'form-control input-sm',
																				'tabindex'=>'7',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						</div>
						<div class="col-lg-3">
							<?php echo $this->Form->input('People.province_id',array('label'=>__('Provincia *'),
																				'class'=>'form-control input-sm',
																				'tabindex'=>'8',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						</div>
						<div class="col-lg-3">
							<?php echo $this->Form->input('People.department_id',array('label'=>__('Departamento *'),
																				'placeholder' => 'Ingrese Departamento',
																				'tabindex'=>'9',
																				'class'=>'form-control input-sm',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						</div>
						<div class="col-lg-3">
							<?php echo $this->Form->input('People.location_id',array('label'=>__('Localidad *'),
																			'placeholder' => 'Ingrese Localidad',
																			'class'=>'form-control input-sm',
																			'tabindex'=>'10',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<?php echo $this->Form->input('People.address',array('label'=>__('Domiclio *'),
																		'placeholder' => __('Ingrese Domiclio'),
																		'size'=>'10',
																		'tabindex'=>'11',
																		'class'=>'form-control input-sm',
																		'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						</div>
						<div class="col-lg-4">
							<?php echo $this->Form->input('People.number',array('label'=>__('Número *'),
																				'placeholder' => __('Ingrese Altura'),
																				'size'=>'10',
																				'tabindex'=>'12',
																				'class'=>'form-control input-sm',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						</div>
						<div class="col-lg-1">
							<?php echo $this->Form->input('People.depto',array('label'=>__('Dpto'),
															'placeholder' => __('Departamento'),
															'size'=>'2',
															'class'=>'form-control input-sm',
															'tabindex'=>'13',
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						</div>
						<div class="col-lg-1">
							<?php echo $this->Form->input('People.piso',array('label'=>__('Piso'),
																		'placeholder' => __('Piso'),
																		'size'=>'2',
																		'tabindex'=>'14',
																		'class'=>'form-control input-sm',
																		'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						</div>
						<div class="col-lg-1">
							<?php echo $this->Form->input('People.block',array('label'=>__('Block'),
																		'placeholder' => __('Block'),
																		'size'=>'2',
																		'tabindex'=>'15',
																		'class'=>'form-control input-sm',
																		'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						</div>
					</div>
					<div class='row'>
						<div class="col-lg-3">
							<?php
							echo $this->Form->input('Taxownerdriver.licencenumber',array('label'=>__('Licencia Número *'),
																						'placeholder' => __('Licencia Número'),
																						'size'=>'10',
																						'type'=>'text',
																						'tabindex'=>'16',
																						'maxlength'=>8,
																						'class'=>'form-control input-sm',
																						'error'=>array('attributes' =>array('class'=>'alert alert-danger'))));
							?>
						</div>
						<div class="col-lg-3">
							<label><?php echo __('Fecha de Vencimiento') ?></label>
								<div class="form-group">
									<div class='input-group date' id='datetimepicker2' data-date-format="DD/MM/YYYY">
											<?php echo $this->Form->input('Taxownerdriver.fecvenclicence',array('label'=>false,
																									'placeholder' => __('Fecha de Vencimiento'),
																									'size'=>'7',
																									'tabindex'=>'17',
																									'type'=>'text',
																									'class'=>'form-control input-sm',
																									'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
									<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
								</div>
							</div>
						</div>

					</div>
					<div class="row">
						<div class="row">
							<div class="col-lg-5">
								<label><?php echo __('Foto del Conductor')?></label>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3">
								<?php echo $this->Form->file('Taxownerdriver.picture',array('label' => false,'tabindex'=>'18'))?>
							</div>
						</div>
						<div class="col-lg-3">
							<div id="getfoto" style="height:200px;width:200px;"></div>
						</div>
					</div>
					<div class="row">
					</div>

					<div class="row" style="<?= $this->Session->read('tipousr') == 1 ? "" : "display:none;"?>">
						<div class="col-xs-4 col-sm-4 col-md-4">
							<label><?php echo __('Vincular a Usuario Actual Conectado') ?></label>
						</div>
						<div class="col-xs-1 col-sm-1 col-md-1">
									<?php echo $this->Form->input('Taxownerdriver.newuser',array('label' => false,'type'=>'checkbox','tabindex'=>'19'))?>
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
