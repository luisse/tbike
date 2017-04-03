<!-- FIN BLOQUE BOTONES -->
<?php if(!empty($bicicletas)): ?>
<center>
<div class="table-responsive">
	<table id="bicicletas" class="table table-striped table-bordered table-hover dataTable no-footer table-responsive" aria-describedby="dataTables-example_info">
	<thead>
		<tr>
				<th><?php echo __('Sel');?></th>
				<th><?php echo __('Marca');?></th>
				<th><?php echo __('Modelo');?></th>
				<th><?php echo __('Detalles');?></th>
				<th><?php echo __('Equipamiento');?></th>
				<th><?php echo __('Nro de Cuadro');?></th>
				<th><?php echo __('Acciones');?></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i = 0;
		foreach ($bicicletas as $bicicleta):
		$i++;
		?>
			<tr>
			<td><?php echo $this->Form->input('bicicleta_id'.$i,array('type'=>'hidden','value'=>$bicicleta['Bicicleta']['id']))?>
					<?php echo $this->Form->checkbox('sel'+$i,array('onchange'=>'marcasel('.$i.')','id'=>'sel'.$i))?></td>
			<td><?php echo $bicicleta['Bicicleta']['marca']; ?>&nbsp;</td>
			<td><?php echo $bicicleta['Bicicleta']['modelo']; ?>&nbsp;</td>
			<td><?php echo $bicicleta['Bicicleta']['detalles']; ?>&nbsp;</td>
			<td><?php echo $bicicleta['Bicicleta']['equipodetalle']; ?>&nbsp;</td>
			<td><?php echo $bicicleta['Bicicleta']['nrocuadro']; ?>&nbsp;</td>
			<!-- <td><img alt="Embedded Image" src="data:image/png;base64,<?php echo base64_decode($bicicleta['Bicicleta']['imagen']); ?> "/></td> -->
			<td class="actions">
			<center>
			<div>
				&nbsp;
				<?php
					echo '<button type="button" class="btn btn-primary btn-lw" title="Ver Imagen" onclick="selBicicleta('.$bicicleta['Bicicleta']['id'].','.$i.')">
										<span class="glyphicon glyphicon-camera"></span></button>';
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
<?php echo $this->Form->hidden('totalbikes',array('value'=>$i)); ?>
<?php else: ?>
	<div class="alert alert-warning" role="alert">
		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		<strong><?php echo __('Advertencia!')?></strong>&nbsp;<?php echo 'No se encontraron bicicletas asociadas para el cliente'; ?></div>
	</div>
<?php endif ?>
