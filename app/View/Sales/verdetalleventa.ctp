<!-- TABLA DE CABECERA -->
<?php echo $this->element('modalboxcabecera',array('title'=>__('Detalle de Venta'),'paneltipo'=>'panel-primary'));?>
<div class="panel panel-default">
  <div class="panel-footer">
			<div class="row">	
				<div class="col-lg-2">
					<label><?php echo __('Fecha de Ingreso')?></label>
					<div class="form-group">
						<?php echo $this->Time->Format('d/m/Y',$venta['Sale']['fecha'])?>
					</div>
				</div>
				<div class="col-lg-2">
					<label><?php echo __('Nro Factura')?></label>
						<div class="form-group">
							<?php echo $venta['Sale']['nrofactura']?>
						</div>
				</div>
				<div class="col-lg-3">
				<label><?php echo __('Tipo de Emisión')?></label>
						<div class="form-group">		
							<?php
								echo $str_tipofactura[$venta['Sale']['tipofactura']];
							?>
						</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-2">
					<label><?php echo __('Documento')?></label>
					<div class="form-group">
						<?php echo $venta['Cliente']['documento']?>
					</div>
				</div>											
				<div class="col-lg-4">
					<label><?php echo __('Nombre y Apellido')?></label>
					<div class="form-group">
						<?php echo $venta['Cliente']['nomape']?>
					</div>
				</div>
				<div class="col-lg-2">
					<div class="btn-group">
						<?php echo $this->Html->link('<i class="fa  fa-print"></i>&nbsp;'.__('Imprimir'),array('controller'=>'sales',
										'action'=>'imprimirticket',$venta['Sale']['id']),
										array('onclick'=>"",'escape'=>false,'class'=>'btn btn-app'),'');?>				
					</div>	
				</div>

			</div>	
		<!-- TABLA DE DETALLE -->
					<ul class="nav nav-tabs" id='myTab'>
					  <li class="active"><a href="#tabs-1"   data-toggle="tab"><?php echo __('Productos Vendidos') ?></a></li>
					</ul>
					<div class="tab-content">
					<div class="tab-pane active"  id="tabs-1">
					<div class="table-responsive">
						<table cellspacing="1" width='80%'  class="table table-striped table-bordered table-hover dataTable no-footer" aria-describedby="dataTables-example_info" id = "salesdetails">
						<thead>
							<tr>
									<th><?php echo __('Nombre Producto');?></th>
									<th  width='90px'><?php echo __('Precio');?></th>
									<th  width='50px'><?php echo __('Cantidad');?></th>
									<th width='90px'> <?php echo __('Sub Total');?></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($venta['Salesdetail'] as $salesdetail):?>
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
								<?php echo 'Total' ?>
								</td>
								<td colspan="2" align='right'>
									<?php echo $venta['Sale']['totalsale']?>
								</td>
							</tr>
						</tfoot>
						</table>
				</div>
			</div>
	</div>
</div>
<?php echo $this->element('modalboxpie');?>
