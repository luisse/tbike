<?php if(!empty($mensajes)){?>
<div class="table-responsive">
	<table  class="table table-striped table-bordered table-hover dataTable table-responsive">
		<thead>
			<tr>
						<th><?php echo __('Menajes y Correos',true);?></th>
						<th><?php __('Acciones');?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		foreach ($mensajes as $mensaje):
			?>
		<tr>
			<td>
			<table class="admintable" cellspacing="1" width='90%' border='0'>
					<tr>
						<td class="key"><label for="name"><div class='sort'><?php echo $this->Paginator->sort('created',__('Creado:'))?></div></label></td>
						<td align='left' width='200px'><?php echo $this->Time->format('d/m/Y',$mensaje['Mensaje']['created']); ?></td>
						<td class="key"><label for="name"><div class='sort'><?php echo $this->Paginator->sort('fechasend',__('Enviado:'))?></div></label></td>
						<td align='left' width='100px'><?php
								if($mensaje['Mensaje']['enviado']!=0)
									echo __('<h4><span class="label label-success"><i class="fa fa-check fa-fw"></i>'.$this->Time->format('d/m/Y',$mensaje['Mensaje']['fechasend']).'</span></h4>');
								else
									echo __('<h4><span class="label label-danger"><i class="fa fa-share fa-fw"></i>No</span></h4>'); ?>&nbsp;</td>

						<td class="key"><label for="name"><?php echo __('Fecha Env. Aut.',true)?></label></td>
						<td align='left'><span><?php echo $this->Time->format('d/m/Y',$mensaje['Mensaje']['fechasendauto']); ?></span>&nbsp;</td>
					</tr>
					<tr>
						<td class="key"><label for="name"><?php echo __('Tipo Mensaje:',true)?></label></td>
						<td align='left' width='100px'> <?php echo $mensaje['Tipomen']['descripcion']; ?>&nbsp;</td>
						<td class="key" > <label for="name"><?php echo __('Envio aut:',true)?></label></td>
						<td align='left' width='200px'> <?php	$class ='';
												$label='';
												if($mensaje['Mensaje']['mailauto']==1){
													$class = 'label-success';
													$label='Si';
													$icons='fa-check';
												}else{
													$class = 'label-danger';
													$label='No';
													$icons='fa-times-circle-o';
												}
						?><h4><span class="label <?php echo $class ?>"><i class="fa <?php echo $icons ?> fa-fw"></i><?php echo $label?></span></h4>&nbsp;</td>
						<td class="key"><label for="name"><?php echo __('Confirmado:',true)?></label></td>
						<td align='left' width='100px'>
						<?php
							$class ='';
							$label='';
							if($mensaje['Mensaje']['confirmadocliente']==1){
								$class = 'label-success';
								$label='Si';
								$icons='fa-check';
							}else{
								$class = 'label-danger';
								$label='No';
								$icons='fa-times-circle-o';
							}
							?>
							<h4><span class="label <?php echo $class ?>"><i class="fa <?php echo $icons ?> fa-fw"></i><?php echo $label?></span></h4>
						</td>
					</tr>
					<tr>
						<td class="key"><label for="name"><div class='sort'><?php echo $this->Paginator->sort('Cliente.apellido',__('Enviar a:'))?></div></label></td>
						<td align='left'>
												<?php
							echo $this->Html->link($mensaje['Cliente']['apellido'].', '.$mensaje['Cliente']['nombre'],'#',
								array('onclick'=>'return verCliente('.$mensaje['Cliente']['id'].')','rel'=>'facebox')) ?>
						<td class="key"><label for="name"><?php echo __('Aunto:',true)?></label></td>
						<td colspan='3' align='left'><?php echo $mensaje['Mensaje']['asunto']; ?>&nbsp;</td>
					<td>
					<tr>
						<td class="key"><label for="name"><?php echo __('Detalle:',true)?></label></td>
						<td colspan='4' align='left'><?php echo $mensaje['Mensaje']['detalle']; ?>&nbsp;</td>
					</tr>
					<tr>
						<td colspan='5' align='left'>
							<div id='<?php echo 'enviandomail'.$mensaje['Mensaje']['id']?>' style='display:none;top: 50%;left: 50%;text-align:center'>
								<?php echo $this->Html->image('enviandomail.gif')?>
							</div>
						</td>
					</tr>
				</table>
			</td>

			<td class="actions">
			<div class="btn-group">
				<a class="btn btn-primary" href="#"><i class="fa fa-plus-circle fa-fw"></i> </a>
					<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
						<span class="fa fa-caret-down"></span></a>
						<ul class="dropdown-menu  dropdown-menu-right">
						<li>
							<?php
								echo $this->Html->link('<i class="fa fa-edit fa-fw"></i>&nbsp;'.__('Modificar'),array('controller'=>'mensajes',
								'action'=>'edit',$mensaje['Mensaje']['id']),
								array('onclick'=>'','escape'=>false),
								'');?>
						</li>
						<li>
							<?php echo $this->Html->link('<i class="fa fa-paper-plane fa-fw"></i>&nbsp;'.__('Enviar Mensaje'),array('#',
									'#',null),
									array('onclick'=>"return enviarmensaje(".$mensaje['Mensaje']['id'].")",'escape'=>false),'');?>
						</li>
						<li>
							<?php echo $this->Html->link('<i class="fa fa-trash-o fa-fw"></i>&nbsp;'.__('Borrar'),array('controller'=>'mensajes',
									'action'=>'delete',$mensaje['Mensaje']['id']),
									array('onclick'=>"return confirm('¿Desea Borrar el Registro Seleccionado?')",'escape'=>false),'');?>
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
</div>
<?php }else{?>
	<br>
	<div class="alert alert-warning" role="alert">
		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
		<strong><?php echo __('Advertencia!')?></strong>&nbsp;<?php echo "No se recuperaron datos para los filtros seleccionados";?></div>
	</div>
<?php }?>
