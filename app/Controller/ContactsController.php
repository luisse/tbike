<?php
App::uses('AppController', 'Controller');
/**
 * Contacts Controller
 *
 * @property Contact $Contact
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ContactsController extends AppController {

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
		//$this->Contact->recursive = 0;
		//$this->set('contacts', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		//if (!$this->Contact->exists($id)) {
		//	throw new NotFoundException(__('Invalid contact'));
		//}
		//$options = array('conditions' => array('Contact.' . $this->Contact->primaryKey => $id));
		//$this->set('contact', $this->Contact->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function contact() {
		if(empty($this->Session->read('user_id')))
			$this->layout='register';
		if ($this->request->is('post')) {
			$this->Contact->create();
			if ($this->Contact->save($this->request->data)) {
				try {
					App::uses('CakeEmail', 'Network/Email');
					$Email = new CakeEmail('smtp');
					$Email->emailFormat('html');
					//GET EMAIL CONTACT
					Configure::load('appconf');
					$email = $securedata = Configure::read('emailcontact');
					$Email->to($email);
					$Email->subject(__('Consulta desde aplicación web'));
					Configure::load('appconf');
					$body = '';
					$body = $body.'Nueva Consulta!<br><br>';
					$body = $body.'<b>Nombre y Apellido:</b>'.$this->request->data['Contact']['name'].'<br>';
					$body = $body.'<b>Correo Electrónico:</b>'.$this->request->data['Contact']['email'].'<br>';
					$body = $body.'<b>Consulta:</b>'.$this->request->data['Contact']['message'];
					$Email->send($body);
				}catch(SocketException $e){
					$error = $e->getmessage();
					$this->Session->setFlash(__('Contacto y soporte: '.$error.$this->Email->smtpError));
				}

				//$this->Session->setFlash(__('The contact has been saved.'));
				if(!empty($this->Session->read('user_id')))
					return $this->redirect(array('controller'=>'mains','action' => 'index'));
				else
					return $this->redirect(array('controller'=>'users','action' => 'login'));
			}else {
				//$this->Session->setFlash(__('The contact could not be saved. Please, try again.'));
			}
		}

		if(!empty($this->Session->read('user_id'))){
			$this->set('nomape',trim($this->Session->read('nomape')));
			$this->set('email',trim($this->Session->read('email')));
		}else{
			$this->set('nomape','');
			$this->set('email','');
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
		//if (!$this->Contact->exists($id)) {
		//	throw new NotFoundException(__('Invalid contact'));
		//}
		//if ($this->request->is(array('post', 'put'))) {
		/***	if ($this->Contact->save($this->request->data)) {
				$this->Session->setFlash(__('The contact has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The contact could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Contact.' . $this->Contact->primaryKey => $id));
			$this->request->data = $this->Contact->find('first', $options);
		}***/
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		/**$this->Contact->id = $id;
		if (!$this->Contact->exists()) {
			throw new NotFoundException(__('Invalid contact'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Contact->delete()) {
			$this->Session->setFlash(__('The contact has been deleted.'));
		} else {
			$this->Session->setFlash(__('The contact could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));**/
	}

	public function beforeFilter(){
		$this->Auth->allow('*');
		// For CakePHP 2.1 and up
		$this->Auth->allow();
	}
}
