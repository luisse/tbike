

 <div class="container">
<?php
	echo $this->Bs3Form->create('BasicExample',array('class'=>'form-signin'));

		echo $this->Bs3Form->input('email', array(
			'label' => 'Correo Electronico',
			'placeholder' => 'Ingrese Correo',
		));

		echo $this->Bs3Form->input('password', array(
			'type' => 'password',
			'label' => 'Contraseña',
			'placeholder' => 'Contraseña'
		));

		echo $this->Bs3Form->input('file', array(
			'type' => 'file',
			'label' => 'Seleccione Arcjhivo',
			'help' => 'Carga de Archivos.'
		));

		echo $this->Bs3Form->input('checkbox', array(
			'type' => 'checkbox',
			'label' => false,
			'checkboxLabel' => 'Seleccionar DAtos'
		));

	echo $this->Bs3Form->end(array(
		'text' => 'test',
		'class' => 'btn btn-info'
	));
?>
</div>