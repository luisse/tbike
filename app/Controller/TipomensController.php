<?php
App::uses('AppController', 'Controller');
/**
 * Tipomens Controller
 *
 * @property Tipomen $Tipomen
 * @property PaginatorComponent $Paginator
 */
class TipomensController extends AppController {

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
		$this->set('title_for_layout',__('Tipo de Mensajes'));
		$this->Tipomen->recursive = 0;
		$this->set('tipomens', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Tipomen->exists($id)) {
			throw new NotFoundException(__('Tipo de Mensaje Invalido'));
		}
		$options = array('conditions' => array('Tipomen.' . $this->Tipomen->primaryKey => $id));
		$this->set('tipomen', $this->Tipomen->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('title_for_layout',__('Alta de Tipo de Mensaje'));
		if ($this->request->is('post')) {
			$this->Tipomen->create();
			if ($this->Tipomen->save($this->request->data)) {
				$this->Session->setFlash(__('El Tipo de Mensaje a sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El Tipo de Mensaje no se pudo grabar. Por favor, intente de nuevo.'));
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
		$this->set('title_for_layout',__('Actualizar de Tipo de Mensaje'));
		if (!$this->Tipomen->exists($id)) {
			throw new NotFoundException(__('Invalid tipomen'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Tipomen->save($this->request->data)) {
				$this->Session->setFlash(__('El tipomen a sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El tipomen no se pudo guardar. Por favor, intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Tipomen.' . $this->Tipomen->primaryKey => $id));
			$this->request->data = $this->Tipomen->find('first', $options);
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
		$this->Tipomen->id = $id;
		if (!$this->Tipomen->exists()) {
			throw new NotFoundException(__('Invalid tipomen'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Tipomen->delete()) {
			$this->Session->setFlash(__('El Tipo de Mensaje a sido borrado.'));
		} else {
			$this->Session->setFlash(__('El Tipo de Mensaje no se pudo borrar. Por favor, intente de nuevo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	function beforeFilter(){
	    parent::beforeFilter();
	    // For CakePHP 2.0
	    $this->Auth->allow('*');
	
	    // For CakePHP 2.1 and up
	    $this->Auth->allow();
		
	}
}
