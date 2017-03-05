<?php
App::uses('AppController', 'Controller');
/**
 * People Controller
 *
 * @property Person $Person
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * Apellido secondname
 *firsname nombre
 */
class PeoplesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('RequestHandler');


	public function getpersonsdata(){
		$this->layout='';
		$error='';
		$people=array();
		if(!empty($this->request->data['document'])){
			$people = $this->People->find('first',array('conditions'=>array('People.document'=>$this->request->data['document'])));
		}else{
			$error = __('No se especifico un documento valido');
		}
		$this->set('error',$error);
		$this->set(compact('people'));
	}

	function beforeFilter(){
		parent::beforeFilter();
		// For CakePHP 2.0
		$this->Auth->allow('*');

		// For CakePHP 2.1 and up
		$this->Auth->allow();
		if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost()) && ($this->action == 'ownerregister' || $this->action == 'userajaxloginremote' || $this->action == 'login' || $this->action=='registeruser')){
			$this->Security->validatePost = false;
			$this->Security->enabled = false;
			$this->Security->csrfCheck = false;
		}
		/****UNCOMMENT FOR SECUTIY ACTIVE
			if($this->params['action'] == 'userregister' ||
			$this->params['action'] == 'login' ||
			$this->params['action'] == 'ownerregister' ||
			$this->params['action'] == 'usersactive' ||
			$this->params['action']=='confirmarusuario'){
			$this->Security->unlockedActions=true;
			}else{
			try{
			$result =	$this->Acl->check(array(
			'model' => 'Group',       # The name of the Model to check agains
			'foreign_key' => $this->Session->read('tipousr') # The foreign key the Model is bind to
			), ucfirst($this->params['controller']).'/'.$this->params['action']);
			//SI NO TIENE PERMISOS DA ERROR!!!!!!
			if(!$result)
				$this->redirect(array('controller' => 'mains','action'=>'securityerror','Users-'.$this->params['action']));
				}catch(Exeption $e){

				}
				}***/
	}

	public function view($id = null){
		$this->layout='';
		$people=array();
		if(!empty($id)){
			$people = $this->People->find('first',array('conditions'=>array('People.id'=>$id)));
		}
		$this->set(compact('people'));
	}
}
