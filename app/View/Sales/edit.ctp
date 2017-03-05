<?php 	echo $this->Html->script(array('fmensajes','fgenerales','dateformat','jquery.toastmessage','bootstrap-datetimepicker','jquery.price','jquery.numeric','/js/sales/edit.js'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css(array('message','dootstrap.docs'), null, array('inline' => false))?>		
<?php echo $this->element('flash_message')?>
<script>
	var link = "<?php echo $this->Html->url(array('controller'=>'products','action'=>'listadoproductovta'))?>"
</script>
<?php echo $this->Form->create('Sale',array('action'=>'edit',	
					'inputDefaults' => array(
						'div' => 'form-group',
						'wrapInput' => false,
						'class' => 'form-control'
						),
				'class' => 'well'
			));?>
<!-- TABLA DE CABECERA -->
<?php echo $this->Form->hidden('Sale.id',array('value'=>$this->data['Sale']['id']))?>
<fieldset>
	<legend><?php echo __('Actualizar Venta')?></legend>
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
													'value'=>$this->data['Sale']['nrofactura'],
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>		
		</div>
		<div class="col-lg-3">
		<?php
			echo $this->Form->input('Sale.tipofactura',array('label' => __('Tipo de Venta'),
													'class'=>'form-control input-sm',
													'options'=>$str_tipofactura,
													'value'=>$this->data['Sale']['tipofactura'],
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))));
		?>
		</div>
	</div>
	<div class="row">
						
		<div class="col-lg-2">
				<?php echo $this->Form->hidden('Sale.cliente_id',array('type'=>'text','value'=>$this->data['Cliente']['id']));?>
				<?php echo $this->Form->input('Sale.clientedoc',array('label' => 'Documento',
						'class'=>'form-control input-sm',
						'type'=>'text',
						'maxlength'=>'10',
						'value'=>$this->data['Cliente']['documento'],
						'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>											
		<div class="col-lg-3">
				<?php echo $this->Form->input('Sale.nomap',array('label' => 'Nombre y Apellido',
				'class'=>'form-control input-sm',
				'type'=>'text',
				'value'=>$this->data['Cliente']['apellido'].', '.$this->data['Cliente']['nombre'],
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
		<div class="col-lg-2">
			<div class="btn-group">
				<a class="btn btn-app" href="#" id='aceptarventa'><i class="fa  fa-check"></i><?php echo __('Confirmar Cambios')?></a>
			</div>	
		</div>
		<div class="col-lg-1">
			<div class="btn-group">
				<a class="btn btn-app" href="#" id='cancelarventa'><i class="fa  fa-times-circle"></i><?php echo __('Cancelar')?></a>
		</div>	
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
						<th><?php echo __('Nombre Producto');?></th>
						<th  width='90px'><?php echo __('Precio');?></th>
						<th  width='50px'><?php echo __('Cantidad');?></th>
						<th width='90px'> <?php echo __('Sub Total');?></th>
						<th><?php echo __('Funcion');?></th>
				</tr>
			</thead>
			<tbody>
			<?php
				$salesdetails = $this->data['Salesdetail'];
				$i = 1;
			?>		
			
			<?php
				foreach($salesdetails as $salesdetail):?>
				<?php echo "<tr id='salesdetails_".$i."'>"?>
						<td>
							<?php echo $this->Form->input('Salesdetail.'.$i.'.id',array('value'=>$salesdetail['id'],'type'=>'hidden'))?>
							<?php echo $this->Form->input('Salesdetail.'.$i.'.product_id',array('label' => false	,
																'class'=>'form-control input-sm id',
																'type'=>'text',
																'length'=>'5',
																'value'=>$salesdetail['product_id'],
																'onchange'=>'recuperarDatosProduct('.$i.',"id")',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
						<td><?php echo $this->Form->input('Salesdetail.'.$i.'.productdetail',array('label' => false	,
																'class'=>'form-control input-sm detail',
																'type'=>'text',
																'maxlength'=>'5',
																'value'=>$salesdetail['descripcion'],
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
						<td><?php echo $this->Form->input('Salesdetail.'.$i.'.price',array('label' => false	,
																'class'=>'form-control input-sm precio',
																'type'=>'text',
																'maxlength'=>'5',
																'value'=>$salesdetail['subtotal']/$salesdetail['cantidad'],
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
						<td><?php echo $this->Form->input('Salesdetail.'.$i.'.cantidad',array('label' => false	,
																'class'=>'form-control input-sm cantidad',
																'type'=>'text',
																'maxlength'=>'5',
																'value'=>$salesdetail['cantidad'],
																'onchange'=>'recalcularcantidad('.$i.')',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
						<td><?php echo $this->Form->input('Salesdetail.'.$i.'.subtotal',array('label' => false	,
																'class'=>'form-control input-sm precio',
																'type'=>'text',
																'maxlength'=>'5',
																'value'=>$salesdetail['subtotal'],
																'onchange'=>'recalcularcantidad('.$i.')',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						</td>
						<td>
							<button type="button" class="btn btn-danger btn-lw" title="Borrar Fila" onclick="eliminarFila(<?php echo $i ?>)">
								<span class="glyphicon  glyphicon-remove-circle"></span>
							</button>						
						</td>			
				</tr>
				<?php
					$i++; 
					endforeach;
				?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4">
					<?php echo 'Total' ?>
					</td>
					<td colspan="2">
						<?php echo $this->Form->input('Sale.totalsale',array('label'=>false,'class'=>'inputboxl subtotal','size'=>'10','type'=>'text')) ?>
					</td>
				</tr>
			</tfoot>
			</table>
			<script>
				var oId = <?php echo $i?>
			</script>
		</div>
<?php echo $this->Form->end();?>
	<div id="tabs-2"  class="tab-pane">
		<div class="table-responsive">
			<ul class="nav nav-tabs">
			  <li class="active"><a href="#tabs-1"><?php echo __('Filtros') ?></a></li>
			</ul>
			<div class="tab-content">
			  <div class="tab-pane active" id="tabs-1">
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
				<div id='listproduct'>
				</div>
		</div>
	</div>
</div>
</fieldset>
		
<?php echo $this->element('modalbox')?>
			



