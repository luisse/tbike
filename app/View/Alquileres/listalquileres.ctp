<?php if(!empty($alquileres)){?>
<?php
	$str_estadossino[0]='NO';
	$str_estadossino[1]='SI';
?>

	<div class="table-responsive">
		<table  class="table table-striped table-bordered table-hover dataTable table-responsive">
		<thead>
			<tr>
				<th><?= __('Id')?></th>
				<th><?= __('Cliente');?></th>
				<th><?= $this->Paginator->sort('detalle');?></th>
				<th><?= $this->Paginator->sort('fecha',__('Fecha Alquiler'));?></th>
				<th><?= $this->Paginator->sort('total',__('Total Alquiler'));?></th>
				<th><?= __('Finaliza Alquiler');?></th>
				<th><?php __('Acciones');?></th>
			</tr>
		</thead>
		<tbody>
		<?php
			$i=0;
			foreach ($alquileres as $alquilere):
		?>
		<tr>
			<td>
			<?= $this->Form->hidden('clienteid'.$i,array('value'=>$alquilere['Alquilere']['cliente_id']))?>
			<?= $this->Form->hidden('importetotal'.$i,array('value'=>$alquilere['Alquilere']['total']))?>
			<?= $this->Form->hidden('alquilereid'.$i,array('value'=>$alquilere['Alquilere']['id']))?>

				<?= $this->Html->link( $alquilere['Alquilere']['id'],'#',
							array('onclick'=>'return verdetallealquileres('.$alquilere['Alquilere']['id'].')'))?>&nbsp;</td>

			<td><?= $this->Html->link( $alquilere['Cliente']['documento'].'-'.$alquilere['Cliente']['apellido'].', '.$alquilere['Cliente']['nombre'],'#',
							array('onclick'=>'return verCliente('.$alquilere['Cliente']['id'].')'))?>&nbsp;</td>
			<td><?= $alquilere['Alquilere']['detalle']; ?>&nbsp;</td>
			<td><?= $this->Time->format('d/m/Y H:i',$alquilere['Alquilere']['fecha']); ?>&nbsp;</td>
			<td align='right'><?= $alquilere['Alquilere']['total']; ?>&nbsp;</td>
			<td>
				<center>
				<?php $refcollapse = 'collapseOne'.$i?>
					<div class="panel panel-primary">
					    <div class="panel-heading">
					      <h4 class="panel-title">
					      	<i class="fa fa-plus-square fa-lg"></i>
					        <a data-toggle="collapse" data-parent="#accordion" href="#<?= $refcollapse ?>">
					          <?= __('Detalle de Alquiler') ?>&nbsp;
					        </a>
					      </h4>
					    </div>
					    <div id="<?= $refcollapse ?>" class="panel-collapse collapse">
						   <div class="panel-body">
						      	<!-- GRUPOS SOCIALES ASOCIADOS A LA PERSONA -->
						      	<div class="table-responsive">
									<table class="table table-condensed">
										<?php
											$j = 0;
											$faltaadevol=false;
											foreach($alquilere['Alquileredetalle'] as $alquileredetalle):?>
											<tr  class="active">
												<td><p class="text-primary"><?= $alquileredetalle['Alquileredetalle']['horasalquila']?></p></td>
												<td><p class="text-primary"><?php
													echo $this->Time->format('H:i',$alquileredetalle[0]['finalizaalquiler']);
													?>
												</p></td>
												<td><p class="text-muted"><?= $alquileredetalle['Alquileredetalle']['detalle']?></p></td>
												<td>
													<?php
														if(empty($alquileredetalle['Alquileredetalle']['fechadevol'])){
															$faltaadevol=true;
															echo $this->Form->input('estado'.$j,array('options'=>$str_estadossino,'onchange'=>'MarcaEntregado('.$alquilere['Alquilere']['id'].','.$alquileredetalle['Alquileredetalle']['id'].')','label'=>false));
														}
													?>
													<?php if(!empty($alquileredetalle['Alquileredetalle']['fechadevol'])):?>
															<button type="button" id="statusBtn" class="btn btn-success btn-circle btn-sm" title="Devueltos" >
																	<i class="fa fa-check"></i>
															</button>
													<?php endif;?>
												</td>
											</tr>
										<?php
										$j++;
										endforeach;?>
									</table>
								</div>
							</div>
						</div>
					</div>
				</center>
			</td>
			<td class="actions">
				<?php if($alquilere['Alquilere']['pagado'] != 1):?>
				<div class="btn-group">
					<a class="btn btn-primary" href="#"><i class="fa fa-plus-circle fa-fw"></i> </a>
						<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
							<span class="fa fa-caret-down"></span></a>
							<ul class="dropdown-menu dropdown-menu-right">
							<li>
									<?php
									echo $this->Html->link('<i class="fa fa-edit fa-fw"></i>&nbsp;'.__('Modificar'),array('controller'=>'alquileres',
										'action'=>'edit',$alquilere['Alquilere']['id']),
										array('onclick'=>'','escape'=>false),
										'');?>
							</li>
							  <li>
												<?= $this->Html->link('<i class="fa fa-trash-o fa-fw"></i>&nbsp;'.__('Borrar'),array('controller'=>'alquileres',
													'action'=>'delete',$alquilere['Alquilere']['id']),
													array('onclick'=>"return confirm('¿Desea Borrar el Registro Seleccionado?')",'escape'=>false),'');?>
								</li>
								<?php endif;?>
							  <?php if(!$faltaadevol && $alquilere['Alquilere']['pagado'] != 1):?>
							  <li>
									<?= $this->Html->link('<i class="fa fa-credit-card fa-fw"></i>&nbsp;'.__('Pagar'),array('controller'=>'#',
												'action'=>'#',$alquilere['Alquilere']['id']),
												array('onclick'=>"return AgregarPago(".$i.")",'escape'=>false),'');?>						</li>
							  </ul>

				</div>
				<?php endif;?>
			</td>
		</tr>
	<?php
		$i++;
		endforeach; ?>
	</tbody>
		<tfoot>
			<tr>
			<td colspan="7" class='row1'>
				<center>
				<div class="pagination">
						<?php $paginador = $this->paginator->numbers();?>
							<?php if(!empty($paginador)): ?>
							<center>
								<ul class="pagination">
								  <li><?= $this->paginator->prev('<< ', null, null, array('class'=>'paginator'));?>
								</li>
															  <li><?= $this->paginator->numbers(array('separator'=>''));?>
								</li>
															  <li><?= $this->paginator->next('>>', null, null, array('class'=>'paginator'));?>
								</li>
															</ul>
														</center>
													<?php endif;?>			</div>
											</center>
										</td>
										</tr>
									</tfoot>
								</table>
								</center>
	</div>
<?php }else{?>
	<div class="alert alert-warning" role="alert">
		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		<strong><?= __('Advertencia!')?></strong>&nbsp;<?= "No se recuperaron datos para los filtros seleccionados";?></div>
	</div>
<?php
} ?>
