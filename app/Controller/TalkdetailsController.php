<?php
App::uses('AppController', 'Controller');
/**
 * Talkdetails Controller
 *
 * @property Talkdetail $Talkdetail
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TalkdetailsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Talkdetail->recursive = 0;
		$this->set('talkdetails', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Talkdetail->exists($id)) {
			throw new NotFoundException(__('Invalid talkdetail'));
		}
		$options = array('conditions' => array('Talkdetail.' . $this->Talkdetail->primaryKey => $id));
		$this->set('talkdetail', $this->Talkdetail->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Talkdetail->create();
			if ($this->Talkdetail->save($this->request->data)) {
				$this->Session->setFlash(__('The talkdetail has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The talkdetail could not be saved. Please, try again.'));
			}
		}
		$userRecs = $this->Talkdetail->UserRec->find('list');
		$userSends = $this->Talkdetail->UserSend->find('list');
		$talks = $this->Talkdetail->Talk->find('list');
		$this->set(compact('userRecs', 'userSends', 'talks'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Talkdetail->exists($id)) {
			throw new NotFoundException(__('Invalid talkdetail'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Talkdetail->save($this->request->data)) {
				$this->Session->setFlash(__('The talkdetail has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The talkdetail could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Talkdetail.' . $this->Talkdetail->primaryKey => $id));
			$this->request->data = $this->Talkdetail->find('first', $options);
		}
		$userRecs = $this->Talkdetail->UserRec->find('list');
		$userSends = $this->Talkdetail->UserSend->find('list');
		$talks = $this->Talkdetail->Talk->find('list');
		$this->set(compact('userRecs', 'userSends', 'talks'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Talkdetail->id = $id;
		if (!$this->Talkdetail->exists()) {
			throw new NotFoundException(__('Invalid talkdetail'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Talkdetail->delete()) {
			$this->Session->setFlash(__('The talkdetail has been deleted.'));
		} else {
			$this->Session->setFlash(__('The talkdetail could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
