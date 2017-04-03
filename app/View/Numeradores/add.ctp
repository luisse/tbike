<?php		echo $this->Html->script('fmensajes.js');
		 echo $this->element('botones_alta_mod',
	array('js_funcionalidad' => '/js/numeradores/numeradore_alta.js',
			'label_modelo' =>'Numeradore',
			'label_detalle'=>'Nuevo Numerador',
			'label_caja'=>'Detalles del Numerador',
			'controlador'=>'numeradores'))?>

<?php echo $this->Form->create('Numeradore',array('action'=>'add'));?>
<table class="admintable" cellspacing="1" width='100%' border='0'>
				<tr>
					<td class="key"><label for="name"><?php echo __('Detalle',true)?></label></td>
					<td><?php echo $this->Form->input('detalle',array('label'=>false,'class'=>'inputboxl','size'=>'45'))?></td>
					<td></td>
					<td></td>		
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __('Rango Desde',true)?></label></td>
					<td><?php echo $this->Form->input('rangodesde',array('label'=>false,'class'=>'inputboxl','size'=>'5'))?></td>
					<td></td>
					<td></td>		
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __('Rango Hasta',true)?></label></td>
					<td><?php echo $this->Form->input('rangohasta',array('label'=>false,'class'=>'inputboxl','size'=>'5'))?></td>
					<td></td>
					<td></td>		
				</tr>
</table>

<?php echo $this->Form->end();?>
<?php echo $this->element('fin_botones_alta_mod');?>
