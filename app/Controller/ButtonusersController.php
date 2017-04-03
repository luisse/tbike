<?php
App::uses('AppController', 'Controller');
/**
 * Buttonusers Controller
 *
 * @property Buttonuser $Buttonuser
 * @property PaginatorComponent $Paginator
 */
class ButtonusersController extends AppController {

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
		$this->set('title_for_layout',__('Botones de Usuario'));
		$this->Buttonuser->recursive = 0;
		//opciones solo debe traer los botones del usuario actualmente conectado
		$this->paginate=array('limit' => 8,
							'page' => 1,
							'order'=>array('username'=>'desc'),
							'fields'=>array('Button.id','Button.descripc','User.username','Buttonuser.active','Buttonuser.id'),
							'conditions'=>array('Buttonuser.user_id'=>$this->Session->read('user_id')));
		$this->set('buttonusers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Buttonuser->exists($id)) {
			throw new NotFoundException(__('Invalid Buttonuser'));
		}
		$options = array('conditions' => array('Buttonuser.' . $this->Buttonuser->primaryKey => $id));
		$this->set('Buttonuser', $this->Buttonuser->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('title_for_layout',__('Activar Botones'));
		if ($this->request->is('post')) {
			$this->Buttonuser->create();
			if ($this->Buttonuser->saveAll($this->request->data['Buttonuser'])) {
				$this->Session->setFlash(__('El Registro fue Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo Guardar el Registro. Por Favor Intente de Nuevo.'));
			}
		}

		$ls_notexists=' NOT EXISTS(SELECT 1 FROM buttonusers WHERE buttonusers.button_id = Button.id and buttonusers.user_id ='.$this->Session->read('user_id').')';
		$buttonusers = $this->Buttonuser->Button->find('all',array('conditions'=>array('Button.group_id'=>$this->Session->read('tipousr'),$ls_notexists)));
		$this->set(compact('buttonusers'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('title_for_layout',__('Activar/Desativar Botones'));
		if (!$this->Buttonuser->exists($id)) {
			throw new NotFoundException(__('Identificador Invalido'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Buttonuser->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro Fue Actualizado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo actualizar el registro. Por favor intente de nuevo.'));
			}
		}else{
			$options = array('conditions' => array('Buttonuser.' . $this->Buttonuser->primaryKey => $id));
			$this->request->data = $this->Buttonuser->find('first', $options);

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
		$this->Buttonuser->id = $id;
		if (!$this->Buttonuser->exists()) {
			throw new NotFoundException(__('Invalid Buttonuser'));
		}
		//$this->request->onlyAllow('post', 'delete');
		try {
			if ($this->Buttonuser->delete()) {
				$this->Session->setFlash(__('El Registro fue eliminado.'));
			} else {
				$this->Session->setFlash(__('No se pudo borrar el registro. Por favor intente de nuevo.'));
			}
		}catch(Exception $e){
			$this->Session->setFlash(__('Error: No se puede eliminar el registro. Atributo asignado a registro'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function beforeFilter(){
		parent::beforeFilter();
		 //$this->set('str_estados',$str_estados);
		 $this->set(compact('str_estadossino','str_estados'));
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
	}


}
