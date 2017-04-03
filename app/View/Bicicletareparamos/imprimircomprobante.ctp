<?php
App::import('Vendor','xtcpdf');
ob_end_clean();
$tcpdf = new XTCPDF();
$textfont = 'freesans';
$tcpdf->SetAuthor("TallercitoBike");
$tcpdf->SetShowheaderfooter(false);
$tcpdf->SetAutoPageBreak( true );
$tcpdf->setHeaderFont(array($textfont,'',8));
$tcpdf->xheadercolor = array(255,255,255);

$tcpdf->AddPage();
$tcpdf->SetFont('freesans', '', 5);


//PARAMETROS DE ENTRADA
$fechaingreso = $this->Time->format('d/m/Y',$bicicletareparamos[0]['Bicicletareparamo']['fechaingreso']);
$fechaegreso = $this->Time->format('d/m/Y',$bicicletareparamos[0]['Bicicletareparamo']['fechaegreso']);
$cuadronro = $bicicletareparamos[0]['Bicicleta']['nrocuadro'];
$cliente = $bicicletareparamos[0]['Cliente']['nomape'];
$importetotal = $bicicletareparamos[0]['Bicicletareparamo']['importetotal'];
$detallereparacion = $bicicletareparamos[0]['Bicicletareparamo']['detallereparacion'];
$marca = $bicicletareparamos[0]['Bicicleta']['marca'];
$nrocuadro = $bicicletareparamos[0]['Bicicleta']['nrocuadro'];

$table = '<table cellspacing="0" cellpadding="1" border="1" width="50%">
    <tr>
        <td>
			<table cellspacing="0" cellpadding="1" border="0" width="100%">
			<tr>
				<td colspan="4" align="center"><h2>Tallercito Bike</h2></td>
			</tr>
			<tr>
				<td align="rigth"><h4>Fecha de Ingreso:</h4></td>
				<td align="left">'.$fechaingreso.'</td>
				<td align="rigth"><h4>Fecha Prob. Salida:</h4></td>
				<td align="left">'.$fechaegreso.'</td>
			</tr>
			<tr>
				<td align="rigth"><h4>Bicicleta Marca:</h4></td>
				<td align="left">'.$marca.'</td>
				<td align="rigth"><h4>Nro de Cuadro:</h4></td>
				<td align="left">'.$nrocuadro.'</td>
			</tr>
			<tr>
				<td align="rigth"><h4>Arreglo detalle:</h4></td>
				<td align="left" colspan="2">'.$detallereparacion.'</td>
			</tr>
			<tr>
				<td align="rigth"><h4>Cliente:</h4></td>
				<td align="left">'.$cliente.'</td>
				<td align="rigth"><h4>Importe Total:</h4></td>
				<td align="left">'.$importetotal.'</td>
			</tr>
			</table>
		</td>
    </tr>
</table>';
$tcpdf->writeHTML($table, true, false, false, false, '');
//$tcpdf->MultiCell(70, 50, $table, 0, 'J', false, 1, 125, 30, true, 0, false, true, 0, 'T', false);
// set style for barcode
$style = array(
    'border' => 2,
    'vpadding' => 'auto',
    'hpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255)
    'module_width' => 1, // width of a single module in points
    'module_height' => 1 // height of a single module in points
);
$tcpdf->write2DBarcode('http://'.$ipaddres.'/bicicletareparamos/detalletaller/'.$bicicletareparamos[0]['Bicicletareparamo']['id'].'/'.md5($cuadronro), 'QRCODE,L', 106,9, 18, 18, $style, 'N');
echo $tcpdf->Output('TallercitoBikeIngreso.pdf', 'D');

 ?>
