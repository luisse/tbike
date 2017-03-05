<style>
    #map-canvas {
      height: 100%;
      margin: 10px;
      padding: 200px;
      z-index:100;
    }
</style>
<?php if(!empty($bicicletareparamos)): ?>
<script>
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
	var clat = <?php if($bicicletareparamos['Cliente']['lat']!= 0 && $bicicletareparamos['Cliente']['lat'] != null) 
						echo $bicicletareparamos['Cliente']['lat']; 
					else echo '0';?>;
	var clng = <?php if($bicicletareparamos['Cliente']['lng']!= 0 && $bicicletareparamos['Cliente']['lng'] != null) 
						echo $bicicletareparamos['Cliente']['lng']; 
					else 
						echo '0'; ?>;
</script>
<?php endif;?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"> </script>
<?php echo $this->Html->script(array('/js/bicicletareparamos/getlocalize.js','fgenerales','fmensajes.js'),array('block'=>'scriptjs'));?>
<?php echo $this->Form->create('Bicicletareparamo',array('action'=>'getlocalize',	
					'inputDefaults' => array(
						'div' => 'form-group',
						'wrapInput' => false,
						'class' => 'form-control'
						),
				'class' => 'well'
			));?>
<?php echo $this->Form->hidden('Bicicletareparamo.cliente_id',array('label'=>false,'type'=>'hidden','value'=>$bicicletareparamos['Cliente']['id']))?>
	<legend><?php echo __('Localización Manual de Cliente para Entregada')?></legend>
	<div class="row">
		<div class="col-lg-4">
			<?php echo $this->Form->input('Bicicletareparamo.clinomape',array('label' => __('Cliente Nombre y Apellido'),
													'class'=>'form-control input-sm',
													'value'=>$bicicletareparamos['Cliente']['apellido'].', '.$bicicletareparamos['Cliente']['nombre'],
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	
		<div class="col-lg-2">
			<?php echo $this->Form->input('Bicicletareparamo.latitude',array('label' => __('Latitud'),
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-2">
			<?php echo $this->Form->input('Bicicletareparamo.longitude',array('label' => __('Longitud'),
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<div class="row">
					<div class="col-lg-6">
					    <div class="input-group">
									<?php echo $this->Form->input('Bicicletareparamo.ubicacionmanual', array(
										'label' => false,
										'type'=>'text',
										'placeholder' => __('Ingrese Dirección Formato (Pais,Provincia,Localidad,Direccion)'),
										'class'=>'form-control'
									))?>
					         <span class="input-group-btn">
					        <button class="btn btn-default" type="button" id='gpsubi'><i class="glyphicon glyphicon-globe"></i></button>
					      </span>
					    </div>
					 </div>
	
	</div>		
	<div class="row">
		<div class="table-responsive">
			<div class='col-lg-12'>
				<div id="map-canvas"></div>
			</div>
		</div>
	</div>
<div class="row">	
	<div class="col-xs-6 col-sm-6">
		<center>
		<button type="button" class="btn btn-success btn-lw" id='guardar'>
		  <span class="glyphicon glyphicon glyphicon-save"></span>&nbsp;<?php echo __('Guardar Punto GPS')?>
		</button>	
		</center>
	</div>
	<div class="col-xs-6 col-sm-6">
		<center>
		<button type="button" class="btn btn-danger btn-lw" id='cancelar'>
		  <span class="glyphicon glyphicon glyphicon-off"></span>&nbsp;<?php echo __('Cancelar')?>
		</button>	
		</center>
	</div>
</div>
<?php echo $this->Form->end();?>
<?php echo $this->element('modalbox')?>

