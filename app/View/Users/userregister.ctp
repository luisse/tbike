<?php echo $this->Html->script(array('/js/users/userregister.js','jquery.maskedinput','bootstrap-datetimepicker','fmensajes.js','fgenerales.js','jquery.numeric'),array('block'=>'scriptjs'));		?>
<?php echo $this->Html->css('bootstrap-datetimepicker', null, array('inline' => false))?>

<?php echo $this->Form->create('User',array('action'=>'userregister',
		'inputDefaults' => array(
							'div' => 'form-group',
							'wrapInput' => false,
							'class' => 'form-control'
							),
		'class' => 'well'
			));?>
      <legend><?php echo __('Registro de Usuario')?></legend>
      <div class="row">
    		<div class="col-lg-3">
    			<?php echo $this->Form->input('User.email',array('label'=>'E-Mail',
    													'placeholder' => 'E-Mail',
    													'class'=>'form-control input-sm',
    													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
    		</div>
    	</div>
      <div class="row">
    		<div class="col-lg-3">
    					<?php echo $this->Form->input('User.username',array('label'=>__('Usuario'),
    													'placeholder' => __('Ingrese Usuario'),
    													'class'=>'form-control input-sm',
    													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
    		</div>
    	</div>
    	<div class="row">
    		<div class="col-lg-3">
    				<?php echo $this->Form->input('User.password',array('label'=>__('Contraseña'),
    													'class'=>'form-control input-sm',
    													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
    		</div>
    	</div>
    	<div class="row">
    		<div class="col-lg-3">
    					<?php echo $this->Form->input('User.password_repit',array('label'=>__('Repetir Contraseña'),
    													'class'=>'form-control input-sm',
    													'type'=>'password',
    													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
    		</div>
    	</div>
    </fieldset>
    <div class="row">
    	<div class="col-xs-6 col-sm-6">
    		<center>
    		<button type="button" class="btn btn-success btn-lw" id='guardar'>
    		  <span class="glyphicon glyphicon glyphicon-save"></span> <?php echo __('Guardar')?>
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
