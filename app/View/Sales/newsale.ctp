<?php 	echo $this->Html->script(array('fmensajes','fgenerales','dateformat','jquery.toastmessage','bootstrap-datetimepicker','jquery.price','jquery.numeric','/js/sales/newsale.js'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css(array('message','dootstrap.docs'), null, array('inline' => false))?>
<?php echo $this->element('flash_message')?>
<script>
	var link = "<?php echo $this->Html->url(array('controller'=>'products','action'=>'listadoproductovta'))?>"
</script>
<?php echo $this->Form->create('Sale',array('action'=>'newsale',
					'inputDefaults' => array(
						'div' => 'form-group',
						'wrapInput' => false,
						'class' => 'form-control'
						),
				'class' => 'well'
			));?>
<!-- TABLA DE CABECERA -->
<legend><?php echo __('Nueva Venta')?></legend>
	<div class="row">
		<div class="col-lg-2">
			<label><?php echo __('Fecha de Ingreso')?></label>
			<div class="form-group">
	            <div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
					<?php echo $this->Form->input('Sale.fecha',array('label' =>false,
													'placeholder' => false,
													'class'=>'form-control input-sm',
													'type'=>'text',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
		        </div>
			</div>
		</div>
		<div class="col-lg-2">
			<?php echo $this->Form->input('Sale.nrofactura',array('label' => __('Nro Factura'),
													'placeholder' => __('Nro Factura'),
													'class'=>'form-control input-sm',
													'value'=>$nrofactura,
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
		</div>
		<div class="col-lg-3">
		<?php
			echo $this->Form->input('Sale.tipofactura',array('label' => __('Tipo de Venta'),
													'class'=>'form-control input-sm',
													'options'=>$str_tipofactura,
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))));
		?>
		</div>
		<div class='row'>
			<div class="col-lg-1">
				<div class="btn-group">
					<a class="btn btn-app" href="#" id='aceptarventa'><i class="fa  fa-check"></i><?php echo __('Confirmar')?></a>
				</div>
			</div>
			<div class="col-lg-1">
				<div class="btn-group">
					<a class="btn btn-app" href="#" id='cancelarventa'><i class="fa  fa-times-circle"></i><?php echo __('Cancelar')?></a>
				</div>
			</div>
		</div>
	</div>
	<div class='row'>
		<div class="col-lg-12">
			<?= $this->element('addclient',array('MODEL'=>$this->Session->read('LLAMADO_DESDE')))?>
		</div>
	</div>
	<br>
	<div class="row" id='selcliente'>
		<div class="col-lg-1">
		<div class="btn-group">
			<a class="btn btn-app" href="#" id='selcliente'><i class="fa  fa-user"></i><?php echo __(' Sel. Cliente')?></a>
		</div>
		</div>
		<div class="col-lg-2">
				<?php echo $this->Form->hidden('Sale.cliente_id',array('type'=>'text'));?>
				<?php echo $this->Form->input('Sale.clientedoc',array('label' => 'Documento',
						'class'=>'form-control input-sm',
						'type'=>'text',
						'maxlength'=>'10',
						'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-3">
				<?php echo $this->Form->input('Sale.nomap',array('label' => 'Nombre y Apellido',
				'class'=>'form-control input-sm',
				'type'=>'text',
				'maxlength'=>'10',
				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-2">
				<?php echo $this->Form->input('Sale.credito',array('label' => 'Credito',
				'class'=>'form-control input-sm',
				'type'=>'text',
				'maxlength'=>'10',
				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<!-- TABLA DE DETALLE -->
		<div class="table-responsive">
			<ul class="nav nav-tabs" id='myTab'>
			  <li class="active"><a href="#tabs-1"   data-toggle="tab"><?php echo __('Productos Vendidos') ?></a></li>
			  <li><a href="#tabs-2"  data-toggle="tab"><?php echo __('Seleccionar Productos')?></a></li>
			</ul>
			<div class="tab-content">

			<div class="tab-pane active"  id="tabs-1">
			</br>
			<button type="button" class="btn btn-primary btn-lw" title="Agregar Fila" id='agregarfila'>
				<span class="glyphicon  glyphicon-plus"></span>&nbsp;<?php echo __('Agregar Fila')?>
			</button>
			</br>
			</br>
			<table cellspacing="1" width='80%'  class="table table-striped table-bordered table-hover dataTable no-footer" aria-describedby="dataTables-example_info" id = "salesdetails">
			<thead>
				<tr>
						<th width='80px'><?php echo __('Id');?></th>
						<th><?php echo __('Producto');?></th>
						<th  width='90px'><?php echo __('Precio');?></th>
						<th  width='50px'><?php echo __('Cantidad');?></th>
						<th width='90px'> <?php echo __('Sub Total');?></th>
						<th width='90px'><?php echo __('Funcion');?></th>
				</tr>
			</thead>
			<tbody>
				<?php for($i = 1;$i <= 5;$i++):?>
				<?php echo "<tr id='salesdetails_".$i."' >"?>
						<td><?php echo $this->Form->input('Salesdetail.'.$i.'.product_id',array('label' => false	,
																'class'=>'form-control input-sm id',
																'type'=>'text',
																'length'=>'5',
																'onchange'=>'recuperarDatosProduct('.$i.',"id")',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
						<td><?php echo $this->Form->input('Salesdetail.'.$i.'.productdetail',array('label' => false	,
																'class'=>'form-control input-sm detail',
																'type'=>'text',
																'maxlength'=>'5',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
						<td><?php echo $this->Form->input('Salesdetail.'.$i.'.price',array('label' => false	,
																'class'=>'form-control input-sm precio',
																'type'=>'text',
																'maxlength'=>'5',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
						<td><?php echo $this->Form->input('Salesdetail.'.$i.'.cantidad',array('label' => false	,
																'class'=>'form-control input-sm cantidad',
																'type'=>'text',
																'maxlength'=>'5',
																'onchange'=>'recalcularcantidad('.$i.')',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
						<td><?php echo $this->Form->input('Salesdetail.'.$i.'.subtotal',array('label' => false	,
																'class'=>'form-control input-sm precio',
																'type'=>'text',
																'maxlength'=>'5',
																'onchange'=>'recalcularcantidad('.$i.')',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						</td>
						<td>
							<button type="button" class="btn btn-danger btn-lw" title="Borrar Fila" onclick="eliminarFila(<?php echo $i ?>)">
								<span class="glyphicon  glyphicon-remove-circle"></span>
							</button>
						</td>
				</tr>
				<?php endfor;?>
			</tbody>
			<tfoot>
				<tr class="success">
					<td colspan="4">
					<h4><strong><?php echo __('Total en Venta') ?></strong></h4>
					</td>
					<td colspan="2">
						<?php echo $this->Form->input('Sale.totalsale',array('label'=>false,'class'=>'inputboxl subtotal','size'=>'10','type'=>'text')) ?>
					</td>
				</tr>
			</tfoot>
			</table>

		</div>
<?php echo $this->Form->end();?>
	<div id="tabs-2"  class="tab-pane">
		<div class="table-responsive">
			<ul class="nav nav-tabs">
			  <li class="active"><a href="#tabs-1"><?php echo __('Filtros') ?></a></li>
			</ul>
			<div class="tab-content">
			  <div class="tab-pane active" id="tabs-8">
					<form id="filterproduct" accept-charset="utf-8" method="post" action="#">
					<fieldset>
					<div class="row">
						<div class="col-lg-4">
							<?php echo $this->Form->input('Product.descripcion', array(
									'label' => 'Producto',
									'placeholder' => 'Nombre de Producto',
									'class'=>'form-control input-sm',
									'type'=>'text'
								))?>
						</div>
						<div class="col-lg-3">
							<?php echo $this->Form->input('Product.categoria_id', array(
									'label' => __('Categoria'),
									'options'=>$categorias,
									'default'=>0,
									'class'=>'form-control input-sm'
								))?>
						</div>
						<div class="col-lg-3">
							<?php echo $this->Form->input('Product.subcategoria_id', array(
									'label' => __('Subcategoria'),
									'class'=>'form-control input-sm'
								))?>
						</div>
						<div  class="col-lg-1">
							<br>
							<button type="button" class="btn btn-info btn-lw" id='buscarproductos'>
									<span class="glyphicon glyphicon-search"></span>&nbsp;<?php echo __('Buscar') ?>
							</button>
						</div>
					</div>
					</fieldset>
					<?php echo $this->Form->end()?>
				</div>
			</div>
				<div class="table-responsive">
					<div id='cargandodatos' style='display:none;top: 50%;left: 50%;text-align:center'>
						<?php echo $this->Html->image('carga.gif')?>
					</div>
					<div id='listproduct'>
					</div>
				</div>
		</div>
	</div>
</div>
<?php echo $this->element('modalbox')?>
