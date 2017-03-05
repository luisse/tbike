<style>
#map-canvas {
  height: 500px;
  width: 100%;
  margin: 10px;
  z-index:100;
}
</style>
<script>
var glb_k = '<?= $this->Session->read('key')?>'
</script>

<?php echo $this->Html->script(array('https://maps.googleapis.com/maps/api/js?v=3.exp&key='.$key_api_maps,'https://cdn.firebase.com/js/client/2.3.1/firebase.js','mains/showAllDriversOnMap.js'),array('block'=>'scriptjs'));?>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<i class="fa fa-map-o fa-fw"></i>&nbsp;<?php echo __('Ubicacion Actual de Taxistas')?>
		</div>
		<div class="panel-body">
					<div class="row">
							<div class='col-lg-12'>
								<div class="table-responsive">
									<div id='map-canvas'></div>
								</div>
							</div>
					</div>
		</div>
	</div>
</div>
