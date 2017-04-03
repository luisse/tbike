<?php echo $this->Html->script(array('/js/sales/pagomercadopago.js'),array('block'=>'scriptjs'));?>
<?php
App::import('Vendor','mercadopago'); 
$index=0;	
$items=array();
foreach($sales['Salesdetail'] as $salesdetail){
	$cantidad = intval($salesdetail['cantidad']);
	$unitprice= intval($salesdetail['subtotal']);
	$items[$index]=array("title" => $salesdetail['descripcion'],
           "quantity" => $cantidad,
           "currency_id" => "ARS",
           "unit_price" =>$unitprice
	);
	$index++;
}
$preference_data=array('items'=>$items);
if(!empty($sysconfig)){
	$mp = new MP($sysconfig['Sysconfig']['usermp'],$sysconfig['Sysconfig']['tokenmp']);
	$mp->sandbox_mode(TRUE);
	$preference = $mp->create_preference($preference_data);
}


?>
<div class="panel panel-default">
  <div class="panel-footer">
		<fieldset>
			<legend><?php echo __('Detalle de la Venta')?></legend>
			<div class="row">	
				<div class="col-lg-2">
					<label><?php echo __('Fecha de Ingreso')?></label>
					<div class="form-group">
						<?php echo $this->Time->Format('d/m/Y',$sales['Sale']['fecha'])?>
					</div>
				</div>
				<div class="col-lg-2">
					<label><?php echo __('Nro Factura')?></label>
						<div class="form-group">
							<?php echo $sales['Sale']['nrofactura']?>
						</div>
				</div>
				<div class="col-lg-3">
				<label><?php echo __('Tipo de Emisión')?></label>
						<div class="form-group">		
							<?php
								echo $str_tipofactura[$sales['Sale']['tipofactura']];
							?>
						</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-2">
					<label><?php echo __('Documento')?></label>
					<div class="form-group">
						<?php echo $sales['Cliente']['documento']?>
					</div>
				</div>											
				<div class="col-lg-4">
					<label><?php echo __('Nombre y Apellido')?></label>
					<div class="form-group">
						<?php echo $sales['Cliente']['nomape']?>
					</div>
				</div>
				<div class="col-lg-2">
					<div class="btn-group">
						<a onclick="imprimirticked(<?php echo $sales['Sale']['id']?>)" class='btn btn-app'><i class="fa  fa-print"></i>&nbsp;<?php echo __('Imprimir')?></a>
					</div>	
				</div>
			</div>	
			<!-- TABLA DE DETALLE -->
			<div class="table-responsive">
						<table cellspacing="1"  class="table table-striped table-bordered table-hover dataTable no-footer table-responsive  table-condensed" aria-describedby="dataTables-example_info" id = "salesdetails">
						<thead>
							<tr>
									<th><?php echo __('Nombre Producto');?></th>
									<th  width='90px'><?php echo __('Precio');?></th>
									<th  width='50px'><?php echo __('Cantidad');?></th>
									<th width='90px'> <?php echo __('Sub Total');?></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($sales['Salesdetail'] as $salesdetail):?>
							<?php echo "<tr>"?>
									<td><?php echo $salesdetail['descripcion']?></td>
									<td align='right'><?php echo $this->Number->precision($salesdetail['subtotal']/$salesdetail['cantidad'],2)?></td>
									<td align='right'><?php echo $salesdetail['cantidad']?></td>
									<td align='right'><?php echo $this->Number->precision($salesdetail['subtotal'],2)?>
									</td>
							</tr>
							<?php endforeach;?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="3">
								<strong><?php echo __('Total a pagar') ?></strong>
								</td>
								<td colspan="2" align='right'>
									<?php echo $sales['Sale']['totalsale']?>
								</td>
							</tr>
						</tfoot>
						</table>
			</div>
		</fieldset>
		<?php if(!empty($preference)):?>
		<a href="<?php echo $preference['response']['sandbox_init_point']; ?>" name="MP-Checkout" class="blue-rn-m" id="bt_mercadopago"><?php echo __('Pagar con Mercado Pago')?></a>
		<?php endif;?>
	</div>
</div>
<?php echo $this->element('modalbox')?>
<script type="text/javascript" src="https://www.mercadopago.com/org-img/jsapi/mptools/buttons/render.js"></script>
