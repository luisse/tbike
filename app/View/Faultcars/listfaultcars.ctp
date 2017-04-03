<?php
if(!empty($faultcars)):?>
							<table width="100%" id="pedidos">
							<tbody>
							<?php foreach ($faultcars as $faultcar): ?>
							<tr>
								<td>
								 <ul class="list-group">
									<li class="list-group-item clearfix">
									<div class="row">
										<div class="col-lg-2">
											<div class="pull-left mr15">
                        <?php if(!empty($faultcar['Taxownerscar']['picture'])):?>
														<img width='80px' height='80px' class="img-circle"
													src="<?= $faultcar['Taxownerscar']['picture'];?>" />
												<?php endif;?>
												<?php if(empty($faultcar['Taxownerscar']['picture'])):?>
															<?php
                									echo $this->Html->image ( 'https://taxiar-files.s3.amazonaws.com/img/user_not.jpeg', array (
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
													<span><i class="fa fa-calendar-check-o fa-fw"></i></span>
													<span class="name strong"><?= $faultcar['Faultcar']['created']?></span>
                          <?php if($faultcar['Faultcar']['state'] == 0):?>
                          <a class="see-more small pull-right" href="#">
                            <button type="button" id="faultend<?=$faultcar['Faultcar']['id'] ?>" onclick="changestate(<?= $faultcar['Faultcar']['id'] ?>)" class="btn btn-success btn-circle btn-sm" title="<?= __('Marcar Arreglada')?>">
                              <i class="fa fa-check"></i>
                            </button>
                          </a>
                        <?php endif;?>
											</div>
                      <div class="row">
                        <span><i class="fa fa-user fa-fw"></i></span>
                        <span class="name strong"><?= $faultcar['User']['username']?></span>
                      </div>
                      <div class="row">
													<span><i class="fa fa-exclamation-triangle  fa-fw"></i></span>
													<span class="name strong"><?= $faultcar['Faultcar']['details']?></span>
											</div>
											<div class="row">
													<span><i class="fa fa-car  fa-fw"></i></span>
													<span class="name strong"><?= $faultcar['Taxownerscar']['carcode']?></span>
													<a class="see-more small pull-right" href="#">
														<?php if($faultcar['Faultcar']['state'] == 1):?>
															<button type="button" id="statusBtn" class="btn btn-success btn-circle btn-sm" title="<?= __('Falla Arreglada')?>" >
																<i class="fa fa-check"></i>
															</button>
														<?php endif;?>
														<?php if($faultcar['Faultcar']['state'] != 1):?>
															<button type="button" id="statusBtn" class="btn btn-danger btn-circle btn-sm" title="<?= __('Falla Activa')?>">
																<i class="fa fa-exclamation-triangle"></i>
															</button>
														<?php endif;?>
													</a>
											</div>
											<div class="row">
													<span><i class="fa fa-map-marker fa-fw"></i></span>
													<span class="name strong"><a href='/faultcars/getubicationmaps/<?= $faultcar['faultcar']['lat']?>/<?=$faultcar['faultcar']['lng']?>'><?= __('Ubicar Lugar de Falla')?></a></span>
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
<?php if(empty($faultcars)):?>
	<div class="alert alert-warning" role="alert">
		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only"><?= __('Cerrar')?></span></button>
		<strong><?= __('Advertencia')?>!</strong>&nbsp;<?= __("No se recuperaron datos para los filtros seleccionados");?></div>
	</div>
<?php endif?>
