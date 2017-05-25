<?php echo $this->element('modalboxcabecera',array('title'=>'Datos de Bicicleta','paneltipo'=>'panel-primary'));?>
			<div class="row">
				<div class="col-lg-7">
					<div class="row">
						<div class="col-lg-6">
							<label for="name"><?php echo __('Marca',true)?></label>
							<div class="form-group">
								<div class="well  well-sm"><?php echo $bicicleta['Bicicleta']['marca']?></div>
							</div>
						</div>
						<div class="col-lg-6">
							<label for="name"><?php echo __('Modelo',true)?></label>
							<div class="form-group">
								<div class="well  well-sm"><?php echo $bicicleta['Bicicleta']['modelo']?></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-10">
							<label for="name"><?php echo __('Detalles',true)?></label>
						</div>
						<div class="col-lg-12">
								<div class="well  well-sm"><?php echo $bicicleta['Bicicleta']['detalles']?></div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-3">
							<label for="name"><?php echo __('Equipamiento',true)?></label>
						</div>
						<div class="col-lg-12">
								<div class="well  well-sm"><?php echo $bicicleta['Bicicleta']['equipodetalle']?></div>
						</div>
					</div>
					<div class="row">
							<div class="col-lg-9">
								<label for="name"><?php echo __('Número de Cuadro',true)?></label>
							</div>
							<div class="col-lg-12">
									<div class="well  well-sm"><?php echo $bicicleta['Bicicleta']['nrocuadro']?></div>
							</div>
					</div>
				</div>
				<div class="col-lg-5">
						<div class="col-lg-3">
							<label for="name"><?php echo __('Foto',true)?></label>
						</div>
				</div>
				<div class="col-lg-5">
						<a href="#" class="thumbnail">
								<?php if(empty($bicicleta['Bicicleta']['imagen'])): ?>
								<?= $this->Html->image(!empty($bicicleta['Bicicleta']['imagen']) ? $bicicleta['Bicicleta']['imagen'] : 'no_bike.jpeg') ?>
								<?php else: ?>
								<img  src="<?php echo $bicicleta['Bicicleta']['imagen']; ?> "/>
								<?php endif; ?>
						</a>
				</div>
			</div>
<?php echo $this->element('modalboxpie');?>
