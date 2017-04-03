<?php echo $this->element('modalboxcabecera',array('title'=>'Alertas de Servivio Técnico','paneltipo'=>'panel-primary'));?>
<?php echo $this->element('flash_message')?>
<div class="table table-striped table-bordered table-hover dataTable table-responsive">
	<table class='table'>
	<thead>
		<tr>
				<th><?php echo __('Fecha de Alerta');?></th>
				<th><?php echo __('Revisar');?></th>
				<th><?php echo __('Observaciones');?></th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($mensajesmantenimientos as $mensajesmantenimiento):
		?>
		<tr  class="active">
			<td><?php echo  $this->Time->format('d/m/Y',$mensajesmantenimiento['Mensajesmantenimiento']['fechacontrol']); ?>&nbsp;</td>
			<td><?php echo $mensajesmantenimiento['Mensajesmantenimiento']['objetorevisar']; ?>&nbsp;</td>
			<td><?php echo $mensajesmantenimiento['Mensajesmantenimiento']['observaciones']; ?>&nbsp;</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
</div>