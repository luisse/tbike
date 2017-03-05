<?php echo $this->Html->script(array('/js/bicicletareparamos/tallerlistarbicicletas.js','fgenerales','jquery.maskedinput','fmensajes.js','jquery.toastmessage','bootstrap-datetimepicker','dateformat.js'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css(array('message','bootstrap-datetimepicker','yellow-text-blue'), null, array('inline' => false))?>		
<?php echo $this->element('flash_message')?>
<script>
	var link="<?php echo $this->Html->url(array('controller'=>'bicicletareparamos','action'=>'listadobicicletarepar')) ?>"
</script>
<?php $str_estados[5]='-- TODOS --'?>
<div class="panel panel-danger">
	<div class="panel-heading">
		<i class="fa fa-user-md fa-fw"></i> Ingresos en Taller
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
									'label' => 'Documento ',
									'placeholder' => 'Nro de Documento',
									'class'=>'form-control input-sm',
									'type'=>'text'
								))?>
						</div>
						<div class="col-lg-3">			
							<?php echo $this->Form->input('Cliente.apellido', array(
									'label' => 'Apellido ',
									'class'=>'form-control input-sm'
								))?>
						</div>						
						<div class="col-lg-3">			
							<?php echo $this->Form->input('Cliente.nombre', array(
									'label' => 'Nombre ',
									'placeholder' => '',
									'class'=>'form-control input-sm'
								))?>
						</div>
						<div class="col-lg-3">			
							<?php echo $this->Form->input('Bicicletareparamo.estado', array(
									'label' => 'Estado ',
									'placeholder' => '',
									'value'=>'5',
									'class'=>'form-control input-sm',
									'options'=>$str_estados
								))?>
						</div>
						<div class="col-lg-3">			
							<?php echo $this->Form->input('Bicicletareparamo.nrodecuadro', array(
									'label' => 'Nro de Cuadro ',
									'placeholder' => '',
									'class'=>'form-control input-sm'
								))?>
						</div>					
						<div  class="col-lg-1">
							<br>
							<button type="button" class="btn btn-info btn-lw" id='buscar'>
									<span class="glyphicon glyphicon-search"></span> Buscar
							</button>
						</div>  
					</div>  					
					</fieldset>
					<?php echo $this->Form->end()?>
				</div>
			</div>
			<br>
		</div>
			<div id='cargandodatos' style='display:none;top: 50%;left: 50%;text-align:center'>
				<?php echo $this->Html->image('carga.gif')?>
			</div>						
			<div id='listbicicletareparo'>
			</div>
	</div>
</div>
<?php echo $this->element('modalbox')?>
