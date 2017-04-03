<?= $this->Html->script(array('/js/bicicletasparaalquileres/seleccionarbicicleta.js'),array('block'=>'scriptjs'));?>
<script>
	var bicicletalink="<?= $this->Html->url(array('controller'=>'bicicletasparaalquileres','action'=>'bicicletasparaalquilerl')) ?>"
	var row = <?= $row ?>
</script>
<?= $this->element('modalboxcabecera',array('title'=>__('Seleccionar Bicicleta'),'paneltipo'=>'panel-primary'));?>
<div class="table-responsive">
	<ul class="nav nav-tabs" id='myTab'>
		<li class="active"><a href="#tabs-1"   data-toggle="tab"><?= __('Filtros de Busqueda') ?></a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="tabs-1">
			<div class="panel panel-default">
				<form id="filterbicicletas" accept-charset="utf-8" method="" action="#">
				<?= $this->Form->input('typeuser',array('type'=>'hidden','value'=>'1')); ?>
				<div class="row">
					<div class="col-lg-2">
						<?= $this->Form->input('Bicicleta.nrocuadro', array(
							'label' => array('title'=>__('Nro de Cuadro'),'style'=>''),
							'placeholder' => __('Nro. de Cuadro'),
							'class'=>'form-control input-sm',
							'size'=>5
						)); ?>
					</div>
					<div class="col-lg-4">
					<?= $this->Form->input('Bicicleta.detalles', array(
						'label' => __('Detalles'),
						'placeholder' => __('Detalles'),
						'class'=>'form-control input-sm',
						'size'=>30
					)); ?>
					</div>
					<div class="col-lg-2">
						<br>
						<button type="button" class="btn btn-info btn-lw" id='buscar'>
							<span class="glyphicon glyphicon-search"></span>
						</button>
					</div>
				</div>
				<?= $this->Form->end()?>
			</div>
		</div>
	</div>
 	<div id='cargandodatosm' style='display:none;text-align:center'>
 		<?= $this->Html->image('carga.gif')?>
 	</div>
	<div id='listarbicicletas'>
	</div>
</div>
<?= $this->element('modalboxpie');?>
