<?php echo $this->element('modalboxcabecera',array('title'=>__('Datos de Cliente'),'paneltipo'=>'panel-primary'));?>
<div class="panel panel-default">
  <div class="panel-default">
			<div class="row">
				<div class="col-lg-5">
					<div class="row">
						<div class="col-lg-6">
							<label for="name"><?php echo __('Fecha Nacimiento',true)?></label>
							<div class="form-group">
								<div class="well  well-sm"><?php echo $this->Time->format('d/m/Y',$cliente['Cliente']['fechanac'])?></div>
							</div>

						</div>
						<div class="col-lg-6">
							<label for="name"><?php echo __('Documento',true)?></label>
							<div class="form-group">
								<div class="well  well-sm"><?php echo $cliente['Cliente']['documento']?></div>
							</div>


						</div>
					</div>
					<div class="row">
						<div class="col-lg-10">
							<label for="name"><?php echo __('Apellido y Nombre',true)?></label>
						</div>
						<div class="col-lg-12">
							<div class="well  well-sm"><?php echo $cliente['Cliente']['apellido'].', '.$cliente['Cliente']['nombre'] ?></div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-10">
							<label for="name"><?php echo __('Telefono',true)?></label>
						</div>
						<div class="col-lg-12">
							<div class="well  well-sm"><?php echo $cliente['Cliente']['telefono'] ?></div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-10">
							<label for="name"><?php echo __('Domicilio',true) ?></label>
						</div>
						<div class="col-lg-12">
							<div class="well  well-sm"><?php echo $cliente['Cliente']['domicilio']?></div>
						</div>
					</div>
					<div class="row">
							<div class="col-lg-2">
								<label for="name"><?php echo __('Dpto',true) ?></label>
								<div class="form-group">
									<div class="well  well-sm"><?php if(empty($cliente['Cliente']['dpto']))
																		echo '--';
																	else
																		echo $cliente['Cliente']['dpto'] ?>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<label for="name"><?php echo __('Piso',true) ?></label>
								<div class="form-group">
									<div class="well  well-sm"><?php if(empty($cliente['Cliente']['piso']))
																			echo '--';
																		else
																			echo $cliente['Cliente']['piso']?></div>
								</div>
							</div>
							<div class="col-lg-2">
								<label for="name"><?php echo __('Block',true) ?></label>
								<div class="form-group">
									<div class="well  well-sm"><?php
													if(empty($cliente['Cliente']['block']))
														echo '--';
													else
														echo $cliente['Cliente']['block'] ?></div>
									</div>
								</div>
							</div>
					</div>
				<div class="col-lg-7">
					<div class="row">
						<div class="col-lg-2">
							<label><?php echo __('Foto',true) ?></label>
						</div>
					</div>
					<div class='row'>
						<div class="col-xs-6 col-md-6">
							<a href="#" class="thumbnail">
                						<?php if(!empty($cliente['Cliente']['foto'])):?>
								<?= $this->Html->image($cliente['Cliente']['foto'],
											array ( 'title' =>$cliente['Cliente']['apellido']));
								?>
								<?php else: ?>
                                                                	<?= $this->Html->image('no_user.jpeg') ?>
						                <?php endif;?>
					              </a>
						</div>
					</div>
				</div>
				</div>
			</div>
	<?php echo $this->element('modalboxpie');?>
	</div>
</div>
