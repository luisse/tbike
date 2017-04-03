<?php echo $this->Html->script(array('/js/users/index.js','jquery.maskedinput','jquery.toastmessage'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>		
<?php echo $this->element('flash_message')?>
<script>
	var link="<?php echo $this->Html->url(array('controller'=>'users','action'=>'listusers')) ?>"
</script>

<div class="panel  panel-listados">
    <div class="panel-heading">
		<i class="fa fa-users fa-fw"></i> <?php echo __('Datos de Usuarios');?>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
    	<div class="table-responsive">
			<ul class="nav nav-tabs">
			  <li class="active"><a href="#tabs-1"><?php echo __('Filtro Usuarios') ?></a></li>
			</ul>
			<div class="tab-content">
			  <div class="tab-pane active" id="tabs-1">
					<!-- <form id="filteralumno" accept-charset="utf-8" method="post" action="#">  -->
					<?php echo $this->Form->create('User',array('action'=>'#','id'=>'filteruser'));?>
					<?php echo $this->Form->input('typeuser',array('type'=>'hidden','value'=>'1')); ?>    
				<fieldset>
					<div class="row">	
						<div class="col-lg-3">			
							<?php echo $this->Form->input('Cliente.documento', array(
									'label' => __('Documento '),
									'type'=>'text',
									'placeholder' => __('Nro de Documento'),
									'class'=>'form-control input-sm',
									'size'=>10
								))?>
						</div>
					</div>			
					<div class="row">
						<div  class="col-lg-4">
							<?php echo $this->Form->input('Cliente.apellido', array(
									'label' => __('Apellido '),
									'placeholder' => __('Apellido'),
									'class'=>'form-control input-sm',
									'size'=>30
								))?>
						</div>
						 <div class="col-lg-4">
							<?php echo $this->Form->input('Cliente.nombre', array(
									'label' => __('Nombre '),
									'placeholder' => __('Nombre'),
									'class'=>'form-control input-sm',
									'size'=>30
								))?>
						</div>
						
						<div  class="col-lg-2">
							<br>
							<button type="button" class="btn btn-info btn-lw" id='buscar'>
									<span class="glyphicon glyphicon-search"></span> <?php echo __('Buscar');?>
							</button>
						</div>    
					    
				    </div>
				</div>
				</fieldset>
				<?php echo $this->Form->end()?>
			</div>
		</div>	
		<div id='cargandodatos' style='display:none;top: 50%;left: 50%;text-align:center'>
			<?php echo $this->Html->image('carga.gif')?>
		</div>				
		<div id='listusers'>
		</div>
	</div>
</div>
