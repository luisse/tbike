<?php
App::uses('AppController', 'Controller');
/**
 * Faultcars Controller
 *
 * @property Faultcar $Faultcar
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class FaultcarsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session','RequestHandler');
	public $uses=array('Faultcar','Rsesion','Taxownerscar','Taxowner');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('title_for_layout',__('Listado de Fallas'));
		$taxownerscar_id=array();
		$taxowner=$this->Taxowner->find('first',array('conditions'=>array('Taxowner.user_id'=>$this->Session->read('user_id')),
				'fields'=>array('Taxowner.id')
		));
		if(!empty($taxowner)){
			$taxownerscar_id = $this->Taxownerscar->find('list',array('fields'=>array('Taxownerscar.id','Taxownerscar.carcode'),
				'order'=>array('Taxownerscar.carcode')));
			$taxownerscar_id[0] =' ';
			asort($taxownerscar_id,2);
		}
		$this->set(compact('taxownerscar_id'));
	}

	public function listfaultcars(){
		$this->layout='';
		$this->Faultcar->recursive= 0;
		$faultcars = array();
		$taxowner = $this->Taxowner->find('first',array('conditions'=>array('user_id'=>$this->Session->read('user_id'))));
		if(!empty($taxowner)){
			//Get all cars of user
			if($this->request->data['taxownerscar_id'] != 0 && !empty($this->request->data['taxownerscar_id'])){
				$ls_filter='Faultcar.taxownerscar_id = '.$this->request->data['taxownerscar_id'];
			}else{
				$taxownerscars = $this->Taxownerscar->find('all',array('conditions'=>array('Taxownerscar.taxowner_id'=>$taxowner['Taxowner']['id']),
																														'fields'=>array('Taxownerscar.id')));
				$ftaxownercars='';
				foreach ($taxownerscars as $taxownerscar) {
					if(!empty($taxownerscar['Taxownerscar']['id']))
						$ftaxownercars = $ftaxownercars.$taxownerscar['Taxownerscar']['id'].',';
				}
				$ftaxownercars = $ftaxownercars.'0';
				$ls_filter='Faultcar.taxownerscar_id in('.$ftaxownercars.')';
			}


			if(!empty($this->request->data['fecdesde']) && !empty($this->request->data['fechasta'])){
						App::uses('CakeTime', 'Utility');
						$filtros_fecha = CakeTime::daysAsSql($this->Faultcar->formatDate($this->request->data['fecdesde']),
								$this->Faultcar->formatDate($this->request->data['fechasta']),
								'Faultcar.created');
			}
			/*Recuperamos las ordenes para el usaurio actualmente conectado*/
			$this->paginate=array('limit' => 4,
					'page' => 1,
					'order'=>array('Faultcar.created'=>'desc'),
					'conditions'=>array($ls_filter,$filtros_fecha),
					'fields'=>array('Faultcar.id','Faultcar.state','Faultcar.created','Faultcar.details',
													'Taxownerscar.carcode','Taxownerscar.carcode',
													'User.username','Taxownerscar.id','Taxownerscar.picture','ST_X(Faultcar.gpspoint) As Faultcar__lat','ST_Y(Faultcar.gpspoint) AS Faultcar__lng')
			);
			$faultcars = $this->Paginator->paginate();
		}
		$this->set(compact('faultcars'));
	}

