<style>
    #map-canvas {
      height: 100%;
      margin: 1px;
      padding: 200px;
      z-index:100;
    }
</style>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"> </script>
<?php echo $this->Html->script(array('https://js.pusher.com/2.2/pusher.min.js','taxorders/taketax.js','jquery.toastmessage','class_cronogo.js'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css(array('message'), null, array('inline' => false))?>
<?php echo $this->element('flash_message')?>
<script>
	var glb_k = "<?php echo $this->Session->read('key')?>"
</script>
<div class="panel panel-primary">
	<div class="panel-heading">
		<i class="fa fa-map-o fa-fw"></i><?php echo __('Pedido de Taxi Online')?>
	</div>
	<div class="panel-body">
			<div class="row">
				<div class='col-lg-9'>
					<div id=''>
						<div class="table-responsive">
							<div id='map-canvas'></div>
						</div>
					</div>				
				</div>
		    	<div class="col-lg-3">	
		    		<div id='takeforms'>
						<?php echo $this->Form->create('Takeorder',array('action'=>'#','id'=>'taxorder',
								'inputDefaults' => array(
													'div' => 'form-group',
													'wrapInput' => false,
													'class' => 'form-control'
													),
								'class' => 'well'
									));?>
			    	
			    		<div id='row'>
							<?php echo $this->Form->input('Taxorder.directiodetails',array('label'=>__('Dirección Actual'),
																	'class'=>'form-control input-lg',
																	'tabindex'=>'19',
																	'type'=>'email',
																	'title'=>__('Debe Ingresar una dirección válida'),
																	'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
					    </div>
			    		<div id='row'>
							<?php echo $this->Form->input('Taxorder.travelto',array('label'=>__('Destino'),
																	'class'=>'form-control input-lg',
																	'tabindex'=>'19',
																	'type'=>'email',
																	'title'=>__('Debe Ingresar un Destino'),
																	'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
					    </div>		  
					    <div id='row'>
					    	&nbsp;
					    </div>  						    		    		
			    		<div id='row'>    	
					        	<button type="button" class="btn btn-primary btn-block btn-lg" id='takeacar'>
					            	<span class="glyphicon glyphicon-ok"></span>&nbsp;<?php echo __('Pedir un Taxi')?>
					            </button>
					    </div>
					    <?php echo $this->Form->end();?>
				    </div>

					<div class="panel panel-default" id='listadopedidos'>
                        <div class="panel-heading">
                            <i class="fa fa-tasks fa-fw"></i> <?php echo __('Seguimiento de pedido')?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group" id='pedidos'></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>				

									    	
			</div>
		</div>
	</div>
</div>
			    
