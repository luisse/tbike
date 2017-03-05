<?php		echo $this->Html->script('fmensajes.js');
		 echo $this->element('botones_alta_mod',
	array('js_funcionalidad' => 'Salesdetail_abm.js',
			'label_modelo' =>'Salesdetail',
			'label_detalle'=>'Nuevo Salesdetail',
			'label_caja'=>'Detalles del Salesdetail',
			'controlador'=>'salesdetails'))?><?php echo $this->Form->create('Salesdetail',array('action'=>'edit'));?>
<table class="admintable" cellspacing="1" width='100%' border='0'>
				<tr>
					<td class="key"><label for="name"><?php echo __('cantidad',true)?></label></td>
					<td><?php echo $this->Form->input('cantidad',array('label'=>false,'class'=>'inputboxl','size'=>'5'))?></td>
					<td></td>
					<td></td>		
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __('subtotal',true)?></label></td>
					<td><?php echo $this->Form->input('subtotal',array('label'=>false,'class'=>'inputboxl','size'=>'5'))?></td>
					<td></td>
					<td></td>		
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __('id',true)?></label></td>
					<td><?php echo $this->Form->input('id',array('label'=>false,'class'=>'inputboxl','size'=>'5'))?></td>
					<td></td>
					<td></td>		
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __('sales_id',true)?></label></td>
					<td><?php echo $this->Form->input('sales_id',array('label'=>false,'class'=>'inputboxl','size'=>'5'))?></td>
					<td></td>
					<td></td>		
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __('products_id',true)?></label></td>
					<td><?php echo $this->Form->input('products_id',array('label'=>false,'class'=>'inputboxl','size'=>'5'))?></td>
					<td></td>
					<td></td>		
				</tr>
</table>

<?php echo $this->Form->end();?>
<?php echo $this->element('fin_botones_alta_mod');?>
