<br/>
<?php //print_r($bicicletareparamos);?>
<center>
<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover dataTable table-responsive table-condensed" >
	<thead>
		<tr>
				<th tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1"  aria-label="Rendering engine: activate to sort column ascending"><div class='sort'><?php echo $this->Paginator->sort('fechaingreso','Ingreso');?></div></th>
				<th tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1"  aria-label="Rendering engine: activate to sort column ascending"><div class='sort'><?php echo $this->Paginator->sort('fechaegreso','Egreso');?></div></th>
				<th><div class='sort'><?php echo __('Bicicleta');?></div></th>
				<th><div class='sort'><?php echo __('Detalle Reparación');?></div></th>
				<th><?php echo __('Cliente')?></th>
				<th><div class='sort'><?php echo $this->Paginator->sort('estado','Estado');?></div></th>
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
			<td width='50px'><?php echo $this->Time->format('d/m/Y',$bicicletareparamo['Bicicletareparamo']['fechaingreso']); ?>&nbsp;</td>
			<td width='50px'><?php echo $this->Time->format('d/m/Y',$bicicletareparamo['Bicicletareparamo']['fechaegreso']); ?>&nbsp;</td>
			<td><h8>
						<?php
							echo $this->Html->link($bicicletareparamo['Bicicleta']['marca'].'-'.$bicicletareparamo['Bicicleta']['modelo'],'#',
								array('onclick'=>'return verImagen('.$bicicletareparamo['Bicicleta']['id'].')','rel'=>'facebox')) ?></h8></td>
			<td  width='300px'><?php echo $bicicletareparamo['Bicicletareparamo']['detallereparacion']; ?>&nbsp;</td>
			<td>
				<?php echo $this->Html->link( $bicicletareparamo['Cliente']['documento'].'-'.$bicicletareparamo['Cliente']['apellido'].', '.$bicicletareparamo['Cliente']['nombre'],'#',
							array('onclick'=>'return verCliente('.$bicicletareparamo['Cliente']['id'].')'))?>
			</td>
			<td>
				<center>
				<?php
					echo $this->Html->image($image,array('title'=>$title));
				?>
				</center>
			</td>
			<?php if($this->Session->read('tipousr') != 2): ?>
			<td>

					<div class="btn-group">
					  <a class="btn btn-primary" href="#"><i class="fa fa-plus-circle fa-fw"></i> </a>
					  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
						<span class="fa fa-caret-down"></span></a>
					  <ul class="dropdown-menu  dropdown-menu-right">
						<?php if($bicicletareparamo['Bicicletareparamo']['entregada'] == 0):?>
						<li>
								<?php
									echo $this->Html->link('<i class="fa fa-edit fa-fw"></i> Modificar',array('controller'=>'bicicletareparamos',
										'action'=>'edit',$bicicletareparamo['Bicicletareparamo']['id']),
										array('onclick'=>'','escape'=>false),'');
								?>
						</li>
						<li>
								<?php
									echo $this->Html->link('<i class="fa fa-trash-o fa-fw"></i> Borrar',array('controller'=>'bicicletareparamos',
										'action'=>'delete',$bicicletareparamo['Bicicletareparamo']['id']),
										array('onclick'=>"return confirm('¿Desea borrar el Ingreso al Taller seleccionado?')",'escape'=>false),'');?>
						</li>
						<li class="divider"></li>
						<?php endif;?>
						<li>
							<?php
								echo $this->Html->link('<i class="fa fa-print fa-fw"></i> Imprimir',array('controller'=>'bicicletareparamos',
									'action'=>'imprimircomprobante',$bicicletareparamo['Bicicletareparamo']['id']),
									array('onclick'=>'','escape'=>false),'');?>
						</li>
					  </ul>
					 </div>

			</td>
			<?php endif;?>
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
