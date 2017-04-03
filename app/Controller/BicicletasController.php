<?php
App::uses('AppController', 'Controller');
/**
 * Bicicletas Controller
 *
 * @property Bicicleta $Bicicleta
 * @property PaginatorComponent $Paginator
 */
class BicicletasController extends AppController {
	var $name='Bicicletas';
	var $components = array('Paginator','RequestHandler','Session');
	var $uses = array('Bicicleta','Cliente');

/**
 * index method
 *
 * @return void
 */
	public function index($user_id = null) {
		$ls_filtro = '1=1 ';
		if($this->Session->read('tipousr') != 2){
			if(empty($user_id))
				$user_id = $this->Session->read('useractual');
			else
				$this->Session->write('useractual',$user_id);
		}else{
			$user_id =  $this->Session->read('user_id');
		}

		$ls_filtro = $ls_filtro.' AND user_id='.$user_id;
		//recuperamos los datos de cliente
		$cliente=array();
		if(!empty($user_id)){
			$cliente = $this->Bicicleta->Cliente->find('first',array('conditions'=>array('user_id'=>$user_id),
														'fields'=>array('Cliente.id','Cliente.apellido','Cliente.nombre','Cliente.foto')));
		}

		//utilizamos la sesion para administrar los datos del usuario actual

		$this->paginate=array('limit' => 10,
						'page' => 1,
						'order'=>array('marca'=>'asc'),
						'conditions'=>$ls_filtro);
		$this->Bicicleta->recursive = 0;
		$this->set('bicicletas', $this->Paginator->paginate());
		$this->set('cliente',$cliente);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->layout='bmodalbox';
		if (!$this->Bicicleta->exists($id)) {
			throw new NotFoundException(__('No Existe la Bicicleta'));
		}
		$options = array('conditions' => array('Bicicleta.' . $this->Bicicleta->primaryKey => $id));
		$this->set('bicicleta', $this->Bicicleta->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Bicicleta->create();
			//Informacion datos del cliente
			$cliente= $this->Cliente->find('first',array('conditions'=>array('user_id'=>$this->Session->read('useractual')),
														'fields'=>array('Cliente.id')));
			$this->request->data['Bicicleta']['cliente_id']=$cliente['Cliente']['id'];
			if ($this->Bicicleta->save($this->request->data)) {
				$this->Session->setFlash(__('Los Datos fueron grabados.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Los datos no se pudieron grabar. Por favor, intente de nuevo.'));
			}
		}
	}

	public function addjson(){
		$error = '';
		$this->Bicicleta->create();
		//Informacion datos del cliente
		//print_r($this->request->data);
		if(!empty($this->request->data)){
			$data['Bicicleta']['cliente_id'] 		= $this->request->data['cliente_id'];
			$data['Bicicleta']['marca'] 				= $this->request->data['marca'];
			$data['Bicicleta']['modelo'] 				= $this->request->data['modelo'];
			$data['Bicicleta']['detalles'] 			= $this->request->data['detalles'];
			$data['Bicicleta']['equipodetalle'] = $this->request->data['equipodetalle'];
			$data['Bicicleta']['nrocuadro'] 		= $this->request->data['nrocuadro'];

			if ($this->Bicicleta->save($data)) {
				$error = '';
			} else {
				foreach($this->Bicicleta->validationErrors as $errores)
					$error=$error.'. '.$errores[0];
			}
		}else{
			$error = __('No se encontraron datos validos para procesar');
		}
		$this->set('error',$error);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Bicicleta->exists($id)) {
			throw new NotFoundException(__('Identificador Invalido de Bicicleta'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Bicicleta->save($this->request->data)) {
				$this->Session->setFlash(__('Los datos fueron guardados.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Los datos no se pudieron actualizar. Por favor, intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Bicicleta.' . $this->Bicicleta->primaryKey => $id));
			$this->request->data = $this->Bicicleta->find('first', $options);
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
		$this->Bicicleta->id = $id;
		if (!$this->Bicicleta->exists()) {
			throw new NotFoundException(__('Identificador Invalido'));
		}
		//$this->request->onlyAllow('post', 'delete');
		try {
			if ($this->Bicicleta->delete()) {
				$this->Session->setFlash(__('El registro a sido borrado.'));
			} else {
				$this->Session->setFlash(__('El registro no se pudo borrar. Por favor, intente de nuevo.'));
			}
		}catch(Exception $e){
			$this->Session->setFlash(__('Error: No se puede eliminar el registro. Atributo asignado.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	/*
	* Funcion: permite retornar las bicicletas del cliente
	*/
	function listbiclient($cliente_id = null){
		$this->layout='';
		$ls_filtro='';
		$bicicletas= null;
		if(!empty($cliente_id)){
			$ls_filtro = $ls_filtro.' cliente_id='.$cliente_id;
			$bicicletas=$this->Bicicleta->find('all',array('conditions'=>$ls_filtro));
		}
		$this->set('bicicletas', $bicicletas);
	}

	function listbicicletas($row = null){
		$ls_filtro = '1 = 1 ';
		if(!empty($this->request->data)){
			if($this->request->data['Bicicleta']['nrocuadro'])
				$ls_filtro = $ls_filtro.' and Bicicleta.nrocuadro = '.$this->request->data['Bicicleta']['nrocuadro'];
			if($this->request->data['Bicicleta']['detalle'])
				$ls_filtro = $ls_filtro.' and Bicicleta.detalle like "%'.$this->request->data['Bicicleta']['detalle'].'%"';
		}
		$bicicletas = $this->Bicicleta->find('all',array('conditions'=>array('Bicicleta.cliente_id'=>$this->Session->read('cliente_id'),
																									$ls_filtro)));
		$this->set(compact('bicicletas'));
		$this->set('row',$row);
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
	}

	public function beforeFilter(){
		// For CakePHP 2.0
		$this->Auth->allow('*');

		// For CakePHP 2.1 and up
		$this->Auth->allow();
	}
	function bicicletadetailxml($bicicleta_id=null){
		$bicicleta=array();
		if(!empty($bicicleta_id)){
			$bicicleta = $this->Bicicleta->find('all',array('conditions'=>array('Bicicleta.id'=>$bicicleta_id,'Bicicleta.cliente_id'=>$this->Session->read('cliente_id'))));
		}
		$this->set(compact('bicicleta'));
	}

	public function remoteajax(){
		$this->layout='';
		$this->set('bicicletas',$this->Bicicleta->find('all'));
	}
}
