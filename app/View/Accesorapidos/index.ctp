<?php echo $this->Html->script(array('/js/accesorapidos/index.js','jquery.maskedinput','jquery.toastmessage'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>		
<?php
//determinamos si mostramos el ícono de shimano service center
$tallercito = $this->Session->read('tallercito');
?>
<script>
	var rbicicletaslink="<?php echo $this->Html->url(array('controller'=>'bicicletareparamos','action'=>'bicicletasentaller')) ?>"
	var rmensajesmantenimiento="<?php echo $this->Html->url(array('controller'=>'mensajes','action'=>'retornarmensajes')) ?>"
	var useradmin=<?php echo $this->Session->read('tipousr')?>
</script>
<!--     BLOQUE DE BOTONES -->
<?php if($tallercito['Tallercito']['shimanocenter'] == 2): ?>
<div class="row">		
	  <div class="col-xs-6 col-md-3">
		<h3><span class="label label-default"><?php echo __('Shimano Center Oficial')?></span></h3>
		<a href="https://mapsengine.google.com/map/edit?mid=z_Z4IGEy2Wpo.ktoTYu3e1hH0" class="thumbnail">
		  <?php echo $this->Html->image('SERVICE_RACE.jpg', array('alt' => 'Centros de Servicio Shimano','width'=>"100", 'height'=>"100")); ?>
		</a>
	  </div>	  
</div>
	 <?php endif;?>

	
<?php if( $this->Session->read('tipousr') != 2):?>
<div class="row">
	<div class="col-lg-7">
		<div class="panel panel-primary">
			<div class='panel-body'>
				<label><?php //echo __('Accesos Rapidos')?></label>
				<div class="btn-group">
					<?php foreach($buttonacces as $buttonacce):?>
						<?php echo $this->Html->link($buttonacce['Button']['descripc'],array('controller'=>trim($buttonacce['Button']['modelname']),
										'action'=>trim($buttonacce['Button']['actionname']),null),array('escape' => false,'class'=>'btn btn-app'))?>
					<?php endforeach;?>
				</div>   
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<?php if( $this->Session->read('tipousr') == 2 && $tallercito['Tallercito']['shimanocenter'] == 1):?>
<div class="row">
	<div class="col-lg-12">
		<div class="alert alert-info">
			<div class='panel-body'>
				<div class="col-md-10">
					<label><h2><?php echo __('Shimano Center Oficial')?></h2></label>
				</div>
				<div class="col-md-1">
						<a href="https://mapsengine.google.com/map/edit?mid=z_Z4IGEy2Wpo.ktoTYu3e1hH0" class="">
						  <?php echo $this->Html->image('SERVICE_RACE.jpg', array('alt' => 'Centros de Servicio Shimano','width'=>"100", 'height'=>"100")); ?>
						</a>						
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>



<div class="row">
	<div class="col-lg-3 col-xs-6">
     	<!-- small box -->
        <div class="small-box bg-aqua">
        	<div class="inner">
            	<h3>
                	<?php echo $bicienespera ?> <sup style="font-size: 20px">&nbsp;<?php echo __('Bicicletas')?></sup>
                 </h3>
                 <p>
                 	<?php echo __('En espera') ?>
                 </p>
              </div>
              <div class="icon">
              	<i class="ion ion-android-stopwatch"></i>
              </div>
              <a class="small-box-footer" href="#" id="espera">
              	<?php echo __('Ver Detalles ')?><i class="fa fa-arrow-circle-right"></i>
              </a>
        </div>
	</div>
	<div class="col-lg-3 col-xs-6">
     	<!-- small box -->
        <div class="small-box bg-green">
        	<div class="inner">
            	<h3>
                	<?php echo $bicientaller ?> <sup style="font-size: 20px">&nbsp;<?php echo __('Bicicletas')?></sup>
                 </h3>
                 <p>
                 	<?php echo __('En Taller') ?>
                 </p>
              </div>
              <div class="icon">
              	<i class="ion ion-looping"></i>
              </div>
              <a class="small-box-footer" href="#" id='entaller'>
              	<?php echo __('Ver Detalles')?> <i class="fa fa-arrow-circle-right"></i>
              </a>
        </div>
	</div>	
	<div class="col-lg-3 col-xs-6">
     	<!-- small box -->
        <div class="small-box bg-red">
        	<div class="inner">
            	<h3>
                	<?php echo $biciconfirmar ?> <sup style="font-size: 20px">&nbsp;<?php echo __('Bicicletas')?></sup>
                 </h3>
                 <p>
                 	<?php echo __('Espera Confirmación') ?>
                 </p>
              </div>

              <div class="icon">
              	<i class="ion ion-person"></i>
              </div>
              <a class="small-box-footer" href="#" id='confirmar'>
              	<?php echo __('Ver Detalles') ?> <i class="fa fa-arrow-circle-right"></i>
              </a>
        </div>
	</div>
	<div class="col-lg-3 col-xs-6">
     	<!-- small box -->
        <div class="small-box bg-teal">
        	<div class="inner">
            	<h3>
                	<?php echo $mensajesmant?> <sup style="font-size: 20px"><?php echo __('Mensajes')?></sup>
                 </h3>
                 <p>
                 	<?php echo __('De Mantenimiento') ?>
                 </p>
              </div>
              <div class="icon">
              	<i class="ion ion-android-mail"></i>
              </div>
              <a class="small-box-footer" href="#" id='mantenimiento'>
					<?php echo __('Ver Detalles')?> <i class="fa fa-arrow-circle-right"></i>
              </a>
        </div>
	</div>			
</div>
	
<div class="row">
	<div class='col-lg-9' id='viewinformation' style='display:none'>
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div id='cespera' style='display:none'><i class="fa fa-stop fa-fw" id='bicicletaingreso'></i><label>&nbsp;<?php echo __('En Espera') ?></label></div>
				<div id='centaller' style='display:none'><i class="fa fa-cog  fa-fw" id='bicicletaingreso'></i><label>&nbsp;<?php echo __('En Taller') ?></label></div>
				<div id='cconfirma' style='display:none'><i class="fa fa-exclamation-triangle fa-fw" id='bicicletaingreso'></i><label>&nbsp;<?php echo __('Confirmación') ?></label></div>
				<div id='mensajesmant' style='display:none'><i class="fa fa-envelope fa-fw"> </i><label>&nbsp;<?php echo __('Mensajes de Mantenimiento') ?></label></div>
			</div>
			<div id='informacion'></div>
		</div>
	</div>		
</div>
	
<?php if( $this->Session->read('tipousr') == 2):?>
<div class="row">	
	<div class="col-lg-8">
		<div class="panel panel-warning" id='mensajeservice' style='display:none'>
			<div class="panel-heading">
				<label>&nbsp;<?php echo __('Mensajes Servicio Técnico')?></label>
			</div>
			<div id='mensajes'></div>
		</div>
	</div>
</div>
<?php endif;?>
<?php echo $this->element('modalbox')?>