<?php
App::uses('AppController', 'Controller');
/**
 * Userpreferences Controller
 *
 * @property Userpreference $Userpreference
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UserpreferencesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session','RequestHandler');
	public $uses = array('Userpreference','Carpreference','Rsesion');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Userpreference->recursive = 0;
		$this->set('userpreferences', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Userpreference->exists($id)) {
			throw new NotFoundException(__('Invalid userpreference'));
		}
		$options = array('conditions' => array('Userpreference.' . $this->Userpreference->primaryKey => $id));
		$this->set('userpreference', $this->Userpreference->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Userpreference->create();
			if ($this->Userpreference->save($this->request->data)) {
				$this->Session->setFlash(__('The userpreference has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The userpreference could not be saved. Please, try again.'));
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
		if (!$this->Userpreference->exists($id)) {
			throw new NotFoundException(__('Invalid userpreference'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Userpreference->save($this->request->data)) {
				$this->Session->setFlash(__('The userpreference has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The userpreference could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Userpreference.' . $this->Userpreference->primaryKey => $id));
			$this->request->data = $this->Userpreference->find('first', $options);
		}
	}

	public function adminpref(){
		//procces data
		$this->Userpreference->create();
		if ($this->Userpreference->saveAll($this->request->data['Userpreference'])) {
			$this->Session->setFlash(__('Los datos fueron actualizados.'));
			echo 'OK';
		} else {
			$this->Session->setFlash(__('No se pudieron guardar los datos.'));
			echo 'NADA';
		}

		return $this->redirect(array('controller'=>'users','action'=>'edit'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Userpreference->id = $id;
		if (!$this->Userpreference->exists()) {
			throw new NotFoundException(__('Invalid userpreference'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Userpreference->delete()) {
			$this->Session->setFlash(__('The userpreference has been deleted.'));
		} else {
			$this->Session->setFlash(__('The userpreference could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function beforeFilter(){
		// For CakePHP 2.0
		$this->Auth->allow('*');

		// For CakePHP 2.1 and up
		$this->Auth->allow();
	}

	public function getpreference(){
		$error = '';
		if(!empty($this->request->data['key'])){
			if($this->Rsesion->SessionIsOk($this->request->data['key'])){
				$rsesions = $this->Rsesion->rsesiondata($this->request->data['key']);
				if(!empty($rsesions)){
					//recuperamos las preferencias de los usuario si se encuentran asignadas
					$userpreferences = $this->Userpreference->find('all',array('conditions'=>array('user_id'=>$rsesions['Rsesion']['user_id'])));
					//recuperamos las preferencia de autos
					$carpreferences = $this->Carpreference->find('all',array('conditions'=>array('state'=>1)));
					$i=0;
					$userpreferencejson = array();
					foreach($carpreferences as $carpreference){
								$value=0;
								foreach($userpreferences as $userpreference){
									if($userpreference['Userpreference']['carpreference_id'] == $carpreference['Carpreference']['id']){
										if($userpreference['Userpreference']['state'] == 1)
											$value= 1;
										else
											$value=0;
									}
								}
								$userpreferencejson[$i]['Userpreference']['carpreference_id'] =$carpreference['Carpreference']['id'];
								$userpreferencejson[$i]['Userpreference']['select'] =$value;
								$userpreferencejson[$i]['Userpreference']['existe'] =$carpreference['Carpreference']['description'];
						$i++;
					}
				}else{
					$error = __('Error sesion finalizada');
				}
			}else{
				$error = __('Error sesion inactiva');
			}
		}else{
			$error = __('No se encontro una clave valida');
		}
		$this->set('error',$error);
		$this->set(compact('userpreferencejson'));
	}
}
