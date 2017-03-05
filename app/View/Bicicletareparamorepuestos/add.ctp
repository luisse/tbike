<?php		echo $this->Html->script('fmensajes.js');
		 echo $this->element('botones_alta_mod',
	array('js_funcionalidad' => 'Bicicletareparamorepuesto_abm.js',
			'label_modelo' =>'Bicicletareparamorepuesto',
			'label_detalle'=>'Nuevo Bicicletareparamorepuesto',
			'label_caja'=>'Detalles del Bicicletareparamorepuesto',
			'controlador'=>'bicicletareparamorepuestos'))?><?php echo $this->Form->create('Bicicletareparamorepuesto',array('action'=>'add'));?>
<table class="admintable" cellspacing="1" width='100%' border='0'>
				<tr>
					<td class="key"><label for="name"><?php echo __('repuestodescr',true)?></label></td>
					<td><?php echo $this->Form->input('repuestodescr',array('label'=>false,'class'=>'inputboxl','size'=>'5'))?></td>
					<td></td>
					<td></td>		
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __('precio',true)?></label></td>
					<td><?php echo $this->Form->input('precio',array('label'=>false,'class'=>'inputboxl','size'=>'5'))?></td>
					<td></td>
					<td></td>		
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __('cantidad',true)?></label></td>
					<td><?php echo $this->Form->input('cantidad',array('label'=>false,'class'=>'inputboxl','size'=>'5'))?></td>
					<td></td>
					<td></td>		
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __('aceptado',true)?></label></td>
					<td><?php echo $this->Form->input('aceptado',array('label'=>false,'class'=>'inputboxl','size'=>'5'))?></td>
					<td></td>
					<td></td>		
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __('bicicletareparamo_id',true)?></label></td>
					<td><?php echo $this->Form->input('bicicletareparamo_id',array('label'=>false,'class'=>'inputboxl','size'=>'5'))?></td>
					<td></td>
					<td></td>		
				</tr>
</table>

<?php echo $this->Form->end();?>
<?php echo $this->element('fin_botones_alta_mod');?>
