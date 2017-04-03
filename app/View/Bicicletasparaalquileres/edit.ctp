<?php echo $this->Html->script(array('http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js','/js/bicicletasparaalquileres/edit.js','fmensajes.js','fgenerales.js','jquery.toastmessage','yellow-text'),array('block'=>'scriptjs')); ?>
<?php echo $this->Html->css(array('message','yellow-text-blue'), null, array('inline' => false))?>
<?php echo $this->element('flash_message')?>
<?php echo $this->Form->create('Bicicletasparaalquilere',array('action'=>'edit',
				'inputDefaults' => array(
							'div' => 'form-group',
							'wrapInput' => false,
							'class' => 'form-control'
							),
				'class' => 'well'));?>
<?php echo $this->Form->hidden('id')?>
<?php echo $this->Form->hidden('tallercito_id')?>
<fieldset>
	<legend><?php echo __('Actualizar Datos de Bicicleta para Alquiler') ?></legend>

			<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('detalle',array('label' => __('Detalle'),
													'placeholder'=>'Ingrese Detalle',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
					<div class="row">
				<div class="col-lg-3">
				<?php echo $this->Form->input('bicicleta_id',array('label' => __('Nro de Cuadro'),
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('estado',array('label' => __('Estado'),
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
			<button type="button" class="btn btn-success btn-lw" ng-click='guardar()'>
			  <span class="glyphicon glyphicon glyphicon-save"></span>&nbsp;<?php echo __('Guardar') ?>
			</button>
			</center>
		</div>
		<div class="col-lg-6">
			<center>
			<button type="button" class="btn btn-danger btn-lw" ng-click='cancelar()'>
			  <span class="glyphicon glyphicon glyphicon-off"></span>&nbsp;<?php echo __(' Cancelar')?>
			</button>
			</center>
		</div>
	</div>
</div>
<?php echo $this->Form->end();?>
