<?php		echo $this->Html->script('fmensajes.js');
		 echo $this->element('botones_alta_mod',
	array('js_funcionalidad' => 'Mensajeservice_abm.js',
			'label_modelo' =>'Mensajeservice',
			'label_detalle'=>'Nuevo Mensajeservice',
			'label_caja'=>'Detalles del Mensajeservice',
			'controlador'=>'mensajeservices'))?><?php echo $this->Form->create('Mensajeservice',array('action'=>'edit'));?>
<table class="admintable" cellspacing="1" width='100%' border='0'>
				<tr>
					<td class="key"><label for="name"><?php echo __('id',true)?></label></td>
					<td><?php echo $this->Form->input('id',array('label'=>false,'class'=>'inputboxl','size'=>'5'))?></td>
					<td></td>
					<td></td>		
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __('detalleservice',true)?></label></td>
					<td><?php echo $this->Form->input('detalleservice',array('label'=>false,'class'=>'inputboxl','size'=>'5'))?></td>
					<td></td>
					<td></td>		
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __('enviarcorreo',true)?></label></td>
					<td><?php echo $this->Form->input('enviarcorreo',array('label'=>false,'class'=>'inputboxl','size'=>'5'))?></td>
					<td></td>
					<td></td>		
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __('cantmensajes',true)?></label></td>
					<td><?php echo $this->Form->input('cantmensajes',array('label'=>false,'class'=>'inputboxl','size'=>'5'))?></td>
					<td></td>
					<td></td>		
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __('fechaaprox',true)?></label></td>
					<td><?php echo $this->Form->input('fechaaprox',array('label'=>false,'class'=>'inputboxl','size'=>'5'))?></td>
					<td></td>
					<td></td>		
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __('bicicleta_id',true)?></label></td>
					<td><?php echo $this->Form->input('bicicleta_id',array('label'=>false,'class'=>'inputboxl','size'=>'5'))?></td>
					<td></td>
					<td></td>		
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __('confirmadocliente',true)?></label></td>
					<td><?php echo $this->Form->input('confirmadocliente',array('label'=>false,'class'=>'inputboxl','size'=>'5'))?></td>
					<td></td>
					<td></td>		
				</tr>
</table>

<?php echo $this->Form->end();?>
<?php echo $this->element('fin_botones_alta_mod');?>
