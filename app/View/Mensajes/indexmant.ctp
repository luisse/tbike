<?php echo $this->Html->script(array('/js/mensajes/indexmant.js','fgenerales','dateformat.js','bootstrap-datetimepicker','jquery.toastmessage'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css(array('message','bootstrap-datetimepicker'), null, array('inline' => false))?>		
<?php echo $this->element('flash_message')?>
<script>
	var link="<?php echo $this->Html->url(array('controller'=>'mensajes','action'=>'listmensajeshist')) ?>"
</script>

<div class="panel panel-listados">
	<div class="panel-heading">
		<i class="fa fa-envelope fa-fw"></i><?php echo __('Mensajes de Mantenimiento') ?>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
		<div class="table-responsive">
			<ul class="nav nav-tabs">
			  <li class="active"><a href="#tabs-1"><?php echo __('Filtros') ?></a></li>
			</ul>
			<div class="tab-content">
			  <div class="tab-pane active" id="tabs-1">
				<form id="mensajesmantenimientos" accept-charset="utf-8" method="post" action="#">
				<fieldset>
					<div class="row">	
						<div class="col-lg-2">		
							<label><?php echo __('Fecha Desde')?></label>
							<div class="form-group">
								<div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
								<?php echo $this->Form->input('Mensaje.fecdesde',array('label' =>false,
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
									<?php echo $this->Form->input('Mensaje.fechasta',array('label' =>false,
													'placeholder' => false,
													'class'=>'form-control input-sm',
													'type'=>'text',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
									<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
									</div>
							</div>
						</div>
						<div class="col-lg-4">								
							<?php echo $this->Form->input('Mensaje.observaciones',array(
									'label' => 'Observaciones de Mantenimiento',
									'placeholder' => '',
									'class'=>'form-control input-sm'));?>
						</div>
						<div class=''>
							<br>
							<button type="button" class="btn btn-info btn-lw" id='buscar'>
									<span class="glyphicon glyphicon-search"></span> Mostrar
							</button>						
						</div>
					</div>

				</fieldset>
				<?php echo $this->Form->end()?>
			</div>
		</div>
	</div>
	<div id='cargandodatos' style='display:none;top: 50%;left: 50%;'>
		<?php echo $this->Html->image('carga.gif')?>
	</div>				
	<div id='listmensajesmantenimientos'>
	</div>
</div>
</div>	
<?php echo $this->element('modalbox')?>
