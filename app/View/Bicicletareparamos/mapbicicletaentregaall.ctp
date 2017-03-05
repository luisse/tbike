<style>
    #map-canvas {
      height: 100%;
      margin: 10px;
      padding: 200px;
      z-index:100;
    }
</style>
<?php $tallercito = $this->Session->read('tallercito'); ?>
<div id='formreturn'>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"> </script>
	<script>
	<?php $clienteid =0;?>
	var direccionlocal="<?php echo 'Argentina,'.$tallercito['Provincia']['nombre'].','.$tallercito['Departamento']['nombre'].','.$tallercito['Localidade']['nombre'].','.$tallercito['Tallercito']['direccion']?>"
	var direccion = [<?php foreach($bicicletareparamos as $bicicletareparamo):?>
		<?php if($bicicletareparamo['Cliente']['id'] != $clienteid && empty($bicicletareparamo['Cliente']['lat'])):?>
		<?php $clienteid = $bicicletareparamo['Cliente']['id'];?>
			{direccionclie:'<?php echo $bicicletareparamo['Cliente']['domicilio'] ?>', provincia:'<?php echo $bicicletareparamo['Provincia']['nombre']?>',localidad:'<?php echo $bicicletareparamo['Localidade']['nombre']?>',pais:'Argentina',nomap:'<?php echo $bicicletareparamo['Cliente']['apellido'].', '.$bicicletareparamo['Cliente']['nombre']?>'},
		<?php endif;?>
	<?php endforeach;?>];
	
	<?php $clienteid =0;?>
	var coordgps = [<?php foreach($bicicletareparamos as $bicicletareparamo):?>
		<?php if($bicicletareparamo['Cliente']['id'] != $clienteid && !empty($bicicletareparamo['Cliente']['lat']) && !empty($bicicletareparamo['Cliente']['lng'])):?>
		<?php $clienteid = $bicicletareparamo['Cliente']['id'];?>
			{lat:'<?php echo $bicicletareparamo['Cliente']['lat'] ?>', lng:'<?php echo $bicicletareparamo['Cliente']['lng']?>',nomap:'<?php echo $bicicletareparamo['Cliente']['apellido'].', '.$bicicletareparamo['Cliente']['nombre']?>'},
		<?php endif;?>
	<?php endforeach;?>];
	
	<?php $clienteid =0;?>
	var infocliente=[<?php foreach($bicicletareparamos as $bicicletareparamo):?>
						<?php if($bicicletareparamo['Cliente']['id'] != $clienteid):?>
						<?php $clienteid = $bicicletareparamo['Cliente']['id'];?>
	             		{infoclient:'<div id="content">'+
									'<div id="siteNotice">'+
									'</div>'+
									'<h3 id="firstHeading" class="firstHeading"><?php echo __('Información del Cliente') ?></h3>'+
									'<div id="bodyContent">'+
									'<p><b><?php echo __('Apellido y Nombre:')?> </b><?php echo $bicicletareparamo['Cliente']['apellido'].', '.$bicicletareparamo['Cliente']['nombre']?><br>'+
									'<p><b><?php echo __('Dirección:')?></b><?php echo $bicicletareparamo['Cliente']['domicilio']?><br>'+
									'<p><b><?php echo __('Teléfono:')?></b><?php echo $bicicletareparamo['Cliente']['telefono']?><br>'+
									'</div>'+
									'</div>'},
						<?php endif;?>
	<?php endforeach;?>]
								
	</script>
	<?php echo $this->element('modalboxcabecera',array('title'=>__('Ubicación de Entregas para el Cliente'),'paneltipo'=>'panel-primary'));?>
	<?php echo $this->Html->script(array('bicicletareparamos/mapsbicicletaentregaall.js'),array('block'=>'scriptjs'));?>
		<div class="row">
			<div class="panel panel-default">
			    <div class="panel-heading">
			      <h4 class="panel-title">
			      	<i class="fa fa-plus-square fa-lg"></i>
			        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
			          <?php echo __('Domicilios de Entrega'); ?>&nbsp;
			        </a>
			      </h4>
			    </div>
			    <div id="collapseOne" class="panel-collapse collapse">
			      <div class="panel-body">
						<div class="table-responsive">
						<table id='personas' class="table table-responsive  table-condensed">
							<thead>
								<tr>
									<th><?php echo __('Cliente Nombre')?></th>
									<th><?php echo __('Provincia/Localidad/Dpto')?></th>
									<th><?php echo __('Dirección')?></th>									
									<th><?php echo __('Telefono')?></th>
									<th><?php echo __('Ubicación Manual')?></th>
								</tr>
							</thead>
							<tbody>		
			      			<?php $clienteid=0;?>
				      		<?php foreach($bicicletareparamos as $bicicletareparamo):?>
				      		<?php if($clienteid != $bicicletareparamo['Cliente']['id']):?>
				      		<?php $clienteid=$bicicletareparamo['Cliente']['id'];?>
					      		<tr>
					      			<td><code><strong><?php echo $bicicletareparamo['Cliente']['apellido'].', '.$bicicletareparamo['Cliente']['nombre']?></strong></code></td>
									<td><?php echo $bicicletareparamo['Provincia']['nombre'].' - '.$bicicletareparamo['Localidade']['nombre'].' - '.$bicicletareparamo['Departamento']['nombre']?></td>
					      			<td><?php echo $bicicletareparamo['Cliente']['domicilio']?></td>
					      			<td><code><strong><?php echo $bicicletareparamo['Cliente']['telefono'] ?></strong></code></td>									
					      			<td>	<?php 
											echo $this->Html->link('<button type="button" class="btn btn-danger btn-lw" title="Asignar Coordenadas">
														<span class="glyphicon glyphicon-map-marker"></span></button>',array('controller'=>'bicicletareparamos',
												'action'=>'getlocalize',$bicicletareparamo['Bicicletareparamo']['id']),
												array('onclick'=>'','escape'=>false),
												'');
											?>					
					      			</td>
					      		</tr>
					      	<?php endif;?>
			      			<?php endforeach;?>
   							</tbody>
		      			</table>
						</div>
					</div>
				</div>
			</div>	
		</div>	
		<div class="row">
			
		</div>
		<div class="row">
			<div class="table-responsive">
				<div class='col-lg-12'>
					<div id='map-canvas'></div>
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
