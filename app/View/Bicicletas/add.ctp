<?= $this->Html->script(array('/js/bicicletas/bicicleta_add.js','Photobooth','dateformat.js','fgenerales.js','jquery.numeric'),array('block'=>'scriptjs'));		?>
<?= $this->Html->css(array('message'), null, array('inline' => false))?>

<?= $this->Form->create('Bicicleta',array('action'=>'add',
				'type'=>'file',
				'inputDefaults' => array(
									'div' => 'form-group',
									'wrapInput' => false,
									'class' => 'form-control'
									),
				'class' => 'well'
			));?>
<fieldset>
	<legend>Nueva Bicicleta</legend>
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
			<?= $this->Form->file('Bicicleta.image',array('label' => false))?>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-1">
			<button type="button" class="btn btn-info btn-lw" id='sacarfoto' title='Tomar Foto'>
			  <span class="glyphicon glyphicon-camera"></span>&nbsp;<?= __('Tomar Foto desde Camara',true)?>
			</button>
		</div>
	</div>
	<div class="row">
	<br>
	</div>
	<div class="row">
		<div class="col-lg-3">
				<?= $this->Form->input('imagen',array('type'=>'hidden'))?>
				<div id="example" style="background-color:grey;height:300px;width:300px;"></div>
		</div>
		<div class="col-lg-1">
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
		  <span class="glyphicon glyphicon glyphicon-save"></span>&nbsp;<?= __('Guardar')?>
		</button>
		</center>
	</div>
	<div class="col-xs-6 col-sm-6">
		<center>
		<button type="button" class="btn btn-danger btn-lw" id='cancelar'>
		  <span class="glyphicon glyphicon glyphicon-off"></span>&nbsp; <?= __('Cancelar')?>
		</button>
		</center>
	</div>
</div>
<?= $this->Form->end();?>
