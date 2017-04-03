<?= $this->Html->script(array('/js/products/actualizapreciomasivo.js','jquery.maskedinput','jquery.toastmessage','fgenerales','jquery.numeric','jquery.price'),array('block'=>'scriptjs'));?>
<?= $this->Html->css('message', null, array('inline' => false))?>
<?= $this->element('flash_message')?>
<?php if(empty($subcategorias)) $subcategorias=array();?>
<script>
	var link="<?= $this->Html->url(array('controller'=>'products','action'=>'mostrarresultpreciomod')) ?>"
</script>
<div class="panel panel-ingresos">
	<div class="panel-heading">
		<i class="fa fa-wrench fa-fw"></i>&nbsp;<?= __('Producto Gestion de Precios') ?>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
		<div class="table-responsive">
			<ul class="nav nav-tabs">
			  <li class="active"><a href="#tabs-1"><?= __('Filtros de Reemplazo') ?></a></li>
			</ul>
			<div class="tab-content">
			  <div class="tab-pane active" id="tabs-1">
					<form id="filterproduct" accept-charset="utf-8" method="post" action="#">
					<fieldset>
					<div class="row">
						<div class="col-lg-3">
							<?= $this->Form->input('Product.categoria_id', array(
									'label' => __('Categoria'),
									'options'=>$categorias,
									'default'=>0,
									'class'=>'form-control input-sm'
								))?>
						</div>
						<div class="col-lg-3">
							<?= $this->Form->input('Product.subcategoria_id', array(
									'label' => __('Subcategoria'),
									'options'=>$subcategorias,
									'class'=>'form-control input-sm'
								))?>
						</div>
						<div class="col-lg-2">
							<?= $this->Form->input('Product.porcentaje', array(
									'label' => __('% Actualización'),
									'class'=>'form-control input-sm',
									'div'=>false
								))?>
						</div>
					 	<div class="col-lg-2">
							<label class="checkbox-inline">
								<?php
									$options=array('S'=>'Incrementar','D'=>'Descontar');
									echo $this->Form->input('Product.calc', array(
									'label' => __('Operación'),
									'options'=>$options,
									'default'=>'I',
									'class'=>'form-control input-sm'
								))?>
							</label>
						</div>
						<div  class="col-lg-1">
							<br>
							<button type="button" class="btn btn-info btn-lw" id='buscar'>
									<span class="glyphicon glyphicon-cog"></span>&nbsp;<?= __('Calcular') ?>
							</button>
						</div>
					</div>
					</fieldset>
					<?= $this->Form->end()?>
				</div>
			</div>
			<br>
		</div>
			<div id='cargandodatos' style='display:none;top: 50%;left: 50%;text-align:center'>
				<?= $this->Html->image('carga.gif')?>
			</div>
			<div id='listproductos'>
			</div>
			<div class="row">
		<div class="col-xs-12 col-sm-12" id='regactualizar'>
			<center>
			<button type="button" class="btn btn-success btn-lw" id='actualizar'>
			  <span class="glyphicon glyphicon-saved"></span>&nbsp;<?= __('Actualizar Precios') ?>
			</button>
			</center>
		</div>
	</div>

	</div>
</div>
<?= $this->element('modalbox')?>
