<div class="table table-striped table-bordered table-hover dataTable table-responsive table-condensed">
	<table class='table'>
	<thead>
		<tr>
				<th><?php echo __('Fecha de Alerta');?></th>
				<th><?php echo __('Bicicleta')?>
				<th><?php echo __('Cliente')?>
				<th><?php echo __('Revisar');?></th>
				<th><?php echo __('Observaciones');?></th>
				<th><?php echo __('Acciones')?>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($mensajes as $mensaje):
		?>
		<tr  class="active">
			<td><?php echo  $this->Time->format('d/m/Y',$mensaje['Mensaje']['fechasendauto']); ?>&nbsp;</td>
			<td><h8><?php
							echo $this->Html->link($mensaje['Bicicleta']['marca'].'-'.$mensaje['Bicicleta']['modelo'],'#',
								array('onclick'=>'return verBicicleta('.$mensaje['Bicicleta']['id'].')','rel'=>'facebox')) ?></h8>
			</td>
			<td>
				<h8><?php
							echo $this->Html->link($mensaje['Cliente']['apellido'].', '.$mensaje['Cliente']['nombre'],'#',
								array('onclick'=>'return verCliente('.$mensaje['Cliente']['id'].')','rel'=>'facebox')) ?></h8>
			</td>
			<td><?php echo $mensaje['Mensaje']['asunto']; ?>&nbsp;</td>
			<td><?php echo $mensaje['Mensaje']['detalle']; ?>&nbsp;</td>
			<td width='100px'>
					<div class="btn-group">
					  <a class="btn btn-primary" href="#"><i class="fa fa-plus-circle fa-fw"></i> </a>
					  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
						<span class="fa fa-caret-down"></span></a>
					  <ul class="dropdown-menu  dropdown-menu-right">
						<li>
								<?php
								echo $this->Html->link('<i class="fa fa-edit fa-fw"></i> Modificar',array('controller'=>'mensajes',
									'action'=>'edit',$mensaje['Mensaje']['id']),
									array('onclick'=>'','escape'=>false),'');
								?>
						</li>
						<li>
								<?php
									echo $this->Html->link('<i class="fa fa-trash-o fa-fw"></i> Borrar',array('controller'=>'mensajes',
										'action'=>'delete',$mensaje['Mensaje']['id']),
										array('onclick'=>"return confirm('¿Desea Borrar el Mensaje Seleccionado?')",'escape'=>false),'');
								?>
						</li>
					  </ul>
				 </div>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
</div>
