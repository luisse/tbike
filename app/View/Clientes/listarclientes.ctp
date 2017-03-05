
<table class="table table-striped table-bordered table-hover dataTable table-responsive">
<thead>
	<tr>
			<th><div class='sort'><?php echo $this->Paginator->sort('documento',__('Id'));?></div></th>
			<th><div class='sort'><?php echo $this->Paginator->sort('apellido',__('Apellido'));?></div></th>
			<th><div class='sort'><?php echo $this->Paginator->sort('nombre',__('Nombre'));?></div></th>
			<th><div class='sort'><?php echo $this->Paginator->sort('fechanac',__('Telefono'));?></div></th>
			<th><?php echo __('Acciones');?></th>
	</tr>
</thead>
<tbody>
	<?php
	$i = 0;
	foreach ($clientes as $cliente):
	?>
	<tr>
		<td><?php echo $cliente['Cliente']['id'];
				echo $this->Form->hidden('Cliente.id'.$i,array('value'=>$cliente['Cliente']['id']));
				echo $this->Form->hidden('Cliente.Documento'.$i,array('value'=>$cliente['Cliente']['documento']));
				echo $this->Form->hidden('Cliente.NomApe'.$i,array('value'=>$cliente['Cliente']['apellido'].', '.$cliente['Cliente']['nombre']));
				echo $this->Form->hidden('Cuenta.id'.$i,array('value'=>$cliente['Cuenta']['id']));
				echo $this->Form->hidden('Cliente.telefono'.$i,array('value'=>$cliente['Cliente']['telefono']));
				echo $this->Form->hidden('Cliente.domicilio'.$i,array('value'=>$cliente['Cliente']['domicilio']));
		?>&nbsp;</td>
		<td><?php echo $cliente['Cliente']['apellido']; ?>&nbsp;</td>
		<td><?php echo $cliente['Cliente']['nombre']; ?>&nbsp;</td>
		<td><?php echo $cliente['Cliente']['telefono']; ?>&nbsp;</td>
		<td class="actions">
		<center>
				<button type="button" class="btn btn-primary btn-lw" title="Agregar Cliente" onclick='seleccionarcliente(<?php echo $i?>)'>
					<span class="glyphicon  glyphicon-plus"></span>
				</button>
		</center>
		</td>
	</tr>
<?php $i++;
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
</center>
