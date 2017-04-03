
<?php echo $this->Html->script(array('/js/mains/getorders.js','moment.min','moment-with-locales.min','bootstrap-datetimepicker','fmensajes.js','dateformat','fgenerales.js','jquery.numeric','jquery.toastmessage'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css(array('message','bootstrap-datetimepicker','dootstrap.docs'), null, array('inline' => false))?>
<?php echo $this->element('flash_message')?>
<script>
  var link="<?php echo $this->Html->url(array('controller'=>'kpis','action'=>'getorders.json')) ?>"
</script>
<div class="panel panel-default">
  <div class="panel-heading">
  <i class="fa fa-list fa-lg"></i>&nbsp;<?php echo __('Listado de pedidos')?>
  </div>
  <br>
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

              <div class='col-lg-2'>
                <br/>
                <button type="button" class="btn btn-info btn-lw" id="buscar">
      									<span class="glyphicon glyphicon-search"></span> Buscar</button>
              </div>
            </div>
            <?php echo $this->Form->end()?>
      	</div>
      </div>
     <!-- FIN FILTROS -->
     <div class="row">
     	<div class="panel panel-default">
        <div class="table-responsive"  id ='search'>
     		   <table class="table " id="view_orders"></table>
         </div>
     	</div>
     </div>
</div>
</div>
