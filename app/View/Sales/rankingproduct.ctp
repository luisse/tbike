<?php echo $this->Html->script(array('fgenerales','dateformat.js','/js/sales/rankingproduct.js','jquery.toastmessage','bootstrap-datetimepicker','jquery.price','jquery.numeric'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css(array('fullcalendar.print.css','fullcalendar.css','bootstrap-datetimepicker','message','dootstrap.docs'), null, array('inline' => false))?>		
<?php echo $this->element('flash_message')?>
<script>
	var link="<?php echo $this->Html->url(array('controller'=>'sales','action'=>'listrankproduct')) ?>"
</script>

<div class="panel  panel-listados">
	<div class="panel-heading">
		<i class="fa fa-user fa-fw"></i><?php echo __('Ranking de productos')?>
    </div>
	<br>
<div class="panel-body">
		<div class="table-responsive">
			<ul class="nav nav-tabs">
			  <li class="active"><a href="#tabs-1"><?php echo __('Filtros') ?></a></li>
			</ul>
			<div class="tab-content">
			  <div class="tab-pane active" id="tabs-1">
					<form id="filterproduct" accept-charset="utf-8" method="post" action="#">
					<fieldset>
					<div class="row">
						<div class="col-lg-2">		
							<label><?php echo __('Fecha Desde')?></label>
							<div class="form-group">
								<div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
									<?php echo $this->Form->input('Product.fecdesde',array('label' =>false,
													'placeholder' => false,
													'class'=>'form-control input-sm',
													'type'=>'text',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
									<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
								</div>
							</div>
						</div>
						<div class="col-lg-2">		
							<label><?php echo __('Fecha Hasta')?></label>
							<div class="form-group">
								<div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
									<?php echo $this->Form->input('Product.fechasta',array('label' =>false,
													'placeholder' => false,
													'class'=>'form-control input-sm',
													'type'=>'text',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
									<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">	
						<div class="col-lg-4">			
							<?php echo $this->Form->input('Product.descripcion', array(
									'label' => 'Producto',
									'placeholder' => 'Nombre de Producto',
									'class'=>'form-control input-sm',
									'type'=>'text'
								))?>
						</div>
						<div class="col-lg-3">			
							<?php echo $this->Form->input('Product.categoria_id', array(
									'label' => __('Categoria'),
									'options'=>$categorias,
									'default'=>0,
									'class'=>'form-control input-sm'
								))?>
						</div>						
						<div class="col-lg-3">			
							<?php echo $this->Form->input('Product.subcategoria_id', array(
									'label' => __('Subcategoria'),
									'class'=>'form-control input-sm'
								))?>
						</div>												
						<div  class="col-lg-1">
							<br>
							<button type="button" class="btn btn-info btn-lw" id='listarrank'>
									<span class="glyphicon glyphicon-search"></span>&nbsp;<?php echo __('Buscar') ?>
							</button>
						</div>  
					</div>  					
					</fieldset>
					<?php echo $this->Form->end()?>
				</div>
			</div>
				<div id='cargandodatos' style='display:none;top: 50%;left: 50%;'>
					<?php echo $this->Html->image('carga.gif')?>
				</div>				
				<div id='listproduct'>
				</div>
		</div>
	</div>
</div>