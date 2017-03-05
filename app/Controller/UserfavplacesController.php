<?php
App::uses('AppController', 'Controller');
/**
 * Userfavplaces Controller
 *
 * @property Userfavplace $Userfavplace
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UserfavplacesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session','RequestHandler');
	public $uses=array('Userfavplace','Rsesion');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('title_for_layout',__('Mis Destinos Favoritos'));
		$this->paginate=array('limit' => 5,
				'page' => 1,
				'order'=>array('Taxorder.date'=>'desc'),
				'conditions'=>array('Userfavplace.user_id'=>$this->Session->read('user_id'))
		);
		$this->Userfavplace->recursive = 0;
		$this->set('userfavplaces', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Userfavplace->exists($id)) {
			throw new NotFoundException(__('Invalid userfavplace'));
		}
		$options = array('conditions' => array('Userfavplace.' . $this->Userfavplace->primaryKey => $id));
		$this->set('userfavplace', $this->Userfavplace->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Userfavplace->create();
			if ($this->Userfavplace->save($this->request->data)) {
				$this->Session->setFlash(__('El registro fue guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo Guardar el Registro. Por favor intente de nuevo.'));
			}
		}
		$users = $this->Userfavplace->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('title_for_layout',__('Actualizar Destinos'));
		if (!$this->Userfavplace->exists($id)) {
			throw new NotFoundException(__('Invalid userfavplace'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Userfavplace->save($this->request->data)) {
				$this->Session->setFlash(__('El registro fue guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo Guardar el Registro. Por favor intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Userfavplace.' . $this->Userfavplace->primaryKey => $id,'Userfavplace.user_id'=>$this->Session->read('user_id')));
			$this->request->data = $this->Userfavplace->find('first', $options);
		}
		$users = $this->Userfavplace->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Userfavplace->id = $id;
		if (!$this->Userfavplace->exists()) {
			throw new NotFoundException(__('Invalid userfavplace'));
		}
		try{
			if ($this->Userfavplace->deleteAll(array('Userfavplace.id'=>$id,'Userfavplace.user_id'=>$this->Session->read('user_id')),true)) {
				$this->Session->setFlash(__('El Registro fue eliminado.'));
			} else {
				$this->Session->setFlash(__('No se pudo eliminar el registro. Por favor intente de nuevo.'));
			}
		}catch(Exception $e){
			$this->Session->setFlash(__('Error: No se puede eliminar el registro. Atributo asignado.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function getfavplace(){
		$token='';
		$error='';
		$Publickey = $this->request->header('Security-Access-PublicToken');
		$token = $this->request->header('Security-Access-Token');
		Configure::load('appconf');
		$securedata = Configure::read('securedata');
		//verificamos que la clave publica coincida con la clave primaria
		if($securedata == $Publickey && !empty($this->request->data)){
			if(!empty($token)){
				if($this->Rsesion->SessionIsOk($token)){
					$rsesion = $this->Rsesion->rsesiondata($token);
					if(!empty($rsesion)){
						$this->Userfavplace->unbindModel(
								array('belongsTo' => array('User')
								)
						);
						$userfavplaces=$this->Userfavplace->find('all',array('conditions'=>array('Userfavplace.user_id'=>$rsesion['Rsesion']['user_id'])));

					}
				}else{
					$error=__('No se encuentra una sesion activa');
				}
			}else{
				$error = __('No se encuentra un token valido');
			}
		}else{
			$error = __('Error clave publica erronea');
		}
		$this->set('error',$error);
		$this->set(compact('userfavplaces'));

	}

	public function addfavplace(){
		$token='';
		$error='';
		$Publickey = $this->request->header('Security-Access-PublicToken');
		$token = $this->request->header('Security-Access-Token');
		Configure::load('appconf');
		$securedata = Configure::read('securedata');
		//verificamos que la clave publica coincida con la clave primaria
		if($securedata == $Publickey && !empty($this->request->data)){
			if(!empty($token)){
				if($this->Rsesion->SessionIsOk($token)){
					$rsesion = $this->Rsesion->rsesiondata($token);
					if(!empty($rsesion)){
						$data['Userfavplace']['user_id']	= $rsesion['Rsesion']['user_id'];
						$data['Userfavplace']['detalle']	= $this->request->data['detalle'];
						$data['Userfavplace']['destino']	= $this->request->data['destino'];
						$data['Userfavplace']['lat']		= $this->request->data['lat'];
						$data['Userfavplace']['lng']		= $this->request->data['lng'];
						$data['Userfavplace']['state']		= 1;
						$this->Userfavplace->create();
						if(!$this->Userfavplace->save($data)){
							$error = __('No se pudo guardar el lugar');
						}
					}
				}else{
					$error=__('No se encuentra una sesion activa');
				}
			}else{
				$error = __('No se encuentra un token valido');
			}
		}else{
			$error = __('Error clave publica erronea');
		}
		$this->set('error',$error);
	}

	public function dropfavplace(){
		$token='';
		$error='';
		$Publickey = $this->request->header('Security-Access-PublicToken');
		$token = $this->request->header('Security-Access-Token');
		Configure::load('appconf');
		$securedata = Configure::read('securedata');
		//verificamos que la clave publica coincida con la clave primaria
		if($securedata == $Publickey && !empty($this->request->data)){
			if(!empty($token)){
				if($this->Rsesion->SessionIsOk($token)){
					$rsesion = $this->Rsesion->rsesiondata($token);
					if(!empty($rsesion)){
						//print_r($this->request->data)
						if($this->Userfavplace->deleteAll(array('Userfavplace.id'=>$this->request->data['id'],'Userfavplace.user_id'=>$rsesion['Rsesion']['user_id']),true)){
							$error = __('No se pudo eliminar su lugar favorito');
						}
					}
				}else{
					$error=__('No se encuentra una sesion activa');
				}
			}else{
				$error = __('No se encuentra un token valido');
			}
		}else{
			$error = __('Error clave publica erronea');
		}
		$this->set('error',$error);
	}
	//Userfavplace

	//ALL HACK THIS FUNCTION ;-)
	public function beforeFilter(){
		$this->Auth->allow('*');
		// For CakePHP 2.1 and up
		$this->Auth->allow();
	}

}
