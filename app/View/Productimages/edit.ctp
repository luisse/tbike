<?= $this->Html->script(array('/js/productimages/edit.js','fgenerales.js','jquery.toastmessage'),array('block'=>'scriptjs')); ?>
<?= $this->Html->css('message', null, array('inline' => false))?>
<?= $this->element('flash_message')?>
<?= $this->Form->create('Productimage',array('action'=>'edit',
				'type'=>'file',
				'inputDefaults' => array(
									'div' => 'form-group',
									'wrapInput' => false,
									'class' => 'form-control'
									),
				'class' => 'well'));?>
<?= $this->Form->hidden('id')?>
<?= $this->Form->hidden('product_id')?>

<fieldset>
	<legend><?= __('Actualizar Foto');?></legend>
	<div class="row">
		<div class="row">
			<div class="col-lg-3">
					<?= $this->Form->input('Productimage.imagen',array('label' => __('Foto'),
														'class'=>'form-control input-sm',
														'type'=>'file',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
			</div>
			<div class="col-lg-3">
				<div id="gallery" style="height:250px;width:250px;"></div>
			</div>
		</div>
		<div class="col-lg-10">
					<?= $this->Form->input('Productimage.descripcion',array('label' => __('Descripción'),
													'placeholder'=>__('Ingrese Descripción'),
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-10">
			<?= $this->Form->input('Productimage.estado',array('label' => __('Habilitado'),
													'options'=>$str_estado,
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
</fieldset>
<div class="row">
	<div class="col-xs-6 col-sm-6">
		<center>
		<button type="button" class="btn btn-success btn-lw" id='guardar'>
		  <span class="glyphicon glyphicon glyphicon-save"></span>&nbsp;<?= __('Guardar') ?>
		</button>
		</center>
	</div>
	<div class="col-xs-6 col-sm-6">
		<center>
		<button type="button" class="btn btn-danger btn-lw" id='cancelar'>
		  <span class="glyphicon glyphicon glyphicon-off"></span>&nbsp;<?= __(' Cancelar')?>
		</button>
		</center>
	</div>
</div>
<?= $this->Form->end();?>
