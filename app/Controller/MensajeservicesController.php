<?php
App::uses('AppController', 'Controller');
/**
 * Mensajeservices Controller
 *
 * @property Mensajeservice $Mensajeservice
 * @property PaginatorComponent $Paginator
 */
class MensajeservicesController extends AppController {

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
		$this->Mensajeservice->recursive = 0;
		$this->set('mensajeservices', $this->Paginator->paginate());
	}
	
	public function mostrarmensajes($bicicleta_id = null){
		$this->layout='bmodalbox';
		$this->set('mensajeservices', $this->Mensajeservice->find('all',array('conditions'=>array('Mensajeservice.bicicleta_id'=>$bicicleta_id),
																											'limit'=>10,
																											'order'=>'Mensajeservice.fechaaprox DESC')) );		
	}
	
	
	public function mostrarmensajecliente(){
		$this->layout='bmodalbox';
		$bicicleta_id = $this->Session->read('bicicleta_id');
		if(!empty($bicicleta_id))
			$this->set('mensajeservices', $this->Mensajeservice->find('all',array('conditions'=>array('Mensajeservice.bicicleta_id in('.$this->Session->read('bicicleta_id').')','Mensajeservice.confirmadocliente'=>0),
																								'limit'=>10,
																								'order'=>'Mensajeservice.fechaaprox DESC')) );				
	}
	

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Mensajeservice->exists($id)) {
			throw new NotFoundException(__('Invalid mensajeservice'));
		}
		$options = array('conditions' => array('Mensajeservice.' . $this->Mensajeservice->primaryKey => $id));
		$this->set('mensajeservice', $this->Mensajeservice->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($bicicleta_id = null) {
		$this->layout='bmodalbox';
		if(!empty($bicicleta_id)){
			if ($this->request->is('post')) {
				$this->request->data['Mensajeservice']['tallercito_id']=$this->Session->read('tallercito_id');
				$this->request->data['Mensajeservice']['confirmadocliente']=0;
				$this->request->data['Mensajeservice']['bicicleta_id']=$bicicleta_id;
				
				$this->Mensajeservice->create();
				if ($this->Mensajeservice->save($this->request->data)) {
					//$this->Session->setFlash(__('El Mensaje a sido guardado.'));
					return $this->redirect(array('action' => 'mostrarmensajes',$bicicleta_id));
				} else {
					$this->Session->setFlash(__('El Mensaje no se pudo grabar. Por favor, intente de nuevo.'));
				}
			}
		}else{
			$this->Session->setFlash(__('No se especifico el identificador de  Bicicleta'));
		}
		$this->set('bicicleta_id',$bicicleta_id);
	}
	
	
/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Mensajeservice->exists($id)) {
			throw new NotFoundException(__('Código Invalido de Mensaje'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Mensajeservice->save($this->request->data)) {
				$this->Session->setFlash(__('El Mensaje a sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El Mensaje no se pudo guardar. Por favor, intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Mensajeservice.' . $this->Mensajeservice->primaryKey => $id));
			$this->request->data = $this->Mensajeservice->find('first', $options);
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
		$this->Mensajeservice->id = $id;
		if (!$this->Mensajeservice->exists()) {
			throw new NotFoundException(__('Código de Mensaje Invalido'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Mensajeservice->delete()) {
			$this->Session->setFlash(__('El Mensaje a sido borrado.'));
		} else {
			$this->Session->setFlash(__('El Mensaje no se pudo borrar. Por favor, intente de nuevo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	function cambiarestado($id = null,$estado = null){
		$this->layout='';
		$error = '';
		if(!empty($id) && !empty($estado)){
			$this->request->data['Mensajeservice']['id'] = $id;
			$this->request->data['Mensajeservice']['confirmadocliente'] = $estado;
			$this->request->data['Mensajeservice']['userconfirmed'] = date('Y-m-d');
			if ($this->Mensajeservice->Save($this->request->data)) {
				$error='';
			} else {
				$error = __('El registro no se pudo actualizar. Por favor, intente de nuevo.');
			}
			$this->set('error',$error);			
		}
	}
	
	public function beforeRender(){
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
