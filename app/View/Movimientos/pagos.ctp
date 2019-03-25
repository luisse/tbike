	<?php	echo $this->Html->script(array('movimientos/pagos.js'),array('block'=>'scriptjs'));?>
	<div id='formreturn'>
	<?php echo $this->element('modalboxcabecera',array('title'=>'Cobros','paneltipo'=>'panel-primary'));?>
	<?php echo $this->Form->create('Mensajeservice',array('url'=>array('action'=>'add'),	
						'inputDefaults' => array(
							'div' => 'form-group',
							'wrapInput' => false,
							'class' => 'form-control'
							),
					'class' => 'well'
				));?>
	<?php echo $this->Form->hidden('Movimiento.cliente_id',array('value'=>$cliente_id)) ?>			
	<?php echo $this->Form->hidden('Movimiento.comprobanteint',array('value'=>$comprobanteint)) ?>			
	<?php echo $this->Form->hidden('Movimiento.importe',array('value'=>$importe)) ?>			
	<?php echo $this->Form->hidden('Movimiento.tipomovimientoid',array('value'=>2)) ?>	
	<?php echo $this->Form->hidden('Movimiento.totalcredito',array('value'=>$totalcredito)); ?>
	<?php echo $this->Form->hidden('Movimiento.cuentaid',array('value'=>$cuentaid)); ?>
	<?php echo $this->Form->hidden('Movimiento.maxdeuda',array('value'=>$maxdeuda)); ?>
	<?php echo $this->Form->hidden('Movimiento.llamadodesde',array('value'=>$llamadodesde)); ?>
	<?php echo $this->Form->hidden('Movimiento.funcerrar',array('value'=>$this->Session->flash())); ?>
	<div id=row>
			<div class="bs-glyphicons">
				<ul class="bs-glyphicons-list">
					<li id='contado' onclick='VerFuncion(1)' class="selected">
						<span class="glyphicon glyphicon glyphicon-euro"></span>
						<span class="glyphicon-class">Contado</span>
					</li>
					<li id='ctacte' onclick='VerFuncion(2)'>
						<span class="glyphicon glyphicon-user"></span>
						<span class="glyphicon-class">Cuenta Corriente</span>
					</li>
					<li id='creditcard' onclick='VerFuncion(3)'>
						<span class="glyphicon glyphicon-credit-card"></span>
						<span class="glyphicon-class">Tarjeta de Credito</span>
					</li>
				</ul>
			</div>
		</div>
	<div id='row'>
		<div id='col-lg-5'>
			<div id='pagocontado'>
					<div class="well">
						<div id='row'>
										<h3><?php echo __('Total a Pagar')?> <span class="label label-default"><?php echo '$ '.$importe?></span></h3>
						</div>			
						<div id='row'>					
										<?php echo $this->Form->input('Movimiento.abonacon',array('label' => 'Paga Con ',
														'class'=>'form-control input-sm clprecio',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>

						</div>
						<div id='row'>
										<?php echo $this->Form->input('Movimiento.vuelto',array('label' => 'Vuelto',
																			'class'=>'form-control input-sm',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						</div>
						<div id='row'>
										<?php echo $this->Form->input('Movimiento.nrocomprobante',array('label' => 'Comprobante',
																			'class'=>'form-control input-sm',
																			'type'=>'text',
																			'maxlength'=>'10',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						</div>					
						</div>
				  </div>
			</div>
			<div id='cuentacorriente'>
				<div class="well">
						<div id='row'>
										<h3><?php echo __('Total a Pagar')?> <span class="label label-default"><?php echo '$ '.$importe?></span></h3>
						</div>
						<div id = 'row'>
							<div class="row">	
							
								<div class="col-lg-5">
									<h5><label><?php echo __('Apellido y Nombre',true)?></label></h5>
									<div class="form-group">
										<h4><span class="label  label-default"><?php echo $cliente['Cliente']['apellido'].', '.$cliente['Cliente']['nombre'] ?></span></h4>
									</div>								
								</div>
								<div class="col-lg-2">
									<h5><label><?php echo __('Telefono',true)?></label></h5>
									<div class="form-group">
										<h4><span class="label label-default"><?php echo $cliente['Cliente']['telefono'] ?></span></h4>
									</div>								
								</div>
								<div class="col-lg-2">
									<h5><label><?php echo __('Deuda Total',true)?></label></h5>
									<div class="form-group">
										<?php if($totalcredito > $maxdeuda && $maxdeuda > 0) 
													$class='label-danger';
												else
													$class='label-warning'; ?>
										<h4><span class=<?php echo '"label '.$class.'"' ?>><?php echo '$ '.$this->Number->precision($totalcredito,2) ?></span></h4>
									</div>								
								</div>							
							</div>
						</div>
								<div id='row'>					
												<?php echo $this->Form->input('Movimiento.abonaconcred',array('label' => 'Paga Con ',
																'class'=>'form-control input-sm clprecio',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>

								</div>
								<div id='row'>
												<?php echo $this->Form->input('Movimiento.deuda',array('label' => 'Debe',
																					'class'=>'form-control input-sm',
																					'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
								</div>
						
				</div>		
			</div>
			<div id='tarjeta'>
				<div class="well">
						<div id='row'>
										<h3><?php echo __('Total a Pagar')?> <span class="label label-default"><?php echo '$ '.$importe?></span></h3>
						</div>			
						<div id='row'>
										<?php echo $this->Form->input('Movimiento.nrocomprobantetarjeta',array('label' => 'Número Comprobante Tarjeta',
																			'class'=>'form-control input-sm',
																			'type'=>'text',
																			'maxlength'=>'10',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						</div>					
				</div>		
			</div>
			<div id='alerta' class="alert alert-danger">
						<span class="glyphicon glyphicon glyphicon-exclamation-sign"></span>
						<span class="glyphicon-class" id='mensaje'>ERROR</span>
			</div>
	</div>
	<?php echo $this->Form->end();?>
	<div class="row">	
		<div class="col-xs-6 col-sm-6">
			<center>
			<button type="button" class="btn btn-success btn-lw" id='aceptar'>
			  <span class="glyphicon glyphicon-ok"></span> Aceptar
			</button>	
			</center>
		</div>
		<div class="col-xs-6 col-sm-6">
			<center>
			<button type="button" class="btn btn-danger btn-lw" id='cancelar'  data-dismiss="modal"> 
			  <span class="glyphicon glyphicon glyphicon-off"></span><?php echo __(' Cancelar')?>
			</button>	
			</center>
		</div>
	</div>
	</div>