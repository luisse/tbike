<?php
App::uses('AppController', 'Controller');
/**
 * Radiotaxis Controller
 *
 * @property Radiotaxi $Radiotaxi
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class RadiotaxisController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session','RequestHandler');
	public $uses = array('Radiotaxi','Taxorder');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		//$this->Radiotaxi->recursive = 0;
		//$this->set('radiotaxis', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view() {
		$cuit = $this->request->query['cuit'] ? $this->request->query['cuit'] : '';
		$options = array('conditions' => array('Radiotaxi.cuit' => $cuit));
		$this->set('radiotaxi', $this->Radiotaxi->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		/***if ($this->request->is('post')) {
			if($this->Session->read('tipousr') == 4){
				$this->Radiotaxi->create();
				if ($this->Radiotaxi->save($this->request->data)) {
					$this->Session->setFlash(__('The radiotaxi has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The radiotaxi could not be saved. Please, try again.'));
				}
			}else{

			}
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
	/**	$this->Radiotaxi->id = $id;
		if (!$this->Radiotaxi->exists()) {
			throw new NotFoundException(__('Invalid radiotaxi'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Radiotaxi->delete()) {
			$this->Session->setFlash(__('The radiotaxi has been deleted.'));
		} else {
			$this->Session->setFlash(__('The radiotaxi could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));**/
	}

	public function orders(){
		$this->set('title_for_layout','Administrador de pedidos');
		Configure::load('appconf');
		$key_api_maps = Configure::read('key_api_maps');
		$this->set('key_api_maps',$key_api_maps);
	}

	public function beforeFilter(){
		parent::beforeRender();
		//$acepted_func = array('listcars','exists');
		$acepted_func = array();
		if(in_array($this->params['action'],$acepted_func)){
					$this->Auth->allow();
		}else{
				try{
					$result =	$this->Acl->check(array(
						'model' => 'Group',       # The name of the Model to check agains
						'foreign_key' => $this->Session->read('tipousr') # The foreign key the Model is bind to
						), ucfirst($this->params['controller']).'/'.$this->params['action']);
						//SI NO TIENE PERMISOS DA ERROR!!!!!!
						if(!$result)
							$this->redirect(array('controller' => 'mains','action'=>'securityerror',$this->params['controller'].' - '.$this->params['action']));
				}catch(Exeption $e){

				}
		}
	}

	public function charts(){
		$this->set('title_for_layout','Graficas de Pedidos');
	}

	public function get_data_to_chart(){
		$data = array();
		$date_from = empty($this->request->query['date_from']) ? date('Y-m-d') : $this->request->query['date_from'];
		$date_to   = empty($this->request->query['date_to']) ? date('Y-m-d') : $this->request->query['date_to'];
		$state     = empty($this->request->query['state']) ? 1 : $this->request->query['state'];
		$Taxorder  = ClassRegistry::init('Taxorder');
		if($this->request->query('type') == 0)
		{
			$data      = $Taxorder->get_order_per_day($this->Session->read('user_id'),$date_from,$date_to,$state);
		}else
		{
			$date_from = $date_to;
			$data      = $Taxorder->get_order_per_driver($this->Session->read('user_id'),$date_from,$date_to,$state);
		}
		$this->set(compact('data'));
	}
}
