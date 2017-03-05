<?php echo $this->Html->script(array('mensajeservices/mostrarmensajecliente.js','fmensajes.js'),array('block'=>'scriptjs'));?>
<table class='table'>
<thead>
	<tr>
			<th><?php echo __('Bicicleta')?></th>
			<th><?php echo __('Fecha del Mensaje');?></th>			
			<th><?php echo __('Mensaje');?></th>
			<th><?php echo __('Confirmar');?></th>
	</tr>
</thead>
<tbody>
	<?php
	$i = 0;
	foreach ($mensajeservices as $mensajeservice):
	
	?>
	<tr>
		<td><span class="label label-success"><?php echo  $mensajeservice['Bicicleta']['modelo'].'-'.$mensajeservice['Bicicleta']['marca'] ?></span></td>
		<td>
				<?php echo $this->Form->hidden('Mensajeservice.id'.$i,array('value'=>$mensajeservice['Mensajeservice']['id']));?>
				<?php echo $this->Time->format('d/m/Y',$mensajeservice['Mensajeservice']['fechaaprox']);; ?></td>
		<td><?php echo $mensajeservice['Mensajeservice']['detalleservice']; ?></td>
		<td><?php 
						echo $this->Html->link('<button type="button" class="btn btn-info btn-lw" title="Confirmar Mensaje" id="confirmar">
									<span class="glyphicon glyphicon glyphicon-ok"></span> Confirmar</button>','#',
							array('onclick'=>'confirmarmensaje('.$i.')','escape'=>false),
							'');
				?>

		
		</td>
	</tr>
	<?php 
	$i++;
	endforeach; ?>
</tbody>
</table>
<?php echo $this->element('mensajealerta',array('title'=>__('Mensajes'),'buttondesc'=>' Cerrar'))?>	
