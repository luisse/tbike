<style>
#map-canvas {
  height: 350px;
  width: 100%;
  margin: 10px;
  z-index:100;
}
</style>
<?php echo $this->Html->script(array('https://cdn.firebase.com/js/client/2.3.1/firebase.js',
				'https://maps.googleapis.com/maps/api/js?v=3.exp&key='.$key_api_maps,'class_cronogo.js',
				'taxorders/taketax.js','jquery.toastmessage',
				'bootstrap-typeahead.js'),array('block'=>'scriptjs'));?>
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
		    		<div id='takeforms' >
						<?php echo $this->Form->create('Takeorder',array('action'=>'#','id'=>'taxorder',
								'inputDefaults' => array(
													'div' => 'form-group',
													'wrapInput' => false,
													'class' => 'form-control'
													),
								'class' => 'well'
									));?>

			    		<div class='row'>
			    			<label><?php echo __('Dirección Actual')?></label>
				    		<!-- <div class="input-group"> -->
								<?php echo $this->Form->input('Taxorder.directiodetails',array('label'=>false,
																		'class'=>'form-control input-lg',
																		'tabindex'=>'19',
																		'type'=>'email',
																		'title'=>__('Debe Ingresar una dirección válida'),
																		'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				    			<!-- <span class="input-group-addon" id="basic-addon1">
				    				<?php
									/**echo $this->Html->link('<i class="fa fa-heart fa-fw"></i>','#',
										array('onclick'=>"addfavplace(1)",'escape'=>false,'title'=>__('Agregar a Favoritos')),'');**/
									?>
                </span> -->
							<!-- </div> -->
					    </div>
			    		<div class='row'>
			    				<label><?php echo __('Destino')?></label>
				    			<!-- <div class = 'input-group'> -->
								<?php echo $this->Form->input('Taxorder.travelto',array('label'=>false,
																	'class'=>'form-control input-lg',
																	'tabindex'=>'19',
																	'type'=>'text',
																	'autocomplete'=>'off',
																	'title'=>__('Debe Ingresar un Destino'),
																	'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				    			<!-- <span class="input-group-addon" id="basic-addon1">
				    				<?php
									/**echo $this->Html->link('<i class="fa fa-heart fa-fw"></i>','#',
										array('onclick'=>"addfavplace(2)",'escape'=>false,'title'=>__('Agregar a Favoritos')),'');**/
									?>
                </span> -->

							<!-- </div> -->
					    </div>
              <!--
					    <div class='row'>
							<?php
							$i=0;
							foreach($carpreferences as $carpreference):?>
										<?php $value='';
											$existe=0;
										?>
										<?php foreach($userpreferences as $userpreference):?>
											<?php if($userpreference['Userpreference']['carpreference_id'] == $carpreference['Carpreference']['id']){
												if($userpreference['Userpreference']['state'] == 1)
													$value='checked' ;
												else
													$value='';
												$existe=1;
											}?>
										<?php endforeach;?>
										<div class="input-group">
												<?php echo $this->Form->input('Userpreference.'.$i.'.state',array('type'=>'checkbox',$value,'label'=>$carpreference['Carpreference']['description'],
																						'class'=>'',
																						'value'=>$carpreference['Carpreference']['description']))?>

										</div>

							<?php
								$i++;
								endforeach;
							?>
						</div>
          -->
					    <div class='row'>
					    	<br>
					    </div>
			    		<div class='row'>
					        	<button type="button" class="btn btn-primary btn-block btn-lg" id='takeacar'>
					            	<span class="glyphicon glyphicon-ok"></span>&nbsp;<?php echo __('Pedir un Taxi')?>
					            </button>
					    </div>
					    <?php echo $this->Form->end();?>
				    </div>


					<div class="panel panel-primary" id='destino' style='display:none'>
	                       <div class="panel-heading">
	                            <i class="fa fa-street-view fa-fw"></i> <?php echo __('Guardar Destino')?>
	                        </div>
	                        <!-- /.panel-heading -->
	                        <div class="panel-body">
						    	<div class='row'>
									<?php echo $this->Form->input('Taxorder.Destino',array('label'=>__('Destino Descripción'),
																		'class'=>'form-control input-lg',
																		'tabindex'=>'19',
																		'title'=>__('Debe Ingresar el detalle'),
																		'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						    	</div>
						    	<div class='row'>
						    	<div class="col-xs-5 col-sm-5">
								       	<button type="button" class="btn btn-primary btn-block btn-lg" id='saveplace'>
								           	<span class="glyphicon glyphicon-ok"></span>&nbsp;<?php echo __('Guardar')?>
								           </button>
								 </div>
								 <div class="col-xs-5 col-sm-5">
								           <button type="button" class="btn btn-danger btn-circle btn-sm" id="cancelplace">
								           	<span class="glyphicon glyphicon-remove" aria-hidden="true">
								           </button>
								  </div>
								</div>

						    </div>
					  </div>
					<div class="panel panel-default" id='listadopedidos' style='display:none'>
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
