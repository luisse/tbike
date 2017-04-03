<?= $this->Html->script(array('/js/taxownerdrivers/edit.js','jquery.maskedinput','moment.min','moment-with-locales.min','bootstrap-datetimepicker','fmensajes.js','fgenerales.js','jquery.numeric','jquery.toastmessage'),array('block'=>'scriptjs'));		?>
<?= $this->Html->css(array('bootstrap-datetimepicker','message'), null, array('inline' => false))?>
<?= $this->element('flash_message')?>
<script>
var msg_people="<?= __('Solo se permiten personas mayores a 18 años')?>"
</script>
<div class="container">
			<div class="row">
					<div class="col-lg-12">
									<div class="panel-body">
										<?= $this->Form->create('Taxownerdriver',array('action'=>'edit',
																										'type'=>'file',
																										'inputDefaults' => array(
																										'div' => 'form-group',
																										'wrapInput' => false,
																										'class' => 'form-control'
																										),
																									'class' => 'well'
													)); ?>
										<?= $this->Form->hidden('Taxownerdriver.id')?>
										<?= $this->Form->hidden('People.id')?>
										<?= $this->Form->hidden('Taxownerdriver.taxowner_id')?>
										<?= $this->Form->hidden('Taxownerdriver.image')?>
										<legend>
											<?php if(!empty($this->request->data['Taxownerdriver']['picture'])):?>
											<img width='80px' height='80px' class="img-circle" src="<?= $this->request->data['Taxownerdriver']['image'];?>?cache=none"/>
											<?php endif;?>
											<?= __('Actualizar Datos de Conductor'); ?>
											<div class="pull-right">
													<div class="btn-group">
														<div class="col-xs-4 col-sm-3 col-md-3">
														    <span class="button-checkbox">
														        <button type="button" class="btn" data-color="primary"><?= __('Activo')?></button>
														        <?= $this->Form->input('Taxownerdriver.state',array('type'=>'checkbox','class'=>'hidden','label'=>false))?>
														    </span>
														</div>
													</div>
											</div>
										</legend>
										<hr style="width: 100%; color: black; height: 1px; background-color:black;">
										<div class="row">
											<div class="col-lg-2">
												<?= $this->Form->input('People.document',array('label' => __('Nro de Documento'),
																										'placeholder' => __('Número de Documento'),
																										'size'=>'3',
																										'tabindex'=>'1',
																										'maxlength'=>8,
																										'type'=>'text',
																										'class'=>'form-control input-sm',
																										'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
											</div>
											<div class="col-lg-2">
												<label><?= __('Fecha de Nacimiento') ?></label>
												<div class="form-group">
													<div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
														<?= $this->Form->input('People.birthdate',array('label'=>false,
																												'placeholder' => __('Fecha de Nacimiento'),
																												'size'=>'7',
																												'tabindex'=>'2',
																												'type'=>'text',
																												'class'=>'form-control input-sm',
																												'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
														<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-2">
												<?= $this->Form->input('People.firstname',array('label'=>__('Apellido'),
																										'placeholder' => __('Ingrese Apellido'),
																										'size'=>'7',
																										'tabindex'=>'3',
																										'class'=>'form-control input-sm',
																										'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
											</div>
											<div class="col-lg-4">
												<?= $this->Form->input('People.secondname',array('label'=>__('Nombres'),
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
													$options = array('0' => __('Femenino'), '1' => 'Masculino');
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
												<?= $this->Form->input('People.phonenumber',array('label'=>__('Telefono'),
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
												<?= $this->Form->input('People.countrie_id',array('label'=>__('País'),
																											'class'=>'form-control input-sm',
																											'tabindex'=>'7',
																											'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
											</div>
											<div class="col-lg-3">
												<?= $this->Form->input('People.province_id',array('label'=>__('Provincia'),
																											'class'=>'form-control input-sm',
																											'tabindex'=>'8',
																											'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
											</div>
											<div class="col-lg-3">
												<?= $this->Form->input('People.department_id',array('label'=>__('Departamento'),
																											'placeholder' => 'Ingrese Departamento',
																											'class'=>'form-control input-sm',
																											'tabindex'=>'9',
																											'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
											</div>
											<div class="col-lg-3">
												<?= $this->Form->input('People.location_id',array('label'=>__('Localidad'),
																											'placeholder' => 'Ingrese Localidad',
																											'class'=>'form-control input-sm',
																											'tabindex'=>'10',
																											'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-4">
												<?= $this->Form->input('People.address',array('label'=>__('Domiclio'),
																										'placeholder' => __('Ingrese Domiclio'),
																										'size'=>'10',
																										'tabindex'=>'11',
																										'class'=>'form-control input-sm',
																										'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
											</div>
											<div class="col-lg-4">
												<?= $this->Form->input('People.number',array('label'=>__('Número'),
																										'placeholder' => __('Ingrese Altura'),
																										'size'=>'10',
																										'tabindex'=>'12',
																										'class'=>'form-control input-sm',
																										'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
											</div>
											<div class="col-lg-1">
												<?= $this->Form->input('People.depto',array('label'=>__('Dpto'),
																											'placeholder' => __('Departamento'),
																											'size'=>'2',
																											'tabindex'=>'13',
																											'class'=>'form-control input-sm',
																											'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
											</div>
											<div class="col-lg-1">
												<?= $this->Form->input('People.piso',array('label'=>__('Piso'),
																											'placeholder' => __('Piso'),
																											'size'=>'2',
																											'tabindex'=>'14',
																											'class'=>'form-control input-sm',
																											'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
											</div>
											<div class="col-lg-1">
												<?= $this->Form->input('People.block',array('label'=>__('Block'),
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
																	echo $this->Form->input('Taxownerdriver.licencenumber',array('label'=>__('Licencia Número'),
																													'placeholder' => __('Licencia Número'),
																													'size'=>'10',
																													'tabindex'=>'16',
																													'type'=>'text',
																													'class'=>'form-control input-sm',
																													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))));
																	?>
											</div>
											<div class="col-lg-3">
												<label><?= __('Fecha de Vencimiento') ?></label>
												<div class="form-group">
													<div class='input-group date' id='datetimepicker2' data-date-format="DD/MM/YYYY">
														<?= $this->Form->input('Taxownerdriver.fecvenclicence',array('label'=>false,
																												'placeholder' => __('Fecha de Vencimiento'),
																												'size'=>'7',
																												'tabindex'=>'2',
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
													<h5><?= __('Cargar Imagen Desde Archivo')?></h5>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-3">
													<?= $this->Form->file('Taxownerdriver.picture',array('label' => false,'tabindex'=>'17'))?>
												</div>
											</div>
											<div class="col-lg-3">
												<?php //echo $this->Form->input('Taxownerdriver.picture',array('type'=>'hidden'))?>
											</div>
											<div class="col-lg-1">
											</div>
											<div class="col-lg-3">
												<div id="getfoto" style="height:200px;width:200px;"></div>
											</div>
										</div>
										<hr style="width: 100%; color: black; height: 1px; background-color:black;">
										<div class="row">
											<div class="col-xs-6 col-sm-6">
												<center>
													<button type="button" class="btn btn-success btn-lw" id='guardar' tabindex='18'>
														<span class="glyphicon glyphicon glyphicon-save"></span> <?= __('Guardar')?>
													</button>
												</center>
												</div>
												<div class="col-xs-6 col-sm-6">
													<center>
														<button type="button" class="btn btn-danger btn-lw" id='cancelar'  tabindex='18'>
															<span class="glyphicon glyphicon glyphicon-off"></span><?= __(' Cancelar')?>
															</button>
															</center>
														</div>
													</div>
												<?= $this->Form->end();?>
										</div>
						</div>
			</div>
</div>
