<?php if(empty($subcategorias))$subcategorias=array(); ?>
<?php echo $this->Html->script(array('/js/products/seleccionarproducto.js'),array('block'=>'scriptjs'));?>
<script>
	var productslink="<?php echo $this->Html->url(array('controller'=>'products','action'=>'seleccionarlistarproductos')) ?>"
	var rowpos=<?php echo $rowpos ?>
</script>
<?php echo $this->element('modalboxcabecera',array('title'=>__('Seleccionar Producto'),'paneltipo'=>'panel-primary'));?>
<div class="table-responsive">
	<ul class="nav nav-tabs" id='myTab'>
		<li class="active"><a href="#tabs-1"   data-toggle="tab"><?php echo __('Filtros de Busqueda') ?></a></li>
	</ul>
			<div class="tab-content">
			  <div class="tab-pane active" id="tabs-1">
					<form id="filterproduct" accept-charset="utf-8" method="post" action="#">
					<fieldset>
					<div class="row">	
						<div class="col-lg-4">			
							<?php echo $this->Form->input('Product.descripcion', array(
									'label' => __('Producto'),
									'placeholder' => __('Nombre de Producto'),
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
			<div id='listproductos'></div>
</div>
<?php echo $this->element('modalboxpie');?>