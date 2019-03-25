<?= $this->Html->script(array('/js/alquileres/edit.js','fmensajes.js','fgenerales.js','dateformat','jquery.toastmessage','bootstrap-datetimepicker','jquery.price','jquery.numeric','jquery.maskedinput'),array('block'=>'scriptjs')); ?>
<?= $this->Html->css(array('message','dootstrap.docs'), null, array('inline' => false))?>
<?= $this->element('flash_message')?>

<?= $this->Form->create('Alquilere',array('url'=>array('action'=>'edit'),
				'inputDefaults' => array(
							'div' => 'form-group',
							'wrapInput' => false,
							'class' => 'form-control'
							),
				'class' => 'well'));?>
<?= $this->Form->hidden('Alquilere.id')?>
	<legend><?= __('Actualizar datos de Alquiler') ?></legend>

			<div class="row">
				<div class="col-lg-2">
					<label><?= __('Fecha de Alquiler')?></label>
					<div class="form-group">
						<div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
							<?= $this->Form->input('Alquilere.fecha',array('label' =>false,
															'placeholder' => false,
															'class'=>'form-control input-sm',
															'type'=>'text',
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-2">
						<?= $this->Form->hidden('Sale.cliente_id',array('type'=>'text'));?>
						<?= $this->Form->input('Sale.clientedoc',array('label' => 'Documento',
								'class'=>'form-control input-sm',
								'type'=>'text',
								'value'=>$this->request->data['Cliente']['documento'],
								'maxlength'=>'10',
								'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
				<div class="col-lg-3">
						<?= $this->Form->input('Sale.nomap',array('label' => 'Nombre y Apellido',
						'class'=>'form-control input-sm',
						'type'=>'text',
						'maxlength'=>'10',
						'value'=>$this->request->data['Cliente']['apellido'].', '.$this->request->data['Cliente']['nombre'],
						'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
				<div class="col-lg-2">
						<?= $this->Form->input('Sale.credito',array('label' => 'Credito',
						'class'=>'form-control input-sm',
						'type'=>'text',
						'maxlength'=>'10',
						'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-5">
				<?= $this->Form->input('Alquilere.detalle',array('label' => __('Detalle'),
													'placeholder'=>'Ingrese Detalle',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
				<div class="col-lg-3">
				</div>
				<div class="col-lg-1">
					<div class="btn-group">
						<a class="btn btn-app" href="#" id='guardar'><i class="fa  fa-check"></i><?= __('Confirmar')?></a>
					</div>
				</div>
				<div class="col-lg-1">
						<div class="btn-group">
							<a class="btn btn-app" href="#" id='cancelar'><i class="fa  fa-times-circle"></i><?= __('Cancelar')?></a>
						</div>
				</div>
		</div>
<!-- TABLA DE DETALLE -->
<div class="table-responsive">
			<ul class="nav nav-tabs" id='myTab'>
			  <li class="active"><a href="#tabs-1"   data-toggle="tab"><?= __('Detalles de Alquiler') ?></a></li>
			</ul>
<div class="tab-content">
			<div class="tab-pane active"  id="tabs-1">
			</br>
			<button type="button" class="btn btn-primary btn-lw" title="Agregar Fila" id='agregarfila'>
				<span class="glyphicon  glyphicon-plus"></span>&nbsp;<?= __('Agregar Fila')?>
			</button>
			</br>
			</br>
			<table cellspacing="1" width='80%'  class="table table-striped table-bordered table-hover dataTable no-footer" aria-describedby="dataTables-example_info" id = "salesdetails">
			<thead>
				<tr>
						<th width='80px'><?= __('Id');?></th>
						<th  width='120px'><?= __('Horas Alquila')?></th>
						<th><?= __('Detalle');?></th>
						<th  width='90px'><?= __('Precio');?></th>
						<th  width='50px'><?= __('Cantidad');?></th>
						<th width='90px'> <?= __('Sub Total');?></th>
						<th width='90px'><?= __('Funcion');?></th>
				</tr>
			</thead>
			<tbody>
				<?php
					$alquileredetalles=$this->request->data['Alquileredetalle'];
					$i=0;
					foreach($alquileredetalles as $alquileredetalle):?>
					<?= "<tr id='alquileredetalles_".$i."' >"?>

						<td>
							<?= $this->Form->hidden('Alquileredetalle.'.$i.'id',array('value'=>$alquileredetalle['id']))?>
							<?= $this->Form->input('Alquileredetalle.'.$i.'.bicicletasparaalquilere_id',array('label' => false	,
																'class'=>'form-control input-sm id',
																'type'=>'text',
																'onchange'=>'recuperarDatosBicicleta('.$i.',"id")',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
						<td><?= $this->Form->input('Alquileredetalle.'.$i.'.horasalquila',array('label' => false,
																'class'=>'form-control input-sm tiempoalquila',
																'type'=>'text',
																'maxlength'=>'80',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						<td><?= $this->Form->input('Alquileredetalle.'.$i.'.detalle',array('label' => false	,
																'class'=>'form-control input-sm detail',
																'type'=>'text',
																'maxlength'=>'100',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
						<td><?= $this->Form->input('Alquileredetalle.'.$i.'.precio',array('label' => false	,
																'class'=>'form-control input-sm clprecio',
																'type'=>'text',
																'value'=>$alquileredetalle['subtotal']/$alquileredetalle['cantidad'],
																'maxlength'=>'12',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
						<td><?= $this->Form->input('Alquileredetalle.'.$i.'.cantidad',array('label' => false	,
																'class'=>'form-control input-sm cantidad',
																'type'=>'text',
																'maxlength'=>'5',
																'onchange'=>'recalcularcantidad('.$i.')',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
						<td><?= $this->Form->input('Alquileredetalle.'.$i.'.subtotal',array('label' => false	,
																'class'=>'form-control input-sm precio',
																'type'=>'text',
																'maxlength'=>'5',
																'onchange'=>'recalcularcantidad('.$i.')',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						</td>
						<td>
							<button type="button" class="btn btn-danger btn-lw" title="Borrar Fila" onclick="eliminarFila(<?= $i ?>)">
								<span class="glyphicon  glyphicon-remove-circle"></span>
							</button>
						</td>
				</tr>
				<?php
					$i++;
					 endforeach;?>
			</tbody>
			<tfoot>
				<tr class="success">
					<td colspan="4">
					<h4><strong><?= __('Total en Venta') ?></strong></h4>
					</td>
					<td colspan="2">
						<?= $this->Form->input('Alquilere.total',array('label'=>false,'class'=>'inputboxl subtotal','size'=>'10','type'=>'text')) ?>
					</td>
				</tr>
			</tfoot>
			</table>
			<script>
				var oId = <?= $i?>
			</script>
		</div>
	</div>
</div>
<?= $this->Form->end();?>
<?= $this->element('modalbox')?>
