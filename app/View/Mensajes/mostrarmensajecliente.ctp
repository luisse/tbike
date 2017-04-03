<?php echo $this->Html->script(array('mensajes/mostrarmensajecliente.js','fmensajes.js'),array('block'=>'scriptjs'));?>
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
	foreach ($mensajes as $mensaje):	
	?>
	<tr>
		<td><span class="label label-success"><?php echo  $mensaje['Bicicleta']['modelo'].'-'.$mensaje['Bicicleta']['marca'] ?></span></td>
		<td>
				<?php echo $this->Form->hidden('Mensaje.id'.$i,array('value'=>$mensaje['Mensaje']['id']));?>
				<?php echo $this->Time->format('d/m/Y',$mensaje['Mensaje']['fechasendauto']);; ?></td>
		<td><?php echo $mensaje['Mensaje']['detalle']; ?></td>
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
