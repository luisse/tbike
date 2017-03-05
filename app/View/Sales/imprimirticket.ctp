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
$table = '<table cellspacing="0" cellpadding="1" border="1" width="80%">
    <tr>
        <td>
			<table cellspacing="0" cellpadding="1" border="0" width="100%">
			<tr>
				<td colspan="4" align="center"><h2>Tallercito Bike</h2></td>
			</tr>
			<tr>
				<td align="Center"><h4>Fecha de Ingreso:</h4></td>
				<td align="left">'.$this->Time->format('d/m/Y',$venta['Sale']['saledate']).'</td>
				<td align="rigth"><h4>Cliente:</h4></td>
				<td align="left">'.$venta['Cliente']['nomape'].'</td>
			</tr>
			<tr>
				<td align="Center"><h4>Tipo de Emision:</h4></td>
				<td align="left">'.$str_tipofactura[$venta['Sale']['tipofactura']].'</td>
				<td align="rigth"><h4>Nro Comprobante:</h4></td>
				<td align="left">'.$venta['Sale']['nrofactura'].'</td>
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

$repuestos = '<table cellspacing="0" cellpadding="1" border="1" width="80%">
    <tr>
        <td>
			<table cellspacing="0" cellpadding="1" border="0" width="90%">
			<tr>
				<td align="center"><h4>Nombre Producto</h4></td>
				<td align="center"><h4>Precio Unitario</h4></td>
				<td align="center"><h4>Cantidad</h4></td>
				<td align="center"><h4>Subtotal</h4></td>
			</tr>';
$filas='';			
foreach($venta['Salesdetail'] as $salesdetail){
		$filas = $filas.'<tr><td>'.$salesdetail['descripcion'].'</td><td align="center">'.$salesdetail['subtotal']/$salesdetail['cantidad'].'</td>'.
						'<td  align="center">'.$salesdetail['cantidad'].'</td>'.
						'<td align="center">'.$salesdetail['subtotal'].'</td></tr>';
}
$filas = $filas.'<tr><td colspan="3"><h4>Total</h4></td><td align="center">'.$venta['Sale']['totalsale'].'</td></tr>';

$repuestos=$repuestos.$filas;
$repuestos=$repuestos.'</table>		
			</td>
		</tr>
	</table>';

$tcpdf->writeHTML($repuestos, true, false, false, false, '');

//echo $tcpdf->Output('TicketVenta'.$venta['Sale']['nrofactura'].'.pdf', 'D');
echo $tcpdf->Output('TicketVenta'.$venta['Sale']['nrofactura'].'.pdf', 'I');

 
 ?>