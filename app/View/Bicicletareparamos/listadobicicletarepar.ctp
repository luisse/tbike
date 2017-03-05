<!-- FIN BLOQUE BOTONES -->
<center>
<div class="table-responsive">
<table id="dataTables-example" class="table table-striped table-bordered table-hover dataTable table-responsive  table-condensed" >
<thead>
	<tr>
			<th><?php echo __('Ingresos en Taller');?></th>
			<th><?php echo __('Estado');?></th>
			<th><?php echo __('Acciones');?></th>
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
	<tr class="<?php echo $class?>">
		<td>
		<table class="admintable" cellspacing="1" width='90%' border='0'>
				<tr>
					<td class="key"><label for="name"><?php echo __('Fecha Ingreso',true)?></label></td>
					<td> <?php echo $this->Form->hidden('bicicletareparamoid'.$i,array('value'=>$bicicletareparamo['Bicicletareparamo']['id']))?>
							<?php echo $this->Form->hidden('bicicletaid'.$i,array('value'=>$bicicletareparamo['Bicicleta']['id']))?>
							<?php echo $this->Time->format('d/m/Y',$bicicletareparamo['Bicicletareparamo']['fechaingreso']);?></td>
					<td class="key"><label for="name"><?php echo __('Detalle Reparación',true)?></label></td>
					<td width='360px'><?php echo $bicicletareparamo['Bicicletareparamo']['detallereparacion']?></td>
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __('Fecha Entrega',true)?></label></td>
					<td><?php echo $this->Time->format('d/m/Y',$bicicletareparamo['Bicicletareparamo']['fechaegreso']);?></td>
					<?php if($bicicletareparamo[0]['cantmensajes']>0)
								$class = 'label-danger';
							else
								$class = 'label-success';
							?>
					<td><label>Mensajes</label></td>
					<td>
					<?php echo $this->Html->link('<h4><span class="label '.$class.'"><i class="fa fa-envelope fa-fw"></i> '.$bicicletareparamo[0]['cantmensajes'].'</span></h4>','#',
							array('onclick'=>'return verMensajes('.$bicicletareparamo['Bicicleta']['id'].')','escape'=>false))?>
					</td>
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __('Cliente',true)?></label></td>
					<td><?php echo $this->Html->link( $bicicletareparamo['Cliente']['documento'].'-'.$bicicletareparamo['Cliente']['apellido'].', '.$bicicletareparamo['Cliente']['nombre'],'#',
							array('onclick'=>'return verCliente('.$bicicletareparamo['Cliente']['id'].')'))?></td>
					<td class="key"><label for="name"></label></td>
					<td></td>
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __('Bicicleta')?></label></td>
					<td><?php echo $this->Html->link($bicicletareparamo['Bicicleta']['marca'].'-'.$bicicletareparamo['Bicicleta']['modelo'],'#',
							array('onclick'=>'return verImagen('.$bicicletareparamo['Bicicleta']['id'].')','rel'=>'facebox'))?>
					</td>
					<td></td>
					<td></td>
				</tr>
		</table>
		</td>
		<td>
				<?php echo $this->Form->input('estado'.$i,array('options'=>$str_estados,'onchange'=>'cambiarestado('.$i.')','label'=>false,'value'=>$bicicletareparamo['Bicicletareparamo']['estado']))?>
		</td>
		<td>
					<div class="btn-group">
					  <a class="btn btn-primary" href="#"><i class="fa fa-plus-circle fa-fw"></i> </a>
					  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
						<span class="fa fa-caret-down"></span></a>
					  <ul class="dropdown-menu  dropdown-menu-right">
						<?php if($bicicletareparamo['Bicicletareparamo']['entregada'] == 0):?>
						<li>
							<?php echo $this->Html->link('<i class="fa fa-edit fa-fw"></i> Modificar',array('controller'=>'bicicletareparamos',
							'action'=>'edit',$bicicletareparamo['Bicicletareparamo']['id']),
							array('onclick'=>'','escape'=>false),'');?>
						</li>
						<li class="divider"></li>
						<li>
								<?php
								echo $this->Html->link('<i class="fa fa-print fa-fw"></i> Imprimir',array('controller'=>'bicicletareparamos',
								'action'=>'imprimiringresotaller',$bicicletareparamo['Bicicletareparamo']['id']),
								array('onclick'=>'','escape'=>false),'');?>
						</li>
						<?php endif;?>
					  </ul>
					 </div>
		</td>
	</tr>
<?php
	$i++;
	endforeach; ?>
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
</div>
</center>
