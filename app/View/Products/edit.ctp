<?php echo $this->Html->script(array('/js/products/edit.js','fmensajes.js','fgenerales.js','jquery.toastmessage','yellow-text','jquery.price','fgenerales','jquery.maskedinput','jquery.numeric','bootstrap-typeahead.js'),array('block'=>'scriptjs')); ?>
<?php echo $this->Html->css(array('message','yellow-text-blue'), null, array('inline' => false))?>			
<?php echo $this->element('flash_message')?>
<?php echo $this->Form->create('Product',array('url'=>array('action'=>'edit'),	
				'type'=>'file',	
				'inputDefaults' => array(
									'div' => 'form-group',
									'wrapInput' => false,
									'class' => 'form-control'
									),
				'class' => 'well'));?>
<?php echo $this->Form->input('Product.id',array('label'=>false,'class'=>'inputboxl','type'=>'hidden'))?>
<?php echo $this->Form->input('Productsdetail.id',array('label'=>false,'class'=>'inputboxl','type'=>'hidden'))?>
<fieldset>
	<legend><?php echo __('Actualizar Datos del Producto') ?></legend>
	<div class="row">	
		<div class="col-lg-10">
			<?php echo $this->Form->input('Product.descripcion',array('label' =>__('Nombre Producto'),
													'placeholder' => __('Nombre Producto'),
													'class'=>'form-control input-sm',
													'type'=>'text',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>		
	<div class="row">		
		<div class="col-lg-5">
			<?php echo $this->Form->input('Product.sintetico',array('label' =>__('Sintetico'),
													'placeholder' => __('Sint.'),
													'class'=>'form-control input-sm',
													'type'=>'text',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>		
		<div class="col-lg-5">
			<?php echo $this->Form->input('Product.codbarra',array('label' =>__('Cod. de Barras'),
													'placeholder' => __('Cod. de Barras'),
													'class'=>'form-control input-sm',
													'type'=>'text',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<div class="row">			
		<div class="col-lg-5">
			<?php echo $this->Form->input('Product.categoria_id',array('label' =>__('Categoria'),
													'class'=>'form-control input-sm',
													//'options'=>$categorias,
													//'values'=>$this->request->data['Product']['categoria_id'],
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-5">
			<?php echo $this->Form->input('Product.subcategoria_id',array('label' =>__('Subcategoria'),
													'class'=>'form-control input-sm',
													//'options'=>$subcategorias,
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<div class="row">		
	</div>
	<div class="row">				
		<div class="col-lg-10">
			<?php echo $this->Form->input('Productsdetail.details',array('label' =>'Detalles del Producto',
													'type'=>'textarea',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-5">
			<?php echo $this->Form->input('Product.proveedore_id',array('label' =>__('Proveedor:'),
													'placeholder' => __('Ingrese Proveedor'),
													'autocomplete'=>"off",
													'class'=>'form-control input-sm',
													'type'=>'text',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>		
	</div>
	<div class="row">
		<div class="col-lg-2">
			<?php echo $this->Form->input('Productsdetail.precio',array('label' =>__('Precio'),
													'size'=>'5','maxlength'=>'10',
													'placeholder' => __(''),
													'class'=>'form-control input-sm',
													'type'=>'text',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>	
		<div class="col-lg-2">
					<?php echo $this->Form->input('Product.codgen',array('label' =>__('Codigo Genérico'),
													'placeholder' => __(''),
													'class'=>'form-control input-sm',
													'type'=>'text',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-1">														
			<?php echo $this->Form->input('Productsdetail.stock',array('label' =>__('Stock'),
													'placeholder' => __('Stock'),
													'class'=>'form-control input-sm',
													'type'=>'text',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>	
		<div class="col-lg-1">
			<?php echo $this->Form->input('Productsdetail.peso',array('label' =>__('Peso (Grs)'),
													'placeholder' => __(''),
													'class'=>'form-control input-sm',
													'type'=>'text',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
</fieldset>
<div class="row">	
	<div class="col-xs-6 col-sm-6">
		<center>
		<button type="button" class="btn btn-success btn-lw" id='guardar'>
		  <span class="glyphicon glyphicon glyphicon-save"></span>&nbsp;<?php echo __('Guardar') ?>
		</button>	
		</center>
	</div>
	<div class="col-xs-6 col-sm-6">
		<center>
		<button type="button" class="btn btn-danger btn-lw" id='cancelar'>
		  <span class="glyphicon glyphicon glyphicon-off"></span>&nbsp;<?php echo __(' Cancelar')?>
		</button>	
		</center>
	</div>
</div>
<?php echo $this->Form->end();?>
