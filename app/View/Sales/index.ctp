<?php echo $this->Html->script(array('fgenerales','dateformat.js','/js/sales/index.js','jquery.toastmessage','bootstrap-datetimepicker','jquery.price','jquery.numeric'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css(array('fullcalendar.print.css','fullcalendar.css','bootstrap-datetimepicker','message','dootstrap.docs'), null, array('inline' => false))?>
<?php echo $this->element('flash_message')?>
<script>
	var link="<?php echo $this->Html->url(array('controller'=>'sales','action'=>'listsales')) ?>"
</script>

<div class="panel  panel-listados">
	<div class="panel-heading">
		<i class="fa fa-user fa-fw"></i><?php echo __('Ventas')?>
    </div>
	<br>
<div class="panel-body">

	<!-- FIN BLOQUE BOTONES -->
   	<div class="table-responsive">
		<ul class="nav nav-tabs">
		  <li class="active"><a href="#tabs-1"><?php echo __('Filtro Usuarios') ?></a></li>
		</ul>
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
								<div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
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
							<?php echo $this->Form->input('tipofactura',array(
									'label' => __('Tipo de Venta'),
									'options'=>$str_tipofactura,
									'class'=>'form-control input-sm'))?>
						</div>
					</div>
					<?php echo $this->element('busqueda_cliente',array('modelname'=>'Sale.'))?>
			    <?php echo $this->Form->end()?>
	    	</div>
		</div>
	</div>
	<div id='cargandodatos' style='display:none;top: 50%;left: 50%;text-align:center'>
		<?php echo $this->Html->image('carga.gif')?>
	</div>
	<div id='listsales'>
	</div>
</div>

<?php echo $this->element('modalbox')?>
