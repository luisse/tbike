<?php
App::uses('AppController', 'Controller');
/**
 * Tipomovimientos Controller
 *
 * @property Tipomovimiento $Tipomovimiento
 * @property PaginatorComponent $Paginator
 */
class TipomovimientosController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('title_for_layout',__('Transacciones del Sistema'));
		$this->Tipomovimiento->recursive = 0;
		$this->set('tipomovimientos', $this->Paginator->paginate());
	}
	
	public function indexusr() {
		$this->set('title_for_layout',__('Transacciones del Sistema'));
		$this->Tipomovimiento->recursive = 0;
		$this->set('tipomovimientos', $this->Paginator->paginate());
	}	

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Tipomovimiento->exists($id)) {
			throw new NotFoundException(__('Tipo de Movimiento Invalido'));
		}
		$options = array('conditions' => array('Tipomovimiento.' . $this->Tipomovimiento->primaryKey => $id));
		$this->set('tipomovimiento', $this->Tipomovimiento->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Tipomovimiento->create();
			if ($this->Tipomovimiento->save($this->request->data)) {
				$this->Session->setFlash(__('El Tipo de Movimiento a sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El Tipo de Movimiento  no se pudo grabar. Por favor, intente de nuevo.'));
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
		if (!$this->Tipomovimiento->exists($id)) {
			throw new NotFoundException(__('Tipo de Movimiento Invalido'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Tipomovimiento->save($this->request->data)) {
				$this->Session->setFlash(__('El Tipo de Movimiento  a sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El Tipo de Movimiento  no se pudo guardar. Por favor, intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Tipomovimiento.' . $this->Tipomovimiento->primaryKey => $id));
			$this->request->data = $this->Tipomovimiento->find('first', $options);
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
		$this->Tipomovimiento->id = $id;
		if (!$this->Tipomovimiento->exists()) {
			throw new NotFoundException(__('Tipo de Movimiento  Invalido'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Tipomovimiento->delete()) {
			$this->Session->setFlash(__('El Tipo de Movimiento  a sido borrado.'));
		} else {
			$this->Session->setFlash(__('El Tipo de Movimiento  no se pudo borrar. Por favor, intente de nuevo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function beforerender(){
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
				
		$str_estados[0]='Negativo';
		$str_estados[1]='Positivo';
		$str_esporcentaje[0]='No';
		$str_esporcentaje[1]='Si';
		$this->set('str_estados',$str_estados);
		parent::beforeRender();
	}
}
