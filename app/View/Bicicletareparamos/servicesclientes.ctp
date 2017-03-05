<?php echo $this->Html->script(array('/js/bicicletareparamos/servicesclientes.js','jquery.maskedinput'),array('block'=>'scriptjs'));?>
<script>
	var link="<?php echo $this->Html->url(array('controller'=>'bicicletareparamos','action'=>'listbicicletasreparadas')) ?>"
</script>
<div class="panel panel-listados">
	<div class="panel-heading">
		<i class="fa fa-cogs fa-fw"></i>&nbsp;<?php echo __('Ingresos en Taller')?>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
			<div id='listbicicletareparo'>
			</div>
	</div>
</div>
<?php echo $this->element('modalbox')?>
