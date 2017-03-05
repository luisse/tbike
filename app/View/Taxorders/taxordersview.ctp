<?php echo $this->Html->script(array('/js/taxorders/taxordersview.js','jquery.toastmessage'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css(array('message'), null, array('inline' => false))?>
<div class="panel panel-default plain toggle panelMove panelClose panelRefresh" id="dyn_13">
	<div class="panel-heading">
		<i class="fa fa-comments"></i>&nbsp;<?php echo __('Histórico de Pedidos Realizados')?>
	    <div class="pull-right"><div class="btn-group"><a class="panel-refresh" href="#"><i class="fa fa-circle-o"></i></a></div></div>
 	</div>
    <div class="panel-body">
    	<ul class="list-group">
    			<div id='listpedidos'>
              	</div>
             </ul>
      	</div>
</div>