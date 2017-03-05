<?php
$str_estadossino[0]='NO';
$str_estadossino[1]='SI';
?>
<br/>
<center>
<div class="table-responsive">
	<table id="dataTables-example" class="table table-striped table-bordered table-hover dataTable table-responsive  table-condensed" >
	<thead>
		<tr>
				<th><div class='sort'><?php echo __('Cliente');?></div></th>
				<th><div class='sort'><?php echo __('Bicicleta');?></div></th>
				<th><div class='sort'><?php echo __('Detalle Reparación');?></div></th>
				<th><div class='sort'><?php echo __('Entregado');?></div></th>
				<?php if($this->Session->read('tipousr') != 2): ?>
					<th><div class='sort'><?php echo __('Acciones');?></div></th>
				<?php endif; ?>
		</tr>
	</thead>
	<tbody>
		<?php
		$i = 0;
		foreach ($bicicletareparamos as $bicicletareparamo):
				switch($bicicletareparamo['Bicicletareparamo']['estado']){
				case 0:
					$image='espera.png';
					$class='danger';
					$title=__('En Espera para ingreso',true); 
					break;
				case 1:								
					$image='entaller.png';
					$class='success';
					$title=__('En Taller',true); 
					break;
				case 2:
					$image='responcliente.png';
					$class='warning';
					$title=__('Confirmacion de Cliente',true); 
					break;
				case 3:
					$image='finalizado.png';
					$title=__('Finalizado',true);
					$class='active'; 
					break;
				}
			?>
		<tr class="<?php echo $class;?>">
			<td><h8>
			
						<?php echo $this->Form->hidden('clienteid'.$i,array('value'=>$bicicletareparamo['Cliente']['id']))?>
						<?php echo $this->Form->hidden('importetotal'.$i,array('value'=>$bicicletareparamo['Bicicletareparamo']['importetotal']))?>
						<?php echo $this->Form->hidden('bicicletareparamoid'.$i,array('value'=>$bicicletareparamo['Bicicletareparamo']['id']))?>									
						<?php
							echo $this->Html->link($bicicletareparamo['Cliente']['nomape'],'#',
								array('onclick'=>'return verCliente('.$bicicletareparamo['Cliente']['id'].')','rel'=>'facebox')) ?></h8>
			</td>
			<td><h8>
						<?php 
							echo $this->Html->link($bicicletareparamo['Bicicleta']['marca'].'-'.$bicicletareparamo['Bicicleta']['modelo'],'#',
								array('onclick'=>'return verImagen('.$bicicletareparamo['Bicicleta']['id'].')','rel'=>'facebox')) ?></h8></td>
			<td  width='300px'><?php echo $bicicletareparamo['Bicicletareparamo']['detallereparacion']; ?>&nbsp;</td>
			<td>
				<center>
				<?php if($bicicletareparamo['Bicicletareparamo']['entregada'] == 0): ?>
					<?php echo $this->Form->input('estado'.$i,array('options'=>$str_estadossino,'onchange'=>'AgregarPago('.$i.')','label'=>false,'value'=>$bicicletareparamo['Bicicletareparamo']['entregada']))?>				
				<?php endif ?>
				
				</center>
			</td>
			<?php if($this->Session->read('tipousr') != 2): ?>
			<td>
					<?php 
						echo $this->Html->link('<button type="button" class="btn btn-primary btn-lw" title="Imprimir Ticket">
									<span class="glyphicon glyphicon-print"></span></button>','#',
							array('onclick'=>'return imprimirticked('.$bicicletareparamo['Bicicletareparamo']['id'].')','escape'=>false),
							'');
							
					?>
					<?php 
						echo $this->Html->link('<button type="button" class="btn btn-primary btn-lw" title="Agregar Mensaje de Mantenimiento">
									<span class="glyphicon glyphicon-envelope"></span></button>','#',
							array('onclick'=>'return AgregarAlertaMantenimiento('.$bicicletareparamo['Bicicletareparamo']['bicicleta_id'].')','escape'=>false),
							'');
					?>
					<?php 
						//echo $this->Html->link('<button type="button" class="btn btn-primary btn-lw" title="Ver Ubicacion">
						//			<span class="glyphicon glyphicon-map-marker"></span></button>',array('controller'=>'bicicletareparamos',
						//	'action'=>'mapsbicicletaentrega',$bicicletareparamo['Bicicletareparamo']['id']),
						//	array('onclick'=>'','escape'=>false),
						//	'');
					?>					
					<?php 
						//echo $this->Html->link('<button type="button" class="btn btn-danger btn-lw" title="Asignar Coordenadas">
						//			<span class="glyphicon glyphicon-map-marker"></span></button>',array('controller'=>'bicicletareparamos',
						//	'action'=>'getlocalize',$bicicletareparamo['Bicicletareparamo']['id']),
						//	array('onclick'=>'','escape'=>false),
						//	'');
					?>					
					
			</td>
			<?php 
			$i++;
			endif;?>
		</tr>
	<?php endforeach; ?>
	</tbody>
		<tfoot>
			<tr>
			<td colspan="7" class='row1'>
				<center>
						<?php 
							$paginador = $this->paginator->numbers(array(
								    'before' => '',
								    'separator' => '',
								    'currentClass' => 'active',
								    'tag' => 'li',
									 'currentTag' => 'a',
								    'after' => ''));
						?>				
						<div class="pagination">
							<?php if(!empty($paginador)): ?>
							<nav>
								<ul class="pagination">
  								  <li><?php echo $this->paginator->prev('<< ', null, null, array('class'=>'paginator'));?></li>
								  <li><?php echo $paginador;?></li>
								  <li><?php echo $this->paginator->next('>>', null, null, array('class'=>'paginator'));?></li>
								</ul>
							</nav>
						<?php endif;?>			
						</div>
				</center>
			</td>
			</tr>
		</tfoot>
	</table>
	</center>
</div>