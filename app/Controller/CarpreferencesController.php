<?php
App::uses('AppController', 'Controller');
/**
 * Carpreferences Controller
 *
 * @property Carpreference $Carpreference
 * @property PaginatorComponent $Paginator
 */
class CarpreferencesController extends AppController {

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
		return;
		$this->Carpreference->recursive = 0;
		$this->set('carpreferences', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		return;
		if (!$this->Carpreference->exists($id)) {
			throw new NotFoundException(__('Invalid carpreference'));
		}
		$options = array('conditions' => array('Carpreference.' . $this->Carpreference->primaryKey => $id));
		$this->set('carpreference', $this->Carpreference->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		return;
		if ($this->request->is('post')) {
			$this->Carpreference->create();
			if ($this->Carpreference->save($this->request->data)) {
				return $this->flash(__('The carpreference has been saved.'), array('action' => 'index'));
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
		return;
		if (!$this->Carpreference->exists($id)) {
			throw new NotFoundException(__('Invalid carpreference'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Carpreference->save($this->request->data)) {
				return $this->flash(__('The carpreference has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('Carpreference.' . $this->Carpreference->primaryKey => $id));
			$this->request->data = $this->Carpreference->find('first', $options);
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
		return;
		$this->Carpreference->id = $id;
		if (!$this->Carpreference->exists()) {
			throw new NotFoundException(__('Invalid carpreference'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Carpreference->delete()) {
			return $this->flash(__('The carpreference has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The carpreference could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}
}
