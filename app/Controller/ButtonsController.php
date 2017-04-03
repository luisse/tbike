<?php
App::uses('AppController', 'Controller');
/**
 * Buttons Controller
 *
 * @property Button $Button
 * @property PaginatorComponent $Paginator
 */
class ButtonsController extends AppController {
	var $uses = array('Button','Group');
/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Paginator');

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
		$this->set('title_for_layout','Administración de Botones');
		$this->Button->recursive = 0;
		$this->set('buttons', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Button->exists($id)) {
			throw new NotFoundException(__('Identificador Invalido'));
		}
		$options = array('conditions' => array('Button.' . $this->Button->primaryKey => $id));
		$this->set('Button', $this->Button->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Button->create();
			$this->request->data['Button']['group_id']=1;
			if ($this->Button->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro fue Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo Guardar el Registro. Por Favor Intente de Nuevo.'));
			}
		}
	}
	
	public function addbuttongrup(){
		$this->set('title_for_layout',__('Asociar Botones a Grupos'));
		if ($this->request->is('post')) {
			$this->Button->create();
			print_r($this->request->data);
			if ($this->Button->saveAll($this->request->data['Button'])) {
				$this->Session->setFlash(__('El Registro fue Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$error = $this->Button->invalidFields();
				print_r($error);
				$this->Session->setFlash(__('No se pudo Guardar el Registro. Por Favor Intente de Nuevo.'));
			}
		}
		$buttons = $this->Button->find('all',array('conditions'=>array('group_id'=>'0')));
		$this->set(compact('buttons'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Button->exists($id)) {
			throw new NotFoundException(__('Identificador Invalido'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Button->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro Fue Actualizado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo actualizar el registro. Por favor intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Button.' . $this->Button->primaryKey => $id));
			$this->request->data = $this->Button->find('first', $options);
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
		$this->Button->id = $id;
		if (!$this->Button->exists()) {
			throw new NotFoundException(__('No se encuentra el identificador'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Button->delete()) {
			$this->Session->setFlash(__('El Registro fue eliminado.'));
		} else {
			$this->Session->setFlash(__('No se pudo borrar el registro. Por favor intente de nuevo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function beforeRender(){
		if($this->action =='edit' ||
			$this->action =='add' ||
			$this->action =='addbuttongrup'){
			$groups = $this->Button->Group->find('list',array('fields'=>array('Group.id','Group.name')));
			$this->set(compact('groups'));
		}
		parent::beforeRender();
	}
}
