<?php //echo $this->Html->script(array('jquery.maskedinput','jquery.toastmessage'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css(array('timeline','message'), null, array('inline' => false))?>		
<?php echo $this->element('flash_message')?>
<script>
	var link="<?php echo $this->Html->url(array('controller'=>'bicicletareparamos','action'=>'listbicicletasreparadas')) ?>"
</script>
<div class="panel panel-ingresos">
	<div class="panel-heading">
		<i class="fa fa-clock-o fa-fw"></i><?php echo __('Historial de Mantenemiento')?>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
    	<ul class="timeline">
    	<?php $class=''?>
    	<?php foreach($bicicletareparamos as $bicicletareparamo):?>
    	<?php if($class == 'timeline-inverted')
    			$class='';
    		else
    			$class='timeline-inverted';?>
    			<li class='<?php echo $class?>'>
				  <div class="timeline-badge danger"><i class="glyphicon glyphicon-wrench"></i></div>
				  <div class="timeline-panel">
					<div class="timeline-heading">
					  <h3 class="timeline-title"><?php echo __('Mantenimiento y Reparación')?></h3>
					</div>
					<div class="timeline-body">
					  	<h4><?php echo __('Bicicleta: ');?></h4>
						<h5><span class="label label-success"><?php echo $bicicletareparamo['Bicicleta']['marca'].' - Modelo:'.$bicicletareparamo['Bicicleta']['modelo']?></span></h5>
						<p><small class="text-info"><i class="glyphicon glyphicon-time"></i>&nbsp;<?php echo 'Fecha de Ingreso: '.$this->Time->Format('d/m/Y',$bicicletareparamo['Bicicletareparamo']['fechaingreso'])?></small></p>
						<p><small class="text-success"><i class="glyphicon glyphicon-time"></i>&nbsp;<?php echo 'Fecha de Egreso: '.$this->Time->Format('d/m/Y',$bicicletareparamo['Bicicletareparamo']['fechaegreso'])?></small></p>
					  	<h4><?php echo __('Detalle Reparación: ');?></h4>											  
					  	<h5><span class="label label-success"><?php echo $bicicletareparamo['Bicicletareparamo']['detallereparacion']?></span></h5>
					</div>
				  </div>
				</li>
    	<?php endforeach;?>
    	</ul>
	</div>
</div>