/**
 * add method
 *
 * @return void
 */
	public function addfualtcars() {
		$error='';
		$token='';
		$error='';
		$Publickey = $this->request->header('Security-Access-PublicToken');
		$token = $this->request->header('Security-Access-Token');
		Configure::load('appconf');
		$securedata = Configure::read('securedata');
		//verificamos que la clave publica coincida con la clave primaria
		if($securedata == $Publickey && !empty($this->request->data)){
			if(!empty($token) &&
					!empty($this->request->data['taxownerscar_id']) &&
					!empty($this->request->data['lat']) &&
					!empty($this->request->data['lng']) &&
					!empty($this->request->data['details'])){
				if($this->Rsesion->SessionIsOk($token)){
					$rsesions = $this->Rsesion->rsesiondata($token);
					if(!empty($rsesions)){
							$count = $this->Taxownerscar->find('count',array('conditions'=>array('Taxownerscar.id'=>$this->request->data['taxownerscar_id'])
																																)
																								);
							if($count > 0){
								$this->Faultcar->create();
								$data['Faultcar']['user_id']					= $rsesions['Rsesion']['user_id'];
								$data['Faultcar']['taxownerscar_id']	= $this->request->data['taxownerscar_id'];
								$data['Faultcar']['details']					= $this->request->data['details'];
								$data['Faultcar']['lat']				 			= $this->request->data['lat'];
								$data['Faultcar']['lng']				 			= $this->request->data['lng'];
								$data['Faultcar']['state']						= 0;
								if (!$this->Faultcar->save($data)){
									$error = __('No se pudieron guardar los datos.');
								}
							}else{
								$error = __('No existe el auto requerido.');
							}
						}else{
							$error=__('No se recuperaron datos para la sesion');
						}
					}else{
						$error = __('Sesion invalida para operar');
					}
				}else{
					$error = __('Parametros invalidaos para operar');
				}
			}else{
				$error = __('Consulta Insegura');
			}
			$this->set('error',$error);
	}



	/**
	 * add method
	 *
	 * @return void
	 */
		public function faultcarschangedstate() {
			$error='';
			$token='';
			$error='';
			$Publickey = $this->request->header('Security-Access-PublicToken');
			$token = $this->request->header('Security-Access-Token');
			Configure::load('appconf');
			$securedata = Configure::read('securedata');
			//verificamos que la clave publica coincida con la clave primaria
			if($securedata == $Publickey && !empty($this->request->data)){
				if(!empty($token) &&
						!empty($this->request->data['faultcar_id']) &&
						!empty($this->request->data['state'])){
					if($this->Rsesion->SessionIsOk($token)){
						$rsesions = $this->Rsesion->rsesiondata($token);

						if(!empty($rsesions)){
								if (!$this->Faultcar->updateAll(array('Faultcar.state'=>$this->request->data['state']),
																									array('Faultcar.id'=>$this->request->data['faultcar_id'],'Faultcar.user_id'=>$rsesions['Rsesion']['user_id']))){
										$error = __('No se pudieron actualizar los datos.');
									}
							}else{
								$error=__('No se recuperaron datos para la sesion');
							}
						}else{
							$error = __('Sesion invalida para operar');
						}
					}else{
						$error = __('Parametros invalidaos para operar');
					}
				}else{
					$error = __('Consulta Insegura');
				}
				$this->set('error',$error);
	}

	/**
	 * add method
	 *
	 * @return void
	 */
		public function faultcarschangedstatenj() {
			$error = '';
			if(!empty($this->request->data['state']) &&
					!empty($this->request->data['id'])){

					if (!$this->Faultcar->updateAll(array('Faultcar.state'=>$this->request->data['state']),
																											array('Faultcar.id'=>$this->request->data['id']))){
												$error = __('No se pudieron actualizar los datos.');
					}
			}else{
				$error = __('Parametros Invalidos');
			}
			$this->set('error',$error);
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function deletefaultcars() {
		$error='';
		$token='';
		$error='';
		$Publickey = $this->request->header('Security-Access-PublicToken');
		$token = $this->request->header('Security-Access-Token');
		Configure::load('appconf');
		$securedata = Configure::read('securedata');
		//verificamos que la clave publica coincida con la clave primaria
		if($securedata == $Publickey && !empty($this->request->data)){
			if(!empty($token) &&
					!empty($this->request->data['faultcar_id'])){
				if($this->Rsesion->SessionIsOk($token)){
					$rsesions = $this->Rsesion->rsesiondata($token);
					if(!empty($rsesions)){
							if (!$this->Faultcar->deleteAll(array('Faultcar.id'=>$this->request->data['faultcar_id'],'Faultcar.user_id'=>$rsesions['Rsesion']['user_id']))) {
								$this->Session->setFlash(__('No se puede eliminar el registro.'));
							}
						}else{
							$error=__('No se recuperaron datos para la sesion');
						}
					}else{
						$error = __('Sesion invalida para operar');
					}
				}else{
					$error = __('Parametros invalidaos para operar');
				}
			}else{
				$error = __('Consulta Insegura');
			}
			$this->set('error',$error);

	}

	function beforeFilter(){
		parent::beforeFilter();
		//parent::beforeFilter();
		// For CakePHP 2.0
		//print_r($this->params);
		if($this->params['action'] 	== 'deletefaultcars' ||
			$this->params['action'] 	== 'faultcarschangedstate' ||
			$this->params['action'] 	== 'addfualtcars'){
				$this->Auth->allow('*');
				// For CakePHP 2.1 and up
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

	function getubicationmaps($lat = null,$lng = null){
		$this->set('title_for_layout',__('Vista Satelital del Movil'));
		$this->set('lat',$lat);
		$this->set('lng',$lng);
	}

}
