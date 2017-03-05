<?php
App::uses('AppController', 'Controller');
/**
 * Mensajesmantenimientos Controller
 *
 * @property Mensajesmantenimiento $Mensajesmantenimiento
 * @property PaginatorComponent $Paginator
 * @estado   Propiedad del mensaje de mantenimiento 0-No Enviado,1-Enviado,2-cancelado
 */
class MensajesmantenimientosController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	var $helpers=array('Time');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->layout='bmodalbox';
		$this->Mensajesmantenimiento->recursive = 0;
		$filtro='';
		$filter='';
		//if($this->Session->read('tipousr') == 2) $filter = array('Mensajesmantenimiento.cliente_id'=>$this->Session->read('cliente_id'));
		
		$this->paginate=array('limit' => 10,
						'page' => 1,
						'order'=>array('id'=>'DESC','fechaingreso'=>'ASC'),
						'conditions'=>array('Mensajesmantenimiento.bicicleta_id'=>$this->Session->read('bicicleta_id'),
													'Mensajesmantenimiento.tallercito_id'=>$this->Session->read('tallercito_id')));	
		$this->set('mensajesmantenimientos', $this->Paginator->paginate());
	}

	public function indexmant(){
		$this->set('title_for_layout','Listado de Mensajes de Mantenimiento');
	}
	
	public function listmensajes(){
		$this->layout='';
		App::uses('CakeTime', 'Utility');
		$filtros = CakeTime::daysAsSql($this->Mensajesmantenimiento->formatDate($this->request->data['Mensajesmantenimiento']['fecdesde']),
																	$this->Mensajesmantenimiento->formatDate($this->request->data['Mensajesmantenimiento']['fechasta']),
																	'fechacontrol');
		
		$this->Mensajesmantenimiento->recursive = 0;
		$this->paginate=array('limit' => 10,
						'page' => 1,
						'order'=>array('Mensajesmantenimiento.fechacontrol'=>'ASC'),
						'conditions'=>array('Mensajesmantenimiento.tallercito_id'=>$this->Session->read('tallercito_id'),$filtros),
						'joins'=>array(array('table'=>'bicicletas',
															'alias'=>'Bicicleta',
															'type'=>'LEFT',
															'conditions'=>array('Bicicleta.id = Mensajesmantenimiento.bicicleta_id')),
												array('table'=>'clientes',
															'alias'=>'Cliente',
															'type'=>'LEFT',
															'conditions'=>array('Bicicleta.cliente_id = Cliente.id'))),
						'fields'=>array('Mensajesmantenimiento.id','Mensajesmantenimiento.fechacontrol','Mensajesmantenimiento.enviarcorreo',
										'Mensajesmantenimiento.objetorevisar','Mensajesmantenimiento.observaciones','Bicicleta.id','Bicicleta.marca',
										'Bicicleta.modelo','Cliente.id','Cliente.nombre','Cliente.apellido'));	
		$this->set('mensajesmantenimientos', $this->Paginator->paginate());
	}
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Mensajesmantenimiento->exists($id)) {
			throw new NotFoundException(__('Invalid mensajesmantenimiento'));
		}
		$options = array('conditions' => array('Mensajesmantenimiento.' . $this->Mensajesmantenimiento->primaryKey => $id));
		$this->set('mensajesmantenimiento', $this->Mensajesmantenimiento->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($bicicleta_id=null){
		$this->layout='bmodalbox';
		if(!empty($bicicleta_id)) $this->Session->Write('bicicleta_id',$bicicleta_id);
		$bicicleta_id = $this->Session->read('bicicleta_id');
		if ($this->request->is('post')){
			$this->Mensajesmantenimiento->create();
			$this->request->data['Mensajesmantenimiento']['bicicleta_id']=$this->Session->read('bicicleta_id');
			$this->request->data['Mensajesmantenimiento']['tallercito_id']=$this->Session->read('tallercito_id');
			if ($this->Mensajesmantenimiento->save($this->request->data)) {
				$this->Session->setFlash(__('La Alerta de Mantenimiento a sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La Alerta de Mantenimiento no se pudo grabar. Por favor, intente de nuevo.'));
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
		/*Seguridad UPDATE*/
		$registros = $this->Mensajesmantenimiento->find('count',array('conditions'=>array('Mensajesmantenimiento.id'=>$id,'Mensajesmantenimiento.tallercito_id'=>$this->Session->read('tallercito_id'))));
		if($registros > 0){			
			if (!$this->Mensajesmantenimiento->exists($id)) {
				throw new NotFoundException(__('Invalid mensajesmantenimiento'));
			}
			if ($this->request->is('post')) {
				if ($this->Mensajesmantenimiento->save($this->request->data)) {
					$this->Session->setFlash(__('El mensajesmantenimiento a sido guardado.'));
					return $this->redirect(array('action' => 'indexmant'));
				} else {
					$this->Session->setFlash(__('El mensajesmantenimiento no se pudo guardar. Por favor, intente de nuevo.'));
				}
			} else {
				$options = array('conditions' => array('Mensajesmantenimiento.' . $this->Mensajesmantenimiento->primaryKey => $id,
														'Mensajesmantenimiento.tallercito_id'=>$this->Session->read('tallercito_id')));
				$this->request->data = $this->Mensajesmantenimiento->find('first', $options);
			}
		}else{
			return $this->redirect(array('action' => 'index'));
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
		$registros = $this->Mensajesmantenimiento->find('count',array('conditions'=>array('Mensajesmantenimiento.id'=>$id,'Mensajesmantenimiento.tallercito_id'=>$this->Session->read('tallercito_id'))));
		if($registros > 0){				
			$this->Mensajesmantenimiento->id = $id;
			if (!$this->Mensajesmantenimiento->exists()) {
				throw new NotFoundException(__('Invalid mensajesmantenimiento'));
			}
			//$this->request->onlyAllow('post', 'delete');
			if ($this->Mensajesmantenimiento->delete()) {
				$this->Session->setFlash(__('El Mensaje de Alerta a sido borrado.'));
			} else {
				$this->Session->setFlash(__('El Mensaje de Alerta no se pudo borrar. Por favor, intente de nuevo.'));
			}
			return $this->redirect(array('action' => 'indexmant'));
		}else{
			return $this->redirect(array('action' => 'index'));
		}
	}
	
	public function beforerender(){
		$str_estadossino[0]='No';
		$str_estadossino[1]='Si';
		$str_estadomensaje[0]='No enviado';
		$str_estadomensaje[1]='Enviado';
		$str_estadomensaje[2]='Cancelado';
		$this->set(compact('str_estadossino','str_estadomensaje'));
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

/**
 * retornarmensajes method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */	
	public function retornarmensajes(){
		$this->layout='';
		$this->Mensajesmantenimiento->recursive = 0;
		$filter='';
		if($this->Session->read('tipousr') == 2){ 
			$filter = array('Cliente.id'=>$this->Session->read('cliente_id'));
		}
		$this->paginate=array('limit' => 5,
						'page' => 1,
						'order'=>array('fechacontrol'=>'ASC'),
						'conditions'=>array('Mensajesmantenimiento.tallercito_id'=>$this->Session->read('tallercito_id'),'Mensajesmantenimiento.fechacontrol = '."'".date('Y-m-d 00:00:00')."'"),
						'joins'=>array(array('table'=>'bicicletas',
															'alias'=>'Bicicleta',
															'type'=>'LEFT',
															'conditions'=>array('Bicicleta.id = Mensajesmantenimiento.bicicleta_id')),
												array('table'=>'clientes',
															'alias'=>'Cliente',
															'type'=>'RIGHT',
															'conditions'=>array('Bicicleta.cliente_id = Cliente.id',$filter))),
						'fields'=>array('Mensajesmantenimiento.id','Mensajesmantenimiento.fechacontrol','Mensajesmantenimiento.enviarcorreo',
										'Mensajesmantenimiento.objetorevisar','Mensajesmantenimiento.observaciones','Bicicleta.id','Bicicleta.marca',
										'Bicicleta.modelo','Cliente.id','Cliente.nombre','Cliente.apellido'));	
		$this->set('mensajesmantenimientos', $this->Paginator->paginate());
	}
}
