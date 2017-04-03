<?php echo $this->Html->script(array('/js/taxorders/vieworders.js','fgenerales','dateformat.js','jquery.toastmessage','moment.min','moment-with-locales.min','bootstrap-datetimepicker','https://maps.googleapis.com/maps/api/js?v=3.exp'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css(array('message','bootstrap-datetimepicker'), null, array('inline' => false))?>
<?php echo $this->element('flash_message')?>
<style>
    #map-canvas {
      height: 100%;
      margin: 10px;
      padding: 200px;
      z-index:100;
    }
</style>

<div class="panel panel-default">
	<div class="panel-heading">
		<i class="fa fa-map-o fa-fw"></i>&nbsp;<?php echo __('Vista de Pedidos Realizados')?>    </div>
	<br>
	<div class="table-responsive">
		<div class="panel-body">
				<!-- FILTROS -->
				<div class="tab-content">
					<div id="tabs-1">
					<form id="filter" accept-charset="utf-8" method="post" action="#">
						<div class="row">
							<div class="col-lg-2">
								<label><?php echo __('Fecha Desde')?></label>
								<div class="form-group">
									<div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
										<?php echo $this->Form->input('fecdesde',array('label' =>false,
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
									<div class='input-group date' id='datetimepicker2' data-date-format="DD/MM/YYYY">
										<?php echo $this->Form->input('fechasta',array('label' =>false,
														'placeholder' => false,
														'class'=>'form-control input-sm',
														'type'=>'text',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
										<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
										<?php echo $this->Form->input('taxownerscar_id',array('label' =>'Filtro por Auto',
														'placeholder' => false,
														'options'=>$taxownerscar_id,
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>

							</div>
							<div  class="col-lg-2">
								<br>
								<button type="button" class="btn btn-info btn-lw" id='verpuntos'>
										<span class="glyphicon glyphicon-search"></span><?php echo __('Mostrar Pedidos');?>
								</button>
							</div>
						</div>
				    <?php echo $this->Form->end()?>
		    	</div>
		    </div>
		    <!-- FIN FILTROS -->
			<div id='cargandodatos' style='display:none;top: 50%;left: 50%;text-align:center'>
				<?php echo $this->Html->image('https://taxiar-files.s3.amazonaws.com/img/carga.gif')?>
			</div>
			<div id='listpedidos'></div>
			<div id='map-canvas'></div>
		</div>
	</div>
</div>
