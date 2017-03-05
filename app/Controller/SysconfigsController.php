<?php
App::uses('AppController', 'Controller');
/**
 * Sysconfigs Controller
 *
 * @property Sysconfig $Sysconfig
 * @property PaginatorComponent $Paginator
 */
class SysconfigsController extends AppController {

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
		$this->Sysconfig->recursive = 0;
		$this->paginate=array('limit' => 10,
						'page' => 1,
						//'order'=>array('username'=>'desc'),
						'conditions'=>array('Sysconfig.tallercito_id'=>$this->Session->read('tallercito_id')));		
		$this->set('sysconfigs', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Sysconfig->exists($id)) {
			throw new NotFoundException(__('Invalid sysconfig'));
		}
		$options = array('conditions' => array('Sysconfig.' . $this->Sysconfig->primaryKey => $id));
		$this->set('sysconfig', $this->Sysconfig->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */ 
	public function add() {
		$this->set('title_for_layout',__('Configuración Global del Sistema'));
		$sysconfigs = $this->Sysconfig->find('first',array('conditions'=>array('Sysconfig.tallercito_id'=>$this->Session->read('tallercito_id'))));
		
		if ($this->request->is('post','put')){
			$this->Sysconfig->create();
			$this->request->data['Sysconfig']['tallercito_id']=$this->Session->read('tallercito_id');
			if ($this->Sysconfig->save($this->request->data)) {
				$this->Session->setFlash(__('Los datos fueron grabados.'));
				//return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo guardar los datos'));
			}
		}
		if(!empty($sysconfigs)){
			$this->request->data=$sysconfigs;
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
		if (!$this->Sysconfig->exists($id)) {
			throw new NotFoundException(__('Invalid sysconfig'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Sysconfig->save($this->request->data)) {
				$this->Session->setFlash(__('The sysconfig has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sysconfig could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Sysconfig.' . $this->Sysconfig->primaryKey => $id));
			$this->request->data = $this->Sysconfig->find('first', $options);
		}
		$tallercitos = $this->Sysconfig->Tallercito->find('list');
		$this->set(compact('tallercitos'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Sysconfig->id = $id;
		if (!$this->Sysconfig->exists()) {
			throw new NotFoundException(__('Invalid sysconfig'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Sysconfig->delete()) {
			$this->Session->setFlash(__('The sysconfig has been deleted.'));
		} else {
			$this->Session->setFlash(__('The sysconfig could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function beforeFilter(){
		// For CakePHP 2.0
		$this->Auth->allow('*');
		
		// For CakePHP 2.1 and up
		$this->Auth->allow();
		
	}

	public function beforeRender(){
		/***try{
			$result =	$this->Acl->check(array(
					'model' => 'Group',       # The name of the Model to check agains
					'foreign_key' => $this->Session->read('tipousr') # The foreign key the Model is bind to
			), ucfirst($this->params['controller']).'/'.$this->params['action']);
			//SI NO TIENE PERMISOS DA ERROR!!!!!!
			if(!$result)
				$this->redirect(array('controller' => 'accesorapidos','action'=>'seguridaderror',ucfirst($this->params['controller']).'-'.$this->params['action']));
		}catch(Exeption $e){
		
		}****/
		parent::beforeRender();		
		$str_estadossino[0]='No';
		$str_estadossino[1]='Si';
		$this->set('str_estadossino',$str_estadossino);
	}
	
}
