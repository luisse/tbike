<!-- TABLA DE CABECERA -->
<?= $this->element('modalboxcabecera',array('title'=>__('Detalle de Alquiler'),'paneltipo'=>'panel-primary'));?>
<?php if(!empty($alquilere)){?>
	<div class="panel panel-default">
	  <div class="panel-footer">
	  			<div class="row">
					<div class="col-lg-2">
						<label><?= __('Fecha de Alquiler')?></label>
						<div class="form-group">
							<?= $this->Time->Format('d/m/Y',$alquilere['Alquilere']['fecha'])?>
						</div>
					</div>
					<div class="col-lg-2">
						<label><?= __('Nro Alquiler')?></label>
							<div class="form-group">
								<?= $alquilere['Alquilere']['id']?>
							</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-2">
						<label><?= __('Documento')?></label>
						<div class="form-group">
							<?= $alquilere['Cliente']['documento']?>
						</div>
					</div>
					<div class="col-lg-4">
						<label><?= __('Nombre y Apellido')?></label>
						<div class="form-group">
							<?= $alquilere['Cliente']['nomape']?>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="btn-group">
							<?= $this->Html->link('<i class="fa  fa-print"></i>&nbsp;'.__('Imprimir'),array('controller'=>'alquileres',
											'action'=>'imprimirticket',$alquilere['Alquilere']['id']),
											array('onclick'=>"",'escape'=>false,'class'=>'btn btn-app'),'');?>
						</div>
					</div>

				</div>
						<ul class="nav nav-tabs" id='myTab'>
						  <li class="active"><a href="#tabs-1"   data-toggle="tab"><?= __('Productos Alquilados') ?></a></li>
						</ul>
						<div class="tab-content">
						<div class="tab-pane active"  id="tabs-1">
						<div class="table-responsive">
							<table cellspacing="1" width='80%'  class="table table-striped table-bordered table-hover dataTable no-footer" aria-describedby="dataTables-example_info" id = "salesdetails">
							<thead>
								<tr>
										<th><?= __('Alquiler Detalle');?></th>
										<th  width='90px'><?= __('Precio');?></th>
										<th  width='50px'><?= __('Cantidad');?></th>
										<th width='90px'> <?= __('Sub Total');?></th>
								</tr>
							</thead>
							<tbody>
							<?php //print_r($alquilere)?>
								<?php foreach($alquilere['Alquileredetalle'] as $alquileredetalle):?>
								<?= "<tr>"?>
										<td><?= $alquileredetalle['detalle']?></td>
										<td align='right'><?= $this->Number->precision($alquileredetalle['subtotal']/$alquileredetalle['cantidad'],2)?></td>
										<td align='right'><?= $alquileredetalle['cantidad']?></td>
										<td align='right'><?= $this->Number->precision($alquileredetalle['subtotal'],2)?>
										</td>
								</tr>
								<?php endforeach;?>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="3">
									<?= 'Total' ?>
									</td>
									<td colspan="2" align='right'>
										<?= $alquilere['Alquilere']['total']?>
									</td>
								</tr>
							</tfoot>
							</table>
					</div>
				</div>
		</div>
	  </div>
	 </div>
<?php }else{?>
	<div class="panel panel-default">
	  <div class="panel-footer">
			<div class="alert alert-warning" role="alert">
				<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<strong><?= __('Advertencia!')?></strong>&nbsp;<?= "No se recuperaron datos para el identificador Ingresado";?>
			</div>
		</div>
	</div>
<?php
} ?>
