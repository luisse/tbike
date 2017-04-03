<?php	echo $this->element('botones_cancelar',
	array('js_funcionalidad' => '',
			'label_modelo' =>'Usuario',
			'label_detalle'=>'Eliminar Alumno',
			'label_caja'=>'Advertencia',
			'controlador'=>'users'))?>
<table class="admintable" cellspacing="1" width='100%' border='0'>
	<tr>
		<td colspan=4>
			<div id='stylemensaje'>
				<h3><?php if(isset($error)) echo $error?></h3>
			</div>
		</td>
	<?php if(isset($profesor)):?>
	<tr>
		<td class="key"><label for="name"><?php echo __('Codigo de Profesional:',true)?></label></td>
		<td><?php echo $profesor['Profesore']['codprof']?></td>
		<td></td>
		<td></td>		
	</tr>
	<tr>
		<td class="key"><label for="name"><?php echo __('Apellido:',true)?></label></td>
		<td><?php echo $profesor['Profesore']['apellido']?></td>
		<td class="key"><label for="name"><?php echo __('Nombre:',true)?></label></td>
		<td><?php echo $profesor['Profesore']['nombre']?></td>		
	</tr>					
	<?php endif;?>		
	
	<?php if(isset($alumno)):?>
	<tr>
		<td class="key"><label for="name"><?php echo __('Nro de Legajo',true)?></label></td>
		<td><?php echo $alumno['Alumno']['nrolegajo']?></td>
		<td></td>
		<td></td>		
	</tr>
	<tr>
		<td class="key"><label for="name"><?php echo __('Apellido',true)?></label></td>
		<td><?php echo $alumno['Alumno']['apellido']?></td>
		<td></td>
		<td></td>		
	</tr>
	<tr>
		<td class="key"><label for="name"><?php echo __('Nombre',true)?></label></td>
		<td><?php echo $alumno['Alumno']['nombre']?></td>
		<td></td>
		<td></td>		
	</tr>
	<tr>
		<td class="key"><label for="name"><?php echo __('Año en Curso',true)?></label></td>
		<td><?php echo $alumno['Alumno']['cursandoanio']?></td>
		<td></td>
		<td></td>		
	</tr>
	<?php endif;?>
</table>
