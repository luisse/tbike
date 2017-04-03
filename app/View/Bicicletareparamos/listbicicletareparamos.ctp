<br/>
<div class="table-responsive">
<center>
	<table id="dataTables-example" class="table table-striped table-bordered table-hover dataTable table-responsive" >
	<thead>
		<tr>
				<th tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1"  aria-label="Rendering engine: activate to sort column ascending"><div class='sort'><?php echo $this->Paginator->sort('fechaingreso','Ingreso');?></div></th>
				<th tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1"  aria-label="Rendering engine: activate to sort column ascending"><div class='sort'><?php echo $this->Paginator->sort('fechaegreso','Egreso');?></div></th>
				<th><div class='sort'><?php echo __('Bicicleta');?></div></th>
				<th><div class='sort'><?php echo __('Cliente');?></div></th>			
				<th><div class='sort'><?php echo __('Detalle Reparación');?></div></th>
				<th><div class='sort'><?php echo $this->Paginator->sort('estado','Estado');?></div></th>
				<th><?php __('Acciones');?></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i = 0;
		foreach ($bicicletareparamos as $bicicletareparamo):
								switch($bicicletareparamo['Bicicletareparamo']['estado']){
				case 0:
					echo
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
			<td><?php  echo $this->Html->link( $bicicletareparamo['Cliente']['documento'].'-'.$bicicletareparamo['Cliente']['nomape'],'#',
								array('onclick'=>'return verCliente('.$bicicletareparamo['Cliente']['id'].')'))?></td>		
			<td  width='300px'><?php echo $bicicletareparamo['Bicicletareparamo']['detallereparacion']; ?>&nbsp;</td>
			<td>
					<center>
				<?php 
					$this->Html->image($image,array('title'=>$title));
				?>
					</center>
			<td class="actions">
			<center>
			<div class="btn-group">
						<?php 
							echo $this->Html->link('<button type="button" class="btn btn-primary btn-lw" title="Imprimir Ticket">
										<span class="glyphicon glyphicon-print"></span></button>',array('controller'=>'bicicletareparamos',
								'action'=>'imprimircomprobante',$bicicletareparamo['Bicicletareparamo']['id']),
								array('onclick'=>'','escape'=>false),
								'');
						?>
						<?php 
							echo $this->Html->link('<button type="button" class="btn btn-info btn-lw" title="Modificar Datos">
										<span class="glyphicon glyphicon-save"></span></button>',array('controller'=>'bicicletareparamos',
								'action'=>'edit',$bicicletareparamo['Bicicletareparamo']['id']),
								array('onclick'=>'','escape'=>false),
								'');
						?>
						<?php
							echo $this->Html->link('<button type="button" class="btn btn-danger btn-lw" title="Borrar Ingreso">
																		<span class="glyphicon  glyphicon-remove-circle"></span></button>',array('controller'=>'bicicletareparamos',
											'action'=>'delete',$bicicletareparamo['Bicicletareparamo']['id']),
											array('onclick'=>"return confirm('¿Desea borrar el Ingreso al Taller seleccionado?')",'escape'=>false),
						'');?>
			</div>
			</center>
			</td>
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