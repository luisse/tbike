<?php echo $this->Html->script(array('/js/clientes/clientedeuda.js','jquery.maskedinput','jquery.toastmessage','fgenerales'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>		
<?php echo $this->element('flash_message')?>
<script>
	var link="<?php echo $this->Html->url(array('controller'=>'clientes','action'=>'listarclientedeuda')) ?>"
</script>
<div class="panel panel-deudas">
	<div class="panel-heading">
		<i class="fa fa-money fa-fw"></i>&nbsp;<?php echo __('Deudas de Clientes'); ?>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
		<div class="table-responsive">
			<ul class="nav nav-tabs">
			  <li class="active"><a href="#tabs-1"><?php echo __('Filtros') ?></a></li>
			</ul>
			<div class="tab-content">
			  <div class="tab-pane active" id="tabs-1">
					<form id="filterclient" accept-charset="utf-8" method="post" action="#">
					<?php echo $this->Form->input('typeuser',array('type'=>'hidden','value'=>'1')); ?>    
					<fieldset>
					<div class="row">	
						<div class="col-lg-2">			
							<?php echo $this->Form->input('Cliente.documento', array(
									'label' => __('Documento'),
									'placeholder' => __('Nro de Documento'),
									'class'=>'form-control input-sm',
									'type'=>'text'
								))?>
						</div>
						<div class="col-lg-3">			
							<?php echo $this->Form->input('Cliente.apellido', array(
									'label' => __('Apellido'),
									'class'=>'form-control input-sm'
								))?>
						</div>						
						<div class="col-lg-3">			
							<?php echo $this->Form->input('Cliente.nombre', array(
									'label' => __('Nombre'),
									'placeholder' => '',
									'class'=>'form-control input-sm'
								))?>
						</div>
						<div  class="col-lg-1">
							<br>
							<button type="button" class="btn btn-info btn-lw" id='buscar'>
									<span class="glyphicon glyphicon-search"></span>&nbsp;<?php echo __('Buscar') ?>
							</button>
						</div>  
					</div>  					
					</fieldset>
					<?php echo $this->Form->end()?>
				</div>
			</div>
			<br>
		</div>
			<div id='cargandodatos' style='display:none;top: 50%;left: 50%;'>
				<?php echo $this->Html->image('carga.gif')?>
			</div>			
			<div id='listarclientesaldos'>
			</div>
	</div>
</div>
<?php echo $this->element('modalbox')?>
