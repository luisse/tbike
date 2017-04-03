<?php echo $this->Html->script(array('/js/users/registeruser.js','jquery.maskedinput','moment.min','moment-with-locales.min','bootstrap-datetimepicker','fmensajes.js','fgenerales.js','jquery.numeric','jquery.toastmessage'),array('block'=>'scriptjs'));		?>
<?php echo $this->Html->css(array('bootstrap-datetimepicker','message'), null, array('inline' => false))?>
<script>
var msg_term="<?php echo __('Debe Aceptar los terminos para continuar')?>"
var msg_people="<?php echo __('El Alta de Usuario es posible para personas mayores de 18 años')?>"
</script>
<div class="container">
	<div class="row">
	    <div class="col-lg-12">
			<?php echo $this->Form->create('User',array('action'=>'registeruser',
					'inputDefaults' => array(
										'div' => 'form-group',
										'wrapInput' => false,
										'class' => 'form-control'
										),
					'class' => 'well'
						));?>
				<h2><?php echo __('Por favor registrese')?> <small></small></h2>
				<hr class="colorgraph">
				<div class="row">
					<div class="col-lg-3 col-sm-6 col-md-6">
						<?php echo $this->Form->input('People.document',array('label' => __('* Nro de Documento'),
																'placeholder' => __('Número de Documento'),
																'size'=>'3',
																'type'=>'text',
																'class'=>'form-control input-lg',
																'title'=>__('Debe Ingresar el Documento'),
																'tabindex'=>'1',
																'maxlength'=>8,
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
					</div>
					<div class="col-lg-3">
						<label><?php echo __('* Fecha de Nacimiento') ?></label>
						<div class="form-group">
				            <div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
								<?php echo $this->Form->input('People.birthdate',array('label'=>false,
																	'placeholder' => __('* Fecha de Nacimiento'),
																	'size'=>'7',
																	'type'=>'text',
																	'title'=>__('Debe Ingresar Fecha de Nacimiento'),
																	'tabindex'=>'2',
																	'class'=>'form-control input-lg',
																	'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
				                </span>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-3">
						<?php echo $this->Form->input('People.firstname',array('label'=>__('* Apellido'),
																'placeholder' => __('Ingrese Apellido'),
																'size'=>'7',
																'title'=>__('Debe Ingresar el Apellido'),
																'tabindex'=>'3',
																'class'=>'form-control input-lg',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
					</div>
					<div class="col-lg-4">
						<?php echo $this->Form->input('People.secondname',array('label'=>__('* Nombres'),
																'placeholder' => __('Ingrese Nombre'),
																'size'=>'7',
																'title'=>__('Debe Ingresar el Nombre'),
																'tabindex'=>'4',
																'class'=>'form-control input-lg',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-2">
					<?php
					$options = array('0' => __('Femenino'), '1' => 'Masculino');
					echo $this->Form->input('People.gender',array('label'=>__('* Sexo'),
																'options'=>$options,
																'value'=>1,
																'tabindex'=>'5',
																'class'=>'form-control input-lg',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-2">
					<?php echo $this->Form->input('People.phonenumber',array('label'=>__('Telefono'),
																'placeholder' => __('Ingrese Telefono'),
																'size'=>'2',
																'tabindex'=>'6',
																'class'=>'form-control input-lg',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
					</div>
				</div>
				<div class="row">
			    <div class="col-lg-3">
								<?php echo $this->Form->input('People.countrie_id',array('label'=>__('País'),
																	'class'=>'form-control input-lg',
																	'tabindex'=>'7',
																	'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
					</div>
					<div class="col-lg-3">
								<?php echo $this->Form->input('People.province_id',array('label'=>__('Provincia'),
																	'class'=>'form-control input-lg',
																	'tabindex'=>'8',
																	'title'=>__('Debe Ingresar la Provincia'),
																	'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
					</div>
					<div class="col-lg-3">
							<?php echo $this->Form->input('People.department_id',array('label'=>__('Departamento'),
																	'placeholder' => 'Ingrese Departamento',
																	'class'=>'form-control input-lg',
																	'tabindex'=>'9',
																	'title'=>__('Debe Ingresar el Departamento'),
																	'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
					</div>
					<div class="col-lg-3">
								<?php echo $this->Form->input('People.location_id',array('label'=>__('Localidad'),
																	'placeholder' => 'Ingrese Localidad',
																	'class'=>'form-control input-lg',
																	'tabindex'=>'10',
																	'title'=>__('Debe Ingresar la Localidad'),
																	'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4">
						<?php echo $this->Form->input('People.address',array('label'=>__('* Domicilio'),
																'placeholder' => __('Ingrese Domicilio'),
																'size'=>'10',
																'tabindex'=>'11',
																'class'=>'form-control input-lg',
																'title'=>__('Debe Ingresar el Domicilio'),
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
					</div>
			    <div class="col-lg-2">
						<?php echo $this->Form->input('People.number',array('label'=>__('* Número'),
																'placeholder' => __('Ingrese Altura'),
																'size'=>'10',
																'tabindex'=>'12',
																'type'=>'text',
																'title'=>__('Debe Ingresar Altura Número'),
																'class'=>'form-control input-lg',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
					</div>
					<div class="col-lg-1">
						<?php echo $this->Form->input('People.depto',array('label'=>__('Dpto'),
																	'placeholder' => __('Departamento'),
																	'size'=>'2',
																	'tabindex'=>'13',
																	'type'=>'text',
																	'title'=>__('Debe Ingresar el Dpto'),
																	'class'=>'form-control input-lg',
																	'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
					</div>
					<div class="col-lg-1">
					<?php echo $this->Form->input('People.piso',array('label'=>__('Piso'),
																	'placeholder' => __('Piso'),
																	'size'=>'2',
																	'tabindex'=>'14',
																	'type'=>'text',
																	'class'=>'form-control input-lg',
																	'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
					</div>
					<div class="col-lg-1">
					<?php echo $this->Form->input('People.block',array('label'=>__('Block'),
																	'placeholder' => __('Block'),
																	'size'=>'2',
																	'tabindex'=>'15',
																	'type'=>'text',
																	'class'=>'form-control input-lg',
																	'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-3">
								<?php echo $this->Form->input('User.username',array('label'=>__('* Usuario'),
																'placeholder' => __('Ingrese Usuario'),
																'class'=>'form-control input-lg',
																'title'=>__('Debe Ingresar el Usuario'),
																'tabindex'=>'16',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-3">
							<?php echo $this->Form->input('User.password',array('label'=>__('* Contraseña'),
																'class'=>'form-control input-lg',
																'tabindex'=>'17',
																'title'=>__('Debe Ingresar la Contraseña'),
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-3">
								<?php echo $this->Form->input('User.password_repit',array('label'=>__('* Repetir Contraseña'),
																'class'=>'form-control input-lg',
																'type'=>'password',
																'tabindex'=>'18',
																'title'=>__('Debe Repetir la Contraseña'),
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4">
						<?php echo $this->Form->input('User.email',array('label'=>'* E-Mail',
																'placeholder' => 'E-Mail',
																'class'=>'form-control input-lg',
																'tabindex'=>'19',
																'type'=>'email',
																'title'=>__('Debe Ingresar un correo electrónico válido'),
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
					</div>
				</div>
			<div class="row">
				<div class="col-xs-4 col-sm-3 col-md-3">
					<div class="col-xs-4 col-sm-3 col-md-3">
					    <span class="button-checkbox">
					        <button type="button" class="btn" data-color="primary"><?php echo __('Aceptar')?></button>
					        <input type="checkbox" class="hidden" id='aceptterm'/>
					    </span>
					</div>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-9">
					 <?php echo __('Al hacer click en')?> <strong class="label label-primary"><?php echo __('Registrarse') ?> </strong><?php echo __(', estaras aceptando ') ?><a href="#" type='submit' data-toggle="modal" data-target="#t_and_c_m"><?php echo __('Terminos y Condiciones')?></a> <?php echo __('correspondiente al sitio, incluido el uso de cookies.')?>
				</div>
			</div>

			<hr class="colorgraph">
			<div class="row">
				<div class="col-xs-12 col-md-6">
					<button type="button" class="btn btn-primary btn-block btn-lg" id='registrarse' tabindex='30'>
					  <span class="glyphicon glyphicon glyphicon-save"></span> <?php echo __('Registrarse')?>
					</button>
				</div>
				<div class="col-xs-12 col-md-6"><a href="/users/login" class="btn btn-success btn-block btn-lg"><?php echo __('Ingresar')?></a></div>
			</div>
			<?php echo $this->Form->end();?>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="t_and_c_m" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Terms & Conditions</h4>
			</div>
			<div class="modal-body">
				<p><strong>Viveo Pty Ltd (“Viveo”)</strong> respects the privacy of its customers, business contacts and employees. This Policy outlines the policy of Viveo in managing personal information which it holds. Viveo is bound by the National Privacy Principles ("NPPs") contained in the Privacy Act 1988 ("Privacy Act"). In summary, "personal information" is information or an opinion relating to an individual which can be used to identify that individual.
										</p>

										<p class="privacy-color">
												Why does Viveo collect personal information?
										</p>
										<p>
										Viveo collects personal information in order to conduct its business of selling our products and services. It may also collect anonymous website usage information to use for website improvement and marketing purposes.
										</p>

										<p class="privacy-color">
												About whom do we collect personal information?
										</p>
										<p>
												They type of personal information Viveo may collect and hold includes (but is not limited to) information about customers of Viveo.
										</p>

										<p class="privacy-color">
												What kind of personal information do we collect?
										</p>
										<p>
												In general, the type of personal information Viveo collects and hold include (but is not limited to) names, addresses, contact details, credit card details and email addresses, which assist us in conducting our business and meeting our legal obligations. In most cases, if personal information we request is not provided, we may not be able to supply the relevant product or service.
										</p>

										<p class="privacy-color">
												How do we collect personal information?
										</p>
										<p style="font-size: 12px!important">
												When you visit this site, our server logs the following information which is provided by your browser for statistical purposes only:<br>
												</p><blockquote>
														<p>
																- the type of browser and operating system you are using;
														</p>
														<p>
																- your top level domain name (for example .com, .gov, .au, .uk etc);
														</p>
														<p>
																- the address of the referring site (for example, the previous site that you visited); and
														</p>
														<p>
																- your server's IP address (a number which is unique to the machine through which you are connected to the internet).
														</p>
												</blockquote>
												<p style="text-align:left">In addition, our server logs the following information:</p>
												<blockquote>
														<p>
																- the date and time of your visit; and
														</p>
														<p>
																- the address of the pages accessed and the documents downloaded.
														</p>
												</blockquote>
												<p>All of this information we use only for statistical analysis or systems administration purposes. No attempt will be made to identify users or their browsing activities.</p>
										<p></p>

										<p class="privacy-color">
												Website collection
										</p>
										<p>
												Viveo collects personal information from its website through emails. We also use third parties to analyse traffic at that website, which may involve the use of cookies. Information collected through such analysis is anonymous.
										</p>

										<p class="privacy-color">
												How might we use and disclose your personal information?
										</p>
										<p>
												Viveo may use and disclose your personal information for the primary purpose for which it is collected, for reasonably expected secondary purposes which are related to the primary purpose and in other circumstances authorised by the Privacy Act. In general, we may use and disclose your personal information for the following purposes:

														</p><blockquote>
														<p>
																- to operate and manage our business;
														</p>
														<p>
																- to conduct our business, including for marketing and research purposes;
														</p>
														<p>
																- to communicate with you; and
														</p>
														<p>
																- to comply with our legal obligations.
														</p>
														</blockquote>

												<p>Apart from in the above circumstances, your personal information will generally not be disclosed without your consent.</p>
										<p></p>

										<p class="privacy-color">
												To whom might we disclose your personal information?
										</p>
										<p>
												We may disclose your personal information to other companies or individuals who assist us in providing services or whom perform functions on our behalf.
										</p>

										<p class="privacy-color">
												Management of personal information
										</p>
										<p>
												The NPPs require us to take reasonable steps to protect the security of personal information. Viveo staff are required to respect the confidentiality of personal information and the privacy of individuals. Viveo take steps to protect personal information held from misuse and loss and from unauthorised access, modification or disclosure, for example by use of physical security and restricted access to electronic records. Shopping at this website is safe, using standard SSL, 40-bit encryption security features for all personal information entry areas. Once the information is in storage our secure servers protect information using advance firewall technology. Where we no longer require your personal information for a permitted purpose under the NPPs, we will take reasonable steps to destroy it.
										</p>

										<p class="privacy-color">
												How do we keep personal information accurate and to date?
										</p>
										<p>
												Viveo endeavours to ensure that the personal information we hold is accurate, complete and up-to-date. You can contact us in order to update any personal information we hold about you. Our contact details are set out below. You have the ability to seek access to your personal information. Subject to the exceptions set out in the Privacy Act, you may seek access to personal information which Viveo holds about you by contacting Viveo's Privacy Officer. We will require you to verify your identify and to specify what information you require. A fee may be charged for providing access. We will advise you of the likely cost in advance.
										</p>

										<p class="privacy-color">
												Updates to this policy
										</p>
										<p>
												This policy will be reviewed from time to time to take account of new laws and technology, changes to our operations and practices and the change in business environment. The most current version of this policy can be obtained by contacting our Privacy Officer.
										</p>
										<p class="privacy-color">
												Enquires
										</p>
										<p>
												If you have any questions about privacy-related issues, please contact Viveo's Privacy Officer:<br></p>				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">I Agree</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
