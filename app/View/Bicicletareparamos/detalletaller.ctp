<div class="well">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Datos de Pedido a Taller</h1>
		</div>
                <!-- /.col-lg-12 -->
    </div>
<?php if(!empty($this->request->data)):?>
	<div class="panel panel-info">
	  <div class="panel-heading">
	    <?php echo __('Información del Cliente');?>
	  </div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
							<label><?php echo __('Nombre y Apellido',true)?></label>
							<div class="well  well-sm"><?php echo $this->request->data['Cliente']['nomape']?></div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-10">
						<div class="row">
									<div class="col-lg-3">
											<label><?php echo __('Dirección')?></label>
											<div class="well  well-sm"><?php echo $this->request->data['Cliente']['domicilio']?></div>
									</div>
									<div class="col-lg-1">
									<label><?php echo __('Block')?></label>
											<div class="well  well-sm"><?php if($this->request->data['Cliente']['block']=='')
																									echo '--';
																								else
																								echo $this->request->data['Cliente']['block'];?></div>
									</div>
									<div class="col-lg-1">
											<label><?php echo __('Dpto')?></label>
											<div class="well  well-sm"><?php if(empty($this->request->data['Cliente']['dpto']))
																								echo '--';
																							else
																								echo $this->request->data['Cliente']['dpto'];?></div>
									</div>
									<div class="col-lg-1">
											<label><?php echo __('Piso')?></label>
											<div class="well  well-sm"><?php echo $this->request->data['Cliente']['piso']?></div>
									</div>
						</div>
					</div>
				</div>
			</div>
	</div>
	<div class="panel panel-info">
	  <div class="panel-heading">
	    <?php echo __('Información de la Bicicleta');?>
	  </div>
			<div class="panel-body">
			<div class="row">
					<div class="col-lg-7">
						<div class="row">
							<div class="col-lg-6">
								<h5><?php echo __('Marca',true)?></h5>
							</div>
							<div class="col-lg-6">
								<h5><?php echo __('Modelo',true)?></h5>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
									<div class="well  well-sm"><?php echo $this->request->data['Bicicleta']['marca']?></div>
							</div>
							<div class="col-lg-6">
									<div class="well  well-sm"><?php echo $this->request->data['Bicicleta']['modelo']?></div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-10">
								<h5><?php echo __('Detalles',true)?></h5>
							</div>
							<div class="col-lg-12">
									<div class="well  well-sm"><?php echo $this->request->data['Bicicleta']['detalles']?></div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3">
								<h5><?php echo __('Equipamiento',true)?></h5>
							</div>
							<div class="col-lg-12">
									<div class="well  well-sm"><?php echo $this->request->data['Bicicleta']['equipodetalle']?></div>
							</div>
						</div>
						<div class="row">
								<div class="col-lg-9">
									<h5><?php echo __('Número de Cuadro',true)?></h5>
								</div>
								<div class="col-lg-12">
										<div class="well  well-sm"><?php echo $this->request->data['Bicicleta']['nrocuadro']?></div>
								</div>
						</div>
					</div>
					<div class="col-lg-5">
							<div class="col-lg-3">
								<h5><?php echo __('Foto',true)?></h5>
							</div>
						<div class="col-lg-12">
								<div class="well  well-sm"><img alt="Embedded Image" src="data:image/png;base64,<?php echo base64_decode($this->request->data['Bicicleta']['imagen']); ?> "/></div>
						</div>
					</div>
				</div>
			</div>
	</div>
	<div class="panel panel-info">
	  <div class="panel-heading">
	    <?php echo __('Detalles de Reparación');?>
	  </div>
	  <div class="panel-body">
		<div class="row">
			<div class="col-lg-2">
				<label><?php echo __('Fecha de Ingreso')?></label>
				<div class="well  well-sm">
					<?php echo $this->Time->format('d/m/Y',$this->request->data['Bicicletareparamo']['fechaingreso']) ?>
				</div>
			</div>
			<div class="col-lg-2">
			<label><?php echo __('Fecha Probable de Egreso')?></label>
				<div class="well  well-sm">
					<?php echo $this->Time->format('d/m/Y',$this->request->data['Bicicletareparamo']['fechaegreso']) ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4">
				<label><?php echo __('Detalles')?></label>
				<div class="well  well-sm">
					<?php echo$this->request->data['Bicicletareparamo']['detallereparacion'] ?>
				</div>
			</div>
			<div class="col-lg-2">
				<label><?php echo __('Importe Total')?></label>
				<div class="well  well-sm">
					<?php echo '$ '.$this->request->data['Bicicletareparamo']['importetotal'] ?>
				</div>
			</div>
		</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="table-responsive">
								<table class="table table-responsive">
									<thead>
										<tr>
											<th><?php echo __('Detalle de Gasto');?></th>
											<th><?php echo __('Cantidad');?></th>
										</tr>
									</thead>
									<tbody>
												<?php
												foreach($this->request->data['Bicicletareparamorepuesto'] as $bicicletareparamos):
												?>
												<tr>
													<td>
														<?php echo $bicicletareparamos['repuestodescr'] ?>
													</td>

													<td>
														<?php echo $bicicletareparamos['cantidad'] ?>
													</td>
												</tr>
											<?php endforeach; ?>
											</tbody>
											</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
<?php endif; ?>
