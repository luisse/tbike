	<div class="row">
		<div class="col-lg-1">
		<div class="btn-group">
			<a class="btn btn-app" href="#" id='selcliente'><i class="fa  fa-user"></i><?php echo __(' Sel. Cliente')?></a>
		</div>	
		</div>						
		<div class="col-lg-2">
				<?php echo $this->Form->hidden($modelname.'cliente_id');?>
				<?php echo $this->Form->input($modelname.'clientedoc',array('label' => 'Documento',
						'class'=>'form-control input-sm',
						'type'=>'text',
						'maxlength'=>'10',
						'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>											
		<div class="col-lg-3">
				<?php echo $this->Form->input($modelname.'nomap',array('label' => 'Nombre y Apellido',
				'class'=>'form-control input-sm',
				'type'=>'text',
				'maxlength'=>'10',
				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>	
		<div class="col-lg-1">
				<?php echo $this->Form->input($modelname.'credito',array('label' => 'Credito',
				'class'=>'form-control input-sm',
				'type'=>'text',
				'maxlength'=>'10',
				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class='col-lg-2'>
			<br>
			<button type="button" class="btn btn-info btn-lw" id='mostrar'>
				<span class="glyphicon glyphicon-search"></span>&nbsp;<?php echo __('Mostrar')?>
			</button>						
		</div>													
	</div>