<!-- FIN BLOQUE BOTONES -->
<center>
<table class="table table-striped table-bordered table-hover dataTable table-responsive" >
<thead>
	<tr>
			<th><div class='sort'><?php echo __('Fecha Ingreso');?></div></th>
			<th><div class='sort'><?php echo __('Detalle de Reparación');?></div></th>
			<th><div class='sort'><?php echo __('Mecanico');?></div></th>
			<th><div class='sort'><?php echo __('Dias - Horas');?></div></th>
	</tr>
</thead>
<tbody>
	<?php
	foreach ($bicicletareparamos as $bicicletareparamo):
	?>
	<tr  class="active">
		<td width='50px'><?php echo $this->Time->format('d/m/Y',$bicicletareparamo['Bicicletareparamo']['fechaingreso']); ?>&nbsp;</td>
		<td  width='400px'><?php echo $bicicletareparamo['Bicicletareparamo']['detallereparacion']; ?>&nbsp;</td>
		<td width='50px'  align='center'><?php echo $bicicletareparamo['User']['username']?></td>
		<td width='40px' align='center'><h4><span class="label label-success"><?php echo $bicicletareparamo[0]['Dias'].' Días '.str_pad($bicicletareparamo[0]['Horas'],2,'0',STR_PAD_LEFT).':'.str_pad($bicicletareparamo[0]['Minutos'],2,'0',STR_PAD_LEFT)?></span></h4></td>
	</tr>
<?php endforeach; ?>
</table>
</center>