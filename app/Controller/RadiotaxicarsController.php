<?php
App::uses('AppController', 'Controller');
/**
 * Radiotaxicars Controller
 *
 * @property Radiotaxicar $Radiotaxicar
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class RadiotaxicarsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session','RequestHandler');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('title_for_layout',__('Listados de Taxis Asociados'));
		$this->Radiotaxicar->recursive = 0;
		$this->set('radiotaxicars', $this->Paginator->paginate());
	}


	public function listcars(){
		$this->layout = '';
		$this->Radiotaxicar->recursive = 0;
		$ls_filtro =' 1=1 ';
		$ls_notexist = '';
		if(!empty($this->request->data)){
			$ls_filtro = !empty($this->request->data['Taxownerscar']['registerpermision']) ? $ls_filtro.' and Taxownerscar.registerpermision = '.$this->request->data['Taxownerscar']['registerpermision'] : $ls_filtro;
			$ls_filtro = !empty($this->request->data['Taxownerscar']['carcode']) ? $ls_filtro." and Taxownerscar.carcode = '".$this->request->data['Taxownerscar']['carcode']."'" : $ls_filtro;
			$ls_filtro = $this->request->data['Taxownerscar']['state'] != 2  ? $ls_filtro.' and Radiotaxicar.state = '.$this->request->data['Taxownerscar']['state'] : $ls_filtro;
		}

		$this->paginate=array('limit' => 8,
						'page' => 1,
						'fields'=>array('Taxownerscar.carcode',
														'Taxownerscar.registerpermision',
														'Taxownerscar.dateexpire',
														'Taxownerscar.descriptioncar',
														'Taxownerscar.registerpermisionorigin',
														'Radiotaxicar.created',
														'Radiotaxicar.id',
														'Radiotaxicar.state'),
						'order'=>array('username'=>'asc'),
						'conditions'=>array($ls_filtro,'Radiotaxicar.radiotaxi_id'=>!empty($this->Session->read('radiotaxi_id'))?$this->Session->read('radiotaxi_id'):0));
		$this->set('radiotaxicars',$this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Radiotaxicar->exists($id)) {
			throw new NotFoundException(__('Invalid radiotaxicar'));
		}
		$options = array('conditions' => array('Radiotaxicar.' . $this->Radiotaxicar->primaryKey => $id));
		$this->set('radiotaxicar', $this->Radiotaxicar->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('title_for_layout',__('TST - Asociar Taxi'));
		if ($this->request->is('post')) {
			$this->Radiotaxicar->create();
			$this->request->data['Radiotaxicar']['radiotaxi_id'] = $this->Session->read('radiotaxi_id');
			$this->request->data['Radiotaxicar']['state'] = 1;
			if ($this->Radiotaxicar->save($this->request->data)) {
				$this->Session->setFlash(__('Los datos fueron grabados.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudieron guardar los datos. Por favor intente de nuevo.'));
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
		if (!$this->Radiotaxicar->exists($id)) {
			throw new NotFoundException(__('Invalid radiotaxicar'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Radiotaxicar->save($this->request->data)) {
				$this->Session->setFlash(__('The radiotaxicar has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The radiotaxicar could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Radiotaxicar.' . $this->Radiotaxicar->primaryKey => $id));
			$this->request->data = $this->Radiotaxicar->find('first', $options);
		}
		$radiotaxis = $this->Radiotaxicar->Radiotaxi->find('list');
		$taxownerscars = $this->Radiotaxicar->Taxownerscar->find('list');
		$this->set(compact('radiotaxis', 'taxownerscars'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$existe = $this->Radiotaxicar->find('count',array('conditions'=>array('Radiotaxicar.id'=>$id,
																										'Radiotaxicar.radiotaxi_id'=>!empty($this->Session->read('radiotaxi_id'))?$this->Session->read('radiotaxi_id'):0)));
		if($existe > 0){
			$this->Radiotaxicar->id = $id;
			try {
				if ($this->Radiotaxicar->delete()) {
					$this->Session->setFlash(__('Los datos han sido eliminados.'));
				} else {
					$this->Session->setFlash(__('No se pudieron borrar los datos. Por favor intente nuevamente.'));
				}
			}catch(Exception $e){
				$this->Session->setFlash(__('Error: No se puede eliminar el registro. Atributo asignado a operación'));
			}
		}else{
			$this->Session->setFlash(__('Error: usuario no autorizado para borrar'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function beforeRender(){
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

	public function exists(){
		$existe_asig = 0;
		if ($this->request->is('post')) {
			$existe = $this->Radiotaxicar->find('count',array('conditions'=>array('taxownerscar_id'=> !empty($this->request->data['taxownerscar_id'])? $this->request->data['taxownerscar_id'] : 0,
																																						'Radiotaxicar.taxownerscar_id = Taxownerscar.id',
																																						'Radiotaxicar.radiotaxi_id'=>!empty($this->Session->read('radiotaxi_id'))? $this->Session->read('radiotaxi_id') : 0) )
																															 );
				if($existe > 0) $existe_asig = 1;
		}else{
			throw new BadRequestException('Invalid Request');
		}
		$this->set('existe_asig',$existe_asig);
	}

	public function changestate(){
		$error = '';
		if (!$this->Radiotaxicar->exists(!empty($this->request->data['id']) ? $this->request->data['id'] : 0 ) ) {
			throw new NotFoundException(__('Identificador invalido'));
		}
		if ($this->request->is('post') && !empty($this->request->data['id'])) {
			$radiotaxicar = $this->Radiotaxicar->find('first',array('conditions'=>array('Radiotaxicar.id'=>$this->request->data['id'],
																														'Radiotaxicar.radiotaxi_id'=>!empty($this->Session->read('radiotaxi_id')) ? $this->Session->read('radiotaxi_id') : 0 ),
																														'fields'=>array('Radiotaxicar.state')));
			$data['Radiotaxicar']['id']    = $this->request->data['id'];
			$data['Radiotaxicar']['state'] = $radiotaxicar['Radiotaxicar']['state'] == 0 ? 1 : 0;
			if (!$this->Radiotaxicar->save($data)) {
					throw new BadRequestException('No se pudo actualizar el registro');
			}
		}else{
			throw new BadRequestException('Invalid Request');
		}
		$this->set('error',$error);
	}

	public function getcars(){
		$Taxorder = ClassRegistry::init('Taxorder');
		if(empty($this->Session->read('radiotaxi_id'))){
			throw new BadRequestException('Sesion Invalida no se pudo ejectar el metodo');
		}
		$cars = $Taxorder->get_car_for_position(!empty($this->request->data['lat']) ? $this->request->data['lat'] : 0,
																						!empty($this->request->data['lng']) ? $this->request->data['lng'] : 0,
																						!empty($this->request->data['ratio']) ? $this->request->data['ratio'] : 0 ,
																						!empty($this->Session->read('radiotaxi_id')) ? $this->Session->read('radiotaxi_id') : 0);
		$this->set(compact('cars'));
	}
}
