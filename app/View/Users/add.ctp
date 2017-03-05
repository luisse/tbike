<?php	echo $this->Html->script('fmensajes.js');
		echo $this->Html->script('dateformat.js');
		echo $this->Html->script('fgenerales.js');	
		
		
		//echo $this->Html->script('jquery.validation.js');
		echo $this->element('botones_alta_mod',
	array('js_funcionalidad' => 'users/useradd.js',
			'label_modelo' =>'Usuario',
			'label_detalle'=>'Registración de Usuario',
			'label_caja'=>'Detalles',
			'controlador'=>'users'))?>
<?php echo $this->Form->create('User',array('action'=>'add'));?>
<table class="admintable" cellspacing="1" width='100%' border='0'>
				<tr>
					<td class="key"><label for="name"><?php echo __('Usuario Acceso:',true)?></label></td>
					<td><?php echo $this->Form->input('username',array('label'=>false,'class'=>'inputboxl','size'=>'20'))?></td>
					<td></td>
					<td></td>		
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __(htmlentities('Contraseña:'),true)?></label></td>
					<td><?php echo $this->Form->input('password',array('label'=>false,'class'=>'inputboxl','size'=>'20'))?></td>
					<td></td>
					<td></td>		
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __(htmlentities('Repetir Contraseña:'),true)?></label></td>
					<td><?php echo $this->Form->input('password_repit',array('label'=>false,'class'=>'inputboxl','size'=>'20','type'=>'password'))?></td>
					<td></td>
					<td></td>		
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __('Email:',true)?></label></td>
					<td><?php echo $this->Form->input('email',array('label'=>false,'class'=>'inputboxl','size'=>'50'))?></td>
					<td></td>
					<td></td>		
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __('Tipo de Usuario:',true)?></label></td>
					<td><?php echo $this->Form->input('tipousuario_id',array('label'=>false,'class'=>'inputboxl','size'=>'1'))?></td>
					<td></td>
					<td></td>		
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __('Legajo:',true)?></label></td>
					<td><?php echo $this->Form->input('Alumno.nrolegajo',array('label'=>false,'class'=>'inputboxl','size'=>'10','type'=>'text'))?></td>
					<td></td>
					<td></td>		
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __('Apellido:',true)?></label></td>
					<td><?php echo $this->Form->input('Alumno.apellido',array('label'=>false,'class'=>'inputboxl','size'=>'50'))?></td>
					<td class="key"><label for="name"><?php echo __('Nombre:',true)?></label></td>
					<td><?php echo $this->Form->input('Alumno.nombre',array('label'=>false,'class'=>'inputboxl','size'=>'50'))?></td>		
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __('Curso Actual:',true)?></label></td>
					<td><?php echo $this->Form->input('Alumno.cursandoanio',array('label'=>false,'class'=>'inputboxl','size'=>'11','type'=>'text'))?></td>
					<td></td>
					<td></td>		
				</tr>
</table>

<?php echo $this->Form->end();?>
<?php echo $this->element('fin_botones_alta_mod');?>
