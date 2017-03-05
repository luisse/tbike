<?php
	$autocompletar = array();
	$i=0;
	foreach($proveedores as $proveedore){
		$autocompletar[$i]['id'] = $proveedore['Proveedore']['id'];
		$autocompletar[$i]['name'] = utf8_encode($proveedore['Proveedore']['denominacion']);
		$i=1;
	}
	echo json_encode($autocompletar);
?>