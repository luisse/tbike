<style>
    #map-canvas {
      height: 100%;
      margin: 1px;
      padding: 200px;
      z-index:100;
    }
</style>
<?php echo $this->Html->script(array('https://maps.googleapis.com/maps/api/js?v=3.exp','faultcars/getubicationmaps.js'),array('block'=>'scriptjs'));?>
<script>
lat = <?=$lat ?>;
lng = <?=$lng ?>
</script>
<?php echo $this->element('modalboxcabecera',array('title'=>__('Vista Satelital del Auto'),'paneltipo'=>'panel-primary'));?>
<div class="panel panel-default">
  <div class="panel-default">
    <div id='map-canvas'></div>
    <div class="modal-footer">
    		<button data-dismiss="modal" class="btn btn-info btn-lw" type="button" id='volveratras'>
    			<span class="glyphicon glyphicon glyphicon-off"></span>&nbsp;<?= __('Volver Atras')?>
        </button>
    </div>
  </div>
</div>
</div>
</div>
