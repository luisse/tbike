<?php echo $this->element('modalboxcabecera',array('title'=>'Alertas de Servivio Técnico','paneltipo'=>'panel-primary'));?>
<div class="table-responsive">
	<table class='table'>
	<thead>
		<tr>
				<th><?php echo $this->Paginator->sort('fechaaprox');?></th>
				<th><?php echo __('detalleservice');?></th>
				<th><?php echo $this->Paginator->sort('enviarcorreo');?></th>
				<th><?php echo $this->Paginator->sort('cantmensajes');?></th>

				<th><?php echo $this->Paginator->sort('confirmadocliente');?></th>
				<th><?php __('Acciones');?></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i = 0;
		foreach ($mensajeservices as $mensajeservice):
			$class = "row0";
			if ($i++ % 2 == 0) {
				$class = ' class="row1"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $mensajeservice['Mensajeservice']['id']; ?>&nbsp;</td>
			<td><?php echo $mensajeservice['Mensajeservice']['detalleservice']; ?>&nbsp;</td>
			<td><?php echo $mensajeservice['Mensajeservice']['enviarcorreo']; ?>&nbsp;</td>
			<td><?php echo $mensajeservice['Mensajeservice']['cantmensajes']; ?>&nbsp;</td>
			<td><?php echo $mensajeservice['Mensajeservice']['fechaaprox']; ?>&nbsp;</td>
			<td><?php echo $mensajeservice['Mensajeservice']['bicicleta_id']; ?>&nbsp;</td>
			<td><?php echo $mensajeservice['Mensajeservice']['confirmadocliente']; ?>&nbsp;</td>
			<td class="actions">
			<center>
			<div>
			<?php 
							echo $this->Html->link($this->Html->image('edit.png',array('title'=>__('Editar',true))),array('controller'=>'mensajeservices',
								'action'=>'edit',$mensajeservice['mensajeservice']['id']),
								array('onclick'=>'','escape'=>false),
								'');
						?>
						&nbsp;
						<?php
							echo $this->Html->link($this->Html->image('delete.gif',array('title'=>__('Borrar Cedente',true))),array('controller'=>'mensajeservices',
											'action'=>'borrar',$mensajeservice['mensajeservice']['id']),
											array('onclick'=>"return confirm('¿Desea borrar el Cedente seleccionado?')",'escape'=>false),
						'');?>		</div>
			</center>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>
<?php echo $this->element('modalboxpie'); ?>