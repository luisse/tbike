<?php	echo $this->Html->script('fmensajes.js');
		echo $this->Html->script('fgenerales.js');
		echo $this->Html->script('jquery.validation.js');
		echo $this->element('botones_alta_mod',
	array('js_funcionalidad' => 'users/addusrneg.js',
			'label_modelo' =>'Usuario',
			'label_detalle'=>'Alda de Usuario',
			'label_caja'=>'Detalles de Usuario',
			'controlador'=>'users'))?>
<?php echo $this->Form->create('User',array('action'=>'addusrneg'));?>
<table class="admintable" cellspacing="1" width='100%' border='0'>
				<tr>
					<td class="key"><label for="name"><?php echo __('Usuario:',true)?></label></td>
					<td><?php echo $this->Form->input('username',array('label'=>false,'class'=>'inputboxl','size'=>'20'))?></td>
					<td></td>
					<td></td>		
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __('Contraseña:',true)?></label></td>
					<td><?php echo $this->Form->input('password',array('label'=>false,'class'=>'inputboxl','size'=>'20'))?></td>
					<td></td>
					<td></td>		
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __('Repetir Contraseña:',true)?></label></td>
					<td><?php echo $this->Form->input('password_repit',array('label'=>false,'class'=>'inputboxl','size'=>'20','type'=>'password'))?></td>
					<td></td>
					<td></td>		
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __('País:',true)?></label></td>
					<td><?php echo $this->Form->input('countrie_id',array('label'=>false,'class'=>'inputboxl','size'=>'1'))?></td>
					<td></td>
					<td></td>		
				</tr>				
				<tr>
					<td class="key"><label for="name"><?php echo __('Provincia: ',true)?></label></td>
					<td><?php echo $this->Form->input('province_id',array('label'=>false,'class'=>'inputboxl','size'=>'1'))?></td>
					<td></td>
					<td></td>		
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __('Email:',true)?></label></td>
					<td><?php echo $this->Form->input('email',array('label'=>false,'class'=>'inputboxl','size'=>'50'))?></td>
					<td></td>
					<td></td>		
				</tr>
</table>

<?php echo $this->Form->end();?>
<?php echo $this->element('fin_botones_alta_mod');?>
