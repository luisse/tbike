<?= $this->Html->script(array('/js/radiotaxis/charts.js','moment.min','moment-with-locales.min','bootstrap-datetimepicker','fmensajes.js','dateformat','fgenerales.js','jquery.numeric','jquery.toastmessage','chart.min.js'),array('block'=>'scriptjs'));		?>
<?= $this->Html->css(array('message','bootstrap-datetimepicker','dootstrap.docs'), null, array('inline' => false))?>
<?php
	$str_state[0]=__('En Espera');
	$str_state[1]=__('Aceptados');
	$str_state[2]=__('Cancelados');
	$str_graph[0]=__('Pedidos por Estados');
	$str_graph[1]=__('Cant: Pedidos por Chofer');
?>

<div class="panel  panel-default">
    <div class="panel-heading">
		<i class="fa fa-line-chart fa-fw"></i> <?php echo __('Graficas y Estadisticas');?>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
      <div class="tab-pane active" id="tabs-1">
        <!-- <form id="filteralumno" accept-charset="utf-8" method="post" action="#">  -->
        <?php echo $this->Form->create('Radiotaxi',array('action'=>'#','id'=>'filtercar'));?>
        <div class="row">
          <div class="col-lg-2">
            <label><?php echo __('Fecha Desde')?></label>
            <div class="form-group">
              <div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
              <?php echo $this->Form->input('Radiotaxi.fecdesde',array('label' =>false,
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
                <?php echo $this->Form->input('Radiotaxi.fechasta',array('label' =>false,
                        'placeholder' => false,
                        'class'=>'form-control input-sm',
                        'type'=>'text',
                        'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                </div>
            </div>
          </div>
          <div class="col-lg-2">
            <?php echo $this->Form->input('Radiotaxi.state', array(
                'label' => __('Estado'),
                'options'=>$str_state,
                'value'=>'2',
                'class'=>'form-control input-sm'
              ))?>
          </div>
					<div class="col-lg-2">
            <?php echo $this->Form->input('Radiotaxi.grafica', array(
                'label' => __('Tipo de Gráfica'),
                'options'=>$str_graph,
                'value'=>'0',
                'class'=>'form-control input-sm'
              ))?>
          </div>
          <div  class="col-lg-2">
            <br>
            <button type="button" class="btn btn-info btn-lw" id='view_chart'>
                <span class="glyphicon glyphicon-stats"></span> <?php echo __('Graficar');?>
            </button>
          </div>
        </div>
      </div>
				<div id='chart'>
      	<canvas id="myChart" width="1024" height="600"></canvas>
				</div>
    </div>
</div>
