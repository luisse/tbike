<?php echo $this->Html->script(array('/js/productimages/index.js','jquery.toastmessage'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>
<?php echo $this->element('flash_message')?>
<div class="panel panel-ingresos">
	<div class="panel-heading">
		<i class="fa fa-file-image-o fa-lg"></i>&nbsp;<?php echo __('Fotos del producto')?>
    </div>
	<br>
<div class="table-responsive">
	<div class="panel-body">
		<div class="table-responsive">
		<table  class="table table-striped table-bordered table-hover dataTable table-responsive">
		<thead>
			<tr>
					<th><?php echo __('Imagen',true)?>
					<th><?php echo $this->Paginator->sort('descripcion',__('Descripción',true));?></th>
					<th><?php echo $this->Paginator->sort('estado',__('Estado',true));?></th>
					<th><?php __('Acciones');?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($productimages as $productimage):
			?>
			<tr>
				<td width='160px'>
					<a href="#" class="thumbnail">
					<?php
							echo $this->Html->image($productimage['Productimage']['thumbs'])
							/**echo $this->Html->image(array ( 'controller' =>
							'productimages' , 'action' => 'mostrarimagenthumbs' ,
							$productimage['Productimage']['id']),
							array ( 'title' =>$productimage['Productimage']['descripcion'] ) );**/
					?>
					</a>
				</td>
				<td><?php echo $productimage['Productimage']['descripcion']; ?>&nbsp;</td>
				<td><?php if($productimage['Productimage']['estado'] == 1):?>
						<h4><span class="label label-success"><?php echo __('Visible');?></span></h4>
					<?php endif;?>
					<?php if ($productimage['Productimage']['estado'] == 0):?>
						<h4><span class="label label-danger"><?php echo __('No Visible'); ?></span></h4>
					<?php endif;?>


								</td>
				<td class="actions">
					<div class="btn-group">
						  <a class="btn btn-primary" href="#"><i class="fa fa-plus-circle fa-fw"></i> </a>
						  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
							<span class="fa fa-caret-down"></span></a>
						  <ul class="dropdown-menu  dropdown-menu-right">
							<li>
									<?php
								echo $this->Html->link('<i class="fa fa-edit fa-fw"></i>&nbsp;'.__('Editar'),array('controller'=>'productimages',
									'action'=>'edit',$productimage['Productimage']['id']),
									array('onclick'=>'','escape'=>false),
									'');?>


							</li>
							<li>
									<?php echo $this->Html->link('<i class="fa fa-trash-o fa-fw"></i>&nbsp;'.__('Borrar'),array('controller'=>'productimages',
												'action'=>'delete',$productimage['Productimage']['id']),
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
		</center>
</div>
<div class="row">
	<div class="col-xs-6 col-sm-6">
		<center>
		<?php
			echo $this->Html->link('<button type="button" class="btn btn-success btn-lw" title="Agregar Foto">
																	<span class="glyphicon  glyphicon-plus"></span>'.__('Agregar Foto').'</button>',array('controller'=>'productimages',
										'action'=>'add',''),
										array('escape'=>false),
					'');
	?>
		</center>
	</div>
	<div class="col-xs-6 col-sm-6">
		<center>
		<button type="button" class="btn btn-danger btn-lw" id='cancelar'>
		  <span class="glyphicon glyphicon glyphicon-off"></span><?php echo __(' Cancelar')?>
		</button>
		</center>
	</div>
</div>
</div>
<div id='message' style='hidden'>
	<?php $this->Session->flash() ?>
</div>
