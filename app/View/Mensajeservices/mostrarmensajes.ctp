<?php echo $this->element('modalboxcabecera',array('title'=>'Mensaje de Servivio Técnico','paneltipo'=>'panel-primary'));?>
<table class="table table-striped table-bordered table-hover dataTable table-responsive">
<thead>
	<tr>
			<th><?php echo __('Fecha Envío');?></th>			
			<th><?php echo __('Mensaje');?></th>
			<th><?php echo __('Enviar Correo');?></th>
			<th><?php echo __('Confirmado Cliente');?></th>
	</tr>
</thead>
<tbody>
	<?php
	foreach ($mensajeservices as $mensajeservice):
	?>
	<tr class="active">
		<td><?php echo $this->Time->format('d/m/Y',$mensajeservice['Mensajeservice']['fechaaprox']); ?></td>
		<td><?php echo $mensajeservice['Mensajeservice']['detalleservice']; ?></td>
		<td><?php if($mensajeservice['Mensajeservice']['enviarcorreo']==1)
							echo __('Si');
						else
							echo __('NO');?></td>
		<td><?php if($mensajeservice['Mensajeservice']['confirmadocliente']==0)
							echo __('No');
						else
							echo __('Si');?></td>
	</tr>
	<?php endforeach; ?>
</tbody>
</table>
<?php echo $this->element('modalboxpie'); ?>
