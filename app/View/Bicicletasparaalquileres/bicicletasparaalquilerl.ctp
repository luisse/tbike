<!-- FIN BLOQUE BOTONES -->
<?php if(!empty($bicicletas)): ?>
<center>
<div class="table-responsive">
	<table id="bicicletas" class="table table-striped table-bordered table-hover dataTable no-footer table-responsive" aria-describedby="dataTables-example_info">
	<thead>
		<tr>
				<th><?= __('Marca');?></th>
				<th><?= __('Modelo');?></th>
				<th><?= __('Detalles');?></th>
				<th><?= __('Equipamiento');?></th>
				<th><?= __('Nro de Cuadro');?></th>
				<th><?= __('Acciones');?></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i = 0;
		foreach ($bicicletas as $bicicleta):
		$i++;
		?>
			<tr>
			<td><?= $bicicleta['Bicicleta']['marca']; ?>&nbsp;</td>
			<td><?= $bicicleta['Bicicleta']['modelo']; ?>&nbsp;</td>
			<td><?= $bicicleta['Bicicleta']['detalles']; ?>&nbsp;</td>
			<td><?= $bicicleta['Bicicleta']['equipodetalle']; ?>&nbsp;</td>
			<td><?= $bicicleta['Bicicleta']['nrocuadro']; ?>&nbsp;</td>
			<!-- <td> <img alt="Embedded Image" src="<?= $bicicleta['Bicicleta']['imagen'] ?> "/></td> -->
			<td class="actions">
			<center>
			<div>
				&nbsp;
				<?= '<button type="button" class="btn btn-success btn-circle btn-sm" title="Agregar Bicicleta" onclick="selBicicleta('.$bicicleta['Bicicletasparaalquilere']['id'].',row)">
										<i class="fa fa-check"></i></button>';
				?>
			</div>
			</center>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
</div>
</center>
<?= $this->Form->hidden('totalbikes',array('value'=>$i)); ?>
<?php else: ?>
	<div class="alert alert-warning" role="alert">
		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		<strong><?= __('Advertencia!')?></strong>&nbsp;<?= 'No se encontraron bicicletas asociadas para el cliente'; ?></div>
	</div>
<?php endif ?>
