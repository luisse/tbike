<?php	echo $this->element('botones_cancelar',
	array('js_funcionalidad' => '',
			'label_modelo' =>'Alumno',
			'label_detalle'=>'Eliminar Alumno',
			'label_caja'=>'Detalles',
			'controlador'=>'alumnos'))?>
<table class="admintable" cellspacing="1" width='100%' border='0'>
	<tr>
		<td colspan=4>
			<div id='stylemensaje'>
				<h3><?php if(isset($error)) echo $error?></h3>
			</div>
		</td>
	</tr>
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
</table>
