<?php echo $this->Html->script(array('/js/bicicletareparamos/bicicletasentrega.js','fgenerales','jquery.maskedinput','yellow-text','jquery.price','jquery.numeric','jquery.toastmessage','bootstrap-datetimepicker'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css(array('message','dootstrap.docs'), null, array('inline' => false))?>		
<script>
	var link="<?php echo $this->Html->url(array('controller'=>'bicicletareparamos','action'=>'listbicicletasentrega')) ?>"
</script>
<div class="panel panel-listados">
	<div class="panel-heading">
		<i class="fa fa-thumbs-o-up fa-fw"></i><?php echo __('Entregas de Bicicletas')?> 
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
			<div id='listbicicletaentrega'>
			</div>
	</div>
</div>
<?php echo $this->element('modalbox')?>
