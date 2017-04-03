<?php			
echo $this->Html->script(array('/js/tallercitos/edit.js','fgenerales','fmensajes.js','jquery.maskedinput','jquery.numeric'),array('block'=>'scriptjs'));?>
<?php echo $this->Form->create('Tallercito',array('action'=>'edit',
		'type'=>'file',	
		'inputDefaults' => array(
							'div' => 'form-group',
							'wrapInput' => false,
							'class' => 'form-control'
							),
		'class' => 'well'
			));?>
<?php echo $this->Form->hidden('id')?>
<fieldset>
	<legend>Datos de Taller</legend>
	<div class="row">	
		<div class="col-lg-3">
					<?php echo $this->Form->input('CUIT',array('label'=>'CUIT',
														'placeholder' => 'CUIT',
														'class'=>'form-control input-sm',
														'type'=>'text',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>			
		<div class="col-lg-5">
			<?php echo $this->Form->input('razonsocial',array('label'=>'Razón Social',
														'placeholder' => 'Razón Social',
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<div class="row">	
		<div class="col-lg-5">
			<?php echo $this->Form->input('direccion',array('label'=>'Dirección',
														'placeholder' => 'Ingrese la Dirección',
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<div class="row">	
		<div class="col-lg-3">
			<?php echo $this->Form->input('telefono',array('label'=>'Telefono',
														'placeholder' => 'Ingrese la Telefono',
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<div class="row">	
		<div class="col-lg-4">
			<?php echo $this->Form->input('email',array('label'=>'Email',
														'placeholder' => 'Ingrese Email',
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-4">
					<?php echo $this->Form->input('webpage',array('label'=>'Web Page',
														'placeholder' => 'Web Page',
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<div class="row">	
		<div class="col-lg-3">
					<?php echo $this->Form->input('provincia_id',array('label'=>'Provincia',
														'placeholder' => 'Ingrese Provincia',
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-3">
				<?php echo $this->Form->input('departamento_id',array('label'=>'Departamento',
														'placeholder' => 'Ingrese Departamento',
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-3">
					<?php echo $this->Form->input('localidade_id',array('label'=>'Localidad',
														'placeholder' => 'Ingrese Localidad',
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-3">
					<?php echo $this->Form->input('shimanocenter',array('label'=>'Shimano Center Oficial',
														'options'=>$str_estadossino,
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>		
	</div>
	<div class="row">
		<div class='col-lg-5'>
				<?php echo $this->Form->input('imglogotallercito',array('label'=>'Logo del Taller',
														'placeholder' => 'Seleccione un Archivo',
														'class'=>'form-control input-sm',
														'type'=>'file',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		
		</div>
		 <div class="col-xs-6 col-md-3">
			<a href="#" class="thumbnail">
				<?php  echo $this->Html->image(array ( 'controller' =>
								'tallercitos' , 'action' => 'mostrarimagen' ,
								$this->data['Tallercito']['id']),
								array ( 'title' =>'Logo del Taller') );
						?>
			</a>
		</div>
	</div>
</fieldset>
<div class="row">	
	<div class="col-xs-6 col-sm-4">
		<button type="button" class="btn btn-success btn-lw" id='guardar'>
		  <span class="glyphicon glyphicon glyphicon-save"></span> Guardar
		</button>	
	</div>
</div>
<?php echo $this->Form->end();?>