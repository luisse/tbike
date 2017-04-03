<?= $this->Html->script(array('/js/products/view.js','bootstrap-typeahead.js'),array('block'=>'scriptjs')); ?>
<?= $this->element('modalboxcabecera',array('title'=>__('Detalle de Producto'),'paneltipo'=>'panel-primary'));?>
<div class="row">
	<div class="col-xs-12 col-md-12">
		<?php if($product[0]['imagenes'] > 0){
				$imageurl=$product['Productimage']['imagen'];
			}else
				$imageurl='/img/noimage.png';?>
		<a href="#" class="thumbnail">
				<?= $this->Html->image($imageurl) ?>
		</a>
	</div>
</div>
			<div class="panel panel-default">
				<div class="panel-default">
				<div class="table-responsive">
					<ul class="nav nav-tabs" id='ProductTab'>
					  <li class="active"><a href="#tabs-3"   data-toggle="tab"><?= __('Producto') ?></a></li>
					  <li><a href="#tabs-4"  data-toggle="tab"><?= __('Detalles')?></a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active"  id="tabs-3">
							<div class="table-responsive">
								<div class="row">
									<div class="col-lg-8">
										<label><?= __('Detalle')?></label>
										<div class="form-group">
											<h4><?= $product['Product']['descripcion']?></h4>
										</div>
									</div>
									<div class="col-lg-3">
										<label><?= __('Precio')?></label>
										<div class="form-group">
											<h4><strong><?= '$ '.$this->Number->precision($product['Productsdetail']['precio'],2)?></strong></h4>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane"  id="tabs-4">
							<div class="row">
							<div class="col-lg-10">
								<div class="well  well-sm"><?= trim($product['Productsdetail']['details'])?></div>
							</div>
							</div>
						</div>
					</div>
				</div>
				</div>
			</div>
<?= $this->element('modalboxpie');?>
