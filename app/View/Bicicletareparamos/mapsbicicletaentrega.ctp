<style>
    #map-canvas {
      height: 100%;
      margin: 10px;
      padding: 200px;
      z-index:100;
    }
</style>
<div id='formreturn'>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"> </script>
	<script>
		var direccion = "<?php echo $bicicletareparamos['Cliente']['domicilio'] ?>, <?php echo $provincia?>, Argentina"
		var infocliente='<div id="content">'+
								'<div id="siteNotice">'+
								'</div>'+
								'<h3 id="firstHeading" class="firstHeading"><?php echo __('Información del Cliente') ?></h3>'+
								'<div id="bodyContent">'+
								'<p><b><?php echo __('Apellido y Nombre:')?> </b><?php echo $bicicletareparamos['Cliente']['apellido'].', '.$bicicletareparamos['Cliente']['nombre']?><br>'+
								'<p><b><?php echo __('Dirección:')?></b><?php echo $bicicletareparamos['Cliente']['domicilio']?><br>'+
								'<p><b><?php echo __('Teléfono:')?></b><?php echo $bicicletareparamos['Cliente']['telefono']?><br>'+
								'</div>'+
								'</div>'
								
	</script>
	<?php echo $this->element('modalboxcabecera',array('title'=>__('Ubicación del Domicilio del Cliente'),'paneltipo'=>'panel-primary'));?>
	<?php echo $this->Html->script(array('bicicletareparamos/mapsbicicletaentrega.js'),array('block'=>'scriptjs'));?>
		<div class="row">
			<div class="table-responsive">
				<div class='col-lg-12'>
								<div id='map-canvas'>
								</div>
				</div>
			</div>
		</div>
	<div class='row'>
                <div class="col-lg-12">
                        <button type="button" class="btn btn-danger btn-lw" id='cancelar'>
                          <span class="glyphicon glyphicon-off"></span><?php echo __(' Cancelar')?>
                        </button>
                </div>
	</div>
</div>
