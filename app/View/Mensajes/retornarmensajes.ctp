<?php $fechaactual = date('Y-m-d');?>
<div  class="table  table-striped  table-hover  table-condensed">
	<table class='table table-striped  table-hover  table-condensed'>
	<thead>
		<tr>
				<th><?php echo __('Fecha de Alerta');?></th>
				<th><?php echo __('Bicicleta')?>
				<th><?php echo __('Cliente')?>
				<th><?php echo __('Observaciones');?></th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($mensajes as $mensaje):
		if($fechaactual == $this->Time->format('Y-m-d',$mensaje['Mensaje']['fechasendauto']))
			$class='success';
		else
			$class='active';
		
		?>
		<tr  class="<?php echo $class?>">
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
			<td><?php echo $mensaje['Mensaje']['detalle']; ?>&nbsp;</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</tbody>
	<tfoot>
		<tr>
		<td colspan="7" class='row1'>
			<?php 
			$paginador = $this->paginator->numbers();
			if(!empty($paginador)): ?>
				<center>
				<ul class="pagination">
				  <li><?php echo $this->paginator->prev('<< ', null, null, array('class'=>'paginator'));?></li>
				  <li><?php echo $this->paginator->numbers(array('separator'=>''));?></li>
				  <li><?php echo $this->paginator->next('>>', null, null, array('class'=>'paginator'));?></li>
				</ul>	
				</center>
			<?php endif;?>
		</td>
		</tr>
	</tfoot>
	</table>
</div>