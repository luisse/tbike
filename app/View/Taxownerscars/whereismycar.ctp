<style>
    #map-canvas {
      height: 600px;
      width: 1300px;
      margin: 10px;
      z-index:100;
    }
</style>
<script>
var glb_k = '<?= $this->Session->read('key')?>'
</script>

<?php echo $this->Html->script(array('https://maps.googleapis.com/maps/api/js?v=3.exp&key='.$key_api_maps,'taxownerscars/whereismycar.js'),array('block'=>'scriptjs'));?>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<i class="fa fa-map-o fa-fw"></i>&nbsp;<?php echo __('Ubicacion Actual de mis Autos')?>
		</div>
		<div class="panel-body">
					<div class="row">
							<div class='col-lg-12'>
								<div class="table-responsive">
									<div id='map-canvas'></div>
								</div>
							</div>
						<!--	<div class="col-lg-3">
								<div class="panel panel-default" id='listadopedidos'>
			                        <div class="panel-heading">
									      <h4 class="panel-title">
									      	<i class="fa fa-plus-square fa-lg"></i>
									        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
									        	<?php echo __('Automoviles Activos')?>&nbsp;
									        </a>
									      </h4>

			                        </div>
			                        <div id="collapseOne" class="panel-collapse">
				                        <div class="panel-body">
				                            <div class="list-group" id='pedidos'></div>
				                        </div>
				                    </div>

			                    </div>
							</div> -->

					</div>
		</div>
	</div>
</div>
