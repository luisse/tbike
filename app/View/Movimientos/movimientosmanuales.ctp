<?php	echo $this->Html->script(array('movimientos/movimientosmanuales.js','fgenerales','jquery.maskedinput','jquery.price','jquery.numeric','jquery.toastmessage'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css(array('message','dootstrap.docs'), null, array('inline' => false))?>
<?php echo $this->element('flash_message')?>
<div id='formreturn'>
	<?php echo $this->Form->create('Movimientos',array('action'=>'movimientosmanuales',	
						'inputDefaults' => array(
							'div' => 'form-group',
							'wrapInput' => false,
							'class' => 'form-control'
							),
					'class' => 'well'
				));?>
	<div id=row>
			<div class="bs-glyphicons">
				<ul class="bs-glyphicons-list">
					<li id='contado' onclick='VerFuncion(1)' class="selected">
						<span class="glyphicon glyphicon glyphicon-euro"></span>
						<span class="glyphicon-class">Movimiento Gral.</span>
					</li>
					<li id='ctacte' onclick='VerFuncion(2)'>
						<span class="glyphicon glyphicon-user"></span>
						<span class="glyphicon-class">Cuenta Corriente</span>
					</li>
				</ul>
			</div>
	<!-- FIN FILA DE ICONOS -->
	</div>
			<!-- BLOQUE CTA CTE -->
			<div id='cuentacorriente'>
				<div class="well">
						<div class='row'>
							<div class="btn-group">
								<a class="btn btn-app" href="#" id='selcliente'><i class="fa  fa-user"></i> Sel. Cliente</a>
							</div>						
						</div>				
						<div class = 'row'>
							<div class="row">	
								<div class="col-lg-2">
									<h5><label><?php echo __('Documento',true)?></label></h5>
								</div>
								<div class="col-lg-5">
									<h5><label><?php echo __('Apellido y Nombre',true)?></label></h5>
								</div>
								<div class="col-lg-2">
									<h5><label><?php echo __('Deuda Total',true)?></label></h5>
								</div>							
							</div>
							<div class="row">	
								<div class="col-lg-2">
									<h4>
														<?php echo $this->Form->input('Movimiento.clientedoc',array('label' => false,
																			'class'=>'form-control input-sm',
																			'type'=>'text',
																			'maxlength'=>'10',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
										</h4>
								</div>											
								<div class="col-lg-5">
									<h4>
																<?php echo $this->Form->hidden('Movimiento.cliente_id'); ?>
																<?php echo $this->Form->hidden('Movimiento.cuenta_id'); ?>
																<?php echo $this->Form->hidden('Movimiento.deudatotal'); ?>
																<?php echo $this->Form->input('Movimiento.nomap',array('label' => false,
																			'class'=>'form-control input-sm',
																			'type'=>'text',
																			'maxlength'=>'10',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
									</h4>
								</div>	
							<div class="col-lg-5">
									<h4>
										<span class="label-danger" id='montodeuda'>
										</span>
									</h4>
							</div>								
							</div>		
						</div>
				</div>		
			</div>
			<!-- FIN BLOQUE CTA CTE -->
	<div id='row'>
		<div id='col-lg-5'>
			<div id='pagocontado'>
					<div class="well">
						<div class='row'>					
										<?php echo $this->Form->input('Movimiento.tipomovimiento_id',array('label' => 'Tipo de movimiento',
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>

						</div>					
						<div class='row'>					
										<?php echo $this->Form->input('Movimiento.importe',array('label' => 'Importe Movimiento',
														'class'=>'form-control input-sm clprecio',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>

						</div>
						<div class='row'>
										<?php echo $this->Form->input('Movimiento.detallemov',array('label' => 'Detalle de Movimiento',
																			'class'=>'form-control input-sm',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						</div>
						<div class='row'>
										<?php echo $this->Form->input('Movimiento.nrocomprobante',array('label' => 'Comprobante',
																			'class'=>'form-control input-sm',
																			'type'=>'text',
																			'maxlength'=>'10',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						</div>					
					</div>
				</div>
			</div>
	</div>	
	<?php echo $this->Form->end();?>
	<div class="row">	
		<div class="col-lg-6">
			<center>
			<button type="button" class="btn btn-success btn-lw" id='aceptar'>
			  <span class="glyphicon glyphicon-ok"></span> Aceptar
			</button>	
			</center>
		</div>
		<div class="col-lg-6">
			<center>
			<button type="button" class="btn btn-danger btn-lw" id='cancelar'  data-dismiss="modal"> 
			  <span class="glyphicon glyphicon glyphicon-off"></span><?php echo __(' Cancelar')?>
			</button>	
			</center>
		</div>
	</div>	
</div>
<?php echo $this->element('modalbox')?>
