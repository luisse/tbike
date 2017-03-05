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
		foreach ($mensajesmantenimientos as $mensajesmantenimiento):
		if($fechaactual == $this->Time->format('Y-m-d',$mensajesmantenimiento['Mensajesmantenimiento']['fechacontrol']))
			$class='success';
		else
			$class='active';
		
		?>
		<tr  class="<?php echo $class?>">
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
			<td><?php echo $mensajesmantenimiento['Mensajesmantenimiento']['observaciones']; ?>&nbsp;</td>
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