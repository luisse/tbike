<?php echo $this->element('modalboxcabecera',array('title'=>__('Datos Personales'),'paneltipo'=>'panel-primary'));?>
<div class="panel panel-default">
  <div class="panel-default">
			<div class="row">
				<div class="col-lg-5">			
					<div class="row">	
						<div class="col-lg-6">
							<label for="name"><?php echo __('Fecha Nacimiento',true)?></label>
							<div class="form-group">
								<div class="well  well-sm"><?php echo $this->Time->format('d/m/Y',$people['People']['birthdate'])?></div>
							</div>						

						</div>
						<div class="col-lg-6">
							<label for="name"><?php echo __('Documento',true)?></label>
							<div class="form-group">
								<div class="well  well-sm"><?php echo $people['People']['document']?></div>
							</div>						
						

						</div>
					</div>
					<div class="row">	
						<div class="col-lg-10">
							<label for="name"><?php echo __('Apellido y Nombre',true)?></label>
						</div>
						<div class="col-lg-12">
							<div class="well  well-sm"><?php echo $people['People']['firstname'].', '.$people['People']['secondname'] ?></div>
						</div>				
					</div>		
					<div class="row">	
						<div class="col-lg-10">
							<label for="name"><?php echo __('Telefono',true)?></label>
						</div>
						<div class="col-lg-12">
							<div class="well  well-sm"><?php echo $people['People']['phonenumber'] ?></div>
						</div>				
					</div>		
					<div class="row">	
						<div class="col-lg-10">
							<label for="name"><?php echo __('Domicilio',true) ?></label>
						</div>
						<div class="col-lg-12">
							<div class="well  well-sm"><?php echo $people['People']['address']?></div>
						</div>				
					</div>		
					<div class="row">
							<div class="col-lg-2">
								<label for="name"><?php echo __('Dpto',true) ?></label>
								<div class="form-group">
									<div class="well  well-sm"><?php if(empty($people['People']['depto']))
																		echo '--';
																	else
																		echo $people['People']['block'] ?>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<label for="name"><?php echo __('Piso',true) ?></label>
								<div class="form-group">
									<div class="well  well-sm"><?php if(empty($people['People']['piso']))
																			echo '--';
																		else
																			echo $cliente['People']['piso']?></div>
								</div>
							</div>
							<div class="col-lg-2">
								<label for="name"><?php echo __('Block',true) ?></label>
								<div class="form-group">
									<div class="well  well-sm"><?php
													if(empty($people['People']['block']))
														echo '--';
													else 
														echo $people['People']['block'] ?></div>
									</div>							
								</div>
							</div>				
					</div>
				</div>		
			</div>
	<?php echo $this->element('modalboxpie');?>
	</div>
</div>