<?php echo $this->Html->script(array('/js/mains/dashboard.js'),array('block'=>'scriptjs'));?>
<script>
var rtaxorderslink="<?php echo $this->Html->url(array('controller'=>'taxorders','action'=>'vieworders')) ?>"
var test=<?= $test ?>
</script>
<?php if($this->Session->read('tipousr') == 4 || $this->Session->read('tipousr') == 6 ):?>
<div class="row">
	<div class="col-lg-3 col-md-4">
		<span>Actualizando datos en :<div id="time_left"></div></span>
	</div>
	<div class="col-lg-2 col-md-2">
		<button id="btn_refrescar" class="btn btn-success btn-ln"><i class="fa fa-refresh fa-fw"></i>&nbsp;Refrescar</button>
	</div>
	<div class="col-lg-2 col-md-2">
		<!-- <div id="pingpong"></div> -->
		<span class='label label-alert' id="pingpong"></span>
	</div>
	<div  class="col-lg-4 col-md-4">
  	<div><a href="/mains/showalldriversonmap?is_test=false" target="_blank"><i class="fa fa-map-marker"></i>Mostrar Ubicación de todos los taxistas</a></div>
  </div>
</div>
 <div class="row">
 	&nbsp;
 </div>
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-success dash-panel">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-cab fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge" id='kpi_libre'>0</div>
                        <div class="mediano"><?php echo __('Libre')?></div>
                        <div class="mediano">&nbsp;</div>
                    </div>
                </div>
            </div>
            <a href="#" id='link_kpi_libre'>
                <div class="panel-footer dash-panel-footer">
                    <span class="pull-left"><?php echo __('Ver Detalles')?></span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

	<div class="col-lg-3 col-md-6">
		<div id="panelTaxiMovil" class="panel panel-yellow dash-panel">
			<div class="panel-heading">
		    	<div class="row">
		        <div class="col-xs-3">
		        	<i class="fa fa-cab fa-5x"></i>
		        </div>
		        <div class="col-xs-9 text-right">
					<div class="huge" id='kpi_en_camino' >0</div>
					<div class="mediano"><?php echo __('En camino')?></div>
					<div class="mediano">&nbsp;</div>
				</div>
			</div>
			</div>
			<a href="#" id='link_kpi_en_camino'>
				<div class="panel-footer dash-panel-footer">
		            <span class="pull-left"><?php echo __('Ver detalles')?></span>
		            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
		        	<div class="clearfix"></div>
		    	</div>
		 	</a>
		</div>
	</div>
	 <div class="col-lg-3 col-md-6">
        <div class="panel panel-danger dash-panel">
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
	<div class="col-lg-3 col-md-6">
		<div id="panelTaxiMovil" class="panel panel-default dash-panel">
			<div class="panel-heading">
		    	<div class="row">
		        <div class="col-xs-3">
		        	<i class="fa fa-cab fa-5x"></i>
		        </div>
		        <div class="col-xs-9 text-right">
					<div class="huge" id='kpi_fuera_de_servicio'>0</div>
					<div class="mediano">Fuera de</div>
					<div class="mediano">servicio</div>
				</div>
			</div>
			</div>
			<a href="#" id='link_kpi_fuera_de_servicio'>
				<div class="panel-footer dash-panel-footer">
		            <span class="pull-left"><?php echo __('Ver Detalles')?></span>
		            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
		        	<div class="clearfix"></div>
		    	</div>
		 	</a>
		</div>
	</div>
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
