<?php
App::uses('AppController', 'Controller');
/**
 * Taxownerscars Controller
 *
 * @property Taxownerscar $Taxownerscar
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TaxownerscarsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session','RequestHandler');
	public $uses=array('Taxownerscar','Taxowner','Rsesion','Taxownerdriver');

/**
 * index method
 *
 * @return void
 */
	public function index($taxowner_id = null) {
		$this->set('title_for_layout',__('Mis Autos'));
		$username = '';
		/*Superadmin user permite modificar u agregar datos de usuarios*/
		if($this->Session->read('tipousr') == 4){
			if(empty($this->Session->read('admin_taxowner_id'))) $this->Session->write('admin_taxowner_id',$taxowner_id);
			if($this->Session->read('admin_taxowner_id') != $taxowner_id && !empty($taxowner_id)) $this->Session->write('admin_taxowner_id',$taxowner_id);
			$taxowner_id = $this->Session->read('admin_taxowner_id');
			$taxowner = $this->Taxowner->find('first',array('conditions'=>array('Taxowner.id'=>$taxowner_id),
																					'joins'=>array(array('table'=>'users',
																															'alias'=>'User',
																															'type'=>'LEFT',
																															'conditions'=>array('User.id = Taxowner.user_id')),
																										array('table'=>'userpeoples',
																																				'alias'=>'Userpeople',
																																				'type'=>'LEFT',
																																				'conditions'=>array('Userpeople.user_id = User.id')),
																										array('table'=>'peoples',
																																				'alias'=>'People',
																																				'type'=>'LEFT',
																																				'conditions'=>array('People.id = Userpeople.people_id'))),
																					'fields'=>array('User.username','People.firstname','People.secondname')
																		 ));
			if(empty($taxowner)){
				return $this->redirect(array('controller' =>'users','action' => 'index'));
			}
			$username = $taxowner['People']['firstname'].', '.$taxowner['People']['secondname'];
		}
		$this->set('username',$username);

	}

	public function listtaxownerscars(){
		$this->Taxownerscar->recursive = 0;
		$taxowner_id= !empty($this->Session->read('taxowner_id')) ? $this->Session->read('taxowner_id') : $this->Session->read('admin_taxowner_id');
		$this->paginate=array('limit' => 4,
				'page' => 1,
				'conditions'=>array('Taxownerscar.taxowner_id'=>$taxowner_id));

		$this->set('taxownerscars', $this->Paginator->paginate());
	}
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Taxownerscar->exists($id)) {
			throw new NotFoundException(__('Invalid taxownerscar'));
		}
		$options = array('conditions' => array('Taxownerscar.' . $this->Taxownerscar->primaryKey => $id));
		$this->set('taxownerscar', $this->Taxownerscar->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($taxowner_id = null) {
		$this->set('title_for_layout',__('Asociar Nuevo Auto'));
		$username='';
		/*Superadmin user permite modificar u agregar datos de usuarios*/
		if($this->Session->read('tipousr') == 4){
			if(empty($this->Session->read('admin_taxowner_id'))) $this->Session->write('admin_taxowner_id',$taxowner_id);
			if($this->Session->read('admin_taxowner_id') != $taxowner_id && !empty($taxowner_id)) $this->Session->write('admin_taxowner_id',$taxowner_id);
			$taxowner_id = $this->Session->read('admin_taxowner_id');
			$taxowner = $this->Taxowner->find('first',array('conditions'=>array('Taxowner.id'=>$taxowner_id),
																					'joins'=>array(array('table'=>'users',
																															'alias'=>'User',
																															'type'=>'LEFT',
																															'conditions'=>array('User.id = Taxowner.user_id')),
																										array('table'=>'userpeoples',
					 																															'alias'=>'Userpeople',
					 																															'type'=>'LEFT',
					 																															'conditions'=>array('Userpeople.user_id = User.id')),
																										array('table'=>'peoples',
																																				'alias'=>'People',
																																				'type'=>'LEFT',
																																				'conditions'=>array('People.id = Userpeople.people_id'))),
																					'fields'=>array('User.username','People.firstname','People.secondname')
																		 ));
			if(empty($taxowner)){
				return $this->redirect(array('controller' =>'users','action' => 'index'));
			}
			$username = $taxowner['People']['firstname'].', '.$taxowner['People']['secondname'];
		}

		if ($this->request->is('post')) {
			$taxowner_id = !empty($this->Session->read('taxowner_id')) ? $this->Session->read('taxowner_id') : $taxowner_id;
			if(!empty($taxowner_id)){
					$this->request->data['Taxownerscar']['taxowner_id']=$taxowner_id;
					$this->request->data['Taxownerscar']['state']=1;
					$this->request->data['Taxownerscar']['descriptioncar'] = $this->__descriptioncar($this->request->data);
					$this->Taxownerscar->create();
					if ($this->Taxownerscar->save($this->request->data)){
						$this->Session->setFlash(__('Los Datos fueron guardados.'));
						return $this->redirect(array('action' => 'index'));
					} else {
						$this->Session->setFlash(__('No se pudieron guardar los datos. Por favor intente nuevamente.'));
					}
			}

			if(!empty($this->request->data['Taxownerscar']['carbrand_id'])){
				$Carmodel 	 = ClassRegistry::init('Carmodel');
				$carmodels   = $Carmodel->find('list',array('fields'=>array('Carmodel.id','Carmodel.name'),'conditions'=>array('Carmodel.brandcar_id'=>$this->request->data['Taxownerscar']['carbrand_id']) ));
				$this->set(compact('carmodels'));
			}
		}
		$this->set('taxowner_id',$taxowner_id);
		$this->set('username',$username);
	}

	/*
	* Function: permite traer la descripcion del auto a partir de los datos seleccionado por el usuario
	*/
	function __descriptioncar($taxownerscar){
		if(empty($taxownerscar)) return "";

		$Carbrand 	= ClassRegistry::init('Carbrand');
		if(empty($taxownerscar['Taxownerscar']['carbrand_id']) || empty($taxownerscar['Taxownerscar']['carmodel_id'])) return;
		$carbrands   = $Carbrand->find('first',array('fields'=>array('Carbrand.name','Carmodel.name'),
																									'conditions'=>array('Carbrand.id' => $taxownerscar['Taxownerscar']['carbrand_id'],
																																			'Carmodel.id' => $taxownerscar['Taxownerscar']['carmodel_id']),
																									'joins'=>array(array('table'=>'carmodels',
																																		'alias'=>'Carmodel',
																																		'type'=>'LEFT',
																																		'conditions'=>array('Carmodel.brandcar_id = Carbrand.id')),
																						)
																			));

		$detalle  = !empty($carbrands) ? $carbrands['Carbrand']['name'].' - '.$carbrands['Carmodel']['name'] : '';
		$aa       = $taxownerscar['Taxownerscar']['aa'] == 'Si' ? 'AA' : 'Sin AA';
		$trsp     = $taxownerscar['Taxownerscar']['transporta'] == 'Si' ? 'Lleva objetos varios' : 'No lleva objetos';
		$type     = !empty($taxownerscar['Taxownerscar']['type']) ? $taxownerscar['Taxownerscar']['type'] : '';
		$detalle  =  $detalle.' - '.$aa.' - '.$trsp.' - '.$type;

		return $detalle;
	}


/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$taxowner_id=0;
		$this->set('title_for_layout',__('Actualizar Datos'));
		if (!$this->Taxownerscar->exists($id)) {
			throw new NotFoundException(__('Identificador Invalido'));
		}

		/*Superadmin user permite modificar u agregar datos de usuarios*/
		if($this->Session->read('tipousr') == 4){
			if(empty($this->Session->read('admin_taxowner_id'))) $this->Session->write('admin_taxowner_id',$taxowner_id);
			if($this->Session->read('admin_taxowner_id') != $taxowner_id && !empty($taxowner_id)) $this->Session->write('admin_taxowner_id',$taxowner_id);
			$taxowner_id = $this->Session->read('admin_taxowner_id');
			$taxowner = $this->Taxowner->find('first',array('conditions'=>array('Taxowner.id'=>$taxowner_id),
																					'joins'=>array(array('table'=>'users',
																															'alias'=>'User',
																															'type'=>'LEFT',
																															'conditions'=>array('User.id = Taxowner.user_id')),
																										array('table'=>'userpeoples',
					 																															'alias'=>'Userpeople',
					 																															'type'=>'LEFT',
					 																															'conditions'=>array('Userpeople.user_id = User.id')),
																										array('table'=>'peoples',
																																				'alias'=>'People',
																																				'type'=>'LEFT',
																																				'conditions'=>array('People.id = Userpeople.people_id'))),
																					'fields'=>array('User.username','People.firstname','People.secondname')
																		 ));
			if(empty($taxowner)){
				return $this->redirect(array('controller' =>'users','action' => 'index'));
			}
			$username = $taxowner['People']['firstname'].', '.$taxowner['People']['secondname'];
		}

		if ($this->request->is(array('post', 'put'))) {
			if(empty($this->request->data['Taxownerscar']['picture']['name'])){
				unset($this->request->data['Taxownerscar']['picture']);
			}

			$this->request->data['Taxownerscar']['descriptioncar'] = $this->__descriptioncar($this->request->data);
			if ($this->Taxownerscar->save($this->request->data)) {
				$this->Session->setFlash(__('Los datos fueron actualizado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo guardar los datos. Por favor intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Taxownerscar.' . $this->Taxownerscar->primaryKey => $id,'Taxownerscar.taxowner_id'=>!empty($this->Session->read('taxowner_id')) ? $this->Session->read('taxowner_id') : $taxowner_id ));
			$this->request->data = $this->Taxownerscar->find('first', $options);
			$descriptioncar_parse = explode('-',$this->request->data['Taxownerscar']['descriptioncar']);

			if(count($descriptioncar_parse) >= 4){

				$Carbrand 	= ClassRegistry::init('Carbrand');
				$carbrand   = $Carbrand->find('first',array('fields'=>array('Carbrand.id'),'conditions'=>array('Carbrand.name'=>trim($descriptioncar_parse[0]))));

				$Carmodel 	= ClassRegistry::init('Carmodel');
				$carmodel   = $Carmodel->find('first',array('fields'=>array('Carmodel.id'),'conditions'=>array('Carmodel.name'=>trim($descriptioncar_parse[1]))));

				$this->request->data['Taxownerscar']['carbrand_id'] = !empty($carbrand['Carbrand']['id']) ? $carbrand['Carbrand']['id'] : '';
				$this->request->data['Taxownerscar']['carmodel_id'] = !empty($carmodel['Carmodel']['id']) ? $carmodel['Carmodel']['id'] : '';
				$this->request->data['Taxownerscar']['type']        = !empty($descriptioncar_parse[4]) ? trim($descriptioncar_parse[4]) : '';
				$this->request->data['Taxownerscar']['aa']          = !empty($descriptioncar_parse[2]) ? strrpos($descriptioncar_parse[2],'Sin') > 0 ? 'No' : 'Si'  : '';
				$this->request->data['Taxownerscar']['transporta']  = !empty($descriptioncar_parse[3]) ? strrpos($descriptioncar_parse[3],'No') > 0 ? 'No' : 'Si'  : '';
				$carmodels   = $Carmodel->find('list',array('fields'=>array('Carmodel.id','Carmodel.name'),'conditions'=>array('Carmodel.brandcar_id'=>!empty($carbrand['Carbrand']['id']) ? $carbrand['Carbrand']['id'] : '') ));
				$this->set(compact('carmodels'));
			}
			//solo se pueden modificar registros pertenecientes al mismo dueño
			if(empty($this->request->data)){
				return $this->redirect(array('action' => 'index'));
			}
			$this->set($descriptioncar_parse);
		}
		//$taxowners = $this->Taxownerscar->Taxowner->find('list');
		//$this->set(compact('taxowners'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Taxownerscar->id = $id;
		if (!$this->Taxownerscar->exists()) {
			throw new NotFoundException(__('Invalid taxownerscar'));
		}
		//solo puede borrar sus moviles asociados
		$taxownerscar=$this->Taxownerscar->find('first',array('conditions'=>array('Taxownerscar.id'=>$id),
																						'fields'=>array('Taxownerscar.taxowner_id','Taxownerscar.picture')));
		if($taxownerscar['Taxownerscar']['taxowner_id'] != $this->Session->read('taxowner_id')){
				$this->Session->setFlash(__('No se puede eliminar el registro. Bloqueado por otro usuario'));
				return $this->redirect(array('action' => 'index'));
		}
		try {
			if ($this->Taxownerscar->delete()) {
				$file = new File(WWW_ROOT.$taxownerscar['Taxownerscar']['picture']);
				if(!empty($file)){
					$file->delete();
					$file->close();
				}

				$this->Session->setFlash(__('El Registro fue eliminado.'));
			} else {
				$this->Session->setFlash(__('No se pudo borrar el registro. Por favor intente de nuevo.'));
			}
		}catch(Exception $e){
			$this->Session->setFlash(__('Error: No se puede eliminar el registro. Atributo asignado a registro'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function  beforeRender(){
		parent::beforeRender();
		$registerpermisionorigin = array('San Miguel de Tucuman'=>'San Miguel de Tucuman','Yerba Buena'=>'Yerba Buena','Tafi Viejo'=>'Tafi Viejo');

		if($this->params['action'] == 'add' || $this->params['action'] == 'edit' ){
			$Carbrand 	= ClassRegistry::init('Carbrand');
			$carbrands   = $Carbrand->find('list',array('fields'=>array('Carbrand.id','Carbrand.name')));
			$this->set(compact('carbrands'));
		}

		$this->set(compact('registerpermisionorigin'));
	}

	function beforeFilter(){
		parent::beforeFilter();
		$acepted_func=array('getownercars','getcarsdrivers','whereismycarjson','caractive','existlicence','existeregistercar');
		if(in_array($this->action,$acepted_func)){
			$this->Auth->allow('*');
			// For CakePHP 2.1 and up
			$this->Auth->allow();
		}else{
			$username = $this->Session->read('username');
			if(!empty($username)){
			 try{
					$result =	$this->Acl->check(array(
						'model' => 'Group',       # The name of the Model to check agains
						'foreign_key' => $this->Session->read('tipousr') # The foreign key the Model is bind to
						), ucfirst($this->params['controller']).'/'.$this->params['action']);
					//SI NO TIENE PERMISOS DA ERROR!!!!!!
					if(!$result)
				 	$this->redirect(array('controller' => 'mains','action'=>'securityerror',$this->params['controller'].'-'.$this->params['action']));
				}catch(Exeption $e){
				}
			}
		}
	}

	public function getownercars(){
		$error='';
		$taxowners=array();
		if(!empty($this->request->query['key'])){
			if($this->Rsesion->SessionIsOk($this->request->query['key'])){
				$rsesion = $this->Rsesion->rsesiondata($this->request->query['key']);
				if(!empty($rsesion)){

					//control para determinar si el usuario que esta ejecutando la opción es un taxista u dueño
					if($rsesion['User']['group_id'] != 2 && $rsesion['User']['group_id'] != 1){
						throw new UnauthorizedException('Usuario no autorizado.');
						exit;
					}

					$taxowners=$this->Taxowner->find('all',array('conditions'=>array('Taxowner.user_id'=>$rsesion['Rsesion']['user_id']),
													'joins'=>array(array('table'=>'taxownerscars',
															'alias'=>'Taxownerscar',
															'type'=>'LEFT',
															'conditions'=>array('Taxowner.id = Taxownerscar.taxowner_id'))),
														'fields'=>array('Taxowner.user_id','Taxownerscar.carcode','Taxownerscar.registerpermision','Taxownerscar.decreenro','Taxownerscar.dateexpire','Taxownerscar.descriptioncar'))
														);
				}
			}
		}else{
			$error=__('No Session Key');
		}
		$this->set('error',$error);
		$this->set(compact('taxowners'));
	}

	/*
  * Function: get the cars asociate to a driver
	*/
	public function getcarsdrivers(){
		$error='';
		$taxownerscars=array();
		if(!empty($this->request->data['key'])){
			if($this->Rsesion->SessionIsOk($this->request->data['key'])){
				$rsesion = $this->Rsesion->rsesiondata($this->request->data['key']);
				if(!empty($rsesion)){

					//control para determinar si el usuario que esta ejecutando la opción es un taxista u dueño
					if($rsesion['User']['group_id'] != 2 && $rsesion['User']['group_id'] != 1){
						throw new UnauthorizedException('Usuario no autorizado.');
						exit;
					}

					$this->Taxownerscar->unbindModel(
							array('belongsTo' => array('Taxowner'),
									'hasMany' =>array('Taxjourney','Taxturn','Taxubication')
							)
					);

					$taxownerscars=$this->Taxownerscar->find('all',array('conditions'=>array('Taxownerdriver.user_id'=>$rsesion['Rsesion']['user_id'],
																																										'Taxownerscar.state'=>1,
																																									  'NOT EXISTS(SELECT 1 FROM taxturns WHERE taxturns.state = 1 and taxturns.taxownerscar_id = Taxownerscar.id)'),
																		'joins'=>array(array('table'=>'taxownerdrivers',
																							'alias'=>'Taxownerdriver',
																							'type'=>'LEFT',
																							'conditions'=>array('Taxownerscar.taxowner_id = Taxownerdriver.taxowner_id'))
																							//solo trae autos que no tengan turno activo
																							/*array('table'=>'taxturns',
																												'alias'=>'Taxturn',
																												'type'=>'LEFT',
																											'conditions'=>array('Taxturn.taxownerscar_id = Taxownerscar.id','Taxturn.state = 1')),*/),
																		'fields'=>array('Taxownerscar.id','Taxownerscar.carcode','Taxownerscar.registerpermision',
																										'Taxownerscar.picture','Taxownerscar.descriptioncar')
					));
				}
			}
		}else{
			$error = __('No Session Key');
		}
		$this->set('error',$error);
		$this->set(compact('taxownerscars'));
	}

	/*
	 * Funcion: permite determinar si el auto que estamos registrando ya existe cargado en DB
	 * */
	public function existeregistercar(){
		$this->layout='';
		$error='';
		$taxownerscars='';

		if(!empty($this->request->data['carcode'])) $conditions =  array('Taxownerscar.carcode'=>$this->request->data['carcode']);
		if(!empty($this->request->data['registerpermision'])) $conditions =  array('Taxownerscar.registerpermision'=>$this->request->data['registerpermision']);

		$this->Taxownerscar->unbindModel(
					array('belongsTo' => array('Taxowner'),
							'hasMany' =>array('Taxjourney','Taxturn','Taxubication')
					)
		);

		$taxownerscars=$this->Taxownerscar->find('first',array('conditions'=>$conditions,
																	'fields'=>array('Taxownerscar.id',
																									'Taxownerscar.carcode',
																									'Taxownerscar.registerpermision',
																									'Taxownerscar.dateexpire',
																									'Taxownerscar.dateactive',
																									'Taxownerscar.descriptioncar',
																								  'Taxownerscar.registerpermisionorigin')
		));
		$this->set(compact('taxownerscars'));
	}

	public function whereismycar(){
		$this->set('title_for_layout',__('Vista Satelital de mis autos'));
		Configure::load('appconf');
		$key_api_maps = Configure::read('key_api_maps');
		$this->set('key_api_maps',$key_api_maps);

	}

	/*
	 * Function: permite determinar la ubicación de los autos para un dueño determinado por sesion
	 * */
	public function whereismycarjson(){
		//Excute call fot remote live GPS
		$this->Taxownerscar->unbindModel(
				array('belongsTo' => array('Taxowner'),
						'hasMany' =>array('Taxjourney','Taxturn','Taxubication')
				)
		);
		$taxownerscars = $this->Taxownerscar->find('all',array('conditions'=>array('Taxownerscar.taxowner_id'=>$this->Session->read('taxowner_id'),'Taxturn.state'=>1),
				'joins'=>array(array('table'=>'taxturns',
						'alias'=>'Taxturn',
						'type'=>'LEFT',
						'conditions'=>array('Taxownerscar.id = Taxturn.taxownerscar_id  and Taxturn.state = 1')),
						array('table'=>'taxubications',
								'alias'=>'Taxubication',
								'type'=>'LEFT',
								'conditions'=>array('Taxownerscar.id = Taxubication.taxownerscar_id')),
						array('table'=>'taxownerdrivers',
									'alias'=>'Taxownerdriver',
									'type'=>'LEFT',
									'conditions'=>array('Taxownerdriver.id = Taxturn.taxownerdriver_id')),
						array('table'=>'rsesions',
									'alias'=>'Rsesion',
									'type'=>'LEFT',
								'conditions'=>array('Rsesion.user_id = Taxownerdriver.user_id ','Rsesion.state = 1')),
						array('table'=>'peoples',
												'alias'=>'People',
												'type'=>'LEFT',
												'conditions'=>array('People.id = Taxownerdriver.people_id'))
				),
				'fields'=>array('Taxownerscar.id','Taxownerscar.carcode','Taxownerscar.registerpermision','Taxownerscar.state',
						'Taxownerscar.decreenro','Taxownerscar.dateexpire','Taxownerscar.descriptioncar',
						'Taxturn.turninit','Taxturn.turnend','Taxturn.state','ST_X(Taxubication.gpspoint) AS Taxubication__lat','ST_Y(Taxubication.gpspoint) AS Taxubication__lng',
						'Taxownerscar.picture','Rsesion.sessionkey','People.firstname','People.secondname'
				))
		);
		$this->set(compact('taxownerscars'));
	}

	/*
	 * Function:autos activos actualmente deben tener iniciado un turno
	 * */
	public function caractive(){
		$user_id = $this->Session->read('user_id');
		$carsactive=0;
		if(!empty($user_id)){
			$this->Taxownerscar->unbindModel(
					array('belongsTo' => array('Taxowner'),
							'hasMany' =>array('Taxjourney','Taxturn','Taxubication')
					)
			);

			$taxowner=$this->Taxowner->find('first',array('conditions'=>array('Taxowner.user_id'=>$user_id),
					'fields'=>array('Taxowner.id')
			));
			if(!empty($taxowner)){
				$carsactive = $this->Taxownerscar->find('count',array('conditions'=>array('Taxownerscar.taxowner_id'=>$taxowner['Taxowner']['id']),
														'joins'=>array(array('table'=>'taxturns',
																			'alias'=>'Taxturn',
																			'type'=>'INNER',
																			'conditions'=>array('Taxownerscar.id = Taxturn.taxownerscar_id','Taxturn.state'=>1)))
				));
			}
		}
		$this->set('carsactive',$carsactive);
	}

	public function setworkstate(){
		$taxorders=array();
		$error='';
		if(empty($this->error_public_token) &&
				empty($this->error_private_token) &&
				!empty($this->request->data['car_id']) &&
				!empty($this->rsesions)){

					//control para determinar si el usuario que esta ejecutando la opción es un taxista u dueño
					if($this->rsesions['User']['group_id'] != 2 && $this->rsesions['User']['group_id'] != 1){
						throw new UnauthorizedException('Usuario no autorizado.');
						exit;
					}

					if(!empty($this->request->data['car_id']))
						$data['Logstate']['car_id'] = $this->request->data['car_id'];
					if(!empty($this->request->data['status']))
						$data['Logstate']['status'] = $this->request->data['status'];
					if(!empty($this->request->data['order_id']))
						$data['Logstate']['order_id'] = $this->request->data['order_id'];
					if(!empty($this->request->data['driver_id']))
						$data['Logstate']['driver_id'] = $this->request->data['driver_id'];
					if(!empty($this->request->data['appversion']))
						$data['Logstate']['appversion'] = $this->request->data['appversion'];
					if(!empty($this->request->data['client_id']))
						$data['Logstate']['client_id'] = $this->request->data['client_id'];
					if(!empty($this->request->data['comment']))
						$data['Logstate']['comment'] = $this->request->data['comment'];
					if(!empty($this->request->data['reason']))
						$data['Logstate']['reason'] = $this->request->data['reason'];
					//NEW POINT LOCATION
					if(!empty($this->request->data['event_source']))
						$data['Logstate']['event_source'] = $this->request->data['event_source'];
					if(!empty($this->request->data['lat']))
						$data['Logstate']['lat'] = $this->request->data['lat'];
					if(!empty($this->request->data['lng']))
						$data['Logstate']['lng'] = $this->request->data['lng'];
					if(!empty($this->request->data['journey_id']))
						$data['Logstate']['journey_id'] = $this->request->data['journey_id'];
					if(!empty($this->request->data['gps_time'])){
							$fecha = date_create();
							date_timestamp_set($fecha, $this->request->data['gps_time']);
							$data['Logstate']['gps_time'] = date_format($fecha, 'Y-m-d H:i:s');
						}


					$data['Taxownerscar']['id'] = $this->request->data['car_id'];
					if(!$this->Taxownerscar->changeworkstate($data)){
						$error = __('No se pudo modificar el estado');
					}
		}else{
			$error = $this->errortoken();
		}
		$this->set('error',$error);
	}
}
