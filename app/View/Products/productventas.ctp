<?= $this->Html->css('smart_cart');?>

<div id="SmartCart" class="scMain">
	<ul class="scMenuBar">
		<li><a href="#sproducts" class="sel">Productos</a></li>
		<li><a href="#scart" title="Cart | Total Products: 0 | Total Quantity: 0" class="">Compras (0)</a></li>
		<li><div class="scMessageBar2" style="display: none; "></div></li>
	</ul>
	<div class="scTabs" style="display: block; ">
		<div class="scSearchPanel">
			<label class="scLabelSearch">Buscar:</label><input type="text" class="scTxtSearch">
			<a href="#" class="scSearch" title="Buscar Productos">Buscar</a>
			<a href="#" class="scSearch" title="Limpiar Busqueda">Limpiar</a>
			<label class="scLabelCategory">Tipo Producto:</label>
			<?= $this->Form->input('Product.rubro_id',array('label'=>false,'class'=>'scLabelCategory','size'=>'1'))?>
			<br>
			<label class="scLabelCategory">Rubro:</label>
				<select class="scSelCategory">
					<option value="">Todos</option>
					<option value="Computers">Computers</option>
					<option value="Cameras">Cameras</option>
					<option value="Mobile Phones">Mobile Phones</option>
					<option value="Accessories">Accessories</option>
					</select>

		</div>
		<div class="scProductList">
			<div class="scProducts">
				<div class="scPDiv1">
					<img src="products/product1.jpg" class="scProductImage"></div>
					<div class="scPDiv2"><strong>Zenith</strong><br>Category: Moutain Bike<br><small>Nueva Zenith de Carbono</small><br><strong>Precio: 2299.99</strong>
					</div>
					<div class="scPDiv3">
						<label class="scLabelQuantity">Cantidad:</label><input type="text" value="1" class="scTxtQuantity">
						<a href="#" rel="0" title="Agregar a la venta" class="scAddToCart">Agregar</a>
					</div>
			</div>
		</div>
		<div class="scTabs" style="display: none; ">
		<div class="scCartHeader">
			<label class="scCartTitle scCartTitle1">Productos</label>
			<label class="scCartTitle scCartTitle2">Precio</label>
			<label class="scCartTitle scCartTitle3">Cantidad</label>
			<label class="scCartTitle scCartTitle4">Subtotal</label>
			<label class="scCartTitle scCartTitle5"></label>
		</div>
		<div class="scCartList">
			<div class="scMessageBar" style="">No hay productos para la venta</div>
		</div>
	</div>
	<div class="scBottomBar">
		<a href="#" class="scCheckoutButton">Aceptar Venta</a>
		<label class="scLabelSubtotalValue">0.00</label>
		<label class="scLabelSubtotalText">Total:</label>
	</div>
	<div class="tooltip" style="display: none; ">
	</div>
	<select name="products_selected[]" multiple="" style="display: none; "></select>
	</div>
</div>
