<?= $this->Html->script(array('/js/alquileres/index.js','fgenerales','dateformat.js','jquery.toastmessage','bootstrap-datetimepicker','jquery.price','jquery.numeric'),array('block'=>'scriptjs'));?>
<?= $this->Html->css(array('message','bootstrap-datetimepicker','dootstrap.docs'), null, array('inline' => false))?>
<?= $this->element('flash_message')?>
<script>
	var link="<?= $this->Html->url(array('controller'=>'alquileres','action'=>'listalquileres')) ?>"
</script>
<div class="panel panel-listados">
	<div class="panel-heading">
		<i class="fa fa-list fa-lg"></i>&nbsp;<?= __('Listados de Alquileres')?>    </div>
	<br>
	<div class="table-responsive">
	<div class="panel-body">
			<!-- FILTROS -->
			<div class="tab-content">
				<div id="tabs-1">
				<form id="filter" accept-charset="utf-8" method="post" action="#">
					<div class="row">
						<div class="col-lg-2">
							<label><?= __('Fecha Desde')?></label>
							<div class="form-group">
								<div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
									<?= $this->Form->input('fecdesde',array('label' =>false,
													'placeholder' => false,
													'class'=>'form-control input-sm',
													'type'=>'text',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
									<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
								</div>
							</div>
						</div>
						<div class="col-lg-2">
							<label><?= __('Fecha Hasta')?></label>
							<div class="form-group">
								<div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
									<?= $this->Form->input('fechasta',array('label' =>false,
													'placeholder' => false,
													'class'=>'form-control input-sm',
													'type'=>'text',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
									<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
								</div>
							</div>
						</div>
					</div>
					<?= $this->element('busqueda_cliente',array('modelname'=>'Sale.'))?>
			    <?= $this->Form->end()?>
	    	</div>
	    </div>
	    <!-- FIN FILTROS -->
		<div id='cargandodatos' style='display:none;top: 50%;left: 50%;text-align:center'>
			<?= $this->Html->image('carga.gif')?>
		</div>
		<div id='listalquileres'>
		</div>
<div class="row">
	<div class="col-xs-6 col-sm-6">
		<center>
		<?php
			echo $this->Html->link('<button type="button" class="btn btn-success btn-lw" title="Agregar Categoria">
																	<span class="glyphicon  glyphicon-plus"></span>Agregar</button>',array('controller'=>'alquileres',
										'action'=>'add',''),
										array('escape'=>false),
					'');
	?>		</center>
	</div>
</div>
</div>
<div id='message' style='hidden'>
	<?php $this->Session->flash() ?>
</div>
<?= $this->element('modalbox')?>
