<?php
// app/Views/Subscribers/export.ctp
foreach ($sales as $row):
	//print_r($row);
	foreach ($row['Sale'] as &$cell):
		// Escape double quotation marks
		$cell = '"' . preg_replace('/"/','""',$cell) . '"';
	endforeach;
	foreach ($row['Tallercito'] as &$cell):
		// Escape double quotation marks
		$cell = '"' . preg_replace('/"/','""',$cell) . '"';
	endforeach;

	echo implode(',', $row['Sale']).','.implode(',', $row['Tallercito'])."\r\n";
endforeach;
?>
