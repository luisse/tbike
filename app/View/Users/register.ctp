<?= $this->Html->script(array('/js/users/register.js','moment.min','moment-with-locales.min','bootstrap-datetimepicker','fmensajes.js','fgenerales.js','jquery.numeric','jquery.toastmessage'),array('block'=>'scriptjs'));		?>
<?php echo $this->Html->css(array('bootstrap-datetimepicker','message'), null, array('inline' => false));
$cant_car = empty($this->request->data['Taxownerscar']) ? 1 : count($this->request->data['Taxownerscar']);
$cant_driver = empty($this->request->data['Taxownerdriver']) ? 1 : count($this->request->data['Taxownerdriver']);
?>
<style>
   .mhr {
       border-top: 1px solid #000000 !important;
       margin-bottom:5px !important;
       margin-top:5px !important;
   }
</style>
<script>
var msg_people="<?php echo __('Solo es posible dar de alta usuarios a personas mayores de 18 años')?>"
var row = 1;
var current_row=<?= $cant_car + $cant_driver + 1 ?> ;
</script>
<?php echo $this->element('flash_message')?>
<div class="container">
			<div class="row">
			    <div class="col-lg-12">
						<?php echo $this->Form->create('User',array('action'=>'register',
								'inputDefaults' => array(
													'div' => 'form-group',
													'wrapInput' => false,
													'class' => 'form-control'
													),
								'class' => 'well',
								'novalidate' => true
									));?>
					<h2><?php echo __('Pre registro ')?><small><?php echo __("es requerido que los dueños de taxis se registren con datos reales para ser validados a posterioridad")?></small></h2>
					<hr class="colorgraph">

					<ul class="nav nav-tabs" id='myTab'>
						<li><a href="#tabs-3"   data-toggle="tab"><i class="fa fa-user fa-fw"></i>&nbsp;<?php echo __('Registro de Propietario') ?></a></li>
						<li><a href="#tabs-2"  data-toggle="tab"><i class="fa fa-taxi fa-fw"></i>&nbsp;<?php  echo __('Registrar mis Autos') ?></a></li>
						<li><a href="#tabs-1"  data-toggle="tab"><i class="fa fa-users  fa-fw"></i>&nbsp;<?php echo __('Registrar mis Choferes') ?></a></li>
					</ul>
					<div class="tab-content">
					<div class="tab-pane  active" id="tabs-3">

						<?= $this->Form->hidden('User.createon',array('value'=>$request)) ?>
							<div class="row">
								<div class="col-lg-3">
									<?php echo $this->Form->input('People.document',array('label' => __('*Nro de Documento'),
																			'placeholder' => __('Número de Documento'),
																			'size'=>'3',
																			'type'=>'number',
																			'tabindex'=>'1',
																			'maxlength'=>10,
																			'title'=>__('Debe Ingresar el Documento'),
																			'class'=>'form-control input-sm',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
								</div>
								<div class="col-lg-3">
									<label><?php echo __('*Fecha de Nacimiento') ?></label>
									<div class="form-group">
							            <div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
											<?php echo $this->Form->input('People.birthdate',array('label'=>false,
																				'placeholder' => __('Fecha de Nacimiento'),
																				'size'=>'7',
																				'type'=>'text',
																				'tabindex'=>'2',
																				'title'=>__('Debe Ingresar Fecha de Nacimiento'),
																				'class'=>'form-control input-sm',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
											<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
							                </span>
										</div>
									</div>
								</div>
							</div>
							<div class="row">

									<div class="col-lg-3">
										<?php echo $this->Form->input('People.secondname',array('label'=>__('*Apellidos'),
																				'placeholder' => __('Ingrese Apellidos'),
																				'size'=>'7',
																				'tabindex'=>'3',
																				'title'=>__('Debe Ingresar el Apellido'),
																				'class'=>'form-control input-sm',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
									</div>
									<div class="col-lg-3">
									<?php echo $this->Form->input('People.firstname',array('label'=>__('*Nombres'),
																			'placeholder' => __('Ingrese Nombres'),
																			'size'=>'7',
																			'tabindex'=>'4',
																			'title'=>__('Debe Ingresar Nombre'),
																			'class'=>'form-control input-sm',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
								</div>
							</div>
							<div class="row">

								<div class="col-lg-2">
								<?php
								$options = array('0' => __('Femenino'), '1' => 'Masculino');
								echo $this->Form->input('People.gender',array('label'=>__('*Sexo'),
																			'options'=>$options,
																			'value'=>1,
																			'tabindex'=>'5',
																			'class'=>'form-control input-sm',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-2">
								<?php echo $this->Form->input('People.phonenumber',array('label'=>__('* Telefono'),
																			'placeholder' => __('Ingrese Telefono'),
																			'size'=>'2',
																			'tabindex'=>'6',
																			'type'=>'number',
																			'maxlength'=>11,
																			'class'=>'form-control input-sm',
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3">
									<?php echo $this->Form->input('User.email',array('label'=>'*E-Mail',
																			'placeholder' => 'E-Mail',
																			'tabindex'=>'14',
																			'class'=>'form-control input-sm',
																			'title'=>__('Debe Ingresar un correo electrónico válido'),
																			'autocomplete'=>'off',
																			'validate'=>false,
																			'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
								</div>
							</div>
						</div> <!-- tabs 3-->
						<div id="tabs-2" class="tab-pane">
							<br>
							<div class="row">
								<div class="col-xs-6 col-sm-6">
									<button type="button" class="btn btn-success btn-lw" id='agregar_auto' title='Puedes Agregar un nuevo registro si requieres ingresar mas autos'>
										<span class="glyphicon glyphicon-plus"></span>&nbsp; <?= __('Agregar Registro')?>
									</button>
								</div>
							</div>
							<hr>
							<div id='rows'>
								<?= $this->element('registercar',array('taxownerscars'=> empty($this->request->data['Taxownerscar']) ? array() : $this->request->data['Taxownerscar'],
                                                        'carbrands'   => empty($carbrands) ? array() : $carbrands )); ?>
							</div> <!-- rows -->
						</div><!-- tabs 2-->
						<div id="tabs-1" class="tab-pane">
							<br>
							<div class="row">
								<div class="col-xs-2 col-sm-2">
									<button type="button" class="btn btn-success btn-lw" id='agregar_chofer' title='Puedes Agregar un nuevo registro si requieres ingresar mas choferes''>
										<span class="glyphicon glyphicon-plus"></span>&nbsp; <?= __('Agregar Registro')?>
									</button>
								</div>
								<div  class='col-xs-10  col-sm-10'>
									<div class="alert alert-success"><?php echo __('<strong>Nota:</strong> Si eres dueño y chofer solo debes ingresar en uno de los registros tu <strong>Documento</strong>, <strong>Nro de licencia</strong> y <strong>Fecha de vencimiento</strong>') ?></div>
								</div>
							</div>
							<hr>
							<div id='driver_rows'>
									<?= $this->element('registerdriver',array('taxownerdrivers'=>empty($this->request->data['Taxownerdriver']) ? array() : $this->request->data['Taxownerdriver'] )); ?>
							</div>
						</div><!-- tabs 1-->
				</div><!-- TABS GLOBAL -->
							<div class="row">
								<div class="col-xs-2 col-sm-2 col-md-2">
									<?php echo $this->Form->input('User.acceptar',array('label'=>'Registrarse','type'=>'checkbox'))?>
										<span class="button-checkbox">
										</span>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-8 col-sm-9 col-md-9">
									 <?php echo __('Al hacer click en')?> <strong class="label label-primary">
										 	<?php echo __('Registrarse') ?> </strong><?php echo __(', estaras aceptando ') ?>
											<a href="https://taxiar.com.ar/privacidad" type='submit' data-toggle="" data-target=""><?php echo __('Terminos y Condiciones')?></a>
											<?php echo __('correspondiente al sitio, incluido el uso de cookies. Se le enviara un email a su casilla de correo para que confirme los datos y finalice la registración.')?>
								</div>
							</div>
							<hr class="colorgraph">
							<div class="row">
								<div class="col-xs-12 col-md-6">
									<button type="button" class="btn btn-primary btn-block btn-lg" id='guardar' tabindex='30'>
									  <span class="glyphicon glyphicon glyphicon-save"></span>&nbsp;<?php echo __('Registrarse')?>
									</button>
								</div>
							</div>
				<?php echo $this->Form->end();?>
			</div>

</div>
<!-- Modal -->
<div class="modal fade" id="t_and_c_m" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Terms & Conditions</h4>
			</div>
			<div class="modal-body">
					<!-- INICIO -->
					<div class="row" style="padding-top: 150px"></div>

									<!-- Section Privacy start -->
									<section>

									<div class="container">
                    <a href="https://taxiar.com.ar/privacidad">Politicas de Privacidad</a>
                    <div class="modal-footer">
              				<button type="button" class="btn btn-primary" data-dismiss="modal">I Agree</button>
              			</div>

                </div> <!-- model HERE-->

									</section>
                </div>
									<!-- Section Privacy end -->
					<!-- FIN -->
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
