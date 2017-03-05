<?php

App::uses('AppController', 'Controller');
/**
 * Product Controller
 *
 * @property Subtypeproducts $Subtypeproducts
 * @property PaginatorComponent $Paginator
*/

class ProductsController extends AppController {

	public  $name = 'Products';
	public  $components = array('RequestHandler','Session');
	public  $uses = array('Product','Productsdetail','Categoria','Proveedore','Productosacategoria','Sysconfig');

	public function index() {
		$this->set('title_for_layout',__('Administración de Productos'));
	}

	public function productjson(){
		$this->layout='';
		$ls_filtro='1=1 ';
		if(!empty($this->request->data)){
			if(!empty($this->request->data['Product']['descripcion'])){
				$ls_filtro = $ls_filtro.'AND Upper(Product.descripcion) like Upper("%'.$this->request->data['Product']['descripcion'].'%")';
			}
			if(!empty($this->request->data['Product']['categoria_id']) &&
						$this->request->data['Product']['categoria_id'] != 0 &&
						$this->request->data['Product']['categoria_id'] !=''){
				$ls_filtro = $ls_filtro.' AND Product.categoria_id = '.$this->request->data['Product']['categoria_id'];
			}
			if(!empty($this->request->data['Product']['subcategoria_id']) && $this->request->data['Product']['subcategoria_id'] != 0){
				$ls_filtro = $ls_filtro.' AND Product.subcategoria_id = '.$this->request->data['Product']['subcategoria_id'];
			}
		}

		$this->paginate=array('limit' => 20,
						'page' => 1,
						'conditions'=>array($ls_filtro,'Product.tallercito_id'=>$this->Session->read('tallercito_id')),
						//'url' => $this->passedArgs,
						'fields'=>array('Product.id','Product.codgen','Product.descripcion',
									'Productsdetail.stock','Productsdetail.precio','Productsdetail.id','Productsdetail.details',
									'(SELECT Categ.descripcion FROM categorias Categ WHERE Categ.id = Product.categoria_id) AS categoria',
									'(SELECT Subcateg.descripcion FROM categorias Subcateg WHERE Subcateg.id = Product.subcategoria_id) AS subcategoria',
									'(SELECT COUNT(*) FROM productimages Productimage WHERE Productimage.product_id = Product.id) AS imagenes'
												));
		$this->Product->recursive = 0;
		$this->set('products', $this->paginate());
	}

	public function listproductos(){
		$this->layout='';
		$ls_filtro='1=1 ';

		if(!empty($this->request->data)){
			if(!empty($this->request->data['Product']['descripcion'])){
				$ls_filtro = $ls_filtro.'AND Upper(Product.descripcion) like Upper("%'.$this->request->data['Product']['descripcion'].'%")';
			}
			if(!empty($this->request->data['Product']['categoria_id']) &&
						$this->request->data['Product']['categoria_id'] != 0 &&
						$this->request->data['Product']['categoria_id'] !=''){
				$ls_filtro = $ls_filtro.' AND Product.categoria_id = '.$this->request->data['Product']['categoria_id'];
			}
			if(!empty($this->request->data['Product']['subcategoria_id']) && $this->request->data['Product']['subcategoria_id'] != 0){
				$ls_filtro = $ls_filtro.' AND Product.subcategoria_id = '.$this->request->data['Product']['subcategoria_id'];
			}
		}

		$this->paginate=array('limit' => 10,
						'page' => 1,
						'conditions'=>array($ls_filtro,'Product.tallercito_id'=>$this->Session->read('tallercito_id')),
						'url' => $this->passedArgs,
						'fields'=>array('Product.id','Product.codgen','Product.descripcion',
									'Productsdetail.stock','Productsdetail.precio','Productsdetail.id',
									'(SELECT Categ.descripcion FROM categorias Categ WHERE Categ.id = Product.categoria_id) AS categoria',
									'(SELECT Subcateg.descripcion FROM categorias Subcateg WHERE Subcateg.id = Product.subcategoria_id) AS subcategoria',
									'(SELECT COUNT(*) FROM productimages Productimage WHERE Productimage.product_id = Product.id) AS imagenes',
									'Productimage.imagen'
								),
						'joins'=>array(array('table'=>'productimages',
										'alias'=>'Productimage',
										'type'=>'LEFT',
										'conditions'=>array('Productimage.product_id = Product.id and Productimage.estado = 1'))),
							);
		$this->Product->recursive = 0;

		$this->set('products', $this->paginate());
	}

