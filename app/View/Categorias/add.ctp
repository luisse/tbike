<?php echo $this->Html->script(array('/js/categorias/add.js','fgenerales.js','jquery.toastmessage'),array('block'=>'scriptjs')); ?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>			
<?php echo $this->element('flash_message')?>
<?php echo $this->Form->create('Categoria',array('url'=>array('action'=>'add'),	
				'type'=>'file',	
				'inputDefaults' => array(
									'div' => 'form-group',
									'wrapInput' => false,
									'class' => 'form-control'
									),
				'class' => 'well'));?>
<fieldset>
	<legend><?php echo __('Nueva Categoria') ?></legend>
	<div class="row">	
		<div class="col-lg-10">
			<?php echo $this->Form->input('Categoria.descripcion',array('label' => 'Categoria',
													'placeholder'=>'Ingrese Categoria',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-4">
			<?php echo $this->Form->input('Categoria.imagen',array('label' => 'Seleccione Imagen',
													'class'=>'form-control input-sm',
													'type'=>'file',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-5">
			<div id="gallery" style="background-color:orange;height:250px;width:250px;"></div>
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
