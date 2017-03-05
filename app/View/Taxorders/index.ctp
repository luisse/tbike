<?php echo $this->Html->script(array('/js/taxorders/index.js','jquery.toastmessage'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>
<?php echo $this->element('flash_message')?>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-table fa-fw"></i><?php echo __('Mis Pedidos')?>
			</div>
			<div class="panel-body">
			<div id='cargandodatos' style='display:none;top: 50%;left: 50%;text-align:center'>
				<?php echo $this->Html->image('https://taxiar-files.s3.amazonaws.com/img/carga.gif')?>
			</div>
			<div id='listorders'></div>
			</div>
	</div>
	</div>
</div>
