<?php echo $this->Html->script(array('/js/radiotaxicars/index.js','jquery.maskedinput','jquery.toastmessage'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>
<?php echo $this->element('flash_message')?>
<script>
	var link="<?php echo $this->Html->url(array('controller'=>'radiotaxicars','action'=>'listcars')) ?>"
</script>

<?php
	$str_estadosusers[0]=__('Inactivo');
	$str_estadosusers[1]=__('Activo');
	$str_estadosusers[2]=__('');
?>

<div class="panel  panel-default">
    <div class="panel-heading">
		<i class="fa fa-users fa-fw"></i> <?php echo __('Listado de Taxis Asociados');?>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
			<ul class="nav nav-tabs">
			  <li class="active"><a href="#tabs-1"><?php echo __('Filtro Taxis') ?></a></li>
			</ul>
			<div class="tab-content">
			  <div class="tab-pane active" id="tabs-1">
					<!-- <form id="filteralumno" accept-charset="utf-8" method="post" action="#">  -->
					<?php echo $this->Form->create('Taxownerscar',array('action'=>'#','id'=>'filtercar'));?>
					<div class="row">
						<div class="col-lg-3">
							<?php echo $this->Form->input('Taxownerscar.registerpermision', array(
									'label' => __('Licencia Automovil'),
									'type'=>'text',
									'class'=>'form-control input-sm',
									'size'=>5
								))?>
						</div>
						<div class="col-lg-1">
							<?php echo $this->Form->input('Taxownerscar.carcode', array(
									'label' => __('Patente'),
									'class'=>'form-control input-sm'
								))?>
						</div>
						<div class="col-lg-1">
							<?php echo $this->Form->input('Taxownerscar.state', array(
									'label' => __('Estado'),
									'options'=>$str_estadosusers,
									'value'=>'2',
									'class'=>'form-control input-sm'
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
				<?php echo $this->Form->end()?>
			</div>
		<div class="table-responsive">
			<div id='cargandodatos' style='display:none;top: 50%;left: 50%;text-align:center'>
				<?php echo $this->Html->image('https://taxiar-files.s3.amazonaws.com/img/carga.gif')?>
			</div>
			<div id='listcars'>
			</div>
		</div>
	</div>
</div>
