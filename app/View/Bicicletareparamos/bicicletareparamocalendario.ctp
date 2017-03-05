<?php	echo $this->Html->script(array('/js/calendar/fullcalendar.js','/js/bicicletareparamos/bicicletareparamocalendario.js','bootstrap-datetimepicker','dateformat','fgenerales','jquery.toastmessage'),array('block'=>'scriptjs'));?>
<?php	echo $this->Html->css(array('fullcalendar.print.css','fullcalendar.css','bootstrap-datetimepicker','message'), null, array('inline' => false));?>
<?php echo $this->element('flash_message')?>
<!--     BLOQUE DE BOTONES -->

<div class="panel panel-default">
	<div class="panel-heading">
		<i class="fa fa-calendar fa-fw"></i>&nbsp;<?php echo __('Calendario de Taller') ?>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
		<div class="table-responsive">
			<ul class="nav nav-tabs">
			  <li class="active"><a href="#tabs-1"><?php echo __('Filtros') ?></a></li>
			</ul>
			<div class="tab-content">
			  <div class="tab-pane active" id="tabs-1">
				<div class="panel panel-default">
					<form id="filterfechas" accept-charset="utf-8" method="post" action="#">
					<?php //echo $this->Form->input('fechadesde',array('type'=>'hidden','value'=>'1')); ?>    
					<fieldset>
					<div class="row">	
						<div class="col-lg-2">	
							<label><?php echo __('Fecha Desde')?></label>
							<div class="form-group">		
					            <div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">						
									<?php echo $this->Form->input('Bicicletareparamo.Fechadesde', array(
											'label' => false,
											'class'=>'form-control input-sm',
											'type'=>'text'
										))?>
									<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
								</div>
							</div>
						</div>
						<div class="col-lg-2">
							<label><?php echo __('Fecha Hasta')?></label>
							<div class="form-group">		
				            <div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">			
								<?php echo $this->Form->input('Bicicletareparamo.Fechasta', array(
										'label' => false,
										'class'=>'form-control input-sm'
									))?>
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
							</div>
							</div>
						</div>						
						<div  class="col-lg-1">
							<br>
							<button type="button" class="btn btn-info btn-lw" id='buscar'>
									<span class="glyphicon glyphicon-search"></span> <?php echo __('Mostrar')?>
							</button>
						</div>  
					</div>  					
					</fieldset>
					<?php echo $this->Form->end()?>
					</div>
				</div>
			</div>
			<br>
		</div>
			<div class='row'>
				<div class='col-lg-1'><h4><span class="label label-espera"><?php	echo __('Espera');?></span></h4></div>
				<div class='col-lg-1'><h4><span class="label label-entaller"><?php	echo __('En Taller');?></span></h4></div>
				<div class='col-lg-1'><h4><span class="label label-confcliente"><?php	echo __('Confirmar Cliente');?></span></h4></div>
			</div>		
			<div id='loading' style='display:none'><i class="fa fa-spinner fa-spin"></i></div>
			<div id='calendar'></div>
</div>
<!-- FIN BLOQUE BOTONES -->

