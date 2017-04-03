<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Clientes del Sistema</div>
  <div class="panel-body"></div>
  
	<table cellspacing="1" width='100%'  class="table  table-striped">
	<thead>
		<tr>
				<th><?php echo __('#');?></th>
				<th><?php echo __('Documento');?></th>
				<th><?php echo __('Fec. Nac.');?></th>
				<th><?php echo __('Nombre');?></th>
				<th><?php echo __('Apellido');?></th>
				<th><?php echo __('Telefono');?></th>
				<th><?php echo __('Domicilio');?></th>
				<th><?php echo __('Acciones');?></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i = 0;
		foreach ($clientes as $cliente):
			$class = "row0";
			if ($i++ % 2 == 0) {
				$class = ' class="row1"';
			}
		?>
		<tr>
			<td><?php echo $cliente['Cliente']['id']; ?>&nbsp;</td>
			<td><?php echo $cliente['Cliente']['documento']; ?>&nbsp;</td>
			<td><?php echo $cliente['Cliente']['fechanac']; ?>&nbsp;</td>
			<td><?php echo $cliente['Cliente']['nombre']; ?>&nbsp;</td>
			<td><?php echo $cliente['Cliente']['apellido']; ?>&nbsp;</td>
			<td><?php echo $cliente['Cliente']['telefono']; ?>&nbsp;</td>
			<td><?php echo $cliente['Cliente']['domicilio']; ?>&nbsp;</td>
			<td>
			<?php 
							echo $this->Html->link('<button type="button" class="btn btn-default btn-lg" title="Modificar Datos">
								<span class="glyphicon glyphicon-save"></span></button>',array('controller'=>'clientes',
								'action'=>'edit',$cliente['Cliente']['id']),
								array('onclick'=>'','escape'=>false),
								'');
						?>
						&nbsp;
						<?php
							echo $this->Html->link('<button type="button" class="btn btn-default btn-lg" title="Borrar Cliente">
																<span class="glyphicon  glyphicon-remove-circle"></span></button>',
																array('controller'=>'clientes','action'=>'borrar',$cliente['Cliente']['id']),
											array('onclick'=>"return confirm('¿Desea borrar el Cedente seleccionado?')",'escape'=>false),
						'');?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
		<tfoot>
			<tr>
			<td colspan="7" class='row1'>
				<?php echo $this->paginator->prev('<< '.__('Antetior', true), null, null, array('class'=>'paginator'));?>
				<?php echo $this->paginator->numbers();?>
				<?php echo $this->paginator->next(__('Siguiente', true).' >>', null, null, array('class'=>'paginator'));?>
			</td>
			</tr>
		</tfoot>
	</table>
</div>