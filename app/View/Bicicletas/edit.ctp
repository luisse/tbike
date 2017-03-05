<?= $this->Html->script(array('/js/bicicletas/bicicletas_edit.js','dateformat.js','fgenerales.js','jquery.numeric','Photobooth','jquery.toastmessage'),array('block'=>'scriptjs'));		?>
<?= $this->Html->css(array('message'), null, array('inline' => false))?>

<?= $this->Form->create('Bicicleta',array('action'=>'edit',
				'type'=>'file',
				'inputDefaults' => array(
									'div' => 'form-group',
									'wrapInput' => false,
									'class' => 'form-control'
									),
				'class' => 'well'
			));?>
<?= $this->Form->input('id',array('type'=>'hidden'))?>
<?= $this->Form->input('tallercito_id',array('type'=>'hidden'))?>
<?= $this->element('flash_message')?>
<fieldset>
	<legend>Actualizar Datos de Bicicleta</legend>
	<div class="row">
		<div class="col-lg-3">
					<?= $this->Form->input('marca',array('label' => 'Marca',
													'placeholder' => 'Ingrese Marca',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-3">
					<?= $this->Form->input('modelo',array('label' => 'Modelo',
													'placeholder' => 'Ingrese Modelo',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
			<?= $this->Form->input('detalles',array('label' => 'Detalles',
													'placeholder' => 'Ingrese detalles',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
			<?= $this->Form->input('equipodetalle',array('label' => 'Equipamiento',
													'placeholder' => 'Ingrese Equipamiento',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-3">
			<?= $this->Form->input('nrocuadro',array('label' => 'Nro de Cuadro',
													'placeholder' => 'Ingrese Nro de Cuadro',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-4">
  			<div class="row">
  				<h4><?= __('Cargar Imagen Desde Archivo')?></h4>
  			</div>
		</div>
		<div class="col-lg-3">
			<?= $this->Form->file('Bicicleta.imagen',array('label' => false))?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-3">
			<label for="name"><?= __('Tomar Foto',true)?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-4">

				<div id="example" style="background-color:grey;height:300px;width:300px;"></div>
		</div>
		<div class="col-lg-3">
				<div id="gallery" style="background-color:grey;height:300px;width:300px;"></div>
		</div>
	</div>
</fieldset>
<br>
<div class="row">
	<div class="col-xs-6 col-sm-6">
		<center>
		<button type="button" class="btn btn-success btn-lw" id='guardar'>
		  <span class="glyphicon glyphicon glyphicon-save"></span> Guardar
		</button>
		</center>
	</div>
	<div class="col-xs-6 col-sm-6">
		<center>
		<button type="button" class="btn btn-danger btn-lw" id='cancelar'>
		  <span class="glyphicon glyphicon glyphicon-off"></span><?= __(' Cancelar')?>
		</button>
		</center>
	</div>
</div>
<?= $this->Form->end();?>
