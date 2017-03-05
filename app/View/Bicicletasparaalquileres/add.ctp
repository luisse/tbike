<?= $this->Html->script(array('http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js','/js/bicicletasparaalquileres/add.js','fmensajes.js','fgenerales.js','jquery.toastmessage','yellow-text'),array('block'=>'scriptjs')); ?>
<?= $this->Html->css(array('message','yellow-text-blue'), null, array('inline' => false))?>
<?= $this->element('flash_message')?>
<?= $this->Form->create('Bicicletasparaalquilere',array('action'=>'add',
				'inputDefaults' => array(
							'div' => 'form-group',
							'wrapInput' => false,
							'class' => 'form-control'
							),
				'class' => 'well'));?>
<fieldset>
	<legend><?= __('Alta Bicicleta para Alquiler') ?></legend>

			<div class="row">
				<div class="col-lg-10">
				<?= $this->Form->input('detalle',array('label' => __('Detalle'),
													'placeholder'=>'Ingrese Detalle',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
					<div class="row">
				<div class="col-lg-3">
				<?= $this->Form->input('bicicleta_id',array('label' => __('Nro de Cuadro'),
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-10">
				<?= $this->Form->input('estado',array('label' => __('Estado'),
													'options'=>$str_estadobike,
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
</fieldset>
<div ng-app='myApp' ng-controller='myCtrl'>
	<div class="row">
		<div class="col-lg-6">
			<center>
			<button type="button" class="btn btn-success btn-lw" id='guardar' ng-click='guardar()'>
			  <span class="glyphicon glyphicon glyphicon-save"></span>&nbsp;<?= __('Guardar') ?>
			</button>
			</center>
		</div>
		<div class="col-lg-6">
			<center>
			<button type="button" class="btn btn-danger btn-lw" id='cancelar' ng-click='cancelar()'>
			  <span class="glyphicon glyphicon glyphicon-off"></span>&nbsp;<?= __(' Cancelar')?>
			</button>
			</center>
		</div>
	</div>
</div>
<?= $this->Form->end();?>
