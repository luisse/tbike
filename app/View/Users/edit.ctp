<?php echo $this->Html->script(array('/js/users/edit.js','jquery.toastmessage','validarclave.js'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>
<?php echo $this->element('flash_message')?>
<?php
$str_estadosusers[0]='Inhabilitado';
$str_estadosusers[1]='Habilitado';
$str_estadosusers[2]='Creado no aceptado';
?>
<ul class="nav nav-tabs" id='myTab'>
	<li><a href="#tabs-3"   data-toggle="tab"><i class="fa fa-pencil fa-fw"></i>&nbsp;<?php echo __('Datos Generales') ?></a></li>
	<li><a href="#tabs-2"  data-toggle="tab"><i class="fa fa-camera fa-fw"></i>&nbsp;<?php echo __('Foto del Perfil') ?></a></li>
	<li><a href="#tabs-1"  data-toggle="tab"><i class="fa fa-unlock  fa-fw"></i>&nbsp;<?php echo __('Modificar Contraseña') ?></a></li>
</ul>
<div class="tab-content">
<div class="tab-pane  active" id="tabs-3">
	
	<?php echo $this->Form->create('User',array('url'=>array('action'=>'edit'),
			'inputDefaults' => array(
							'div' => 'form-group',
							'wrapInput' => false,
							'class' => 'form-control'
							),
				'class' => 'well'
	));?>
	<fieldset>
		<legend><?php echo __('Editar Usuario')?></legend>
				<?php echo $this->Form->input('User.id',array('type'=>'hidden'))?>
				<div class="row">
					<div class="col-lg-3">
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
						<?php if(!empty($clientes)):?>
						<?php echo $this->Form->hidden('Cliente.id')?>

				<?php if($this->Session->read('tipousr')==1):?>
				<div class="row">
					<div class="col-lg-3">
						<?php echo $this->Form->input('User.state',array('label' => 'Estado Usuario',
														'class'=>'form-control input-sm',
														'options'=>$str_estadosusers,
														'value'=>$this->request->data['User']['state'],
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
					</div>
				</div>
				<?php endif;?>
				<div class="row">
					<div class="col-lg-12">
						<div class="alert alert-warning" >
										<?php if($this->Session->read('tipousr') != 2):?>
											<?php echo $this->Html->link($this->Html->image('edit.png',array('title'=>__('Editar Datos Personales',true))),array('controller'=>'clientes',
													'action'=>'edit',$clientes['Cliente']['id']),
													array('onclick'=>'','escape'=>false),'');
											?>
										<?php endif;?>
										<?php echo __('Datos Personales del Cliente ',true)?>
						</div>
					</div>
				</div>
		<div class="row">
			<div class="col-lg-3">
				<?php echo $this->Form->input('Cliente.documento',array('label' => __('Nro de Documento'),
														'placeholder' => __('Número de Documento'),
														'size'=>'3',
														'class'=>'form-control input-sm',
														'value'=>$clientes['Cliente']['documento'],
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
			</div>
				<div class="col-lg-3">
					<label><?php echo __('Fecha de Nacimiento')?></label>
					<div class="form-group">
			            <div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
							<?php echo $this->Form->input('Cliente.fechanac',array('label'=>false,
																'placeholder' => __('Fecha de Nacimiento'),
																'size'=>'7',
																'type'=>'text',
																'value'=>$this->Time->format('d/m/Y',$clientes['Cliente']['fechanac']),
																'class'=>'form-control input-sm',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
			                </span>
						</div>
					</div>
				</div>
		</div>
		<div class="row">
			<div class="col-lg-5">
					<?php echo $this->Form->input('Cliente.apellido',array('label'=>__('Apellido'),
															'placeholder' => __('Ingrese Apellido'),
															'size'=>'7',
															'class'=>'form-control input-sm',
															'value'=>$clientes['Cliente']['apellido'],
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
				<div class="col-lg-5">
					<?php echo $this->Form->input('Cliente.nombre',array('label'=> __('Nombre'),
															'placeholder' => __('Ingrese Nombre'),
															'size'=>'7',
															'value'=>$clientes['Cliente']['nombre'],
															'class'=>'form-control input-sm',
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-2">
				<?php echo $this->Form->input('Cliente.telefono',array('label'=> __('Telefono'),
															'placeholder' => __('Ingrese Telefono'),
															'size'=>'2',
															'value'=>$clientes['Cliente']['telefono'],
															'class'=>'form-control input-sm',
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4">

					<?php echo $this->Form->input('Cliente.domicilio',array('label'=> __('Domiclio'),
															'placeholder' => __('Ingrese Domiclio'),
															'size'=>'10',
															'class'=>'form-control input-sm',
															'value'=>$clientes['Cliente']['domicilio'],
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
				<div class="col-lg-2">
					<?php echo $this->Form->input('Cliente.dpto',array('label'=>__('Dpto'),
																'placeholder' => __('Departamento'),
																'size'=>'2',
																'class'=>'form-control input-sm',
																'value'=>$clientes['Cliente']['dpto'],
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
				<div class="col-lg-2">
				<?php echo $this->Form->input('Cliente.piso',array('label'=>__('Piso'),
																'placeholder' => __('Piso'),
																'size'=>'2',
																'class'=>'form-control input-sm',
																'value'=>$clientes['Cliente']['piso'],
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
				<div class="col-lg-2">
				<?php echo $this->Form->input('Cliente.block',array('label'=>__('Block'),
																'placeholder' => __('Block'),
																'size'=>'2',
																'class'=>'form-control input-sm',
																'value'=>$clientes['Cliente']['block'],
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
			<?php endif;?>
		</fieldset>
	<div class="row">
		<div class="col-xs-6 col-sm-6">
			<center>
			<button type="button" class="btn btn-success btn-lw" id='guardar'>
			  <span class="glyphicon glyphicon glyphicon-save"></span> Guardar
			</button>
			</center>
		</div>
		<div class="col-xs-6 col-sm-6">
			<center>
			<button type="button" class="btn btn-danger btn-lw" id='cancelar'>
			  <span class="glyphicon glyphicon glyphicon-off"></span><?php echo __(' Cancelar')?>
			</button>
			</center>
		</div>
	</div>
	<?php echo $this->Form->end();?>
</div>
<div id="tabs-2" class="tab-pane">

	<?php echo $this->Form->create('Cliente',array('url'=>array('action'=>'editimage'),
						'type'=>'file',
						'inputDefaults' => array(
										'div' => 'form-group',
										'wrapInput' => false,
										'class' => 'form-control'
										),
						'class' => 'well'
	));?>
	<?php echo $this->Form->hidden('Cliente.id',array('value'=>$clientes['Cliente']['id']))?>
	<?php echo $this->Form->hidden('Cliente.user_id',array('value'=>$this->data['User']['id']))?>
	<?php echo $this->Form->hidden('Cliente.tallercito_id',array('value'=>$clientes['Cliente']['tallercito_id']))?>
	<fieldset>
		<div class='row'>
			<div class='col-lg-5'>
					<?php echo $this->Form->input('Cliente.foto',array('label'=>__('Foto del Cliente'),
															'placeholder' => __('Seleccione un Archivo'),
															'class'=>'form-control input-sm',
															'type'=>'file',
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>

			</div>
			 <div class="col-xs-6 col-md-3">
				<a href="#" class="thumbnail">
					<?php if(!empty($clientes['Cliente']['foto'])):?>
					<?php  echo $this->Html->image($clientes['Cliente']['foto'],
									array ( 'title' =>__('Imagen del Cliente'),'width'=>'400px','height'=>'300px') );
							?>
					<?php endif;?>
				</a>
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
<div id="tabs-1" class="tab-pane">
	
	<?php echo $this->Form->create('User',array('url'=>array('action'=>'cambiarcontrasenia'),
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
			  <span class="glyphicon glyphicon glyphicon-save"></span><?php echo __('Guardar')?>
			</button>
			</center>
		</div>
	</div>
	</fieldset>
</div>
</div>
