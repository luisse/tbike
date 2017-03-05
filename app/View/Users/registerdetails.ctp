<?php	echo $this->Html->script('/js/users/useractive.js',array('block'=>'scriptjs'));?>
<?php echo $this->Form->create('User',array('action'=>'#',
			'inputDefaults' => array(
								'div' => 'form-group',
								'wrapInput' => false,
								'class' => 'form-control'
								),
			'class' => 'well',
			'novalidate' => true
));?>
<div class="container">
<?php if(!empty($usersdata)):?>
		<h2><?php echo __('Pre-Registro Finalizado')?></h2>
		<hr class="colorgraph">
    <div class="row">
      <div class="col-lg-12">
        <div class="alert alert-success"><?php echo __('<strong>Importante:</strong> Debe presentarse en las oficinas con los papeles requeridos para validar la información registrada el día <strong>'.$this->Time->format('d/m/Y h:i',$usersdata['Turn']['dateturn']).'</stron>') ?></div>
      </div>
    </div>

			<?php echo $this->Form->input('User.id',array('type'=>'hidden','value'=>$usersdata['User']['id']))?>
			<div class="row">
				<div class="col-lg-3">
					<?php echo $this->Form->input('User.username',array('label' => __('Usuario'),
													'class'=>'form-control input-sm',
													'value'=>$usersdata['User']['username'],
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3">
					<?php echo $this->Form->input('User.email',array('label' => __('Correo Electrónico'),
													'class'=>'form-control input-sm',
													'value'=>$usersdata['User']['email'],
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
				</div>
			</div>
	<div class="row">
		<div class="col-lg-2">
			<?php echo $this->Form->input('People.document',array('label' => __('Nro de Documento'),
													'size'=>'3',
													'class'=>'form-control input-sm',
													'value'=>$usersdata['People']['document'],
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
															'value'=>$this->Time->format('d/m/Y',$usersdata['People']['birthdate']),
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
				<?php echo $this->Form->input('People.firstname',array('label'=>__('Apellido'),
														'placeholder' => __('Ingrese Apellido'),
														'size'=>'7',
														'class'=>'form-control input-sm',
														'value'=>$usersdata['People']['firstname'],
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
			</div>
			<div class="col-lg-3">
				<?php echo $this->Form->input('People.secondname',array('label'=>__('Nombre'),
														'placeholder' => __('Ingrese Nombre'),
														'size'=>'7',
														'value'=>$usersdata['People']['secondname'],
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2">
			<?php echo $this->Form->input('People.phonenumber',array('label'=>__('Telefono'),
														'placeholder' => __('Ingrese Telefono'),
														'size'=>'2',
														'value'=>$usersdata['People']['phonenumber'],
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
			</div>
		</div>
  <?php echo $this->Form->end();?>
  <?php if(!empty($usersdata)):?>
  <div class="row">
  	<div class="col-lg-12">
  		<center>
  		<button type="button" class="btn btn-success btn-lw" onclick=" window.print();">
  		  <span class="glyphicon glyphicon glyphicon-print"></span>&nbsp;<?php echo __('Imprimir Pre-Registro') ?>
  		</button>
  		</center>
  	</div>
  </div>
  <?php endif;?>
<?php endif;?>

<?php if(empty($usersdata)):?>
<fieldset>
	<legend><?php echo __('No se encuentra el usuario en el Sistema u ya activo el usuario. Por Favor Contacte con el Administrador')?></legend>
</fieldset>
<?php endif;?>

<div class="container">
