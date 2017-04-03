<!-- FIN BLOQUE BOTONES -->
<?php $sysconfig = $this->Session->read('sysconfig');?>
<center>
<div class="table-responsive">
	<table id="bicicletareparamorepuesto" class="table table-striped  table-responsive table-bordered table-hover dataTable no-footer" aria-describedby="dataTables-example_info">
	<thead>
		<tr>
				<th><div class='sort'><?= __('Productos');?></div></th>
				<th><?= __('Acciones');?></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i=0;
		foreach ($products as $product):
		?>
		<tr>
			<td>
				<?= $this->Form->hidden('Product.'.$i.'id',array('value'=>$product['Product']['id']))?>
				<?= $this->Form->hidden('Product.'.$i.'descripcion',array('value'=>$product['Product']['descripcion']))?>
				<?= $this->Form->hidden('Product.'.$i.'precio',array('value'=>$product['Productsdetail']['precio']))?>
				<table class="admintable" cellspacing="2" width='100%' border='0'>
					<tr>
						<th rowspan='2' width='200px'>
								<?php if($product[0]['imagenes'] > 0){
									$imageurl = $product['Productimage']['thumbs'];
									/***$filename=WWW_ROOT."/files/img/".$product['Product']['id'].'mgimin'.$this->Session->read('tallercito_id').'.png';
									if(!file_exists($filename)){
										$imageurl = '/productimages/mostrarimagenthumbs/'.$product['Product']['id'];
									}else{
										$imageurl = "/files/img/".$product['Product']['id'].'mgimin'.$this->Session->read('tallercito_id').'.png';
									}***/

								}else
									$imageurl='/img/noimage.png';?>
								<a href="#" class="thumbnail" onclick="mostrarproduct(<?= $i?>)">
								  <img width="200px" src="<?= $imageurl ?>" alt="...">
								</a>
						</th>
						<td align="left" valign="top" width='400px'>
							<div class='sort'><h4><label for="name">&nbsp;<?= $this->Paginator->sort('Product.descripcion',__('Producto Nombre'));?></label></h4></div>
						</td>
						<td align="right" valign="top">
							<label for="name"><h4><?= __('Stock',true)?></h4></label>
						</td>
						<td align="right" valign="top">
							<div class='sort'><label for="name"><h4><?= $this->Paginator->sort('Productsdetail.precio',__('Precio'))?></h4></label></div>
						</td>
					</tr>
					<tr>
						<td  align="left" valign="top"  width='400px'>
							<h4>&nbsp;<?= $product['Product']['descripcion'] ?>&nbsp;</h4>
						</td>
						<td  align="right" valign="top"><h4><?= $product['Productsdetail']['stock'] ?>&nbsp;</h4></td>
						<td  align="right" valign="top"><h4><strong><?= '$ '.$this->Number->precision($product['Productsdetail']['precio'],2); ?></strong></h4>&nbsp;</td>
					</tr>
				</table>
			</td>
			<td align="right">
			<?php	if($product['Productsdetail']['stock'] >= 1 || $sysconfig['Sysconfig']['stockrestrict'] == 0):?>
					<div class="btn-group">
								<button type="button" class="btn btn-success btn-lw" title="<?= __('Agregar Producto')?>" onclick="recuperarDatosProduct(<?= $i?>,'')">
									<span class="glyphicon  glyphicon glyphicon-shopping-cart"></span>
								</button>
					 </div>
			 <?php endif;?>
			 <?php if($product['Productsdetail']['stock'] < 1):?>
			 <code><strong><?= __('Sin Stock')?></strong></code>
			<?php endif;?>
			</td>

		</tr>
	<?php
	$i++;
	endforeach; ?>
	</tbody>
		<tfoot>
			<tr>
			<td colspan="9" class='row1'>
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
  								  <li><?= $this->paginator->prev('<< ', null, null, array('class'=>'paginator'));?></li>
								  <li><?= $paginador;?></li>
								  <li><?= $this->paginator->next('>>', null, null, array('class'=>'paginator'));?></li>
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
</center>
