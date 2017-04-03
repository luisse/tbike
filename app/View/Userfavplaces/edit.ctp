<?php echo $this->Html->script(array('/js/userfavplaces/edit.js','jquery.toastmessage'),array('block'=>'scriptjs'));		?>
<?php echo $this->Html->css(array('message'), null, array('inline' => false))?>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="panel-body">
				<?php echo $this->Form->create('Userfavplace',array('action'=>'edit',
																	'inputDefaults' => array(
																	'div' => 'form-group',
																	'wrapInput' => false,
																	'class' => 'form-control'
																	),
																'class' => 'well')); ?>
				<legend><?php echo __('Actualizar Destino'); ?></legend>
				<hr style="width: 100%; color: black; height: 1px; background-color:black;">
					<div class="row">
						<div class="col-lg-2">
							<?php echo $this->Form->hidden('Userfavplace.id')?>
							<?php echo $this->Form->input('Userfavplace.detalle',array('label' => __('Detalle'),
																			'placeholder' => __('Detalle'),
																			'size'=>'3',
																			'type'=>'text',
																			'tabindex'=>'1',
																			'maxlength'=>40,
																			'class'=>'form-control input-sm',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<?php echo $this->Form->input('Userfavplace.destino',array('label' => __('Dirección'),
																			'placeholder' => __('Dirección'),
																			'size'=>'3',
																			'type'=>'text',
																			'tabindex'=>'1',
																			'maxlength'=>100,
																			'class'=>'form-control input-sm',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						</div>
					</div>
				<hr style="width: 100%; color: black; height: 1px; background-color:black;">
				<div class="row">
					<div class="col-xs-6 col-sm-6">
						<center>
							<button type="button" class="btn btn-success btn-lw" id='guardar' tabindex='22'>
							  <span class="glyphicon glyphicon glyphicon-save"></span> <?php echo __('Guardar')?>
							</button>
						</center>
					</div>
					<div class="col-xs-6 col-sm-6">
						<center>
						<button type="button" class="btn btn-danger btn-lw" id='cancelar' tabindex='23'>
							<span class="glyphicon glyphicon glyphicon-off"></span><?php echo __(' Cancelar')?>
						</button>
						</center>
					</div>
				</div>
					<?php echo $this->Form->end();?>					
				</div>
			</div>
		</div>
</div>