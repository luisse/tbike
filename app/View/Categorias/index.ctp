<?php echo $this->Html->script(array('/js/categorias/index.js','jquery.toastmessage'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>
<?php echo $this->element('flash_message')?>
<div class="panel panel-transacciones">
	<div class="panel-heading">
		<i class="fa fa-list fa-lg"></i>&nbsp;<?php echo __('Categorias')?>
    </div>
	<br>
	<div class="table-responsive">
<div class="panel-body">
	<div class="table-responsive">
	<table  class="table table-striped table-bordered table-hover dataTable table-responsive">
	<thead>
		<tr>
				<th></th>
				<th><?php echo $this->Paginator->sort('descripcion',__('Descripción'));?></th>
				<th><?php __('Acciones');?></th>
		</tr>
	</thead>
	<tbody>
	<?php
	$i = 0;

	foreach ($categorias as $categoria):

	?>
	<tr>
		<?php if(empty($categoria['Categoria']['padre_id'])):?>
		<td width='120px'>
				<a href="#" class="thumbnail">
					<?php
							echo $this->Html->image($categoria['Categoria']['imagen'],
									array ( 'title' =>$categoria['Categoria']['descripcion']));
					?>
				</a>
		</td>
		<td>
		<?php $refcollapse = 'collapseOne'.$i?>
			<div class="panel panel-default">
			    <div class="panel-heading">
			      <h4 class="panel-title">
			        <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $refcollapse ?>">
			          <?php echo $categoria['Categoria']['descripcion']; ?>&nbsp;
			        </a>
			      </h4>
			    </div>
			    <div id="<?php echo $refcollapse ?>" class="panel-collapse collapse">
			      <div class="panel-body">

			      	<?php
			      		//print_r($subcategorias);
			      		$subcategoriasx=array();
			      		if(!empty($subcategorias[$i]))
			      			$subcategoriasx = $subcategorias[$i];
			      		foreach($subcategoriasx as $categoriachild):
			      	?>
			      		<div class='row'>
			        		<div class="col-lg-2">
								<a href="#" class="thumbnail">
									<?php
										$filename = WWW_ROOT."/files/img/".$categoria['Categoria']['id'].'mgicat'.$this->Session->read('tallercito_id').'.png';
										if(!file_exists($filename)){
											echo $this->Html->image(array ( 'controller' =>
														'categorias' , 'action' => 'mostrarimagen' ,
														$categoriachild['Categoria']['id']),
														array ( 'title' =>$categoriachild['Categoria']['descripcion']) );
										}else{
											echo $this->Html->image("/files/img/".$categoria['Categoria']['id'].'mgicat'.$this->Session->read('tallercito_id').'.png',
												array ( 'title' =>$categoria['Categoria']['descripcion']));
										}
											?>
								</a>
			        		</div>
			        		<div class="col-lg-5">
			        			<?php echo $categoriachild['Categoria']['descripcion']?>
			        		</div>
			        		<div class="col-lg-2">
								<div class="btn-group">
								  <a class="btn btn-primary" href="#"><i class="fa fa-plus-circle fa-fw"></i> </a>
								  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
									<span class="fa fa-caret-down"></span></a>
								  <ul class="dropdown-menu  dropdown-menu-right">
									<li>
											<?php
										echo $this->Html->link('<i class="fa fa-edit fa-fw"></i>&nbsp;'.__('Modificar'),array('controller'=>'categorias',
											'action'=>'edit',$categoriachild['Categoria']['id']),
											array('onclick'=>'','escape'=>false),
											'');?>
									</li>
									<li>
											<?php echo $this->Html->link('<i class="fa fa-trash-o fa-fw"></i>&nbsp;'.__('Borrar'),array('controller'=>'categorias',
														'action'=>'delete',$categoriachild['Categoria']['id']),
														array('onclick'=>"return confirm('¿Desea Borrar el Registro Seleccionado?')",'escape'=>false),'');?>
									</li>
								  </ul>
								 </div>
			        		</div>
						</div>
			        <?php endforeach; ?>
			      </div>
			    </div>
			  </div>
		</td>
		<td class="actions">
					<div class="btn-group">
					  <a class="btn btn-primary" href="#"><i class="fa fa-plus-circle fa-fw"></i> </a>
					  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
						<span class="fa fa-caret-down"></span></a>
					  <ul class="dropdown-menu">
						<li>
								<?php
							echo $this->Html->link('<i class="fa fa-edit fa-fw"></i>&nbsp;'.__('Modificar'),array('controller'=>'categorias',
								'action'=>'edit',$categoria['Categoria']['id']),
								array('onclick'=>'','escape'=>false),
								'');?>


						</li>
						<li>
								<?php echo $this->Html->link('<i class="fa fa-trash-o fa-fw"></i>&nbsp;'.__('Borrar'),array('controller'=>'categorias',
											'action'=>'delete',$categoria['Categoria']['id']),
											array('onclick'=>"return confirm('¿Desea Borrar el Registro Seleccionado?')",'escape'=>false),'');?>
						</li>
						<li>
								<?php echo $this->Html->link('<i class="fa fa-plus fa-fw"></i>&nbsp;'.__('Agregar Subcategoria'),array('controller'=>'categorias',
											'action'=>'addsub',$categoria['Categoria']['id']),
											array('onclick'=>"",'escape'=>false),'');?>
						</li>
					  </ul>
					 </div>

		</td>
		<?php endif;?>
	</tr>
<?php
$i++;
endforeach; ?>
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
<div class="row">
	<div class="col-lg-6">
		<center>
		<?php
			echo $this->Html->link('<button type="button" class="btn btn-success btn-lw" title="Agregar Categoria">
																	<span class="glyphicon  glyphicon-plus"></span>Agregar</button>',array('controller'=>'categorias',
										'action'=>'add',''),
										array('escape'=>false),
					'');
	?>
		</center>
	</div>
	<div class="col-lg-6">
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
