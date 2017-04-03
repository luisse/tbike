<?php echo $this->Html->script(array('/js/taxownerdrivers/index.js','jquery.toastmessage'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>
<?php echo $this->element('flash_message')?>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-globe fa-fw"></i><?php echo __('Mis Destinos Favoritos')?>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<div class="table-responsive">
							<table width="100%" id="pedidos">
							<tbody>
							<?php foreach ($userfavplaces as $userfavplace): ?>
							<tr>
								<td>
								 <ul class="list-group">
									<li class="list-group-item clearfix">
									
									<div class="row">
										<div class="col-lg-1">
											<div class="pull-left mr15">
												<?php echo $this->Html->image('favplace.jpg',
													array ('class'=>'img-circle','width'=>'80px','height'=>'80px'));?>
											</div>
										</div>
										<div class="col-lg-11">
											<div class="row">
													<span><i class="fa fa-archive fa-fw"></i></span>
													<span class="name strong"><?php echo $userfavplace['Userfavplace']['detalle']?></span>
													<?php
														echo $this->Html->link('<button type="button" id="statusBtn" class="btn btn-danger btn-circle btn-sm" title="'.__('Eliminar registro').'"><i class="fa fa-trash"></i></button>',array('controller'=>'userfavplaces',
																		'action'=>'delete',$userfavplace['Userfavplace']['id']),
																		array('onclick'=>"return confirm('".__('¿Desea Borrar el Registro Seleccionado?')."')",'escape'=>false,'class'=>'see-more small pull-right'),'');?>											
												
											</div>
											<div class="row">
													<span><i class="fa fa-map-o  fa-fw"></i></span>
													<span class="name strong"><?php echo $userfavplace['Userfavplace']['destino']?></span>
											</div>
											<div class="row">
													<?php
														echo $this->Html->link('<button type="button" id="statusBtn" class="btn btn-success btn-circle btn-sm" title="'.__('Editar Registro').'"><i class="fa fa-pencil-square-o"></i></button>',array('controller'=>'userfavplaces',
																		'action'=>'edit',$userfavplace['Userfavplace']['id']),
																		array('onclick'=>"",'escape'=>false,'class'=>'see-more small pull-right'),'');
														?>																						
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
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
</div>
