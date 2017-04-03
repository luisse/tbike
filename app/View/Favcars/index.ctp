<?php echo $this->Html->script(array('/js/favcars/index.js','jquery.toastmessage'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>
<script>
var glb_k='<?=$this->Session->read("key")?>'
</script>
<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped"	id="favcars">
				<tbody>
							<?php
							foreach ($favcars as $favcar): ?>
							<tr>
						<td>
							<ul class="list-group">
								<li class="list-group-item clearfix" id='favcar<?=$favcar['Favcar']['id']?>'>
									<div class="row">
										<div class="col-lg-2">
											<div class="pull-left mr15">
												<?php if(!empty($favcar['Taxownerscar']['picture'])):?>
														<img width='80px' height='80px' class="img-circle"
													src="<?php echo $favcar['Taxownerscar']['picture'];?>" />
												<?php endif;?>
												<?php if(empty($favcar['Taxownerscar']['picture'])):?>
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
												<span><i class="fa fa-taxi  fa-fw"></i></span> <span
													class="name strong"><?php echo $favcar['Taxownerscar']['carcode'].' - '.$favcar['Taxownerscar']['descriptioncar']?></span>
											</div>
											<div class="row">
												<span class="date text-muted small pull-left"><i
													class="fa fa-calendar fa-fw"></i>&nbsp;<?= $this->Time->format('d/m/Y h:m:s',$favcar['Favcar']['created'])?></span>
													<a class="see-more small pull-right" href="#">
													<button title="<?= __('Eliminar registro')?>" class="btn btn-danger btn-circle btn-sm" id="statusBtn" type="button" onclick="if(confirm('<?=__ ('¿Desea Borrar el Registro Seleccionado?' )?>')) eliminarfavorito(<?=$favcar ['Favcar'] ['id']?>)">
														<i class="fa fa-trash"></i>
													</button>
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