	public function view($id = null) {
		$this->layout='';
		if (!$id) {
			$this->Session->setFlash(__('Producto Invalido', true));
			$this->redirect(array('action' => 'index'));
		}
		$product=$this->Product->find('first',array('conditions'=>array('Product.id'=>$id,'Product.tallercito_id'=>$this->Session->read('tallercito_id')),
													'fields'=>array('Product.id','Product.codgen','Product.descripcion',
													'Productsdetail.stock','Productsdetail.precio','Productsdetail.id','Productsdetail.details',
													'(SELECT Categ.descripcion FROM categorias Categ WHERE Categ.id = Product.categoria_id) AS categoria',
													'(SELECT Subcateg.descripcion FROM categorias Subcateg WHERE Subcateg.id = Product.subcategoria_id) AS subcategoria',
													'(SELECT COUNT(*) FROM productimages Productimage WHERE Productimage.product_id = Product.id) AS imagenes',
													'Productimage.imagen'
												),
												'joins'=>array(array('table'=>'productimages',
																'alias'=>'Productimage',
																'type'=>'LEFT',
																'conditions'=>array('Productimage.product_id = Product.id and Productimage.estado = 1')))
													));
		$this->set(compact('product'));
	}

	/*
	 * Funcion: permite insertar un nuevo registro
	 */

	public function add() {
		$this->set('title_for_layout','Alta de Productos');
		if ($this->request->is('post')) {
			if (!empty($this->request->data)) {
				//detalles del producto

				if($this->request->data['Product']['categoria_id'] == 0) $this->request->data['Product']['categoria_id'] = null;
				if(empty($this->request->data['Product']['subcategoria_id'])) $this->request->data['Product']['subcategoria_id'] = null;

				$this->request->data['Product']['tallercito_id']=$this->Session->read('tallercito_id');
				//ID DE PROVEEDOR
				$proveedor = $this->Proveedore->find('first',array('conditions'=>array('Proveedore.denominacion'=>$this->request->data['Product']['proveedore_id'],
																														'Proveedore.tallercito_id'=>$this->Session->read('tallercito_id'))));
				if(!empty($proveedor)){
					$this->request->data['Product']['proveedore_id']=$proveedor['Proveedore']['id'];
				}else{
					$this->request->data['Product']['proveedore_id'] = null;
				}
				//Detalles del producto
				$this->request->data['Productsdetail']['estado'] = 1;//ACTIVO POR DEFECTO
				$this->Product->set($this->request->data);
				$this->Productsdetail->set($this->request->data);
				$validaProduct = $this->Product->validates();
				$validaProductsdetail= $this->Productsdetail->validates();
				if(($validaProductsdetail == true || empty($validaProductsdetail)) && $validaProduct = 1){
					if($this->Product->saveproduct($this->request->data)){
						$this->Session->setFlash(__('El Producto fue Guardado', true));
						$this->redirect(array('action' => 'index'));
					}else{
						$this->Session->setFlash(__('No se pudo Guardar el Producto. Por Favor Intente de Nuevo.'));
						if(!empty($this->request->data['Product']['proveedore_id'])){
							$proveedor = $this->Proveedore->find('first',array('conditions'=>array('Proveedore.id'=>$this->request->data['Product']['proveedore_id'])));
							if(!empty($proveedor)){
								$this->request->data['Product']['proveedore_id'] = $proveedor['Proveedore']['denominacion'];
							}
						}
					}
				}
			}
		}
	}

