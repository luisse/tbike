<style>
    #map-canvas {
      height: 300px;
      width: 950px;
      margin: 10px;
      z-index:100;
    }
</style>


<?php
echo $this->Html->script(array('https://maps.googleapis.com/maps/api/js?v=3.exp&key='.$key_api_maps,'https://www.gstatic.com/firebasejs/3.4.0/firebase.js','/js/mains/policiamonitor.js','fgenerales.js'),array('block'=>'scriptjs'));?>
<script>
var rtaxorderslink="<?php echo $this->Html->url(array('controller'=>'taxorders','action'=>'vieworders')) ?>"
var test = <?= $test ?>
</script>
<?php if($this->Session->read('tipousr')==5):?>
<div id="sound"></div>
<div class="row">
  <div class="alert alert-danger" id='alert'>
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span id="msg"></span><span class="sr-only"></span>
  </div>
</div>
<div class = 'row'>
    <div class="row">
    	<div class="col-lg-2 col-md-2">
    		<div id="pingpong"></div>
    	</div>
    </div>
    <div class="row">
     	&nbsp;
    </div>
    <div class="row">
      <div class="col-lg-3">
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="panel panel-success dash-panel">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-cab fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge" id='kpi_ocupado'>0</div>
                                <div class="mediano"><?php echo __('Ocupado')?></div>
                                <div class="mediano">&nbsp;</div>
                            </div>
                        </div>
                    </div>
                    <a href="#" id='link_kpi_ocupado'>
                        <div class="panel-footer dash-panel-footer">
                            <span class="pull-left"><?php echo __('Ver Detalles')?></span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
          </div>
          <div class="row">
        	 <div class="col-lg-12 col-md-6">
                <div class="panel panel-danger dash-panel">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-cab fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge" id='panico_activado'>0</div>
                                <div class="mediano"><?php echo __('Alarma Activada')?></div>
                                <div class="mediano">&nbsp;</div>
                            </div>
                        </div>
                    </div>
                    <a href="#" id='link_alarm'>
                        <div class="panel-footer dash-panel-footer">
                            <span class="pull-left"><?php echo __('Ver Detalles')?></span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
      </div> <!-- fin columna principal -->
      <div class="col-lg-9">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <i class="fa fa-map-o fa-fw"></i>&nbsp;<?php echo __('Ubicación de Moviles')?> - <span id="time_left"></span> seg.
            <div class="pull-right">
              <div class="col-lg-2 col-md-2">
                <button id="btn_refrescar" class="btn btn-success btn-xs"><i class="fa fa-refresh fa-fw"></i>&nbsp;<?php echo __('Actualizar Información')?></button>
              </div>
            </div>
          </div>
          <div class = "panel-body">
                  <div class = "row">
                        <div class = "table-responsive">
                          <div id = 'map-canvas'></div>
                        </div>
                  </div>
            </div>
        </div>
      </div>
  </div> <!-- fin rows datos -->
<?php endif;?>
</div>
<div class="row">
	<div id="detail_kpi"></div>
</div>
<div class="row">
	<div class="panel panel-default">
		<table class="table" id="view_detail_kpi"></table>
	</div>
</div>
