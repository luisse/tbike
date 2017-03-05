<?php
// app/Views/Subscribers/export.ctp
foreach ($clientes as $row):
	foreach ($row['Cliente'] as &$cell):
		// Escape double quotation marks
		$cell = '"' . preg_replace('/"/','""',$cell) . '"';
	endforeach;
	$row['Cliente']['saldo']=str_replace('.',',', $row['Cliente']['saldo']);
	echo implode(',', $row['Cliente']) . "\n";
endforeach;
?>