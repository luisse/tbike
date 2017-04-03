<?php echo $this->Html->script(array('https://www.google.com/jsapi',
									'/js/sales/diagramasventas.js',
									'jquery.numeric',
									'fgenerales',
									'jquery.toastmessage'),array('block'=>'scriptjs')); ?>
<div class="panel panel-listados">
	<div class="panel-heading">
		<i class="fa fa-bar-chart-o fa-fw"></i>&nbsp;<?php echo __('Ventas Totales Estimadas') ?>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
		<div class="table-responsive">
			<ul class="nav nav-tabs">
			  <li class="active"><a href="#tabs-1"><?php echo __('Filtros') ?></a></li>
			</ul>
			<div class="tab-content">
			  <div class="tab-pane active" id="tabs-1">
					<form id="filterdiagram" accept-charset="utf-8" method="post" action="#">
					<?php echo $this->Form->input('typeuser',array('type'=>'hidden','value'=>'1')); ?>    
					<fieldset>
					<div class="row">	
						<div class="col-lg-2">			
							<?php echo $this->Form->input('anio', array(
									'label' => __('Año'),
									'class'=>'form-control input-sm',
									'type'=>'text'
								))?>
						</div>
						<div  class="col-lg-1">
							<br>
							<button type="button" class="btn btn-info btn-lw" id='btmostrar'>
									<span class="glyphicon glyphicon-search"></span> <?php echo __('Buscar') ?>
							</button>
						</div>  
					</div>  					
					</fieldset>
					<?php echo $this->Form->end()?>
				</div>
			</div>
			<br>
		</div>
		<div class='row'>
            <div class="panel-body">
				<div id="chart_div" style="width:100; height:100"></div>
			</div>
		</div>
	</div>
</div>