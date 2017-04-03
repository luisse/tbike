<?php echo $this->Html->script(array('/js/mensajes/index.js','jquery.toastmessage','jquery.maskedinput','bootstrap-datetimepicker'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css(array('bootstrap-datetimepicker','message'), null, array('inline' => false))?>
<script>
	var link="<?php echo $this->Html->url(array('controller'=>'mensajes','action'=>'listmensajes')) ?>"
</script>

<?php echo $this->element('flash_message')?>
<div class="panel panel-danger">
	<div class="panel-heading">
		<i class="fa fa-envelope fa-lg"></i>&nbsp;<?php echo __('Mensajes')?>    </div>
	<br>
	<div class="table-responsive">
	<div class="panel-body">
		<div class="table-responsive">
			<div class="table-responsive">
				<ul class="nav nav-tabs">
				  <li class="active"><a href="#tabs-1"><?php echo __('Filtros') ?></a></li>
				</ul>
				<div class="tab-content">
				  <div class="tab-pane active" id="tabs-1">
						<form id="filterclient" accept-charset="utf-8" method="post" action="#">
						<?php echo $this->Form->input('typeuser',array('type'=>'hidden','value'=>'1')); ?>
						<fieldset>
						<div class="row">
							<div class="col-lg-2">
								<?php echo $this->Form->input('Cliente.documento', array(
										'label' => 'Documento ',
										'placeholder' => 'Nro de Documento',
										'class'=>'form-control input-sm',
										'type'=>'text'
									))?>
							</div>
							<div class="col-lg-3">
								<?php echo $this->Form->input('Cliente.apellido', array(
										'label' => 'Apellido ',
										'class'=>'form-control input-sm'
									))?>
							</div>
							<div class="col-lg-3">
								<?php echo $this->Form->input('Cliente.nombre', array(
										'label' => 'Nombre ',
										'placeholder' => '',
										'class'=>'form-control input-sm'
									))?>
							</div>
							<div  class="col-lg-1">
								<br>
								<button type="button" class="btn btn-info btn-lw" id='buscar'>
										<span class="glyphicon glyphicon-search"></span> Buscar
								</button>
							</div>
								<div class="col-xs-2 col-sm-2">
									<br>
									<center>
									<?php
										echo $this->Html->link('<button type="button" class="btn btn-success btn-lw" title="Agregar Mensaje">
																								<span class="glyphicon  glyphicon-plus"></span>Nuevo Mensaje</button>',array('controller'=>'mensajes',
																	'action'=>'add',''),
																	array('escape'=>false),
												'');
								?>		</center>
								</div>
						</div>
						<div class='row'>
							<div class="col-lg-2">
								<label><?php echo __('Fecha Env. Aut. desde')?></label>
								<div class="form-group">
									<div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
									<?php echo $this->Form->input('Mensaje.fechasendautodesde',array('label' =>false,
														'placeholder' => false,
														'class'=>'form-control input-sm',
														'type'=>'text',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
									<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<label><?php echo __('Fecha Env. Aut. hasta')?></label>
								<div class="form-group">
									<div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
									<?php echo $this->Form->input('Mensaje.fechasendautohasta',array('label' =>false,
														'placeholder' => false,
														'class'=>'form-control input-sm',
														'type'=>'text',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
									<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
									</div>
								</div>
							</div>
						</div>
						</fieldset>
						<?php echo $this->Form->end()?>
					</div>
				</div>
				<br>
			</div>
		</div>
		<div id='cargandodatos' style='display:none;top: 50%;left: 50%;text-align:center'>
			<?php echo $this->Html->image('carga.gif')?>
		</div>
		<div id='listmensajes'></div>
	</div>
</div>
</div>
<div id='message' style='hidden'>
	<?php $this->Session->flash() ?>
</div>
<?php echo $this->element('modalbox')?>
