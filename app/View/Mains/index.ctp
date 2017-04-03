<?php echo $this->Html->script(array('/js/mains/index.js'),array('block'=>'scriptjs'));?>
<script>
var rtaxorderslink="<?php echo $this->Html->url(array('controller'=>'taxorders','action'=>'vieworders')) ?>"
</script>

<div class="row">
    <div class="col-lg-3 col-md-6">
        <!--HEADER PANELS-->
        <?php if($this->Session->read('tipousr') == 1):?>
        <div class="panel panel-primary dash-panel">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge" id='travels'>0</div>
                        <div class="mediano"><?php echo __('Viajes y Pedidos')?></div>
                    </div>
                </div>
            </div>
            <?php if($this->Session->read('tipousr') == 1):?>
            <a href="/taxorders/vieworders" id='vieworder'>
            <?php endif;?>
            <?php if($this->Session->read('tipousr') == 3):?>
            <a href="/taxorders/index" id='vieworder'>
            <?php endif;?>
                <div class="panel-footer dash-panel-footer">
                    <span class="pull-left"><?php echo __('Ver Detalles')?></span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
        <?php endif;?>
    </div>
<?php if($this->Session->read('tipousr')==1):?>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow dash-panel">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-cab fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"  id="cars">0</div>
                        <div class="mediano"><?php echo __('Mis Autos Activos')?></div>
                    </div>
                </div>
            </div>
            <a href="/taxownerscars/whereismycar">
                <div class="panel-footer dash-panel-footer">
                    <span class="pull-left"><?php echo __('Ver Detalles')?></span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
<?php endif;?>
<?php if($this->Session->read('tipousr')==3):?>
<div class="col-lg-3 col-md-6">
	<div id="panelTaxiMovil" class="panel panel-yellow dash-panel">
		<div class="panel-heading">
	    	<div class="row">
	        <div class="col-xs-3">
	        	<i class="fa fa-cab fa-5x"></i>
	        </div>
	        <div class="col-xs-9 text-right">
				<div class="huge"><?php echo __('Movil')?></div>
				<div class="mediano"><?php echo __('Nuevo Pedido')?></div>
			</div>
		</div>
		</div>
		<a href="/taxorders/taketax">
			<div class="panel-footer dash-panel-footer">
	            <span class="pull-left"><?php echo __('Pedir un Movil')?></span>
	            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	        	<div class="clearfix"></div>
	    	</div>
	 	</a>
	</div>
</div>
<?php endif;?>
</div>


<div class="row">
	<div id="viewtarorders"></div>
</div>
