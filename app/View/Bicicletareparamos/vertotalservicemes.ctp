<?php echo $this->Html->script(array('/js/bicicletareparamos/vertotalservicemes.js','fmensajes','jquery.numeric','flot/jquery.flot.js','flot/jquery.flot.categories'),array('block'=>'scriptjs')); ?>
<!--     BLOQUE DE BOTONES -->
<!-- FIN BLOQUE BOTONES -->

<script type="text/javascript">
	var datosdiagrama= new Array();
	<?php if(isset($bicicletareparamos)):?>
	<?php foreach($bicicletareparamos as $bicicletareparamo):?>
		<?php echo 'datosdiagrama["'.$bicicletareparamo['0']['anio'].'"]='.$bicicletareparamo[0]['totalsale'].';'."\n"?>
	<?php endforeach;?>
	<?php endif;?>
</script>
<div class="panel panel-default">
	<div class="panel-heading">
		<i class="fa fa-bar-chart-o fa-fw"></i><?php echo __('Ingresos en Taller') ?>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
		<div class="table-responsive">
			<ul class="nav nav-tabs">
			  <li class="active"><a href="#tabs-1"><?php echo __('Filtros') ?></a></li>
			</ul>
			<div class="tab-content">
			  <div class="tab-pane active" id="tabs-1">
					<form id="filterdiagram" accept-charset="utf-8" method="post" action="#">
					<?php echo $this->Form->input('typeuser',array('type'=>'hidden','value'=>'1')); ?>    
					<fieldset>
					<div class="row">	
						<div class="col-lg-2">			
							<?php echo $this->Form->input('anio', array(
									'label' => __('Año'),
									'class'=>'form-control input-sm',
									'type'=>'text'
								))?>
						</div>
						<div  class="col-lg-1">
							<br>
							<button type="button" class="btn btn-info btn-lw" id='buscar'>
									<span class="glyphicon glyphicon-search"></span> <?php echo __('Buscar') ?>
							</button>
						</div>  
					</div>  					
					</fieldset>
					<?php echo $this->Form->end()?>
				</div>
			</div>
			<br>
		</div>
		<div class='row'>
                        <div class="panel-body">
                            <div class="flot-chart">
                                <div class="flot-chart-content" id="flot-bar-chart"></div>
                            </div>
                        </div>
		</div>
	</div>
</div>
