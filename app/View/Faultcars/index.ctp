<?php echo $this->Html->script(array('/js/faultcars/index.js','fgenerales','dateformat.js','jquery.toastmessage','moment.min','moment-with-locales.min','bootstrap-datetimepicker'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css(array('message','bootstrap-datetimepicker'), null, array('inline' => false))?>
<?php echo $this->element('flash_message')?>
<script>
	var rlink="<?php echo $this->Html->url(array('controller'=>'faultcars','action'=>'listfaultcars')) ?>"
</script>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-table fa-fw"></i><?php echo __('Listado de Fallas')?>
			</div>
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
								<button type="button" class="btn btn-info btn-lw" id='viewfaults'>
										<span class="glyphicon glyphicon-search"></span><?php echo __('Buscar Fallas');?>
								</button>
							</div>
						</div>
				    <?php echo $this->Form->end()?>
		    	</div>
		    </div>
			<div id='cargandodatos' style='display:none;top: 50%;left: 50%;text-align:center'>
				<?php echo $this->Html->image('carga.gif')?>
			</div>
			<div id='listfaultcars'></div>
			</div>
	</div>
	</div>
</div>
<?php echo $this->element('modalbox')?>
