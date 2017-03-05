<?php echo $this->Html->script(array('/js/rubros/index.js','jquery.toastmessage'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>
<?php echo $this->element('flash_message')?>
<div class="panel panel-transacciones">
	<div class="panel-heading">
	<i class="fa fa-clock-o fa-lg"></i>&nbsp;<?php echo __('Rubros')?>
    </div>
	<br>
<div class="table-responsive">
	<div class="panel-body">
		<div class="table-responsive">
		<center>
			<table  class="table table-striped table-bordered table-hover dataTable table-responsive">
			<thead>
				<tr>
						<th><?php echo $this->Paginator->sort('descripcion',__('Descripcion'));?></th>
						<th><?php echo $this->Paginator->sort('sintetico',__('Sintetico'));?></th>
						<th><?php echo $this->Paginator->sort('estado',__('Estado'));?></th>
						<th><?php __('Acciones');?></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$i = 0;
				foreach ($rubros as $rubro):
				?>
				<tr>
					<td><?php echo $rubro['Rubro']['descripcion']; ?>&nbsp;</td>
					<td><?php echo $rubro['Rubro']['sintetico']; ?>&nbsp;</td>
					<td><?php if($rubro['Rubro']['estado'] = 1)
									echo 'Habilitado';
								else
								  echo 'Inhabilitado';?>&nbsp;</td>
					<td class="actions">
					<div class="btn-group">
					  <a class="btn btn-primary" href="#"><i class="fa fa-plus-circle fa-fw"></i> </a>
					  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
						<span class="fa fa-caret-down"></span></a>
					  <ul class="dropdown-menu  dropdown-menu-right">
						<li>
								<?php
							echo $this->Html->link('<i class="fa fa-edit fa-fw"></i>&nbsp;'.__('Modificar'),array('controller'=>'rubros',
								'action'=>'edit',$rubro['Rubro']['id']),
								array('onclick'=>'','escape'=>false),
								'');?>


						</li>
						<li>
								<?php echo $this->Html->link('<i class="fa fa-trash-o fa-fw"></i>&nbsp;'.__('Borrar'),array('controller'=>'rubros',
											'action'=>'delete',$rubro['Rubro']['id']),
											array('onclick'=>"return confirm('¿Desea Borrar el Rubro Seleccionado?')",'escape'=>false),'');?>
						</li>
					  </ul>
					 </div>
					</td>
				</tr>
			<?php endforeach; ?>
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
		</center>
		</div>
	</div>
</div>
<div id='message' style='hidden'>
	<?php $this->Session->flash() ?>
</div>
