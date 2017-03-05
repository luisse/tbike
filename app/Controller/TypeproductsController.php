<?php
App::uses('AppController', 'Controller');
/**
 * Typeproducts Controller
 *
 * @property Tallercito $Tallercito
 * @property PaginatorComponent $Paginator
 */

class TypeproductsController extends AppController {

	public $name = 'Typeproducts';
	public $uses = array('Typeproduct');
/**
 * index method
 *
 * @return void
 */
	
	public function index() {
		$this->set('title_for_layout',__('Administración Tipo de Productos'));
		$this->Typeproduct->recursive = 0;
		$this->paginate=array('limit' => 10,
						'page' => 1,
						'order'=>array('descripction'=>'desc')/*,
						'conditions'=>$ls_filtro*/);				
		$this->set('typeproducts', $this->paginate());
	}
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	
	public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Tipo de Producto Invalido', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('typeproduct', $this->Typeproduct->read(null, $id));
	}
/**
 * add method
 *
 * @return void
 */
	
	public function add() {
		$this->set('title_for_layout',__('Alta de Tipo de producto',true));
		if ($this->request->is('post')) {
			if (!empty($this->request->data)) {
				$this->Typeproduct->create();
				$this->request->data['Typeproduct']['est'] = 1; //por defecto se encuentra habilitado
				$this->request->data['Typeproduct']['tiponegocio_id']=2;
				if ($this->Typeproduct->save($this->data)) {
					$this->Session->setFlash(__('El producto fue guardado satisfactoriamente', true));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The typeproduct could not be saved. Please, try again.', true));
				}
			}
		}
	}
	
/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('title_for_layout',__('Modificación de Tipo de producto',true));
		if (!$this->Typeproduct->exists($id)) {
			$this->Session->setFlash(__('Invalid Tipo de producto', true));
			$this->redirect(array('action' => 'index'));
		}
		
		if ($this->request->is(array('post', 'put'))) {
			if (!empty($this->request->data)) {
				if ($this->Typeproduct->save($this->data)) {
					$this->Session->setFlash(__('El Tipo de Producto fue Guardado', true));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('No se pudo actualizar los datos. Por favor intente de nuevo.', true));
				}
			}
		}else{
			if (empty($this->request->data)) {
				$options = array('conditions' => array('Typeproduct.' . $this->Typeproduct->primaryKey => $id));
				$this->request->data = $this->Typeproduct->find('first', $options);
			}
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	
	public function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Código de Tipo de Producto Invalido', true));
			$this->redirect(array('action'=>'index'));
		}
		try {
			if ($this->Typeproduct->delete($id)) {
				$this->Session->setFlash(__('El tipo de Producto fue Eliminado', true));
				$this->redirect(array('action'=>'index'));
			}
		}catch(Exception $e){
			$this->Session->setFlash(__('Error: No se puede eliminar el registro. Atributo asignado a operación'));
		}
		$this->redirect(array('action' => 'index'));
	}
}
?>