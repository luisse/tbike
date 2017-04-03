<?php echo $this->element('modalboxcabecera',array('title'=>'Mensajes Enviados','paneltipo'=>'panel-primary'));?>
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
	foreach ($mensajes as $mensaje):
	?>
	<tr class="active">
		<td><?php echo $this->Time->format('d/m/Y',$mensaje['Mensaje']['fechasendauto']); ?></td>
		<td><?php echo $mensaje['Mensaje']['detalle']; ?></td>
		<td><?php if($mensaje['Mensaje']['mailauto']==1)
							echo __('Si');
						else
							echo __('NO');?></td>
		<td><?php if($mensaje['Mensaje']['confirmadocliente']==0)
							echo __('No');
						else
							echo __('Si');?></td>
	</tr>
	<?php endforeach; ?>
</tbody>
</table>
<?php echo $this->element('modalboxpie'); ?>
