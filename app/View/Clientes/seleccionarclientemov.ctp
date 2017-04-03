<?php echo $this->Html->script(array('/js/clientes/seleccionarclientemov.js','jquery.maskedinput'),array('block'=>'scriptjs'));?>
<script>
	var clientlink="<?php echo $this->Html->url(array('controller'=>'clientes','action'=>'listarclientes')) ?>"
</script>
<?php echo $this->element('modalboxcabecera',array('title'=>'Seleccionar Cliente','paneltipo'=>'panel-primary'));?>
<div class="table-responsive">
	<ul class="nav nav-tabs" id='myTab'>
		<li class="active"><a href="#tabs-1"   data-toggle="tab"><?php echo __('Filtros de Busqueda') ?></a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="tabs-1">
			<div class="panel panel-default">
				<form id="filterclient" accept-charset="utf-8" method="" action="#">
				<?php echo $this->Form->input('typeuser',array('type'=>'hidden','value'=>'1')); ?>    
				<div class="row">
					<div class="col-lg-2">
						<?php echo $this->Form->input('Cliente.Documento', array(
							'label' => array('title'=>__('Documento'),'style'=>''),
							'placeholder' => __('Nro. Documento'),
							'class'=>'form-control input-sm',
							'size'=>5
						)); ?>	
					</div>
					<div class="col-lg-4">
					<?php echo $this->Form->input('Cliente.Apellido', array(
						'label' => __('Apellido'),
						'placeholder' => __('Apellido'),
						'class'=>'form-control input-sm',
						'size'=>30
					)); ?>			
					</div>
					<div class="col-lg-4">
					<?php echo $this->Form->input('Cliente.Nombre', array(
						'label' => __('Nombre '),
						'placeholder' => __('Nombre'),
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
				<?php echo $this->Form->end()?>
			</div>
		</div>
	</div>
 	<div id='cargandodatosm' style='display:none;text-align:center'>
 		<?php echo $this->Html->image('carga.gif')?>
 	</div>	
	<div id='listarclientes'>
	</div>	
</div>

<?php echo $this->element('modalboxpie');?>
