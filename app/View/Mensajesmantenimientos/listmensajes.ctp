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
		foreach ($mensajesmantenimientos as $mensajesmantenimiento):
		?>
		<tr  class="active">
			<td><?php echo  $this->Time->format('d/m/Y',$mensajesmantenimiento['Mensajesmantenimiento']['fechacontrol']); ?>&nbsp;</td>
			<td><h8><?php 
							echo $this->Html->link($mensajesmantenimiento['Bicicleta']['marca'].'-'.$mensajesmantenimiento['Bicicleta']['modelo'],'#',
								array('onclick'=>'return verBicicleta('.$mensajesmantenimiento['Bicicleta']['id'].')','rel'=>'facebox')) ?></h8>
			</td>
			<td>
				<h8><?php
							echo $this->Html->link($mensajesmantenimiento['Cliente']['apellido'].', '.$mensajesmantenimiento['Cliente']['nombre'],'#',
								array('onclick'=>'return verCliente('.$mensajesmantenimiento['Cliente']['id'].')','rel'=>'facebox')) ?></h8>
			</td>			
			<td><?php echo $mensajesmantenimiento['Mensajesmantenimiento']['objetorevisar']; ?>&nbsp;</td>
			<td><?php echo $mensajesmantenimiento['Mensajesmantenimiento']['observaciones']; ?>&nbsp;</td>
			<td width='100px'>
					<div class="btn-group">
					  <a class="btn btn-primary" href="#"><i class="fa fa-plus-circle fa-fw"></i> </a>
					  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
						<span class="fa fa-caret-down"></span></a>
					  <ul class="dropdown-menu">
						<li>
								<?php 
								echo $this->Html->link('<i class="fa fa-edit fa-fw"></i> Modificar',array('controller'=>'mensajesmantenimientos',
									'action'=>'edit',$mensajesmantenimiento['Mensajesmantenimiento']['id']),
									array('onclick'=>'','escape'=>false),'');								
								?>
						</li>
						<li>
								<?php
								echo $this->Html->link('<i class="fa fa-trash-o fa-fw"></i> Borrar',array('controller'=>'mensajesmantenimientos',
										'action'=>'delete',$mensajesmantenimiento['Mensajesmantenimiento']['id']),
										array('onclick'=>"return confirm('¿Desea Borrar el Mensaje Seleccionado?')",'escape'=>false),'');?>
						</li>
					  </ul>
				 </div>		
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
</div>