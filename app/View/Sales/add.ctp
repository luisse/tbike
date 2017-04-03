<?php		echo $this->Html->script('fmensajes.js');
		 echo $this->element('botones_alta_mod',
	array('js_funcionalidad' => 'Sale_abm.js',
			'label_modelo' =>'Sale',
			'label_detalle'=>'Nuevo Sale',
			'label_caja'=>'Detalles del Sale',
			'controlador'=>'sales'))?><?php echo $this->Form->create('Sale',array('action'=>'add'));?>
<table class="admintable" cellspacing="1" width='100%' border='0'>
				<tr>
					<td class="key"><label for="name"><?php echo __('saledate',true)?></label></td>
					<td><?php echo $this->Form->input('saledate',array('label'=>false,'class'=>'inputboxl','size'=>'5'))?></td>
					<td></td>
					<td></td>		
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __('totalsale',true)?></label></td>
					<td><?php echo $this->Form->input('totalsale',array('label'=>false,'class'=>'inputboxl','size'=>'5'))?></td>
					<td></td>
					<td></td>		
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __('totaliva',true)?></label></td>
					<td><?php echo $this->Form->input('totaliva',array('label'=>false,'class'=>'inputboxl','size'=>'5'))?></td>
					<td></td>
					<td></td>		
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __('tipofactura',true)?></label></td>
					<td><?php echo $this->Form->input('tipofactura',array('label'=>false,'class'=>'inputboxl','size'=>'5'))?></td>
					<td></td>
					<td></td>		
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __('nrofactura',true)?></label></td>
					<td><?php echo $this->Form->input('nrofactura',array('label'=>false,'class'=>'inputboxl','size'=>'5'))?></td>
					<td></td>
					<td></td>		
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __('negocio_id',true)?></label></td>
					<td><?php echo $this->Form->input('negocio_id',array('label'=>false,'class'=>'inputboxl','size'=>'5'))?></td>
					<td></td>
					<td></td>		
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __('fecha',true)?></label></td>
					<td><?php echo $this->Form->input('fecha',array('label'=>false,'class'=>'inputboxl','size'=>'5'))?></td>
					<td></td>
					<td></td>		
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __('cliente_id',true)?></label></td>
					<td><?php echo $this->Form->input('cliente_id',array('label'=>false,'class'=>'inputboxl','size'=>'5'))?></td>
					<td></td>
					<td></td>		
				</tr>
</table>

<?php echo $this->Form->end();?>
<?php echo $this->element('fin_botones_alta_mod');?>
