<table class="table  table-striped  table-hover  table-condensed">
	<thead>
		<tr>
			<th>Ingreso</th>
			<th>Bicicleta</th>
			<th></th>
		</tr>
	</thead>
	<?php
	$i = 0;
	foreach ($bicicletareparamos as $bicicletareparamo):
	?>
	<tr>
		<td><?php echo $this->Time->format('d/m/Y H:m',$bicicletareparamo['Bicicletareparamo']['fechaingreso']);?></td>
		<td><?php echo $this->Html->link($bicicletareparamo['Bicicleta']['marca'].'-'.$bicicletareparamo['Bicicleta']['modelo'],'#',
							array('onclick'=>'return verBicicleta('.$bicicletareparamo['Bicicleta']['id'].')'))?>
		</td>	
		<?php if($this->Session->read('tipousr') != 2):?>
		<td>
					<?php 
						echo $this->Html->link('<button type="button" class="btn btn-info btn-lw" title="Actualizar Datos">
									<span class="glyphicon glyphicon-save"></span></button>',array('controller'=>'bicicletareparamos',
							'action'=>'edit',$bicicletareparamo['Bicicletareparamo']['id']),
							array('onclick'=>'','escape'=>false),
							'');
					?>
		</td>		
		<?php endif;?>
	</tr>
	<?php endforeach; ?>
</table>
