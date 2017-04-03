<?php
App::uses('AppController', 'Controller');
/**
 * Taxpanics Controller
 *
 * @property Taxpanic $Taxpanic
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TaxpanicsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components	= array('RequestHandler');


	public function cancelpanic(){
		$error = $this->error_public_token;
		if(empty($this->error_public_token) &&
				empty($this->error_private_token) &&
				!empty($this->rsesions)){

					//control para determinar si el usuario que esta ejecutando la opción es un taxista u dueño
					if($this->rsesions['User']['group_id'] != 2 && $this->rsesions['User']['group_id'] != 1){
						throw new UnauthorizedException('Usuario no autorizado.');
						exit;
					}

					$Taxownerdriver = ClassRegistry::init('Taxownerdriver');
					$taxownerdrivers = $Taxownerdriver->find('first', array('conditions' => array('Taxownerdriver.user_id'=>$this->rsesions['Rsesion']['user_id']),
																				'fields' => array('Taxownerdriver.id')
					));

					$taxownerdriver_id = (!empty($taxownerdrivers)) ? $taxownerdrivers['Taxownerdriver']['id'] : 0;
					$taxpanic = $this->Taxpanic->find('first',array('conditions'=>array('taxownerdriver_id' => $taxownerdriver_id),
																													'order'  => array('datepanic DESC'),
																													'fields' => array('Taxpanic.id')));
					$id = (!empty($taxpanic)) ? $taxpanic['Taxpanic']['id'] : 0;
					$this->Taxpanic->id = $id;
					if (!$this->Taxpanic->exists()) {
						$error = __('Identificador Invalido'.$id);
					}else{
						$data = $this->Taxpanic->find('first',array('conditions'=>array('Taxpanic.id'=>$id),
																										'fields'=>array('Taxpanic.id','ST_X(Taxpanic.gpspoint) As Taxpanic__lat',
																																		'ST_Y(Taxpanic.gpspoint) AS Taxpanic__lng')));
						$data['Taxpanic']['state'] = 0; //inactive
						if(!$this->Taxpanic->save($data)){
							$error = __('No se puede desbloquear la llamada');
						}else{
							$this->_sendmessagecar($data['taxpanic']['lat'],$data['taxpanic']['lng'],'','del');
						}
					}
		}else{
			$error = $this->errortoken();
		}
		$this->set('error',$error);
	}
	/*
	*Function: create new pannic from a movil and sen data to all car
	*/
	public function addpanic(){
		if($this->request->is('post')){
		$error = $this->error_public_token;
		if(empty($this->error_public_token) &&
				empty($this->error_private_token) &&
				!empty($this->request->data) &&
				!empty($this->rsesions)){

					//control para determinar si el usuario que esta ejecutando la opción es un taxista u dueño
					if($this->rsesions['User']['group_id'] != 2 && $this->rsesions['User']['group_id'] != 1){
						throw new UnauthorizedException('Usuario no autorizado.');
						exit;
					}
										
						$Taxownerdriver = ClassRegistry::init('Taxownerdriver');
						$taxownerdrivers = $Taxownerdriver->find('first',array('conditions'=>array('Taxownerdriver.user_id'=>$this->rsesions['Rsesion']['user_id']),
																					'fields'=>array('Taxownerdriver.id')
						));
						if(!empty($taxownerdrivers)){
							$data['Taxpanic']['taxownerdriver_id'] 	= $taxownerdrivers['Taxownerdriver']['id'];
							$data['Taxpanic']['datepanic']			= date('Y-m-d H:i:s');
							$data['Taxpanic']['message']			= $this->request->data['message'];
							$data['Taxpanic']['lat']				= $this->request->data['lat'];
							$data['Taxpanic']['lng']				= $this->request->data['lng'];
							$data['Taxpanic']['state']				= 1; //activa por defecto
							$this->Taxpanic->create();
							if(!$this->Taxpanic->save($data)){
								$error = __('No se pudo generar el mensaje de panico');
							}else{

								$this->_sendmessagecar($this->request->data['lat'],$this->request->data['lng'],$this->request->data['message']);
							}
						}else{
							$error = __('Usuario invalido para generar alarmas de panico');
						}
		}else{
			$error = $this->errortoken();
		}
	}else{
		$error = _('Metodo no accesible');
	}
		$this->set('error',$error);
	}

	private function _sendmessagecar($lat = null,$lng = null,$msg = null,$del = null){
		if(!empty($lat) && !empty($lng)){
			$km = 2;
			$Taxubications = ClassRegistry::init('Taxubication');
			//recuperamos los autos que estan mas cercanos del mensaje
			$taxubications = $Taxubications->find('all',array('conditions'=>array('Taxubication.state'=>'1',
										"ST_Distance_Sphere(Taxubication.gpspoint,ST_GeomFromText('POINT(".$lat." ".$lng.")', 4326))/1000 <".$km,
										"ST_Distance_Sphere(Taxubication.gpspoint,ST_GeomFromText('POINT(".$lat." ".$lng.")', 4326))/1000 > 0",
										"date_part('minutes',current_timestamp - Taxubication.modified) < 5",
										"date_part('hours',current_timestamp - Taxubication.modified) = 0 ",
										"date_part('month',current_timestamp) = date_part('month',Taxubication.modified)",
										"date_part('year',current_timestamp) = date_part('year',Taxubication.modified)",
										"date_part('day',current_timestamp) = date_part('day',Taxubication.modified)"),
										'joins'=>array(
														array('table'=>'taxownerscars',
															'alias'=>'Taxownerscar',
															'type'=>'INNER',
															'conditions'=>array('Taxownerscar.id= Taxubication.taxownerscar_id')
														),
														array('table'=>'taxturns',
															'alias'=>'Taxturn',
															'type'=>'INNER',
															'conditions'=>array('Taxturn.taxownerscar_id= Taxubication.taxownerscar_id','Taxturn.state = 1')
														),
														array('table'=>'taxownerdrivers',
															'alias'=>'Taxownerdriver',
															'type'=>'INNER',
															'conditions'=>array('Taxownerdriver.id= Taxturn.taxownerdriver_id')
														),
														array('table'=>'rsesions',
															'alias'=>'Rsesion',
															'type'=>'INNER',
															'conditions'=>array('Rsesion.user_id= Taxownerdriver.user_id','Rsesion.state = 1')
														),
											),
										'fields'=>array('Taxownerscar.carcode','Taxownerscar.registerpermision','Taxownerscar.picture','Rsesion.sessionkey')
										));

			if(!empty($taxubications)){
				foreach($taxubications as $taxubication){
					if(empty($del)){
						$sendmsg['carcode'] 	= $taxubication['Taxownerscar']['carcode'];
						$sendmsg['lat_panic'] = $lat;
						$sendmsg['lng_panic'] = $lng;
						$sendmsg['msgpanic'] 	= $msg;
						$sendmsg['picture']		= $taxubication['Taxownerscar']['picture'];
						$sendmsg['registerpermision']		= $taxubication['Taxownerscar']['registerpermision'];

						$sendalert[$taxubication['Rsesion']['sessionkey']]=$sendmsg;
						$this->_execfirebase('firebase/panic',$sendalert,$del);
					}else{
						$sendalert[$taxubication['Rsesion']['sessionkey']]='';
						$this->_execfirebase('firebase/panic',$sendalert,'del');
					}
				}
			}
		}
	}

	public function gettaxpanics(){
		$token='';
		$error='';
		$taxpanics=array();
		$Publickey = $this->request->header('Security-Access-PublicToken');
		$token = $this->request->header('Security-Access-Token');
		Configure::load('appconf');
		$securedata = Configure::read('securedata');
		//verificamos que la clave publica coincida con la clave primaria
		//print_r($securedata);
		if($securedata == $Publickey){
			if(!empty($token)){
				if($this->Rsesion->SessionIsOk($token)){
					$rsesion = $this->Rsesion->rsesiondata($token);

					if(!empty($rsesion)){
						$taxownerdrivers = $this->Taxownerdriver->find('first',array('conditions'=>array('Taxownerdriver.user_id'=>$rsesion['Rsesion']['user_id']),
								'fields'=>array('Taxownerdriver.id')
						));
						if(!empty($taxownerdrivers)){
							$taxpanics = $this->Taxpanic->find('all',array('conditions'=>array('Taxpanic.taxownerdriver_id'=>$taxownerdrivers['Taxownerdriver']['id']),
																		'fields'=>array('Taxpanic.id','Taxpanic.taxownerdriver_id','Taxpanic.datepanic','Taxpanic.message')
							));
						}
					}else{
						$error = __('Sesion Invalida');
					}
				}else{
					$error = __('No se encuentra una clave valida');
				}
			}else{
				$error = __('Parametros requeridos');
			}
		}
		$this->set('error',$error);
		$this->set(compact('taxpanics'));
	}

	public function getpanic(){
		$total_panics = 0;
		$panics=0;
		if(empty($this->request->query['is_test'])) $this->request->query['is_test'] = 'false';
		$this->request->query['is_test'] = $this->request->query['is_test'] == 1 ? 'true' : 'false';
		$is_test = $this->request->query['is_test'];
		$panics = $this->Taxpanic->getTotalPanic($is_test);
		$this->set('total_panics',count($panics));
		$this->set(compact('panics'));
	}

	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('*');
    // For CakePHP 2.1 and up
    $this->Auth->allow();
	}
}
?>
