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
$tcpdf->SetFont('freesans', '', 4);


//PARAMETROS DE ENTRADA
$table = '<table cellspacing="0" cellpadding="1" border="1" width="50%">
    <tr>
        <td>
			<table cellspacing="0" cellpadding="1" border="0" width="100%">
			<tr>
				<td colspan="4" align="center"><h2>Tallercito Bike</h2></td>
			</tr>
			<tr>
				<td align="Center"><h4>Fecha de Alquiler:</h4></td>
				<td align="left">'.$this->Time->format('d/m/Y',$alquilere['Alquilere']['fecha']).'</td>
				<td align="rigth"><h4>Cliente:</h4></td>
				<td align="left">'.$alquilere['Cliente']['nomape'].'</td>
			</tr>
			<tr>
				<td align="Center"><h4>Alquiler de Bicicleta</h4></td>
				<td align="left"></td>
				<td align="rigth"><h4>Nro Alquiler:</h4></td>
				<td align="left">'.$alquilere['Alquilere']['id'].'</td>
			</tr>			
			<tr>
				<td align="rigth"></td>
				<td align="left" colspan="2"></td>
			</tr>
			</table>		
		</td>
    </tr>
</table>';
$tcpdf->writeHTML($table, true, false, false, false, '');
$alquileredetalles = '<table cellspacing="0" cellpadding="1" border="1" width="50%">
    <tr>
        <td>
			<table cellspacing="0" cellpadding="1" border="0" width="90%">
			<tr>
				<td align="center"><h4>Alquiler Detalle</h4></td>
				<td align="center"><h4>Precio Unitario</h4></td>
				<td align="center"><h4>Cantidad</h4></td>
				<td align="center"><h4>Subtotal</h4></td>
			</tr>';
$filas='';			
foreach($alquilere['Alquileredetalle'] as $alquileredetalle){
		$filas = $filas.'<tr><td>'.$alquileredetalle['detalle'].'</td><td align="center">'.$alquileredetalle['subtotal']/$alquileredetalle['cantidad'].'</td>'.
						'<td  align="center">'.$alquileredetalle['cantidad'].'</td>'.
						'<td align="center">'.$alquileredetalle['subtotal'].'</td></tr>';
}
$filas = $filas.'<tr><td colspan="3"><h4>Total</h4></td><td align="center">'.$alquilere['Alquilere']['total'].'</td></tr>';
$alquileredetalles=$alquileredetalles.$filas;
$alquileredetalles=$alquileredetalles.'</table>		
			</td>
		</tr>
	</table>';

$tcpdf->writeHTML($alquileredetalles, true, false, false, false, '');

//echo $tcpdf->Output('TicketVenta'.$venta['Sale']['nrofactura'].'.pdf', 'D');
echo $tcpdf->Output('TicketAlquiler'.$alquilere['Alquilere']['id'].'.pdf', 'I');
 ?>