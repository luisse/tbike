<?php
class SalesdetailsController extends AppController {

	var $name 	=	'Salesdetails';
	var $uses	=	array('Salesdetail','Product');

	function index() {
		$this->Salesdetail->recursive = 0;
		$this->set('salesdetails', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid salesdetail', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('salesdetail', $this->Salesdetail->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Salesdetail->create();
			if ($this->Salesdetail->save($this->data)) {
				$this->Session->setFlash(__('The salesdetail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The salesdetail could not be saved. Please, try again.', true));
			}
		}
		$sales = $this->Salesdetail->Sale->find('list');
		$products = $this->Salesdetail->Product->find('list');
		$this->set(compact('sales', 'products'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid salesdetail', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Salesdetail->save($this->data)) {
				$this->Session->setFlash(__('The salesdetail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The salesdetail could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Salesdetail->read(null, $id);
		}
		$sales = $this->Salesdetail->Sale->find('list');
		$products = $this->Salesdetail->Product->find('list');
		$this->set(compact('sales', 'products'));
	}

	public function delete($id = null) {
		$this->layout = '';
		if (!$id) {
			$this->set('error','El Identificador no existe en la Base de datos');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Salesdetail->delete($id)) {
			$this->set('error','');
		}else{
			$this->set('error','Error al intentar borrar el Producto Seleccionado');
		}
	}
	
	public function Eliminarproducto($product_id = null,$salesdetail_id = null){
		$this->layout='';
		$error='';
		if(!empty($product_id)){
			$salesdetails = $this->Salesdetail->find('first',array('conditions'=>array('Salesdetail.id'=>$salesdetail_id),
																'fields'=>array('Salesdetail.cantidad')));
			try{
				if (!$this->Salesdetail->deleteAll(array('Salesdetail.product_id'=>$product_id,
						'Salesdetail.id'=>$salesdetail_id
				))) {
					$error = 'No se puede eliminar el producto';
				}else{
					//actualizamos el stock en la cantidad ingresada
					if(!empty($salesdetails)){
						ClassRegistry::init('Product');
						$Product   = new Product();
						$product['Product']['id']  = $product_id;
						$product['Product']['cantidad'] = $salesdetails['Salesdetail']['cantidad']*-1;
						$Product->ProductStock($product,true);
					}
				}
			}catch(Exception $e){
				$error = 'Error: No se puede eliminar el registro. Atributo asignado a registro';
			}
		}
		$this->set('error',$error);
	}
}
?>