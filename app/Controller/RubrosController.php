<?php
App::uses('AppController', 'Controller');
/**
 * Rubros Controller
 *
 * @property Subtypeproducts $Subtypeproducts
 * @property PaginatorComponent $Paginator
 */

class RubrosController extends AppController {

	public $name = 'Rubros';
	public $components = array('RequestHandler');

/**
 * Index method
 *
 * @return void
 */
	
	public function index() {
		$this->set('title_for_layout','Listado de Rubros');
		$this->Rubro->recursive = 0;
		$this->set('rubros', $this->paginate());
	}

/**
 * View method
 *
 * @return void
 */	
	public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid rubro', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('rubro', $this->Rubro->read(null, $id));
	}

/**
 * Add method
 *
 * @return void
 */	
	public function add() {
		$this->set('title_for_layout','Alta de Rubro');
		
		if ($this->request->is('post')) {
			if (!empty($this->request->data)) {
				$this->Rubro->create();
				$this->request->data['Rubro']['negocio_id'] = $this->Session->read('negocio_id');
				if ($this->Rubro->save($this->data)) {
					$this->Session->setFlash(__('El Rubro fue guardado', true));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('No se pudo guardar el rubro. Por Favor Intente nuevamente.', true));
				}
			}
		}
	}

/**
 * Edit method
 *
 * @return void
 */
	
	public function edit($id = null) {
		$this->set('title_for_layout','Edición de Rubro');
		if (!$this->Rubro->exists($id)) {
			$this->Session->setFlash(__('Identificador Invalido', true));
			$this->redirect(array('action' => 'index'));
			exit;
		}
		if ($this->request->is(array('post', 'put'))) {
			if (!empty($this->request->data)) {
				if ($this->Rubro->save($this->data)) {
					$this->Session->setFlash(__('Los datos fueron Actualizados', true));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('No se pudo actualizar el Rubro. Por favor intente nuevamente.', true));
				}
			}
		}else{
			if (empty($this->request->data)) {
				$options = array('conditions' => array('Rubro.' . $this->Rubro->primaryKey => $id));
				$this->request->data = $this->Rubro->find('first', $options);
			}
		}
	}

/**
 * delete method
 *
 * @return void
 */
	public function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Código de rubro invalido', true));
			$this->redirect(array('action'=>'index'));
		}
		try {
			if ($this->Rubro->delete($id)) {
				$this->Session->setFlash(__('El Rubro fue borrado', true));
				$this->redirect(array('action'=>'index'));
			}
		}catch(Exception $e){
			$this->Session->setFlash(__('Error: No se puede eliminar el registro. Atributo asignado.'));
		}			
		$this->redirect(array('action' => 'index'));
	}
	
	public function beforeRender(){
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
		parent::beforeRender();
	}
}
?>