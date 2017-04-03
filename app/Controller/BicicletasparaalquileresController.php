<?php
App::uses('AppController', 'Controller');
/**
 * Bicicletasparaalquileres Controller
 *
 * @property Bicicletasparaalquilere $Bicicletasparaalquilere
 * @property PaginatorComponent $Paginator
 */
class BicicletasparaalquileresController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','RequestHandler');
	public $uses = array('Bicicletasparaalquilere','Bicicleta','Cliente');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('title_for_layout',__('Administrar Bicicleta para Aquiler'));
		$this->Bicicletasparaalquilere->recursive = 0;
		$ls_filtro='Bicicletasparaalquilere.tallercito_id = '.$this->Session->read('tallercito_id');
		$this->paginate=array('limit' => 10,
						'page' => 1,
						//'order'=>array('marca'=>'asc'),
						'conditions'=>$ls_filtro);
		$this->set('bicicletasparaalquileres', $this->Paginator->paginate());
	}

	public function listbicicletas(){
		$bicicletasparaalquileres = $this->Bicicletasparaalquilere->find('all',array('conditions'=>
					array('Bicicletasparaalquilere.tallercito_id'=>$this->Session->read('tallercito_id'))));
		$this->set(compact('bicicletasparaalquileres'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Bicicletasparaalquilere->exists($id)) {
			throw new NotFoundException(__('Identificador Invalido bicicletasparaalquilere'));
		}
		$options = array('conditions' => array('Bicicletasparaalquilere.' . $this->Bicicletasparaalquilere->primaryKey => $id));
		$this->set('bicicletasparaalquilere', $this->Bicicletasparaalquilere->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('title_for_layout',__('Nueva Bicicleta para Aquiler'));
		if ($this->request->is('post')) {
			$this->Bicicletasparaalquilere->create();
			$this->request->data['Bicicletasparaalquilere']['tallercito_id']=$this->Session->read('tallercito_id');
			if ($this->Bicicletasparaalquilere->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro fue Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo Guardar el Registro. Por Favor Intente de Nuevo.'));
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
		$this->set('title_for_layout',__('Actualizar datos de Bicicleta para Aquiler'));
		if (!$this->Bicicletasparaalquilere->exists($id)) {
			throw new NotFoundException(__('Identificador Inválido'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Bicicletasparaalquilere->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro Fue Actualizado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo actualizar el registro. Por favor intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Bicicletasparaalquilere.' . $this->Bicicletasparaalquilere->primaryKey => $id));
			$this->request->data = $this->Bicicletasparaalquilere->find('first', $options);
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
		$this->Bicicletasparaalquilere->id = $id;
		if (!$this->Bicicletasparaalquilere->exists()) {
			throw new NotFoundException(__('Identificador Invalido'));
		}
		try {
			if ($this->Bicicletasparaalquilere->delete()) {
				$this->Session->setFlash(__('El Registro fue eliminado.'));
			} else {
				$this->Session->setFlash(__('No se pudo borrar el registro. Por favor intente de nuevo.'));
			}
		}catch(Exception $e){
			$this->Session->setFlash(__('Error: No se puede eliminar el registro. Atributo asignado.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function beforeFilter(){
		parent::beforeFilter();
		if($this->params['action'] == 'NOACT'){

		}else{
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

	public function bicicletasparaalquilere(){
		$error='';
		$bicicletasparaalquilere=array();
		if(!empty($this->request->data['id'])){
				$bicicletasparaalquilere=$this->Bicicletasparaalquilere->find('first',array('conditions'=>array('Bicicletasparaalquilere.id'=>$this->request->data['id'],
																											'Bicicletasparaalquilere.tallercito_id'=>$this->Session->read('tallercito_id')),
																											'fields'=>array('Bicicletasparaalquilere.id','Bicicleta.marca','Bicicleta.modelo','Bicicleta.nrocuadro','Bicicletasparaalquilere.estado')));
			if(empty($bicicletasparaalquilere))
					$error = __('No se encontraron bicicletas para alquilar');
			else{
				if($bicicletasparaalquilere['Bicicletasparaalquilere']['estado']){
					$error = __('Bicicleta alquilada no se puede asignar...');
				}
			}
		}else{
			$error = __('No se especifico identificador de bicicleta');
		}
		$this->set(compact('bicicletasparaalquilere'));
		$this->set('error',$error);
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

		}***/
		parent::beforeRender();
		$str_estadobike[0]='Activa';
		$str_estadobike[1]='Desactiva';
		$this->set(compact('str_estadobike'));
		if($this->params['action'] == 'add' ||
			$this->params['action']=='edit'){
			$bicicletas=array();
			if($this->Session->read('tipousr') == 1){
				$bicicletas = $this->Bicicletasparaalquilere->Bicicleta->find('list',array('conditions'=>array('Bicicleta.cliente_id'=>$this->Session->read('cliente_id')),
																						'fields'=>array('Bicicleta.id','Bicicleta.nrocuadro')));
			}
			$this->set(compact('bicicletas'));
		}
	}

	public function seleccionarbicicleta($row = null){
		$this->layout='bmodalbox';
		$this->set('row',$row);
	}

	public function bicicletasparaalquilerl(){
		$ls_filtro = '1 = 1 ';
		if(!empty($this->request->data)){
			if($this->request->data['Bicicleta']['nrocuadro'])
				$ls_filtro = $ls_filtro.' and Bicicleta.nrocuadro = "'.$this->request->data['Bicicleta']['nrocuadro'].'"';
			if($this->request->data['Bicicleta']['detalles'])
				$ls_filtro = $ls_filtro.' and Bicicleta.detalles like "%'.$this->request->data['Bicicleta']['detalles'].'%"';
		}

		$bicicletas = $this->Bicicletasparaalquilere->find('all',array('conditions'=>
					array('Bicicletasparaalquilere.tallercito_id'=>$this->Session->read('tallercito_id')
						,$ls_filtro)));
		$this->set(compact('bicicletas'));
	}
}
