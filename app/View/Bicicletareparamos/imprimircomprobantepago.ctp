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
$table = '<table cellspacing="0" cellpadding="1" border="1" width="50%">
    <tr>
        <td>
			<table cellspacing="0" cellpadding="1" border="0" width="100%">
			<tr>
				<td colspan="4" align="center"><h2>Tallercito Bike</h2></td>
			</tr>
			<tr>
				<td align="Center"><h4>Fecha de Ingreso:</h4></td>
				<td align="left">'.$this->Time->format('d/m/Y',$bicicletareparamos['Bicicletareparamo']['fechaingreso']).'</td>
				<td align="rigth"><h4>Fecha Prob. Salida:</h4></td>
				<td align="left">'.$this->Time->format('d/m/Y',$bicicletareparamos['Bicicletareparamo']['fechaegreso']).'</td>
			</tr>
			<tr>
				<td align="rigth"><h4>Bicicleta Marca:</h4></td>
				<td align="left">'.$bicicletareparamos['Bicicleta']['marca'].'</td>
				<td align="rigth"><h4>Nro de Cuadro:</h4></td>
				<td align="left">'.$bicicletareparamos['Bicicleta']['nrocuadro'].'</td>
			</tr>			
			<tr>
				<td align="rigth"><h4>Arreglo detalle:</h4></td>
				<td align="left" colspan="2">'.$bicicletareparamos['Bicicletareparamo']['detallereparacion'].'</td>
			</tr>';
			
$datosventa='';
if(!empty($tipomovimiento) && $tipomovimiento != 0){
			$datosventa='<tr>
				<td align="rigth"><h4>Tipo de Pago:</h4></td>
				<td align="left">'.$tipomovimientodesc.'</td>';
			//solo para movimientos de creditos
			if($tipomovimiento==2){
				$datosventa=$datosventa.'<td align="rigth"><h4>Crédito Cliente:</h4></td>
				<td align="left">'.$this->Number->precision($totaldeuda,2).'</td>';			
			}
			$datosventa=$datosventa.'</tr>';
	
}			

$pie='</table>		
		</td>
    </tr>
</table>';

$table=$table.$datosventa.$pie;
$tcpdf->writeHTML($table, true, false, false, false, '');
$repuestos = '<table cellspacing="0" cellpadding="1" border="1" width="50%">
    <tr>
        <td>
			<table cellspacing="0" cellpadding="1" border="0" width="80%">
			<tr>
				<td align="center"><h4>Detalle Gasto</h4></td>
				<td align="center"><h4>Cantidad</h4></td>
				<td align="center"><h4>Precio Unit.</h4></td>
				<td align="center"><h4>Subtotal</h4></td>
			</tr>';
			$filas='';			
			$total=0;
			foreach($bicicletareparamorepuestos as $bicicletareparamorepuesto){
					$filas = $filas.'<tr><td>'.$bicicletareparamorepuesto['Bicicletareparamorepuesto']['repuestodescr'].
									'</td><td align="center">'.$bicicletareparamorepuesto['Bicicletareparamorepuesto']['cantidad'].
									'</td><td align="center">'.$bicicletareparamorepuesto['Bicicletareparamorepuesto']['precio'].
									'</td><td align="center">'.$bicicletareparamorepuesto['Bicicletareparamorepuesto']['precio']*$bicicletareparamorepuesto['Bicicletareparamorepuesto']['cantidad'].'</td></tr>';
					$total = $total+$bicicletareparamorepuesto['Bicicletareparamorepuesto']['precio']*$bicicletareparamorepuesto['Bicicletareparamorepuesto']['cantidad'];
			}
			$repuestos=$repuestos.$filas.'<tr><td></td><td></td><td><h4>Total</h4></td><td align="center">'.$total.'</td></tr>';
			$repuestos=$repuestos.'</table>		
		</td>
    </tr>
</table>';
$tcpdf->writeHTML($repuestos, true, false, false, false, '');

//echo $tcpdf->Output('TallercitoBikePago.pdf', 'D'); 
echo $tcpdf->Output('TallercitoBikePago.pdf', 'I'); 
 
 ?>