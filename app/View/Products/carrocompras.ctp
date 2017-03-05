<?php echo $this->Html->script(array('/js/products/carrocompras.js','jquery.maskedinput','jquery.toastmessage','fgenerales','ShoppingCart.min','json2'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css(array('message','styles.min'), null, array('inline' => false))?>		
<?php echo $this->element('flash_message')?>
<?php if(empty($subcategorias)) $subcategorias=array();?>
<script>
	var link="<?php echo $this->Html->url(array('controller'=>'products','action'=>'productjson')) ?>"
</script>
<div class="panel panel-ingresos">
	<div class="panel-heading">
		<i class="fa fa-wrench fa-fw"></i>&nbsp;<?php echo __('Ventas') ?>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
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
									'options'=>$subcategorias,
									'class'=>'form-control input-sm'
								))?>
						</div>												
						<div  class="col-lg-1">
							<br>
							<button type="button" class="btn btn-info btn-lw" id='buscar'>
									<span class="glyphicon glyphicon-search"></span>&nbsp;<?php echo __('Buscar') ?>
							</button>
						</div>  
					</div>  					
					</fieldset>
					<?php echo $this->Form->end()?>
				</div>
			</div>
			<br>
		</div>
		<div class='row'>
			<div class="acidjs-shopping-cart-dropdown"></div>
		</div>
		<div class='row'>
			<div class="acidjs-shopping-cart"></div>
		</div>
	</div>
</div>
<?php echo $this->element('modalbox')?>