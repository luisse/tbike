<?php
	echo $this->Html->script(array('/js/bicicletareparamos/bicicletareparamos_add.js','fgenerales','bootstrap-datetimepicker','fmensajes.js','dateformat.js','jquery.maskedinput','jquery.price','jquery.numeric','jquery.toastmessage'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css(array('bootstrap-datetimepicker','message'), null, array('inline' => false))?>

<script>
	var rlink="<?php echo $this->Html->url(array('controller'=>'bicicletas','action'=>'listbiclient')) ?>"
</script>
<?php echo $this->Form->create('Bicicletareparamo',array('action'=>'add',
					'inputDefaults' => array(
						'div' => 'form-group',
						'wrapInput' => false,
						'class' => 'form-control'
						),
				'class' => 'well'
			));?>
<?php echo $this->Form->input('Bicicletareparamo.bicicleta_id',array('type'=>'hidden'))?>
<?php echo $this->Form->input('Bicicletareparamo.cliente_id',array('label'=>false,'type'=>'hidden'))?>
<?php echo $this->Form->input('Bicicletareparamo.user_id',array('label'=>false,'type'=>'hidden'))?>

<fieldset>
	<legend><?php echo __('Nuevo Ingreso')?></legend>
	<div class="row">
		<div class="col-lg-2">
			<label><?php echo __('Fecha de Ingreso')?></label>
			<div class="form-group">
	            <div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
						<?php echo $this->Form->input('Bicicletareparamo.fechaingreso',array('label' =>false,
													'placeholder' => false,
													'class'=>'form-control input-sm',
													'type'=>'text',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
		        </div>
			</div>
		</div>
		<div class="col-lg-2">
			<label><?php echo __('Fecha Egreso')?></label>
		  <div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
						<?php echo $this->Form->input('Bicicletareparamo.fechaegreso',array('label' =>false,
													'placeholder' => false,
													'class'=>'form-control input-sm',
													'type'=>'text',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
		  </div>
		</div>
	</div>
<?= $this->element('addclient',array('MODEL'=>$this->Session->read('LLAMADO_DESDE')))?>	
<div class="row" id='clientselect'>
		<div class="col-lg-2">
			<?php echo $this->Form->input('documento',array('label' => __('Documento'),
													'placeholder' => __('Ingrese Documento'),
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-1">
			<br>
			<button type="button" class="btn btn-success btn-lw" id='buscarcliente' title='Seleccionar Cliente'>
				<span class="glyphicon  glyphicon-search"></span>
			</button>
		</div>
		<div class="col-lg-3" id='nombredetalle'>
			<?php echo $this->Form->input('nomap',array('label' => __('Nombre y Apellido'),
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
</div>

	<div class="row">
		<div class="col-lg-4">
			<?php echo $this->Form->input('Bicicletareparamo.detallereparacion',array('label' => __('Detalle de reparación'),
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-2">
			<?php echo $this->Form->input('Bicicletareparamo.importetotal',array('label' => __('Importe Total'),
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-2">
			<?php echo $this->Form->input('Bicicletareparamo.enviodom',array('label' => __('Envió a Domicilio'),
													'class'=>'form-control input-sm',
													'options'=>$str_estadossino,
													'value'=>'0',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
</div>

		<div class="table-responsive">
			<ul class="nav nav-tabs" id='myTab'>
			  <li class="active"><a href="#tabs-1"   data-toggle="tab"><?php echo __('Seleccion de Bicicleta') ?></a></li>
			  <li><a href="#tabs-2"  data-toggle="tab"><?php echo __('Ingreso de Gastos') ?></a></li>
			</ul>
			<div class="tab-content">
				 <div class="tab-pane active" id="tabs-1">
					<div class="panel panel-default">
						<div class = "row" id='btnuevobici'>
							<div class='col-lg-3' style="padding-top: 5px;padding-bottom: 5px;padding-left: 20px;">
							<button type="button" class="btn btn-primary btn-lw" title="Nueva Bicicleta" id='agregarbicicleta'>
								<span class="glyphicon  glyphicon-plus"></span><?= __('Nueva Bicicleta') ?>
							</button>
							</div>
						</div>
						<!-- ALTA DE BICICLETA -->
						<div id='addbicicleta' style="display:none;">
						<div class="well">
							<legend><?= __('Alta Nueva Bicicleta')?></legend>
							<div class="row">
								<div class="col-lg-3">
											<?= $this->Form->input('marca',array('label' => 'Marca *',
																			'placeholder' => 'Ingrese Marca',
																			'class'=>'form-control input-sm',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
								</div>
								<div class="col-lg-3">
											<?= $this->Form->input('modelo',array('label' => 'Modelo *',
																			'placeholder' => 'Ingrese Modelo',
																			'class'=>'form-control input-sm',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<?= $this->Form->input('detalles',array('label' => 'Detalles',
																			'placeholder' => 'Ingrese detalles',
																			'class'=>'form-control input-sm',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<?= $this->Form->input('equipodetalle',array('label' => 'Equipamiento',
																			'placeholder' => 'Ingrese Equipamiento',
																			'class'=>'form-control input-sm',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3">
									<?= $this->Form->input('nrocuadro',array('label' => 'Nro de Cuadro',
																			'placeholder' => 'Ingrese Nro de Cuadro',
																			'class'=>'form-control input-sm',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
								</div>
							</div>
							<div class="row">
								<div class='col-lg-2'>
									<button type="button" class="btn btn-success btn-lw" title="<?= __('Guardar Bicicleta')?>" id='guardarbicicleta'>
										<span class="glyphicon  glyphicon-floppy-save"></span>&nbsp;<?= __('Guardar Bicicleta') ?>
									</button>
								</div>
							</div>
						</div>
						</div>
						<div id='biciclient' style="padding-top: 5px;padding-bottom: 5px;padding-left: 10px;padding-right: 10px"></div>
					</div>
				</div>
				<div id="tabs-2" class="tab-pane">
				<div class="panel panel-default">
						<button type="button" class="btn btn-primary btn-lw" title="Agregar Fila" id='agregarfila'  style="padding-top: 5px;padding-bottom: 5px;padding-left: 10px;padding-right: 10px;margin-top: 5px;margin-left: 5px;">
							<span class="glyphicon  glyphicon-plus"></span>
						</button>
						<div class="table-responsive">
							<table id="bicicletareparamorepuesto" width='70%' class="table table-striped table-bordered table-hover dataTable no-footer table-condensed" aria-describedby="dataTables-example_info">
								<thead>
									<tr>
										<th width='80px'></th>
										<th><?php echo __('Detalle de Gasto');?></th>
										<th width='90px'><?php echo __('Cantidad');?></th>
										<th width='90px'><?php echo __('Precio');?></th>
										<th><?php __('Acciones');?></th>
									</tr>
								</thead>
								<tbody>
											<?php
											for($i=0;$i<=5;$i++):
											?>
											<tr id='bicicletareparamorepuesto_<?php echo $i?>'>
												<td>
													<button type="button" class="btn btn-success btn-xs" onclick="buscarproductosmodal(<?php echo $i?>)" id='buscarproductos' title='Buscar Productos'>
														<span class="glyphicon  glyphicon-search"></span>
													</button>
												</td>
												<td>
													<?php echo $this->Form->input('Bicicletareparamorepuesto.'.$i.'.repuestodescr',array(
														'class'=>'form-control input-sm',
														'label'=>false,
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
												</td>
												<td>
														<?php echo $this->Form->input('Bicicletareparamorepuesto.'.$i.'.cantidad',array(
														'class'=>'form-control input-sm clcantidad',
														'label'=>false,
														'maxlength'=>'3',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
													<?php echo $this->Form->hidden('Bicicletareparamorepuesto.'.$i.'.aceptado',array('value'=>'1'))?>
												</td>
												<td>
													<?php echo $this->Form->input('Bicicletareparamorepuesto.'.$i.'.precio',array(
														'class'=>'form-control input-sm clprecio',
														'label'=>false,
														'type'=>'text',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>

												</td>
												<td class="actions">
														<button type="button" class="btn btn-danger btn-lw" title="Borrar Fila" onclick="eliminarFila(<?php echo $i ?>)">
																		<span class="glyphicon  glyphicon-remove-circle"></span>
														</button>
												</td>
											</tr>
										<?php endfor; ?>
										</tbody>
										</table>
									</div>
								</div>
							</div>
				</div>
			</div>
</fieldset>
<div class="row">
	<div class="col-xs-6 col-sm-6">
		<center>
		<button type="button" class="btn btn-success btn-lw" id='guardar'>
		  <span class="glyphicon glyphicon glyphicon-save"></span> <?php echo __(' Guardar')?>
		</button>
		</center>
	</div>
	<div class="col-xs-6 col-sm-6">
		<center>
		<button type="button" class="btn btn-danger btn-lw" id='cancelar'>
		  <span class="glyphicon glyphicon glyphicon-off"></span><?php echo __(' Cancelar')?>
		</button>
		</center>
	</div>
</div>
<?php echo $this->Form->end();?>
<?php echo $this->element('modalbox')?>
<?php echo $this->element('mensajealerta',array('title'=>__('Nuevo ingreso'),'buttondesc'=>' Cerrar'))?>
