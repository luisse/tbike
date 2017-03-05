<?php echo $this->Html->script(array('/js/senderlogs/index.js','fgenerales','jquery.toastmessage','dateformat.js','bootstrap-datetimepicker'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css(array('bootstrap-datetimepicker','message'), null, array('inline' => false))?>		
<?php echo $this->element('flash_message')?>


<script>
	var link="<?php echo $this->Html->url(array('controller'=>'senderlogs','action'=>'listsenderlogs')) ?>"
</script>
<div class="panel panel-danger">
	<div class="panel-heading">
		<i class="fa fa-bug fa-lg"></i>&nbsp;<?php echo __('Log de Envios de Correo')?>
    </div>
	<br>
<div class="table-responsive">
	<div class="panel-body">
		<div class="table-responsive">
			<ul class="nav nav-tabs">
			  <li class="active"><a href="#tabs-1"><?php echo __('Filtros') ?></a></li>
			</ul>
			<div class="tab-content">
			  <div class="tab-pane active" id="tabs-1">
				<form id="senderlogs" accept-charset="utf-8" method="post" action="#">
				<fieldset>
					<div class="row">	
						<div class="col-lg-2">		
							<label><?php echo __('Fecha Desde')?></label>
							<div class="form-group">
								<div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
								<?php echo $this->Form->input('Senderlog.fecdesde',array('label' =>false,
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
									<?php echo $this->Form->input('Senderlog.fechasta',array('label' =>false,
													'placeholder' => false,
													'class'=>'form-control input-sm',
													'type'=>'text',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
									<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
									</div>
							</div>
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
	<div id='listsenderlogs'></div>
	</div>
</div>
<div id='message' style='hidden'>
	<?php $this->Session->flash() ?>
</div>