<?php echo $this->Html->script(array('fgenerales','fmensajes.js','dateformat.js','bootstrap-datetimepicker','/js/movimientos/veringresosfecha.js','jquery.toastmessage'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css(array('bootstrap-datetimepicker','message'), null, array('inline' => false))?>
<?php echo $this->element('flash_message')?>

<script>
	var link="<?php echo $this->Html->url(array('controller'=>'movimientos','action'=>'listmovimientos')) ?>"
</script>
<!--     BLOQUE DE BOTONES -->

<div class="panel panel-listados">
	<div class="panel-heading">
		<i class="fa fa-clock-o fa-fw"></i> Movimientos por Fecha
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
		<div class="table-responsive">
			<ul class="nav nav-tabs">
			  <li class="active"><a href="#tabs-1"><?php echo __('Filtros') ?></a></li>
			</ul>
			<div class="tab-content">
			  <div class="tab-pane active" id="tabs-1">
				<form id="movimientosfilter" accept-charset="utf-8" method="post" action="#">
				<?php echo $this->Form->input('movimientos',array('type'=>'hidden','value'=>'1')); ?>    
				<?php //echo $this->Form->create('filter',array('action'=>'#'))?>
				<fieldset>

					<div class="row">	
						<div class="col-lg-2">		
							<label><?php echo __('Fecha Desde')?></label>
							<div class="form-group">
								<div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
								<?php echo $this->Form->input('Movimiento.fecdesde',array('label' =>false,
													'placeholder' => false,
													'class'=>'form-control input-sm',
													'type'=>'text',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
								</div>
							</div>
						</div>
						<div class="col-lg-2">			
							<label><?php echo __('Fecha Hasta')?></label>
							<div class="form-group">
									<div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
									<?php echo $this->Form->input('Movimiento.fechasta',array('label' =>false,
													'placeholder' => false,
													'class'=>'form-control input-sm',
													'type'=>'text',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
									<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
									</div>
							</div>
						</div>
						<div class="col-lg-3">								
							<?php echo $this->Form->input('Movimiento.tipomovimiento_id',array(
									'label' => __('Tipo de Movimiento '),
									'placeholder' => '',
									'class'=>'form-control input-sm'));?>
						</div>
						</div>
						<div class="row">
								<div class="col-lg-1">
									<div class="btn-group">
										<a class="btn btn-app" href="#" id='selcliente'><i class="fa  fa-user"></i> Sel. Cliente</a>
									</div>	
								</div>						
								<div class="col-lg-2">
														<?php echo $this->Form->input('Movimiento.clientedoc',array('label' => 'Doc Cliente',
																			'class'=>'form-control input-sm',
																			'type'=>'text',
																			'maxlength'=>'10',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
								</div>											
								<div class="col-lg-3">
																<?php echo $this->Form->hidden('Movimiento.cliente_id'); ?>
																<?php echo $this->Form->hidden('Movimiento.cuenta_id'); ?>
																<?php echo $this->Form->hidden('Movimiento.deudatotal'); ?>
																<?php echo $this->Form->input('Movimiento.nomap',array('label' => 'Nombre y Apellido',
																			'class'=>'form-control input-sm',
																			'type'=>'text',
																			'maxlength'=>'10',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
								</div>	
							<div class='col-lg-2'>
								<br>
								<button type="button" class="btn btn-info btn-lw" id='mostrar'>
										<span class="glyphicon glyphicon-search"></span> Mostrar
								</button>						
							</div>
						</div>

				</fieldset>
				<?php echo $this->Form->end()?>
			</div>
		</div>
	</div>
	<div id='cargandodatos' style='display:none;top: 50%;left: 50%;text-align:center'>
		<?php echo $this->Html->image('carga.gif')?>
	</div>		
	<div id='listmovimientos'>
	</div>
</div>
</div>	
<br>
<?php echo $this->element('modalbox')?>