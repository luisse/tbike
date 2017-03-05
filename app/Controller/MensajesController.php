<?php
App::uses('AppController', 'Controller');
/**
 * Mensajes Controller
 *
 * @property Mensaje $Mensaje
 * @property PaginatorComponent $Paginator
 */
class MensajesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $uses=array('Mensaje','Tipomen','Bicicleta','Cliente');
	public $components = array('Paginator');
	public $helpers=array('Time');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Mensaje->recursive = 0;
		$this->paginate=array('limit' => 10,
						'page' => 1,
						'fields'=>array('Mensaje.id','Mensaje.userrec_id','Mensaje.asunto','Mensaje.detalle','Mensaje.fechasend','Mensaje.enviado',
									'Mensaje.fechasendauto','Mensaje.confirmadocliente','Tipomen.descripcion','Cliente.nombre','Cliente.apellido','Mensaje.created',
									'Mensaje.mailauto'),
						'order'=>array('Mensaje.fechasendauto'=>'desc','id'=>'desc'),
						'joins'=>array(array('table'=>'clientes',
												'alias'=>'Cliente',
												'type'=>'LEFT',
												'conditions'=>array('Cliente.user_id = Mensaje.userrec_id')))
					);
		
		$this->set('mensajes', $this->Paginator->paginate());
	}
	
	public function listmensajes(){
		$this->layout='';
		App::uses('CakeTime', 'Utility');
		$ls_filtros='1=1 ';
		if(!empty($this->request->data)){
					$ls_filtros = $ls_filtros.'AND Cliente.tallercito_id ='.$this->Session->read('tallercito_id');
					if(!empty($this->request->data)){
					if($this->request->data['Cliente']['documento']!= null &&
						$this->request->data['Cliente']['documento']!= '')
						$ls_filtros = $ls_filtros.' AND Cliente.documento = '.str_replace('.', '', $this->request->data['Cliente']['documento']);
					if($this->request->data['Cliente']['nombre']!= null &&
						$this->request->data['Cliente']['nombre']!= '')
						$ls_filtros = $ls_filtros.' AND Cliente.nombre like "%'.$this->request->data['Cliente']['nombre'].'%" ';
					if($this->request->data['Cliente']['apellido']!= null &&
						$this->request->data['Cliente']['apellido']!= '')
						$ls_filtros = $ls_filtros.' AND Cliente.apellido  like "%'.$this->request->data['Cliente']['apellido'].'%" ';
					if($this->request->data['Mensaje']['fechasendautodesde']!='' &&
						$this->request->data['Mensaje']['fechasendautohasta']!=''){
							$filtros_fecha = CakeTime::daysAsSql($this->Mensaje->formatDate($this->request->data['Mensaje']['fechasendautodesde']),
																	$this->Mensaje->formatDate($this->request->data['Mensaje']['fechasendautohasta']),
																	'fechasendauto');
							$ls_filtros = $ls_filtros.' AND '.$filtros_fecha;
						}
						
		}
			
		
		}
		$this->paginate=array('limit' => 10,
						'page' => 1,
						'fields'=>array('Mensaje.id','Mensaje.userrec_id','Mensaje.asunto','Mensaje.detalle','Mensaje.fechasend','Mensaje.enviado',
									'Mensaje.fechasendauto','Mensaje.confirmadocliente','Tipomen.descripcion','Cliente.nombre','Cliente.apellido','Mensaje.created',
									'Mensaje.mailauto','Cliente.id'),
						'order'=>array('Mensaje.created'=>'desc'),
						'conditions'=>$ls_filtros,
						'joins'=>array(array('table'=>'clientes',
												'alias'=>'Cliente',
												'type'=>'LEFT',
												'conditions'=>array('Cliente.user_id = Mensaje.userrec_id')))
					);
		
		$this->set('mensajes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Mensaje->exists($id)) {
			throw new NotFoundException(__('Invalid mensaje'));
		}
		$options = array('conditions' => array('Mensaje.' . $this->Mensaje->primaryKey => $id));
		$this->set('mensaje', $this->Mensaje->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('title_for_layout',__('Nuevo Mensaje'));
		if ($this->request->is('post')) {
			$this->Mensaje->create();
			$cliente=$this->Cliente->find('first',array('conditions'=>array('Cliente.id'=>$this->request->data['Mensaje']['userrec_id']),
														'fields'=>array('Cliente.user_id')));
			if(!empty($cliente)){				
				$this->request->data['Mensaje']['usersend_id']=$this->Session->read('user_id');
				$this->request->data['Mensaje']['tallercito_id']=$this->Session->read('tallercito_id');
				$this->request->data['Mensaje']['userrec_id']=$cliente['Cliente']['user_id'];
				if ($this->Mensaje->save($this->request->data)) {
					$this->Session->setFlash(__('El mensaje a sido guardado.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('El mensaje no se pudo grabar. Por favor, intente de nuevo.'));
				}
			}else{
				$this->Session->setFlash(__('No se pudo recuperar el cliente.'));
			}
		}
	}
/**
 * Agregar nuevo mensaje Service
 */
	
	public function addmensajeservice($bicicleta_id = null) {
		$this->layout='bmodalbox';
		if(!empty($bicicleta_id)){
			if ($this->request->is('post')) {
				$this->request->data['Mensaje']['usersend_id']=$this->Session->read('user_id');
				$this->request->data['Mensaje']['tallercito_id']=$this->Session->read('tallercito_id');
				$this->request->data['Mensaje']['tipomen_id']=1;
				$this->request->data['Mensaje']['bicicleta_id']=$bicicleta_id;
				$this->request->data['Mensaje']['mailauto']=1;
				$this->request->data['Mensaje']['enviado']=0;
				
				//recupero el usuario asociado a la bicicleta
				$bicicleta=$this->Bicicleta->find('first',array('conditions'=>array('Bicicleta.id'=>$bicicleta_id)));
				if(!empty($bicicleta)){
					$this->request->data['Mensaje']['userrec_id']=$bicicleta['Cliente']['user_id'];
					$this->Mensaje->create();
					if ($this->Mensaje->save($this->request->data)) {
						$this->Session->setFlash(__('El mensaje a sido guardado.'));
						//return $this->redirect(array('action' => 'index'));
						return $this->redirect(array('action' => 'mostrarmensajes',$bicicleta_id));
					} else {
						$this->Session->setFlash(__('El mensaje no se pudo grabar. Por favor, intente de nuevo.'));
					}
				}else{
					$this->Session->setFlash(__('No se encontro el Usuario para asignar el mensaje.'));
				}
			}
		}
		$this->set('bicicleta_id',$bicicleta_id);
	}

	public function addmensajeservicetecnico($bicicleta_id = null){
		$this->layout='bmodalbox';
		if(!empty($bicicleta_id)){
			if ($this->request->is('post')) {
				$this->request->data['Mensaje']['usersend_id']=$this->Session->read('user_id');
				$this->request->data['Mensaje']['tallercito_id']=$this->Session->read('tallercito_id');
				$this->request->data['Mensaje']['tipomen_id']=2;
				$this->request->data['Mensaje']['bicicleta_id']=$bicicleta_id;
				$this->request->data['Mensaje']['mailauto']=1;
				$this->request->data['Mensaje']['enviado']=0;
				
				//recupero el usuario asociado a la bicicleta
				$bicicleta=$this->Bicicleta->find('first',array('conditions'=>array('Bicicleta.id'=>$bicicleta_id)));
				if(!empty($bicicleta)){
					$this->request->data['Mensaje']['userrec_id']=$bicicleta['Cliente']['user_id'];
					$this->Mensaje->create();
					if ($this->Mensaje->save($this->request->data)) {
						$this->Session->setFlash(__('El mensaje a sido guardado.'));
						return $this->redirect(array('action' => 'mostrarmensajes',$bicicleta_id));
					}else {
						$this->Session->setFlash(__('El mensaje no se pudo grabar. Por favor, intente de nuevo.'));
					}
				}else{
					echo 'User no encontrado';
					$this->Session->setFlash(__('No se encontro el Usuario para asignar el mensaje.'));
				}
			}
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
		if (!$this->Mensaje->exists($id)) {
			throw new NotFoundException(__('Invalid mensaje'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Mensaje->save($this->request->data)) {
				$this->Session->setFlash(__('El mensaje a sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El mensaje no se pudo guardar. Por favor, intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Mensaje.' . $this->Mensaje->primaryKey => $id));
			$this->request->data = $this->Mensaje->find('first', $options);
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
		$this->Mensaje->id = $id;
		if (!$this->Mensaje->exists()) {
			throw new NotFoundException(__('Invalid mensaje'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Mensaje->delete()) {
			$this->Session->setFlash(__('El mensaje a sido borrado.'));
		} else {
			$this->Session->setFlash(__('El mensaje no se pudo borrar. Por favor, intente de nuevo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	function beforeFilter(){
	    parent::beforeFilter();
	    // For CakePHP 2.0
	    $this->Auth->allow('*');
	    // For CakePHP 2.1 and up
	    $this->Auth->allow();
		
	}
	
	function mostrarmensajes($bicicleta_id){
		$this->layout='';
		$mensajes=array();
		if(!empty($bicicleta_id)){
			$mensajes = $this->Mensaje->find('all',array('conditions'=>array('Mensaje.bicicleta_id'=>$bicicleta_id)));
		}
		$this->set(compact('mensajes'));
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
		$this->Mensaje->recursive = 0;
		$filter='';
		if($this->Session->read('tipousr') == 2){ 
			$filter = array('Cliente.id'=>$this->Session->read('cliente_id'));
		}
		$this->paginate=array('limit' => 5,
						'page' => 1,
						'order'=>array('fechacontrol'=>'ASC'),
						'conditions'=>array('Mensaje.tallercito_id'=>$this->Session->read('tallercito_id'),
											'Mensaje.fechasend = '."'".date('Y-m-d')."'",
											'Mensaje.tipomen_id in(1,2)'),
						'joins'=>array(array('table'=>'bicicletas',
															'alias'=>'Bicicleta',
															'type'=>'LEFT',
															'conditions'=>array('Bicicleta.id = Mensaje.bicicleta_id')),
										array('table'=>'clientes',
															'alias'=>'Cliente',
															'type'=>'RIGHT',
															'conditions'=>array('Bicicleta.cliente_id = Cliente.id',$filter))															
															),
						'fields'=>array('Mensaje.id','Mensaje.fechasendauto','Mensaje.mailauto',
										'Mensaje.asunto','Mensaje.detalle','Bicicleta.id','Bicicleta.marca',
										'Bicicleta.modelo','Cliente.id','Cliente.nombre','Cliente.apellido'));	
		$this->set('mensajes', $this->Paginator->paginate());
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
				
		}	***/	
		if($this->params['action'] == 'view' ||
			$this->params['action'] == 'add'){ 
			$str_sino[0]='No';
			$str_sino[1]='Si';

		}
		
		if($this->params['action']=='add'){
			$tipomens = $this->Tipomen->find('list',array('fields'=>array('Tipomen.id','Tipomen.descripcion'),
														'conditions'=>array('Tipomen.id <> 2')
			));
		}
		
		
		$this->set(compact('tipomens','str_sino'));
		parent::beforeRender();
	}
	/**
	 * mostrarmensajecliente method
	 *
	 * @throws NotFoundException
	 * @param data 
	 * @return void
	 */
	public function mostrarmensajecliente(){
		$this->layout='bmodalbox';
		$bicicleta_id = $this->Session->read('bicicleta_id');
		if(!empty($bicicleta_id))
			$this->set('mensajes', $this->Mensaje->find('all',array('conditions'=>array('Mensaje.bicicleta_id in('.$this->Session->read('bicicleta_id').')',
																								'(Mensaje.confirmadocliente = 0 OR Mensaje.confirmadocliente IS NULL)'),
																								'limit'=>10,
																								'fields'=>array('Mensaje.id','Mensaje.detalle','Mensaje.fechasendauto','Bicicleta.modelo','Bicicleta.marca'),
																	'joins'=>array(array('table'=>'bicicletas',
																										'alias'=>'Bicicleta',
																										'type'=>'LEFT',
																										'conditions'=>array('Bicicleta.id = Mensaje.bicicleta_id'))),
																								'order'=>'Mensaje.fechasendauto DESC')));				
	}

	/**
	 * cambiarestado method
	 *
	 * @throws NotFoundException
	 * @param integer $id Identificador a actualizar
	 * @param integer $estado Estado
	 * @return void
	 */
	public function cambiarestado($id = null,$estado = null){
		$this->layout='';
		$error = '';
		if(!empty($id) && !empty($estado)){
			$this->request->data['Mensaje']['id'] = $id;
			$this->request->data['Mensaje']['confirmadocliente'] = $estado;
			if ($this->Mensaje->Save($this->request->data)) {
				$error='';
			} else {
				$error = __('El registro no se pudo actualizar. Por favor, intente de nuevo.');
			}
			$this->set('error',$error);			
		}
	}

	/**
	 * cambiarestado method
	 *
	 * @throws NotFoundException
	 * @param integer $id Identificador a actualizar
	 * @param integer $estado Estado
	 * @return void
	 */
	public function indexmant(){
		$this->set('title_for_layout','Historial de Mensajes de Mantenimiento');
	}
	
	public function listmensajeshist(){
		$this->layout='';
		App::uses('CakeTime', 'Utility');
		$filtros = CakeTime::daysAsSql($this->Mensaje->formatDate($this->request->data['Mensaje']['fecdesde']),
				$this->Mensaje->formatDate($this->request->data['Mensaje']['fechasta']),
				'Mensaje.fechasendauto');
		
		$this->Mensaje->recursive = 0;
		$this->paginate=array('limit' => 10,
				'page' => 1,
				'order'=>array('Mensaje.fechasendauto'=>'DESC'),
				'conditions'=>array('Mensaje.tallercito_id'=>$this->Session->read('tallercito_id'),$filtros,
									'Mensaje.tipomen_id in(1)'
				),
				'joins'=>array(array('table'=>'bicicletas',
						'alias'=>'Bicicleta',
						'type'=>'LEFT',
						'conditions'=>array('Bicicleta.id = Mensaje.bicicleta_id')),
						array('table'=>'clientes',
								'alias'=>'Cliente',
								'type'=>'LEFT',
								'conditions'=>array('Bicicleta.cliente_id = Cliente.id'))),
				'fields'=>array('Mensaje.id','Mensaje.fechasendauto','Mensaje.enviado',
						'Mensaje.asunto','Mensaje.detalle','Bicicleta.id','Bicicleta.marca',
						'Bicicleta.modelo','Cliente.id','Cliente.nombre','Cliente.apellido'));
		$this->set('mensajes', $this->Paginator->paginate());
		
	}
	
}
