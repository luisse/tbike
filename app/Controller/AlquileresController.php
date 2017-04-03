<?php
App::uses('AppController', 'Controller');
/**
 * Alquileres Controller
 *
 * @property Alquilere $Alquilere
 * @property PaginatorComponent $Paginator
 */
class AlquileresController extends AppController {

/**
 * Components
 *
 * @var array
 */
	var $helpers = array('Time');
	var $uses=array('Alquilere','Alquileredetalle','Bicicletasparaalquilere');
	public $components = array('Paginator','RequestHandler');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('title_for_layout',__('Alquiler de Bicicletas'));
	}

	public function listalquileres(){
		$this->layout='';
		$this->Alquilere->recursive = 0;
		$ls_filtro='Alquilere.tallercito_id = '.$this->Session->read('tallercito_id').' ';
		App::uses('CakeTime', 'Utility');
		$fieldName = 'Alquilere.fecha';
		if(!empty($this->request->data)){
			if($this->request->data['fecdesde'] != null && $this->request->data['fecdesde'] != '' &&
				$this->request->data['fechasta'] != null &&  $this->request->data['fechasta'] != ''){
					$ls_filtro = CakeTime::daysAsSql($this->Alquilere->formatDate($this->request->data['fecdesde']),
																	$this->Alquilere->formatDate($this->request->data['fechasta']),
																	'Alquilere.fecha');
			}
			//filtro por nombre de cliente
			if($this->request->data['Sale']['cliente_id']!= '' && $this->request->data['Sale']['cliente_id']!= null){
				$ls_filtro = $ls_filtro.' AND Alquilere.cliente_id = '.$this->request->data['Sale']['cliente_id'];
			}
		}


		$this->paginate=array('limit' => 10,
						'page' => 1,
						'conditions'=>$ls_filtro);
		$alquileres=$this->Paginator->paginate();
		$i=0;

		foreach($alquileres as $alquilere){
			$alquileredetalle=$this->Alquileredetalle->find('all',array('conditions'=>array('Alquileredetalle.alquilere_id'=>$alquilere['Alquilere']['id']),
																		'fields'=>array('Alquileredetalle.id','Alquileredetalle.horasalquila',
																		'Alquileredetalle.detalle','ADDTIME("'.$alquilere['Alquilere']['fecha'].'",Alquileredetalle.horasalquila) AS finalizaalquiler',
																		'Alquileredetalle.fechadevol')));
			if(!empty($alquileredetalle)){
				$alquileres[$i]['Alquileredetalle']=$alquileredetalle;
				$i++;
			}
		}
		$this->set(compact('alquileres'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Alquilere->exists($id)) {
			throw new NotFoundException(__('Identificador Invalido alquilere'));
		}
		$options = array('conditions' => array('Alquilere.' . $this->Alquilere->primaryKey => $id));
		$this->set('alquilere', $this->Alquilere->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('title_for_layout',__('Nuevo Alquiler'));
		if ($this->request->is('post')) {
			$this->request->data['Alquilere']['tallercito_id']=$this->Session->read('tallercito_id');
			if ($this->Alquilere->guardaralquileres($this->request->data)) {
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
		$this->set('title_for_layout',__('Actualizar Alquiler'));
		if (!$this->Alquilere->exists($id)) {
			throw new NotFoundException(__('Identificador Inválido'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Alquilere->saveAll($this->request->data)) {
				$this->Session->setFlash(__('El Registro fue Actualizado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo actualizar el registro. Por favor intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Alquilere.' . $this->Alquilere->primaryKey => $id));
			$this->request->data = $this->Alquilere->find('first', $options);
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
		$this->Alquilere->id = $id;
		if (!$this->Alquilere->exists()) {
			throw new NotFoundException(__('Invalid alquilere'));
		}
		try {

			if ($this->Alquilere->delete()) {
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

	public function beforeRender(){
			parent::beforeRender();
	}
	/*
	 * Funcion: permite dar de alta una nueva fila
	 * */
	public function newrow($row = null){
		$this->layout='';
		$this->set('row',$row);
	}

	public function verdetallealquileres($id = null){
		$this->layout='';
		$alquilere=array();
		if(!empty($id)){
			$alquilere = $this->Alquilere->find('first',array('conditions'=>array('Alquilere.id'=>$id,
																				'Alquilere.tallercito_id'=>$this->Session->read('tallercito_id'))));
		}
		$this->set(compact('alquilere'));
	}

	public function imprimirticket($id = null){
		$this->layout='';
		$alquilere=array();
		if(!empty($id)){
			$alquilere = $this->Alquilere->find('first',array('conditions'=>array('Alquilere.id'=>$id,
																				'Alquilere.tallercito_id'=>$this->Session->read('tallercito_id'))));
		}
		$this->set(compact('alquilere'));
	}
	/*
	* Funcion: permite eliminar las filas de detalle
	*/
	public function eliminardetalle($alquileredetalle_id=null){
		$this->layout='';
		$error='';
		if(!empty($alquileredetalle_id)){
			$alquileredetalle=$this->Alquileredetalle->find('first',array('conditions'=>array('Alquileredetalle.id'=>$alquileredetalle_id)));
			try{
				if (!$this->Alquileredetalle->deleteAll(array('Alquileredetalle.id'=>$alquileredetalle_id))) {
					$error = 'No se puede eliminar el detalla';
				}else{
					//actualizamos el stock en la cantidad ingresada
					if(!empty($alquileredetalle)){
						if(!empty($alquileredetalle['Alquileredetalle']['bicicletasparaalquilere_id'])){
							ClassRegistry::init('Bicicletasparaalquilere');
							$Bicicletasparaalquilere   = new Bicicletasparaalquilere();
							$bicicletasparaalquilere['Bicicletasparaalquilere']['id']  = $alquileredetalle['Alquileredetalle']['bicicletasparaalquilere_id'];
							$bicicletasparaalquilere['Bicicletasparaalquilere']['estado'] = 0;
							$Bicicletasparaalquilere->save($bicicletasparaalquilere);
						}
					}
				}
			}catch(Exception $e){
				$error = 'Error: No se puede eliminar el registro. Atributo asignado a registro';
			}
		}
		$this->set('error',$error);
	}

	public function marcarentregado(){
		$error='';
		$alquilere=array();
		if(!empty($this->request->data['alquileredetalle_id']) && !empty($this->request->data['alquilere_id'])){
			$this->Alquilere->unbindModel(
        			array('belongsTo' => array('Cliente'),
					'hasMany'=>array('Alquileredetalle')));
			$alquilere = $this->Alquilere->find('first',array('conditions'=>array('Alquilere.id'=>$this->request->data['alquilere_id'],'Alquilere.tallercito_id'=>$this->Session->read('tallercito_id'),
														'Alquileredetalle.id = '.$this->request->data['alquileredetalle_id']),
														'joins'=>array(array('table'=>'alquileredetalles',
															'alias'=>'Alquileredetalle',
															'type'=>'LEFT',
															'conditions'=>array('Alquileredetalle.alquilere_id = Alquilere.id',
																				'Alquileredetalle.id = '.$this->request->data['alquileredetalle_id']))),
														'fields'=>array('Alquileredetalle.id','Alquileredetalle.fechadevol','Alquileredetalle.bicicletasparaalquilere_id')));
			if(!empty($alquilere)){
				$data['Alquileredetalle']['id']		= $this->request->data['alquileredetalle_id'];
				$data['Alquileredetalle']['fechadevol']	= date('Y-m-d H:i:s');
				if($this->Alquileredetalle->marcarentregado($data)){
					$error = '';
				}else{
					$error = __('No se pudieron actualizar los datos');
				}

				if(!empty($alquilere['Alquileredetalle']['bicicletasparaalquilere_id'])){
					$bicicletasparaalquilere['Bicicletasparaalquilere']['id'] = $alquilere['Alquileredetalle']['bicicletasparaalquilere_id'];
					$bicicletasparaalquilere['Bicicletasparaalquilere']['estado'] = 1;
					if(!$this->Bicicletasparaalquilere->save($bicicletasparaalquilere)){
						$error =  __('No se pudieron actualizar los datos de Bicicletas para alquilar');
					}
				}
			}else{
				$error = __('No existe el registro para actualizar');
			}
		}else{
			$error = __('No se encontraron valores correctos');
		}
		$this->set('error',$error);
	}

	/*
	* Function: permite marcar como pagado un alquiler return json error message
	*/
	public function marcarpagado(){
		$error='';
		$alquilere=array();
		if(!empty($this->request->data['alquilere_id'])){
			$data['Alquilere']['pagado'] = 1;
			$data['Alquilere']['id']		 = $this->request->data['alquilere_id'];
			//if hava error return message
			if(!$this->Alquilere->UpdateAll(array('Alquilere.pagado'=>1),
				array('Alquilere.id'=>$this->request->data['alquilere_id'],'Alquilere.tallercito_id'=>$this->Session->read('tallercito_id')))){
					$error='Datos G';
				}
		}else{
			$error=__('Datos no seteados correctamente');
		}
		$this->set('error',$error);
	}
}
