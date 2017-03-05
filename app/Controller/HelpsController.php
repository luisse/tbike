<?php
App::uses('AppController', 'Controller');
/**
 * Helps Controller
 *
 * @property Help $Help
 * @property PaginatorComponent $Paginator
 */
class HelpsController extends AppController {

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Text');

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
		$this->Help->recursive = 0;
		$this->paginate=array('limit' => 10,
						'page' => 1);			
		$this->set('helps', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($controller = null,$action=null){
		$this->layout='';
		$options = array('conditions' => array('Help.controller'=>$controller,'Help.action'=>$action));
		$this->set('help',$this->Help->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Help->create();
			if ($this->Help->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro fue Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo Guardar el Registro. Por Favor Intente de Nuevo.'));
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
		if (!$this->Help->exists($id)) {
			throw new NotFoundException(__('Invalido help'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Help->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro Fue Actualizado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo actualizar el registro. Por favor intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Help.' . $this->Help->primaryKey => $id));
			$this->request->data = $this->Help->find('first', $options);
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
		$this->Help->id = $id;
		if (!$this->Help->exists()) {
			throw new NotFoundException(__('Invalid help'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Help->delete()) {
			$this->Session->setFlash(__('El Registro fue eliminado.'));
		} else {
			$this->Session->setFlash(__('No se pudo borrar el registro. Por favor intente de nuevo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
