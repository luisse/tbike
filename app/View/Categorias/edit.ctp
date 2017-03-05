<?php echo $this->Html->script(array('/js/categorias/edit.js','fgenerales.js','jquery.toastmessage'),array('block'=>'scriptjs')); ?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>			
<?php echo $this->element('flash_message')?>

<?php echo $this->Form->create('Categoria',array('action'=>'edit',	
				'type'=>'file',
				'inputDefaults' => array(
									'div' => 'form-group',
									'wrapInput' => false,
									'class' => 'form-control'
									),
				'class' => 'well'));?>
<fieldset>
<?php echo $this->Form->hidden('id'); ?>
<?php echo $this->Form->hidden('tallercito_id'); ?>
	<legend>
	<?php if(empty($this->request->data['Categoria']['padre_id']))
					echo __('Actualizar Categoria');
			else
					echo __('Actualizar SubCategoria');
	?>
	</legend>
	<div class="row">	
		<div class="col-lg-10">
			<?php echo $this->Form->input('descripcion',array('label' => 'Categoria',
													'placeholder'=>'Ingrese Categoria',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<div class="row">	
		<div class="col-lg-3">
			<?php echo $this->Form->input('imagen',array('label' => 'Imagen',
													'class'=>'form-control input-sm',
													'type'=>'file',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>		
		<div class="col-lg-3">
				<a href="#" class="thumbnail">
					<?php  echo $this->Html->image(array ( 'controller' =>
									'categorias' , 'action' => 'mostrarimagen' ,
									$this->request->data['Categoria']['id']),
									array ( 'title' =>$this->request['Categoria']['descripcion']) );
							?>
				</a>
		</div>
		<div class="col-lg-3">
				<a href="#" class="thumbnail">
					<div id="gallery" style="height:250px;width:250px;"></div>
				</a>
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
