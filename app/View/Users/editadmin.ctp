<?php echo $this->Html->script(array('/js/users/editadmin.js','jquery.toastmessage','validarclave.js','moment.min','moment-with-locales.min','bootstrap-datetimepicker','fmensajes.js','fgenerales.js','jquery.numeric','jquery.toastmessage'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css(array('bootstrap-datetimepicker','message'), null, array('inline' => false))?>

<?php
	$str_estadosusers[0]=__('Inhabilitado');
	$str_estadosusers[1]=__('Habilitado');
	$str_estadosusers[2]=__('Creado no aceptado');
?>
<ul class="nav nav-tabs" id='myTab'>
	<li><a href="#tabs-5"   data-toggle="tab"><i class="fa fa-pencil fa-fw"></i>&nbsp;<?php echo __('Datos Generales') ?></a></li>
	<li><a href="#tabs-4"  data-toggle="tab"><i class="fa fa-camera fa-fw"></i>&nbsp;<?php  echo __('Foto del Perfil') ?></a></li>
	<li><a href="#tabs-3"  data-toggle="tab"><i class="fa fa-unlock  fa-fw"></i>&nbsp;<?php echo __('Modificar Contraseña') ?></a></li>
</ul>
<div class="tab-content">
<div class="tab-pane  active" id="tabs-5">
	<?php echo $this->Form->create('User',array('action'=>'editadmin',
			'inputDefaults' => array(
							'div' => 'form-group',
							'wrapInput' => false,
							'class' => 'form-control'
							),
				'class' => 'well'
	));?>
	<fieldset>
		<legend><?php echo __('Editar Datos de Usuario')?></legend>
				<?php echo $this->Form->input('User.id',array('type'=>'hidden'))?>
				<div class="row">
					<div class="col-lg-2">
						<?php echo $this->Form->input('User.username',array('label' => 'Usuario',
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-3">
						<?php echo $this->Form->input('User.email',array('label' => 'Correo E.',
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
					</div>
				</div>

				<?php if($this->Session->read('tipousr')==4):?>
				<div class="row">
					<div class="col-lg-3">
						<?php echo $this->Form->input('User.state',array('label' => __('Estado Usuario'),
														'class'=>'form-control input-sm',
														'options'=>$str_estadosusers,
														//'value'=>$this->request->data['User']['state'],
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
					</div>
				</div>
        <div class="row">
					<div class="col-lg-3">
						<?php echo $this->Form->input('User.group_id',array('label' => __('Grupo'),
														'class'=>'form-control input-sm',
														//'value'=>$this->request->data['User']['state'],
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
					</div>
				</div>
				<?php endif;?>
		<?php if($this->request->data['User']['group_id'] != 6): ?>
		<div class="row">
			<div class="col-lg-2">
				<?php echo $this->Form->hidden('People.id',array('value'=>$this->request->data['People']['id'])) ?>
				<?php echo $this->Form->input('People.document',array('label' => __('Nro de Documento'),
														'placeholder' => __('Número de Documento'),
														'size'=>'3',
														'class'=>'form-control input-sm',
														//'value'=>$this->request->data['People']['document'],
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
			</div>
				<div class="col-lg-2">
					<label><?php echo __('Fecha de Nacimiento')?></label>
					<div class="form-group">
			            <div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
							<?php echo $this->Form->input('People.birthdate',array('label'=>false,
																'placeholder' => __('Fecha de Nacimiento'),
																'size'=>'7',
																'type'=>'text',
																//'value'=>$this->Time->format('d/m/Y',$this->request->data['People']['birthdate']),
																'class'=>'form-control input-sm',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
			                </span>
						</div>
					</div>
				</div>
		</div>

		<div class="row">
			<div class="col-lg-2">
					<?php echo $this->Form->input('People.firstname',array('label'=>__('Nombre'),
															'placeholder' => __('Ingrese Nombre'),
															'size'=>'7',
															'class'=>'form-control input-sm',
															//'value'=>$this->request->data['People']['firstname'],
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
			</div>
			<div class="col-lg-2">
					<?php echo $this->Form->input('People.secondname',array('label'=> __('Apellido'),
															'placeholder' => __('Ingrese Apellido'),
															'size'=>'7',
															//'value'=>$this->request->data['People']['secondname'],
															'class'=>'form-control input-sm',
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
			</div>
		</div>
		<div class="row">
				<div class="col-lg-2">
				<?php echo $this->Form->input('People.phonenumber',array('label'=> __('Telefono'),
															'placeholder' => __('Ingrese Telefono'),
															'size'=>'2',
															'value'=>$this->request->data['People']['phonenumber'],
															'class'=>'form-control input-sm',
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
			<div class="row">
			    <div class="col-lg-3">
								<?php echo $this->Form->input('People.countrie_id',array('label'=>__('País'),
																	'class'=>'form-control input-sm',
																	'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
					</div>
					<div class="col-lg-3">
								<?php echo $this->Form->input('People.province_id',array('label'=>__('Provincia'),
																	'class'=>'form-control input-sm',
																	'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
					</div>
					<div class="col-lg-3">
							<?php echo $this->Form->input('People.department_id',array('label'=>__('Departamento'),
																	'placeholder' => 'Ingrese Departamento',
																	'class'=>'form-control input-sm',
																	'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
					</div>
					<div class="col-lg-3">
								<?php echo $this->Form->input('People.location_id',array('label'=>__('Localidad'),
																	'placeholder' => 'Ingrese Localidad',
																	'class'=>'form-control input-sm',
																	'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4">

					<?php echo $this->Form->input('People.address',array('label'=> __('Domiclio'),
															'placeholder' => __('Ingrese Domiclio'),
															'size'=>'10',
															'class'=>'form-control input-sm',
															'value'=>$this->request->data['People']['address'],
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
				<div class="col-lg-2">
					<?php echo $this->Form->input('People.number',array('label'=> __('Nro'),
															'placeholder' => __('Nro'),
															'size'=>'10',
															'class'=>'form-control input-sm',
															'value'=>$this->request->data['People']['number'],
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>

				<div class="col-lg-2">
					<?php echo $this->Form->input('People.depto',array('label'=>__('Dpto'),
																'placeholder' => __('Departamento'),
																'size'=>'2',
																'class'=>'form-control input-sm',
																'value'=>$this->request->data['People']['depto'],
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
				<div class="col-lg-2">
				<?php echo $this->Form->input('People.block',array('label'=>__('Block'),
																'placeholder' => __('Block'),
																'size'=>'2',
																'class'=>'form-control input-sm',
																'value'=>$this->request->data['People']['block'],
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
		<?php endif ?>
		<?php if($this->request->data['User']['group_id'] == 6):?>
			<div class="row">
				<div class="col-lg-2">
					<?php echo $this->Form->hidden('Radiotaxi.id')?>
					<?php echo $this->Form->input('Radiotaxi.cuit',array('label' => __('CUIT *'),
																	'placeholder' => __('Número de CUIT'),
																	'size'=>'3',
																	'type'=>'text',
																	'tabindex'=>'1',
																	'maxlength'=>11,
																	'class'=>'form-control input-sm',
																	'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
				<div class="col-lg-3">
					<?php echo $this->Form->input('Radiotaxi.name',array('label'=>__('Razon Social *'),
																	'placeholder' => __('Razon Social'),
																	'size'=>'20',
																	'type'=>'text',
																	'tabindex'=>'2',
																	'class'=>'form-control input-sm',
																	'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>

					</div>
			</div>
			<div class="row">
				<div class="col-lg-2">
					<?php echo $this->Form->input('Radiotaxi.telefono',array('label'=>__('Telefono *'),
																		'placeholder' => __('Telefono'),
																		'size'=>'12',
																		'tabindex'=>'3',
																		'class'=>'form-control input-sm',
																		'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
				<div class="col-lg-4">
					<?php echo $this->Form->input('Radiotaxi.domicilio',array('label'=>__('Domicilio *'),
																		'placeholder' => __('Ingrese Domicilio'),
																		'size'=>'20',
																		'tabindex'=>'4',
																		'class'=>'form-control input-sm',
																		'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
		<?php endif; ?>

		</fieldset>
	<div class="row">
		<div class="col-xs-6 col-sm-6">
			<center>
			<button type="button" class="btn btn-success btn-lw" id='guardar'>
			  <span class="glyphicon glyphicon glyphicon-save"></span>&nbsp; <?php echo __('Guardar')?>
			</button>
			</center>
		</div>
		<div class="col-xs-6 col-sm-6">
			<center>
			<button type="button" class="btn btn-danger btn-lw" id='cancelar'>
			  <span class="glyphicon glyphicon glyphicon-off"></span>&nbsp;<?php echo __(' Cancelar')?>
			</button>
			</center>
		</div>
	</div>
	<?php echo $this->Form->end();?>
</div>
<div id="tabs-4" class="tab-pane">
	<?php echo $this->Form->create('User',array('action'=>'editimage',
						'type'=>'file',
						'inputDefaults' => array(
										'div' => 'form-group',
										'wrapInput' => false,
										'class' => 'form-control'
										),
						'class' => 'well'
	));?>
	<?php echo $this->Form->hidden('User.call',array('value'=>'admin'))?>
	<?php echo $this->Form->hidden('User.id',array('value'=>$this->data['User']['id']))?>
	<fieldset>
		<div class='row'>
			<div class='col-lg-5'>
					<?php echo $this->Form->input('User.picture',array('label'=>__('Foto de Usuario'),
															'placeholder' => __('Seleccione un Archivo'),
															'class'=>'form-control input-sm',
															'type'=>'file',
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>

			</div>
			 <div class="col-lg-1">
					<?php if(!empty($this->request->data['User']['picture'])):?>
						<img  width='80px' height = '80px' class="img-circle" src="<?php echo $this->request->data['User']['picture'];?>?cache=none"/>
					<?php endif;?>
					<?php if(empty($this->request->data['User']['picture'])):?>
						<?php echo $this->Html->image('https://taxiar-files.s3.amazonaws.com/img/user_not.jpeg',
											array ( 'title' =>__('Imagen de '.$this->Session->read('nomape')),'class'=>'img-circle','width'=>'80px','height'=>'80px'));?>
					<?php endif;?>
			</div>
		</div>
	</fieldset>
	<div class="row">
		<div class="col-lg-1">
			<center>
			<button type="button" class="btn btn-success btn-lw" id='actualizarfoto'>
			  <span class="glyphicon glyphicon glyphicon-save"></span><?php echo __('Actualizar Foto')?>
			</button>
			</center>
		</div>
	</div>

	<?php echo $this->Form->end();?>
</div>
<div id="tabs-3" class="tab-pane">
	<?php echo $this->Form->create('User',array('action'=>'changepassword',
						'inputDefaults' => array(
										'div' => 'form-group',
										'wrapInput' => false,
										'class' => 'form-control'
										),
						'class' => 'well'
	));?>
	<?php echo $this->Form->hidden('User.id',array('value'=>$this->data['User']['id']))?>
	<?php echo $this->Form->hidden('User.cambiarcontrasenia',array('value'=>'0'))?>
	<fieldset>
		<div class='row'>
			<div class='col-lg-5'>
					<?php echo $this->Form->input('User.passwordc',array('label'=>__('Ingresa la Contraseña'),
															'placeholder' => '',
															'class'=>'form-control input-sm',
															'type'=>'password',
															'val'=>'',
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
					<span id='mensajecontrola'></span>

			</div>
		</div>
		<div class='row'>
			 <div  class='col-lg-5'>
					<?php echo $this->Form->input('User.passwordrepit',array('label'=>__('Ingresa nuevamente la Contraseña'),
															'placeholder' => '',
															'class'=>'form-control input-sm',
															'type'=>'password',
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>

			</div>
			<div  class='col-lg-5'>
				<div class="alert alert-success"><?php echo __('Debes repetir la contraseña para evitar errores de tipeo') ?></div>
			</div>
		</div>
	<?php echo $this->Form->end();?>
	<div class="row">
		<div class="col-lg-1">
			<center>
			<button type="button" class="btn btn-success btn-lw" id='actualizarpswd'>
			  <span class="glyphicon glyphicon glyphicon-save"></span>&nbsp;<?php echo __('Guardar')?>
			</button>
			</center>
		</div>
	</div>
	</fieldset>
</div>
	<?php echo $this->element('flash_message')?>	
</div>