	/*
	 * Funcion: permite realizar la actualización de los datos del producto
	 */
	public function edit($id = null) {
		$this->set('title_for_layout','Modificación de Productos');
		if (!$this->Product->exists($id)) {
			$this->Session->setFlash(__('Identificador Invalido', true));
			$this->redirect(array('action' => 'index'));
			exit;
		}
		if ($this->request->is(array('post', 'put'))) {
			if (!empty($this->request->data)) {
				$proveedor = $this->Proveedore->find('first',array('conditions'=>array('Proveedore.denominacion'=>$this->request->data['Product']['proveedore_id'],
																														'Proveedore.tallercito_id'=>$this->Session->read('tallercito_id'))));
				if(!empty($proveedor)){
					$this->request->data['Product']['proveedore_id']=$proveedor['Proveedore']['id'];
				}else{
					$this->request->data['Product']['proveedore_id'] = null;
				}
				if ($this->Product->saveAll($this->request->data)) {
					$this->Session->setFlash(__('El Producto fue Actualizado', true));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('No se pudo Actualizar el Producto. Por favor Intente de Nuevo.', true));
				}
			}
		}else{
			if (empty($this->request->data)) {
				$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
				$this->request->data = $this->Product->find('first', $options);
				//PROVEEDOR DESCRIPCION
				if(!empty($this->request->data['Product']['proveedore_id'])){
					$proveedor = $this->Proveedore->find('first',array('conditions'=>array('Proveedore.id'=>$this->request->data['Product']['proveedore_id'])));
					if(!empty($proveedor)){
						$this->request->data['Product']['proveedore_id'] = $proveedor['Proveedore']['denominacion'];
					}
				}
				if(!empty($this->request->data['Product']['id'])){
					$subcategorias = $this->Categoria->find('list',array('conditions'=>array('Categoria.padre_id'=>$this->request->data['Product']['categoria_id']),
																'fields'=>array('Categoria.id','Categoria.descripcion'),
																'order'=>array('Categoria.descripcion')));
					$this->set('subcategorias',$subcategorias);
					}
				}

			}
	}

	/*
	 * Funcion: permite realizar la carga de los rellenos de los drop down de tipo y subtipo
	 * de productos
	 * */
	function beforeRender(){
		try{
			$result =	$this->Acl->check(array(
					'model' => 'Group',       # The name of the Model to check agains
					'foreign_key' => $this->Session->read('tipousr') # The foreign key the Model is bind to
			), ucfirst($this->params['controller']).'/'.$this->params['action']);
			//SI NO TIENE PERMISOS DA ERROR!!!!!!
			if(!$result)
				$this->redirect(array('controller' => 'accesorapidos','action'=>'seguridaderror',ucfirst($this->params['controller']).'-'.$this->params['action']));
		}catch(Exeption $e){

		}

		if($this->params['action'] == 'add' || $this->params['action'] == 'edit' ||
		 $this->params['action'] == 'index' || $this->params['action'] == 'seleccionarproducto' ||
			$this->params['action'] =='carrocompras' || $this->params['action'] == 'actualizapreciomasivo'){
			$categorias = $this->Categoria->find('list',
				array('fields'=>array('Categoria.id','Categoria.descripcion'),
				'order'=>array('Categoria.descripcion'),
				'conditions'=>array('Categoria.tallercito_id'=>$this->Session->read('tallercito_id'),'Categoria.padre_id IS NULL')));
			$categorias[0]='Todas';
			$this->set(compact('categorias','subcategorias'));
		}
		parent::beforeRender();
	}

	/*
	 * Funcion: permite realizar el borrado de un registro
	 */
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Código de rubro invalido', true));
			$this->redirect(array('action'=>'index'));
		}
		try {
			if ($this->Product->delete($id)) {
				$this->Session->setFlash(__('Producto Eliminado', true));
				$this->redirect(array('action'=>'index'));
			}else{
				$this->Session->setFlash(__('El producto no fue borrado', true));
			}
		}catch(Exception $e){
			$this->Session->setFlash(__('Error: No se puede eliminar el registro. Atributo asignado a operación'));
		}
		$this->redirect(array('action' => 'index'));
	}

	/*
	* Funcion:Permite buscar un producto determinado u por filtro
	*/
	function buscar(){
		$this->layout='buscar';
		//asignamos ls JS necesarios para el proceso de búsqueda
		$js_funciones = array('jquery','jquery-ui.min','jquery.numeric.js',
				'jquery.maskedinput.js','fmensajes.js','dateformat.js',
				'fgenerales.js','jquery.price.js','js_buscar_product');
		$this->set('js_funciones',$js_funciones);

        //recuperamos los valores para tipo y subtipo
		$subtypeproducts = $this->Subtypeproduct->retornarsubtypeproduct();
        $typeproducts = $this->Typeproduct->retornartypeproduct();
		$rubros = $this->Rubro->retornarubro($this->Session->read('tallercito_id'));

        $subtypeproducts[0]='';
        $typeproducts[0]='';
        $rubros[0] = '';

        asort($subtypeproducts);
        asort($typeproducts);
        asort($rubros);
        $this->set(compact('subtypeproducts', 'typeproducts','rubros'));
	}

	/*
	 * Funcion: permite realizar la impresion de productos con TCPDF
	 * */
	function imprimirproductos($id  = null){
		//si el identificador esta en null no debemos procesar
		if(!$id){
			$this->Session->setFlas('No se ingreso un identificador válido para el producto');
			$this->redirec(array('action' => 'index'));
		}
		Configure::write('debug',0);
		$productdetail = $this->Product->read(null,$id);
		if(empty($productdetail)){
			$this->Session->setFlas('No se recuperaron datos para el producto seleccionado');
			$this->redirec(array('action' => 'index'));
		}
		$this->layout = 'pdf';
		$this->set('productdetail',$productdetail);

	}

	function productventas(){

	}
	/*
	 * Funcion: permite retornar los datos del XML
	 */

	function productdetailxml($id = null,$typeproduct_id = null,$subtypeproduct_id = null,$rubro_id = null ){
		$this->layout = '';
		$ls_conditions = ' 1 = 1 ';
		if($id <> null && $id <> -1){
			$ls_conditions .= ' AND Product.id = '.$id;
		}else{
			if($typeproduct_id <> 0 && $typeproduct_id <> null)
				$ls_conditions .= ' OR Product.typeproduct_id = '.$typeproduct_id;
			if($subtypeproduct_id <> 0 && $subtypeproduct_id <> null)
				$ls_conditions .= ' OR Product.subtypeproduct_id = '.$subtypeproduct_id;
			if($rubro_id <> 0 && $rubro_id <> null)
				$ls_conditions .= ' OR Product.rubro_id = '.$rubro_id;
		}

		$product = $this->Product->find('all',array('conditions'=>array($ls_conditions,'Product.tallercito_id'=>$this->Session->read('tallercito_id')),
											'fields'=>array('Product.id','Product.descripcion','Product.codgen','Productsdetail.precio')));
		$this->set('product',$product);
	}

	/*
	 * Funcion: permite recuperar los datos de producto y visualizarlo
	 * */
	function listadoproducto($typeproduct_id = null,$subtypeproduct_id = null,$rubro_id = null){
		$this->layout='';
		$this->paginate = array('limit' => 10, 'page' => 1,
				'order'=>array('Product.descripction'=>'asc'),'conditions'=>"(Product.typeproduct_id = ".$typeproduct_id." OR ".$typeproduct_id." = 0 ) AND (Product.subtypeproduct_id = ".$subtypeproduct_id.' OR '.$subtypeproduct_id.' = 0 ) AND (Rubro.id = '.$rubro_id.' OR '.$rubro_id.' = 0 )');
		$this->Product->recursive = 0;
		$this->set('products',$this->paginate());
	}

	/*
	 * Funcion: permite seleccionar un producto por medio de un modal box
	 * */
	public function seleccionarproducto($rowpos = null){
			$this->layout = 'bmodalbox';
			$this->set('rowpos',$rowpos);
	}

	/*
	 * Funcion: muestra los datos a partir de los filtros
	 * */
	public function seleccionarlistarproductos(){
		$this->layout='';
		$ls_filtro='1=1 ';
		if(!empty($this->request->data)){
			if(!empty($this->request->data['Product']['descripcion'])){
				$ls_filtro = $ls_filtro.'AND Upper(Product.descripcion) like Upper("%'.$this->request->data['Product']['descripcion'].'%")';
			}
			if(!empty($this->request->data['Product']['categoria_id']) &&
						$this->request->data['Product']['categoria_id'] != 0 &&
						$this->request->data['Product']['categoria_id'] !=''){
				$ls_filtro = $ls_filtro.' AND Product.categoria_id = '.$this->request->data['Product']['categoria_id'];
			}
			if(!empty($this->request->data['Product']['subcategoria_id']) && $this->request->data['Product']['subcategoria_id'] != 0){
				$ls_filtro = $ls_filtro.' AND Product.subcategoria_id = '.$this->request->data['Product']['subcategoria_id'];
			}
		}

		$this->paginate=array('limit' => 10,
						'page' => 1,
						'conditions'=>array($ls_filtro,'Product.tallercito_id'=>$this->Session->read('tallercito_id')),
						'url' => $this->passedArgs,
						'fields'=>array('Product.id','Product.codgen','Product.descripcion',
									'Productsdetail.stock','Productsdetail.precio','Productsdetail.id',
									'(SELECT Categ.descripcion FROM categorias Categ WHERE Categ.id = Product.categoria_id) AS categoria',
									'(SELECT Subcateg.descripcion FROM categorias Subcateg WHERE Subcateg.id = Product.subcategoria_id) AS subcategoria'
												));
		$this->Product->recursive = 0;
		$this->set('products', $this->paginate());
	}

	/*Demo Cart*/
	public function carrocompras(){
		$this->set('title_for_layout','Carro de Compras');
		$categorias = $this->Categoria->find('list',
				array('fields'=>array('Categoria.id','Categoria.descripcion'),
				'order'=>array('Categoria.descripcion'),
				'conditions'=>array('Categoria.tallercito_id'=>$this->Session->read('tallercito_id'),'Categoria.padre_id IS NULL')));

	}

	public function listadoproductovta(){
		$this->layout='';
		$ls_filtro='1=1 ';
		if(!empty($this->request->data)){
			if(!empty($this->request->data['Product']['descripcion'])){
				$ls_filtro = $ls_filtro.'AND Upper(Product.descripcion) like Upper("%'.$this->request->data['Product']['descripcion'].'%")';
			}
			if(!empty($this->request->data['Product']['categoria_id']) &&
						$this->request->data['Product']['categoria_id'] != 0 &&
						$this->request->data['Product']['categoria_id'] !=''){
				$ls_filtro = $ls_filtro.' AND Product.categoria_id = '.$this->request->data['Product']['categoria_id'];
			}
			if(!empty($this->request->data['Product']['subcategoria_id']) && $this->request->data['Product']['subcategoria_id'] != 0){
				$ls_filtro = $ls_filtro.' AND Product.subcategoria_id = '.$this->request->data['Product']['subcategoria_id'];
			}
		}

		$this->paginate=array('limit' => 10,
						'page' => 1,
						'conditions'=>array($ls_filtro,'Product.tallercito_id'=>$this->Session->read('tallercito_id')),
						'url' => $this->passedArgs,
						'joins'=>array(array('table'=>'productimages',
								'alias'=>'Productimage',
								'type'=>'LEFT',
								'conditions'=>array('Productimage.product_id = Product.id and Productimage.estado = 1'))),
						'fields'=>array('Product.id','Product.codgen','Product.descripcion',
									'Productsdetail.stock','Productsdetail.precio','Productsdetail.id',
									'(SELECT Categ.descripcion FROM categorias Categ WHERE Categ.id = Product.categoria_id) AS categoria',
									'(SELECT Subcateg.descripcion FROM categorias Subcateg WHERE Subcateg.id = Product.subcategoria_id) AS subcategoria',
									'(SELECT COUNT(*) FROM productimages Productimage WHERE Productimage.product_id = Product.id) AS imagenes',
									'Productimage.thumbs'
												));
		$this->Product->recursive = 0;
		$this->set('products', $this->paginate());
	}

	/*
	*Funcion para calcular si existe la cantidad deseada
	*/
	public function existecantidad($product_id=null,$cantidad=null){
		$this->layout='';
		$enstock = 0;
		$stockrestrict = $this->Session->read('stockrestrict');
		if(empty($stockrestrict)){
			$sysconfig = $this->Sysconfig->find('first',array('conditions'=>array('Sysconfig.tallercito_id'=>$this->Session->read('tallercito_id')),
											'fields'=>'Sysconfig.stockrestrict'));
			if(!empty($sysconfig['Sysconfig']['stockrestrict']))
				$stockrestrict=$sysconfig['Sysconfig']['stockrestrict'];
			else
				$stockrestrict=0;
			$this->Session->Write('stockrestrict',$stockrestrict);
		}
		if($stockrestrict == 1){
			if(!empty($cantidad) && $cantidad > 0 && !empty($product_id)){
					$product['Product']['id']=$product_id;
					$product['Product']['cantidad']=$cantidad;
					//miramos la cantidad no gravamos nada
					if($this->Product->ProductStock($product,false))
						$enstock=1;
			}
		}else{
			$enstock=1;
		}
		$this->set('enstock',$enstock);
	}

	public function beforeFilter(){
		// For CakePHP 2.0
		$this->Auth->allow('*');

		// For CakePHP 2.1 and up
		$this->Auth->allow();

	}

	/*
	*Function: filtros para actualizar los precios de los productos
	*/
	public function actualizapreciomasivo(){
		$this->set('title_for_layout',__('Actualizar Precios Masivo'));
	}

	public function mostrarresultpreciomod(){
		$ls_filtro = '1 = 1';
		$ls_calculo='+';
		if(!empty($this->request->data)){
			if(!empty($this->request->data['Product']['categoria_id']) &&
						$this->request->data['Product']['categoria_id'] != 0 &&
						$this->request->data['Product']['categoria_id'] !=''){
				$ls_filtro = $ls_filtro.' AND Product.categoria_id = '.$this->request->data['Product']['categoria_id'];
			}
			if(!empty($this->request->data['Product']['subcategoria_id']) && $this->request->data['Product']['subcategoria_id'] != 0){
				$ls_filtro = $ls_filtro.' AND Product.subcategoria_id = '.$this->request->data['Product']['subcategoria_id'];
			}
			if($this->request->data['Product']['calc']=='D')
				$ls_calculo='-';
		}
		$this->paginate=array('limit' => 100,
						'page' => 1,
						'conditions'=>array($ls_filtro,'Product.tallercito_id'=>$this->Session->read('tallercito_id')),
						'url' => $this->passedArgs,
						'fields'=>array('Product.id','Product.codgen','Product.descripcion',
									'Productsdetail.stock','Productsdetail.precio','Productsdetail.id','Productsdetail.modified',
									'(SELECT Categ.descripcion FROM categorias Categ WHERE Categ.id = Product.categoria_id) AS categoria',
									'(SELECT Subcateg.descripcion FROM categorias Subcateg WHERE Subcateg.id = Product.subcategoria_id) AS subcategoria',
									'(SELECT COUNT(*) FROM productimages Productimage WHERE Productimage.product_id = Product.id) AS imagenes',
									'(Productsdetail.precio'.$ls_calculo.'((Productsdetail.precio*'.$this->request->data['Product']['porcentaje'].')/100)) AS preciofinal'
												));
		$this->Product->recursive = 0;
		$this->set('products', $this->paginate());
	}

	public function actualizarprecio(){
		$this->set('title_for_layout',__('Resultado Actualización'));
		$result = $this->Productsdetail->saveallprecio($this->request->data);
		$i=0;
		foreach($result['Productsdetail']  as $productsdetail){
					$product=$this->Product->find('first',array('conditions'=>array('Product.id'=>$productsdetail['product_id']),
																'values'=>array('Product.descripcion')));
			if(!empty($product))
				$result['Productsdetail'][$i]['descripcion']=$product['Product']['descripcion'];
			$i++;
		}
		$this->set('productsdetails',$result);
	}
}
?>
