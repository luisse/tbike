<?php echo $this->Html->script(array('/js/bicicletareparamos/bicicletareparamos_edit.js','fgenerales','bootstrap-datetimepicker','fmensajes.js','dateformat.js','jquery.maskedinput','jquery.price','jquery.numeric','jquery.toastmessage'),array('block'=>'scriptjs')); ?>
<?php echo $this->Html->css(array('bootstrap-datetimepicker','message'), null, array('inline' => false))?>
<script>
	var rlink="<?php echo $this->Html->url(array('controller'=>'bicicletas','action'=>'listbiclient')) ?>"
	var oId =<?php echo count($this->request->data['Bicicletareparamorepuesto']); ?>
</script>
			
<?php echo $this->Form->create('Bicicletareparamo',array('action'=>'edit',	
					'inputDefaults' => array(
						'div' => 'form-group',
						'wrapInput' => false,
						'class' => 'form-control'
						),
				'class' => 'well'
			));?>
<?php echo $this->Form->hidden('Bicicletareparamo.id')?>
<?php echo $this->Form->hidden('Bicicletareparamo.bicicleta_id')?>
<?php echo $this->Form->hidden('Bicicletareparamo.cliente_id')?>
<fieldset>
	<legend>Actualizar datos de Ingreso</legend>
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
	<div class="row">	
		<div class="col-lg-2">
			<?php echo $this->Form->input('Bicicletareparamo.documento',array('label' => 'Documento',
													'placeholder' => 'Ingrese Documento',
													'class'=>'form-control input-sm',
													'type'=>'text',
													'value'=>$this->data['Cliente']['documento'],
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-3">
			<?php echo $this->Form->input('nomap',array('label' => 'Nombre y Apellido',
													'class'=>'form-control input-sm',
													'value'=>$this->data['Cliente']['nomape'],
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>

	
	<div class="row">	
		<div class="col-lg-4">
			<?php echo $this->Form->input('Bicicletareparamo.detallereparacion',array('label' => 'Detalle de reparación',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-1">
			<?php //echo $this->Form->input('Bicicletareparamo.descuento',array('label' => 'Descuento',
					//								'class'=>'form-control input-sm',
					//								'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-2">
			<?php echo $this->Form->input('Bicicletareparamo.importetotal',array('label' => 'Importe Total',
													'class'=>'form-control input-sm',
													'type'=>'text',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-2">
			<?php echo $this->Form->input('Bicicletareparamo.enviodom',array('label' => __('Envió a Domicilio'),
													'class'=>'form-control input-sm',
													'options'=>$str_estadossino,
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
			<div id='biciclient'></div>
		</div>
	</div>
	<div id="tabs-2" class="tab-pane">
	<div class="panel panel-default">
		<button type="button" class="btn btn-primary btn-lw" title="Agregar Fila" id='agregarfila'>
			<span class="glyphicon  glyphicon-plus"></span>
		</button>						
		<?php	
			$totalrows = count($this->request->data['Bicicletareparamorepuesto']);
			echo $this->Form->hidden('Bicicletareparamo.totalrows',array('value'=>$totalrows + 2));
		?>
		<table id="bicicletareparamorepuesto" class="table table-striped table-bordered table-hover dataTable no-footer" aria-describedby="dataTables-example_info">		
		<thead>
			<tr>
				<th></th>
				<th><?php echo __('Detalle de Gasto');?></th>
				<th><?php echo __('Cantidad');?></th>
				<th><?php echo __('Precio');?></th>
				<th><?php __('Acciones');?></th>
			</tr>
		</thead>
		<tbody>
			<?php
				for($i=0;$i<=$totalrows;$i++):
				?>
					<tr id='bicicletareparamorepuesto_<?php echo $i?>'>
						<td>
							<button type="button" class="btn btn-success btn-xs" onclick="buscarproductosmodal(<?php echo $i?>)" id='buscarproductos' title='Buscar Productos'>
							<span class="glyphicon  glyphicon-search"></span>
							</button>	
						</td>
						<td>
							<div class="col-lg-11">
							<?php echo $this->Form->input('Bicicletareparamorepuesto.'.$i.'.repuestodescr',array(
													'class'=>'form-control input-sm',
													'label'=>false,
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
							</div>
						</td>
						<td>
							<div class="col-lg-5">
							<?php echo $this->Form->input('Bicicletareparamorepuesto.'.$i.'.cantidad',array(
													'class'=>'form-control input-sm clcantidad',
													'label'=>false,													
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
							</div>
						<?php echo $this->Form->hidden('Bicicletareparamorepuesto.'.$i.'.aceptado',array('value'=>'1'))?>
						<?php echo $this->Form->hidden('Bicicletareparamorepuesto.'.$i.'.id')?>
						<?php echo $this->Form->hidden('Bicicletareparamorepuesto.'.$i.'.bicicletareparamo_id')?>
						</td>
						<td>
							<div class="col-lg-5">						
							<?php echo $this->Form->input('Bicicletareparamorepuesto.'.$i.'.precio',array(
													'class'=>'form-control input-sm clprecio',
													'label'=>false,
													'type'=>'text',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
							</div>
						</td>
						<td class="actions">
							<button type="button" class="btn btn-danger btn-lw" title="Borrar Fila" onclick="BorrarProductosAsoc(<?php echo $i ?>)">
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
</fieldset>
<div class="row">	
	<div class="col-xs-6 col-sm-6">
		<center>
		<button type="button" class="btn btn-success btn-lw" id='guardar'>
		  <span class="glyphicon glyphicon glyphicon-save"></span> Guardar
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
<?php echo $this->element('mensajealerta',array('title'=>__('Editar Ingreso'),'buttondesc'=>' Cerrar'))?>	
