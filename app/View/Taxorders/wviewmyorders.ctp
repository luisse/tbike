<?php if(!empty($taxorders)):?>
							<table width="100%" id="pedidos">
							<tbody>
							<?php foreach ($taxorders as $taxorder): ?>
							<tr>
								<td>
								 <ul class="list-group">
									<li class="list-group-item clearfix">
									
									<div class="row">
										<div class="col-lg-2">
											<div class="pull-left mr15">
												<?php echo $this->Html->image('favplace.jpg',
													array ('class'=>'img-circle','width'=>'80px','height'=>'80px'));?>
											</div>
										</div>
										<div class="col-lg-10">
											<div class="row">
													<span><i class="fa fa-archive fa-fw"></i></span>
													<span class="name strong"><?php echo $taxorder['Taxorder']['date']?></span>
													<?php
														/**echo $this->Html->link('<button type="button" id="statusBtn" class="btn btn-danger btn-circle btn-sm" title="'.__('Eliminar registro').'"><i class="fa fa-trash"></i></button>',array('controller'=>'taxorders',
																		'action'=>'delete',$taxorder['Taxorder']['id']),
																		array('onclick'=>"return confirm('".__('¿Desea Borrar el Registro Seleccionado?')."')",'escape'=>false,'class'=>'see-more small pull-right'),'');**/?>											
												
											</div>
											<div class="row">
													<span><i class="fa fa-map-o  fa-fw"></i></span>
													<span class="name strong"><?php echo $taxorder['Taxorder']['directiodetails'].' - '.$taxorder['Taxorder']['travelto']?></span>
											</div>
											<div class="row">
													<span><i class="fa fa-car  fa-fw"></i></span>
													<span class="name strong"><?php echo $taxorder['Taxownerscar']['carcode']?></span>
													<a class="see-more small pull-right" href="#">
														<?php if($taxorder['Taxorder']['state'] == 1):?>
															<button type="button" id="statusBtn" class="btn btn-success btn-circle btn-sm" title="<?php echo __('Pedido Aceptado')?>" >
																<i class="fa fa-check"></i>
															</button>
														<?php endif;?>
														
														<?php if($taxorder['Taxorder']['state'] != 1):?>
															<button type="button" id="statusBtn" class="btn btn-danger btn-circle btn-sm" title="<?php echo __('Pedido Cancelado por el usuario')?>">
																<i class="fa fa-exclamation-triangle"></i>
															</button>
														<?php endif;?>	
													</a>													
											</div>
										</div>										
									</div>
									</li>
							 </ul>
								</td>
							</tr>															
							<?php endforeach;?>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="7" class='row1'>
										<center>
										<?php
											$paginador = $this->paginator->numbers(array(
																							'before' => '',
																						    'separator' => '',
																						    'currentClass' => 'active',
																						    'tag' => 'li',
																							 'currentTag' => 'a',
																						    'after' => ''));
																				?>
										<div class="pagination">
											<?php if(!empty($paginador)): ?>
											<nav>
											<ul class="pagination">
												<li><?php echo $this->paginator->prev('<< ', null, null, array('class'=>'paginator'));?></li>
												<li><?php echo $paginador;?></li>
												<li><?php echo $this->paginator->next('>>', null, null, array('class'=>'paginator'));?></li>
											</ul>
											</nav>
											<?php endif;?>
										</div>
										</center>
									</td>
								</tr>
							</tfoot>
						</table>
	
<?php endif;?>
<?php if(empty($taxorders)):?>
	<div class="alert alert-warning" role="alert">
		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo __('Cerrar')?></span></button>	
		<strong><?php echo __('Advertencia')?>!</strong>&nbsp;<?php echo __("No se recuperaron datos para los filtros seleccionados");?></div>
	</div>
<?php endif?>