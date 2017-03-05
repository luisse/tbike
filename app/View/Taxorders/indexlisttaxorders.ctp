
<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped"
				id="pedidos">
				<tbody>
							<?php foreach ($taxorders as $taxorder): ?>
							<tr>
						<td>
							<ul class="list-group">
								<li class="list-group-item clearfix">
									<div class="row">
										<div class="col-lg-2">
											<div class="pull-left mr15">
												<?php if(!empty($taxorder['Taxownerdriver']['picture'])):?>
													  <img width="80px" height='80px' src="<?php echo $taxorder['Taxownerdriver']['picture']?>" alt="" class="img-circle">
												<?php endif;?>
												<?php if(empty($taxorder['Taxownerdriver']['picture'])):?>
												<?php
														echo $this->Html->image ( 'https://taxiar-files.s3.amazonaws.com/img/user_not.jpeg', array (
																'title' => __ ( 'Imagen de ' . $taxorder ['People'] ['firstname'] . ', ' . $taxorder ['People'] ['secondname'] ),
																'class' => 'img-circle',
																'width' => '80px',
																'height' => '80px'
														) );
												?>
												<?php endif;?>
											</div>
										</div>
										<div class="col-lg-10">
											<div class="row">
												<span><i class="fa fa-user fa-fw"></i></span> <span
													class="name strong"><?php echo $taxorder['People']['firstname'].', '.$taxorder['People']['secondname']?></span>
												<?php
								echo $this->Html->link ( '<button type="button" id="statusBtn" class="btn btn-danger btn-circle btn-sm" title="' . __ ( 'Eliminar registro' ) . '"><i class="fa fa-trash"></i></button>', array (
										'controller' => 'taxorders',
										'action' => 'delete',
										$taxorder ['Taxorder'] ['id']
								), array (
										'onclick' => "return confirm('" . __ ( '¿Desea Borrar el Registro Seleccionado?' ) . "')",
										'escape' => false,
										'class' => 'see-more small pull-right'
								), '' );
								?>
										</div>
											<div class="row">
												<span><i class="fa fa-taxi  fa-fw"></i></span> <span
													class="name strong"><?php echo $taxorder['Taxownerscar']['carcode'].' - '.$taxorder['Taxownerscar']['descriptioncar']?></span>
											</div>
											<div class="row">
												<span class="date text-muted small pull-left"><i
													class="fa fa-calendar fa-fw"></i>&nbsp;<?php echo $this->Time->format('d/m/Y h:m:s',$taxorder['Taxorder']['date'])?></span>
												<a class="see-more small pull-right" href="#">
												<?php if($taxorder['Taxorder']['state'] == 1):?>
													<button type="button" id="statusBtn"
														class="btn btn-success btn-circle btn-sm"
														title="<?php echo __('Pedido Aceptado')?>">
														<i class="fa fa-check"></i>
													</button>
												<?php endif;?>
												<?php if($taxorder['Taxorder']['state'] != 1):?>
													<button type="button" id="statusBtn"
														class="btn btn-danger btn-circle btn-sm"
														title="<?php echo __('Pedido Cancelado por el usuario')?>">
														<i class="fa fa-exclamation-triangle"></i>
													</button>
												<?php endif;?>

											</a>
											</div>
											<div class="row">
												<span class="date text-muted small pull-left"><i
													class="fa fa-map-o fa-fw"></i>&nbsp;<?php echo $taxorder['Taxorder']['directiodetails'].' - '.$taxorder['Taxorder']['travelto'] ?></span>
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
										$paginador = $this->paginator->numbers ( array (
												'before' => '',
												'separator' => '',
												'currentClass' => 'active',
												'tag' => 'li',
												'currentTag' => 'a',
												'after' => ''
										) );
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
