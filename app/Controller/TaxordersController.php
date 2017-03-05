<?php
App::uses('AppController', 'Controller');
/**
 * Taxorders Controller
 *
 * @property Taxorder $Taxorder
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TaxordersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session','RequestHandler','Acl');
	public $uses=array('Taxorder','Rsesion');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('title_for_layout',__('Mis Pedidos'));

	}

	public function indexlisttaxorders(){
		$this->Taxorder->recursive= 0;
		/*Recuperamos las ordenes para el usaurio actualmente conectado*/
		$this->paginate=array('limit' => 4,
				'page' => 1,
				'order'=>array('Taxorder.date'=>'desc'),
				'joins'=>array(
						array('table'=>'taxturns',
								'alias'=>'Taxturn',
								'type'=>'INNER',
								'conditions'=>array('Taxturn.id = Taxorder.taxturn_id')),
						array('table'=>'taxownerscars',
								'alias'=>'Taxownerscar',
								'type'=>'INNER',
								'conditions'=>array('Taxownerscar.id = Taxturn.taxownerscar_id')),
						array('table'=>'taxownerdrivers',
								'alias'=>'Taxownerdriver',
								'type'=>'INNER',
								'conditions'=>array('Taxownerdriver.id = Taxturn.taxownerdriver_id')),
						array('table'=>'peoples',
								'alias'=>'People',
								'type'=>'INNER',
								'conditions'=>array('People.id = Taxownerdriver.people_id'))),
				'conditions'=>array('Taxorder.user_id'=>$this->Session->read('user_id')),
				'fields'=>array('Taxorder.id','Taxorder.date','Taxorder.directiodetails','Taxorder.travelto','Taxownerscar.carcode','Taxorder.state',
						'Taxownerscar.registerpermision','Taxownerscar.descriptioncar','People.firstname','People.secondname','Taxownerdriver.picture','Taxownerdriver.id')
		);
		$this->set('taxorders',$this->Paginator->paginate());
	}


	/*
	 * meworder method
	 * @key token de usuario pueden crear ordenes Choferes/Administradores/Clientes
	 * @lat @lng posicion GPS de objecto que esta realizando la orden
	 * */
	public function neworder(){
		$key = $this->request->header('Security-Access-Token');
		$error='';
		$order_id='';
		if(!empty($this->request->data['key']) && !empty($this->request->data['lat']) && !empty($this->request->data['lng'])){
			$ltoken=$this->request->data['key'];
			//$this->log( 'REQUEST PARM: '.print_r($this->request->data, true));
			if($this->Rsesion->SessionIsOk($ltoken)){
				$rsesions = $this->Rsesion->rsesiondata($ltoken);
				if(!empty($rsesions)){
					//determina el tiempo que paso desde la última llamada
					if(empty($this->request->data['hour'])){
						$taxorder = $this->Taxorder->find('first',array('conditions'=>array('Taxorder.user_id'=>$rsesions['Rsesion']['user_id'],
																			'Taxorder.state'=>'0',
																			"date_part('minutes',current_timestamp - Taxorder.date) < 5",
																			"date_part('hours',current_timestamp - Taxorder.date) = 0",
																			"date_part('month',current_timestamp) = date_part('month',Taxorder.date)",
																			"date_part('year',current_timestamp) = date_part('year',Taxorder.date)",
																			"date_part('day',current_timestamp) = date_part('day',Taxorder.date)"),
																			'order'=>array('Taxorder.date'=>'DESC')));
					}else{
						$taxorder = $this->Taxorder->find('first',array('conditions'=>array('Taxorder.user_id'=>$rsesions['Rsesion']['user_id'],
																			'Taxorder.state'=>'0',
																			"Taxorder.date > current_timestamp"),
																	'order'=>array('Taxorder.date'=>'DESC')));

					}

					//si es un radio taxi se debe poder realizar los pedidos que se quieran sin controlar el tiempo
					if(!empty($taxorder) && $rsesions['User']['group_id'] <> 6){
						$error = __('Existe un pedido en procesamiento');
					}else{
						//guardamos el pedido
						$km = !empty($this->request->data['distance']) ? $this->request->data['distance'] : 3;
						$data['Taxorder']['user_id']= $rsesions['Rsesion']['user_id'];
						//User people_id
						if($rsesions['User']['group_id'] <> 6){
							$Userpeople = ClassRegistry::init('Userpeople');
							$people = $Userpeople->find('first',array('conditions'=>array('Userpeople.user_id'=>$rsesions['Rsesion']['user_id']),
													'fields'=>array('People.secondname','People.firstname','User.picture')
							));
						}else{
							$Userradiotaxi = ClassRegistry::init('Userradiotaxi');
							$radiotaxi = $Userradiotaxi->find('first',array('conditions'=>array('Userradiotaxi.user_id'=>$rsesions['Rsesion']['user_id']),
													'joins' => array(array('table'=>'radiotaxis',
																							'alias'=>'Radiotaxi',
																							'type'=>'INNER',
																							'conditions'=>array('Radiotaxi.id= Userradiotaxi.radiotaxi_id')),
																							array('table'=>'users',
																																	'alias'=>'User',
																																	'type'=>'INNER',
																																	'conditions'=>array('User.id= Userradiotaxi.user_id'))
																						),
													'fields' => array('Radiotaxi.id','Radiotaxi.cuit','Radiotaxi.name','User.picture')
												));
						}

						//para pedidos en horario superior al actual only hh:mm
						if(!empty($this->request->data['hour'])){
							$hour=date('Y-m-d '.$this->request->data['hour']);
						}else{
							$hour=date('Y-m-d H:i:s');
						}

						$data['Taxorder']['date']							= $hour;
						//si el usuario que pide el taxi es un driver es el mismo que inicia el evento  y toma el pedido
						$data['Taxorder']['state']						= $rsesions['User']['group_id'] == 2 || $rsesions['User']['group_id'] == 1  ? 1 : 0;
						$data['Taxorder']['lat']							=	$this->request->data['lat'];
						$data['Taxorder']['lng']							= $this->request->data['lng'];
						$data['Taxorder']['directiodetails']	= $this->request->data['directiodetails'];
						$data['Taxorder']['travelto']					= $this->request->data['travelto'];
						$data['Taxorder']['preferences']			= !empty($this->request->data['preference']) ? $this->request->data['preference'] : '';
						$data['Taxorder']['order_details'] 		= !empty($this->request->data['preference']) ? $this->request->data['preference'] : '';
						$data['Taxorder']['order_details'] 		= !empty($this->request->data['order_details']) ? $this->request->data['order_details'] : '';
						$data['Taxorder']['order_details'] 		= empty($data['Taxorder']['order_details']) ? !empty($this->request->data['client_info']) ? $this->request->data['client_info'] : '' : $data['Taxorder']['order_details'];
						//$data['Taxorder']['order_details'] 		= !empty($this->request->data['order_details']) ? $this->request->data['order_details'] : '';

						if(!empty($people)){
							$data['Taxorder']['firstname'] 			= $people['People']['firstname'];
							$data['Taxorder']['secondname'] 		= $people['People']['secondname'];
							$data['Taxorder']['picture'] 				= $people['User']['picture'];
						}

						//Si el pedido es realizado desde una empresa registramos los datos de la empresa
						if(!empty($radiotaxi)){
							$data['Taxorder']['firstname']   = $radiotaxi['Radiotaxi']['name'];
							$data['Taxorder']['secondname']   = '';
							$data['Taxorder']['picture']     = !empty($radiotaxi['User']['picture']) ? $radiotaxi['User']['picture'] : '';
							$data['Taxorder']['radiotaxi_id']= $radiotaxi['Radiotaxi']['id'];
						}

						//si la orden se da de alta como tomada entonces asigno el turno del taxista conectado actualmente
						if($data['Taxorder']['state'] == 1){
							$taxownerdriver = $this->getdetaildriver($rsesions['Rsesion']['user_id']);
							$data['Taxorder']['taxturn_id'] = empty($taxownerdriver['Taxturn']['id']) ? 0 : $taxownerdriver['Taxturn']['id'];
						}


						$data['Taxorder']['directiodetails'] = !empty($this->request->data['directiodetails']) ? $this->request->data['directiodetails'] : '';

						$data['Taxorder']['travelto'] = !empty($this->request->data['travelto']) ? $this->request->data['travelto'] : '';

						$this->Taxorder->create();
						if(!$this->Taxorder->save($data)){
							$error=__('No se pudo realizar el pedido');
						}else{
							$data['Taxorder']['id'] = $this->Taxorder->id;
							$order_id = $data['Taxorder']['id'];
							//envia las ordenes a todos los taxis cercanos solo si no es el mismo taxista que inicio el viaje
							$km = $km != 0 || !empty($km) ? $km : 2;
							if($rsesions['User']['group_id'] != 2 && $rsesions['User']['group_id'] != 1)
								$this->_sendordertax($data, $km);
						}
					}
				}
			}else{
				$error = __('Session is invalid');
			}
		}else{
			$error=__('No se definieron coordenadas GPS específicas'.$this->request->data['key'].'-'.$this->request->data['lat'].'-'.$this->request->data['lng']);
		}
		$this->set('order_id',$order_id);
		$this->set('error',$error);
	}

	/*
	*Function: permite enviar la señal de pedidos a todos los taxis cercanos en un radio definido en $km
	*/
	private function _sendordertax($taxorders = null, $km = null){
		if(!empty($taxorders)){
			//recuperamos los autos que estan mas cercanos del mensaje
			$taxubications = array();
			$radiotaxi_id  = !empty($data['Taxorder']['radiotaxi_id']) ? $data['Taxorder']['radiotaxi_id'] : 0;
			//for($km=1; $km < 10; $km++){
				//id de negocio se debe agregar para filtrar los taxis de lo contrario enviar 0
				$taxubications = $this->Taxorder->get_car_for_position($taxorders['Taxorder']['lat'],$taxorders['Taxorder']['lng'],$km,$radiotaxi_id, $taxorders['Taxorder']['preferences']);
				/*if(count($taxubications) > 2)
					break;*/
			//}

			//$this->log( 'CAR REQUEST  : '.print_r($taxubications, true));
			if(!empty($taxubications)){
				//recuperamos el id ingresado por el usaurio
				$taxorder = $this->Taxorder->find('first',array('conditions'=>array('Taxorder.user_id'=>$taxorders['Taxorder']['user_id']),
														'order'=>array('Taxorder.id DESC')
				));
				//preferencias del usuario
				$Userpreference = ClassRegistry::init('Userpreference');
				$userpreference = $Userpreference->find('all',array('conditions'=>array('Userpreference.user_id'=>$taxorder['Taxorder']['user_id']),
						'joins'=>array(array('table'=>'carpreferences',
								'alias'=>'Carpreference',
								'type'=>'INNER',
								'conditions'=>array('Carpreference.id= Userpreference.carpreference_id'))),
						'fields'=>array('Carpreference.description')
					)
				);
				$taxorders['Userpreference']=$userpreference;
				//send message for all car prox
				$order=array();
				$orderdet=array();
				$ids=array();
				foreach($taxubications as $taxubication){
					if(!empty($taxubication[0]['carcode'])){
						$Taxturn = ClassRegistry::init('Taxturn');
						$Taxturn->unbindModel(
								array('belongsTo' => array('Taxownerdriver'))
						);
						//Deteminar si existe un turno activo para el movil encontrado en taxubication
						$taxturn = $Taxturn->find('first',array('conditions'=>array('Taxturn.taxownerscar_id'=>$taxubication[0]['id'],
																																	'Taxturn.state = 1','Rsesion.state = 1','Taxownerscar.state in(0,1)'),
																																	'joins'=>array(
																																								array('table'=>'taxownerdrivers',
																																										'alias'=>'Taxownerdriver',
																																										'type'=>'INNER',
																																										'conditions'=>array('Taxownerdriver.id= Taxturn.taxownerdriver_id')
																																								),
																																								array('table'=>'rsesions',
																																										'alias'=>'Rsesion',
																																										'type'=>'INNER',
																																										'conditions'=>array('Rsesion.user_id = Taxownerdriver.user_id','Rsesion.state = 1')
																																								)
																																						),
																																		'fields'=>array('Rsesion.sessionkey','Rsesion.phone_id')
																							));
						if(!empty($taxturn)){
							if(!empty($taxturn['Rsesion']['phone_id']))
								$ids[]=trim($taxturn['Rsesion']['phone_id']);
							$order[$taxturn['Rsesion']['sessionkey']] = $taxorders['Taxorder'];
						}
					}
				}

				if(!empty($order)){
					/*SEND MESSAGE TO ALL CAR O NO*/
					$data = array( "title" => "Taxiar",
												'message' => 'Tienes un pedido',
												"priority"=> 2,
												"vibrationPattern" => [1000, 400, 1000, 1000],
												"style" =>"message",
												//"picture"=> "https://taxiar.com.ar/img/TaxiAppLogo.png",
												"ledColor" =>[255, 3, 169, 244],
												"count" =>3);
					if(!empty($ids)){
						$this->sendGoogleCloudMessage($data,$ids);
					}
					$this->_execfirebase('firebase/neworder-get',$order);
					//$order_create[$taxorders['Taxorder']['id']]=array('p_msg'=>'','t_msg'=>'', 'distance' => $km);
					$this->_execfirebase('firebase/orders/'.$taxorders['Taxorder']['id'],array('p_msg'=>'','t_msg'=>'','distance' => 3));
				}
			}
		}
	}

	/*
	 * Function permite dar de baja una orden
	 * */
	public function taxordercancel(){
		$error='';
		$taxturn_id = 0;
		$state=2;
		if(!empty($this->request->data['reason'])){
			if(strtoupper($this->request->data['reason']) == 'VIAJE CANCELADO POR EL USUARIO'){
				$state=2; //CANCELADOR POR EL USUARIO
			}

			if(strtoupper($this->request->data['reason']) == 'CANCELADO POR EL TAXISTA'){
				$state = 3;
			}
		}

		$order_id = !empty($this->request->data['order_id']) ? $this->request->data['order_id'] : 0;
		$result = $this->Taxorder->cancel_order($this->request->data['key'],$order_id,$state);

		if(!empty($result)){
			//Modificamos el estado del auto solo si el auto tomo es el que tomo el pedido y el usuario lo cancelo
			if(!empty($result[0]['taxturn_id'])){
				$data['Logstate']['car_id'] = $result[0]['taxownerscar_id'];
				$reason='';
				$message='';
				if(!empty($this->request->data['reason']))
					$reason=$this->request->data['reason'];
				if(!empty($this->request->data['message']))
					$message=$this->request->data['message'];

				$order[$result[0]['sessionkey']] = array('reason'=>$reason,'message'=>$message);
				$this->_execfirebase('firebase/cancel-order',$order);
				//
				$order_cancel['cancelorder'] = array('reason'=>$reason,'message'=>$message);
				$this->_execfirebase('firebase/orders/'.$result[0]['taxorder_id'],$order_cancel);
			}else{
				$this->_execfirebase('firebase/orders/'.$result[0]['taxorder_id'],[''],'del');
			}

			if(!empty($this->request->data['message']))
				$data['Logstate']['comment']=$this->request->data['message'];

			$data['Logstate']['state'] = ''; //activ
			$data['Logstate']['lat'] = $result[0]['taxorder_lat']; //activo
			$data['Logstate']['lng'] = $result[0]['taxorder_lng']; //activo

			$data['Logstate']['order_id'] = $result[0]['taxorder_id'];
			if(!empty($this->request->data['reason']))
				$data['Logstate']['reason'] = $this->request->data['reason'];
			else
				$data['Logstate']['reason'] = 'VIAJE CANCELADO POR EL USUARIO';
			$data['Logstate']['event_source'] = 'System';
			$Logstate = ClassRegistry::init('Logstate');
			$Logstate->save($data);
		}else{
			$error = __('No se pudo ubicar el pedido');
		}
		$this->set('error',$error);
	}

	/*
	* Function: permite mandar señal de cancelacion a todos las ordenes cercanas
	**/
	private function _sendordertaxcancelall($taxorder = null){
		if(!empty($taxorder['taxorder']['lat'])){
			$km = 10;
			$taxubications = $this->Taxorder->get_car_for_position($taxorder['Taxorder']['lat'],$taxorder['Taxorder']['lng'],$km);
			//recuperamos los autos que estan mas cercanos para cancelarlos
			if(!empty($taxubications)){
				//send message for all car prox
				foreach($taxubications as $taxubication){
					if(!empty($taxubication[0]['carcode'])){
  					 $Taxturn = ClassRegistry::init('Taxturn');
						$Taxturn->unbindModel(
								array('belongsTo' => array('Taxownerdriver'))
						);
						$taxturn = $Taxturn->find('first',array('conditions'=>array('Taxturn.taxownerscar_id'=>$taxubication[0]['id'],
																																	'Taxturn.state = 1','Rsesion.state = 1'),
																																	'joins'=>array(
																																								array('table'=>'taxownerdrivers',
																																										'alias'=>'Taxownerdriver',
																																										'type'=>'INNER',
																																										'conditions'=>array('Taxownerdriver.id= Taxturn.taxownerdriver_id')
																																								),
																																								array('table'=>'rsesions',
																																										'alias'=>'Rsesion',
																																										'type'=>'INNER',
																																										'conditions'=>array('Rsesion.user_id = Taxownerdriver.user_id','Rsesion.state = 1')
																																								)
																																						),
																																		'fields'=>array('Rsesion.sessionkey')
																							));
						if(!empty($taxturn)){
							$order[$taxturn['Rsesion']['sessionkey']] = ''	;
							//borramos los datos de firebase para que no sigan siendo visibles
							$this->_execfirebase('firebase/neworder-get',$order,'del');
							$this->_execfirebase('firebase/userpreference-get',$order,'del');
						}
					}
				}
			}
		}
	}


	/*
	 * Function: getorder method recupera las ordenes cercanas a un punto GPS de pedido,
	 * se agrega el filtrado por radio taxis un radio taxi que genera un pedido no debe ser
	 * enviado a todos los demas autos que no se encuentran asociados al radio taxi.
	 * Es importante tener en cuenta que un taxista puede recibir ordenes de radio taxis asociados
	 * como de ordenes independientes.
	 * */
	public function getorder(){
		$taxorders=array();
		$error='';
		$taxorder_results_return = array();

		if(empty($this->error_public_token) &&
				empty($this->error_private_token) &&
				!empty($this->request->data['lat']) &&
				!empty($this->request->data['lng']) &&
				!empty($this->rsesions)){

					//control para determinar si el usuario que esta ejecutando la opción es un taxista u dueño
					if($this->rsesions['User']['group_id'] != 2 && $this->rsesions['User']['group_id'] != 1){
						throw new UnauthorizedException('Usuario no autorizado.');
						exit;
					}

					$km=2;

					$is_test = $this->rsesions['User']['is_test'];

					/*Si el usuario esta asociado debe traer solo ordenes de radiotaxis*/
					$User = ClassRegistry::init('User');
					$User->unbindModel(
							array('hasMany' => array('SocialProfile'),
										'belongsTo' => array('Group'))
					);
					/*Validamos si el usuario que solicita las ordenes pertenece a una remisería*/
					$radiotaxicars = $User->find('first',array('conditions' => array('User.id'=>$this->rsesions['Rsesion']['user_id'],'Taxturn.state = 1'),
																					'joins'=>array(
																												array('table'=>'taxownerdrivers',
																													'alias'=>'Taxownerdriver',
																													'type'=>'LEFT',
																													'conditions'=>array('Taxownerdriver.user_id = User.id')),
																													array('table'=>'taxturns',
																														'alias'=>'Taxturn',
																														'type'=>'LEFT',
																														'conditions'=>array('Taxturn.taxownerdriver_id = Taxownerdriver.id')),
																														array('table'=>'radiotaxicars',
																															'alias'=>'Radiotaxicar',
																															'type'=>'LEFT',
																															'conditions'=>array('Radiotaxicar.taxownerscar_id = Taxturn.taxownerscar_id')),
																															array('table'=>'userradiotaxis',
																																'alias'=>'Userradiotaxi',
																																'type'=>'LEFT',
																																'conditions'=>array('Userradiotaxi.radiotaxi_id = Radiotaxicar.radiotaxi_id'))
																											),
																											'fields'=>array('Radiotaxicar.radiotaxi_id','Userradiotaxi.user_id')
																										));
					/*RECUPERAMOS EL DESCRIPTION DEL AUTO ASOCIADO*/
					$User->unbindModel(
							array('hasMany' => array('SocialProfile'),
										'belongsTo' => array('Group'))
					);

					/*Recuperamos el tipo de auto para luego en caso de ser necesario filtrar la informacion*/
					$cars_info = $User->find('first',array('conditions'=>array('User.id'=>$this->rsesions['Rsesion']['user_id'],'Taxturn.state = 1'),
												'joins'=>array(
																			array('table'=>'taxownerdrivers',
																				'alias'=>'Taxownerdriver',
																				'type'=>'LEFT',
																				'conditions'=>array('Taxownerdriver.user_id = User.id')),
																				array('table'=>'taxturns',
																					'alias'=>'Taxturn',
																					'type'=>'LEFT',
																					'conditions'=>array('Taxturn.taxownerdriver_id = Taxownerdriver.id')),
																					array('table'=>'taxownerscars',
																						'alias'=>'Taxownerscar',
																						'type'=>'LEFT',
																						'conditions'=>array('Taxownerscar.id = Taxturn.taxownerscar_id')),

									),
									'fields'=>array('Taxownerscar.id','Taxownerscar.descriptioncar','Taxownerscar.state')
								)
							);

					//agregamos filtro si es un radio taxi solo debe traer ordenes que son del radio taxi
					$ls_filter = '';
					$ls_filter_radio = '';
					$ls_filter = empty($radiotaxicars['Userradiotaxi']['user_id']) ? ' 1 = 1 ' : ' User.id <> '.$radiotaxicars['Userradiotaxi']['user_id'];
					$ls_filter_radio = empty($radiotaxicars['Userradiotaxi']['user_id']) ? ' 3 = 1 ' : ' User.id = '.$radiotaxicars['Userradiotaxi']['user_id'];


					$taxorders_radiotaxis = $this->Taxorder->find('all',array('conditions'=>array('Taxorder.state'=>'0',
																			"ST_Distance_Sphere(gpspoint,ST_GeomFromText('POINT(".$this->request->data['lat']." ".$this->request->data['lng'].")', 4326))/1000 <".$km,
																			"User.is_test"=>$is_test,
																			"date_part('minutes',current_timestamp - Taxorder.date) < 5",
																			"date_part('hours',current_timestamp - Taxorder.date) = 0",
																			"date_part('month',current_timestamp) = date_part('month',Taxorder.date)",
																			"date_part('year',current_timestamp) = date_part('year',Taxorder.date)",
																			"date_part('day',current_timestamp) = date_part('day',Taxorder.date)",$ls_filter_radio),
																	'fields'=>array('ST_X(gpspoint) AS GPSPOINT__X','ST_Y(gpspoint) AS GPSPOINT__Y','Taxorder.travelto','Taxorder.directiodetails',
																					'Taxorder.id','Taxorder.user_id','People.firstname','People.secondname','People.phonenumber','User.picture',
																					'Radiotaxi.cuit','Radiotaxi.name','Radiotaxi.telefono','Taxorder.order_details'),
																	'joins'=>array(
																								array('table'=>'userpeoples',
																									'alias'=>'Userpeople',
																									'type'=>'LEFT',
																									'conditions'=>array('Userpeople.user_id = Taxorder.user_id')),
																								array('table'=>'peoples',
																									'alias'=>'People',
																									'type'=>'LEFT',
																									'conditions'=>array('People.id = Userpeople.people_id')),
																									//RADIO TAXI
																									array('table'=>'userradiotaxis',
																																		'alias'=>'Userradiotaxi',
																																		'type'=>'LEFT',
																																		'conditions'=>array('Userradiotaxi.user_id = User.id')),
																									array('table'=>'radiotaxis',
																																		'alias'=>'Radiotaxi',
																																		'type'=>'LEFT',
																																		'conditions'=>array('Radiotaxi.id = Userradiotaxi.radiotaxi_id')
																																	)
																								),
																	'order'=>array('Taxorder.date'=>'DESC')));


					$taxorders = $this->Taxorder->find('all',array('conditions'=>array('Taxorder.state'=>'0',
																			"ST_Distance_Sphere(gpspoint,ST_GeomFromText('POINT(".$this->request->data['lat']." ".$this->request->data['lng'].")', 4326))/1000 <".$km,
																			"User.is_test"=>$is_test,
																			"date_part('minutes',current_timestamp - Taxorder.date) < 5",
																			"date_part('hours',current_timestamp - Taxorder.date) = 0",
																			"date_part('month',current_timestamp) = date_part('month',Taxorder.date)",
																			"date_part('year',current_timestamp) = date_part('year',Taxorder.date)",
																			"date_part('day',current_timestamp) = date_part('day',Taxorder.date)",$ls_filter
					),
																	'fields'=>array('ST_X(gpspoint) AS GPSPOINT__X','ST_Y(gpspoint) AS GPSPOINT__Y','Taxorder.travelto','Taxorder.directiodetails',
																					'Taxorder.id','Taxorder.user_id','People.firstname','People.secondname','People.phonenumber','User.picture',
																					'Radiotaxi.cuit','Radiotaxi.name','Radiotaxi.telefono','Taxorder.order_details'),
																	'joins'=>array(
																								array('table'=>'userpeoples',
																									'alias'=>'Userpeople',
																									'type'=>'LEFT',
																									'conditions'=>array('Userpeople.user_id = Taxorder.user_id')),
																								array('table'=>'peoples',
																									'alias'=>'People',
																									'type'=>'LEFT',
																									'conditions'=>array('People.id = Userpeople.people_id')),
																									//RADIO TAXI
																									array('table'=>'userradiotaxis',
																																		'alias'=>'Userradiotaxi',
																																		'type'=>'LEFT',
																																		'conditions'=>array('Userradiotaxi.user_id = User.id')),
																									array('table'=>'radiotaxis',
																																		'alias'=>'Radiotaxi',
																																		'type'=>'LEFT',
																																		'conditions'=>array('Radiotaxi.id = Userradiotaxi.radiotaxi_id')
																																	)
																								),
																	'order'=>array('Taxorder.date'=>'DESC')));

					$taxorder_results = array_merge($taxorders,$taxorders_radiotaxis);

					if(!empty($taxorder_results)){
						$i=0;
						//estructuramos resultado para visualizar con JSON de forma ordenada los datos

						foreach($taxorder_results as $taxorder){
							//::FILTROS: para filtrar el tipo de AUTO
							/***if(!empty($taxorder['Taxorder']['order_details']) && trim($taxorder['Taxorder']['order_details']) != '')
								$result = strpos(trim($desccars['Taxownerscar']['descriptioncar']),trim($taxorder['Taxorder']['order_details']));
							else {
								$result = true;
							}***/

							//Validamos el estado para enviar la orden si el estado es bloqueado no enviamos el pedidos al usuario
							$result = true;
							//print_r($cars_info);
							if(!empty($cars_info['Taxownerscar']['state'])){
								$result = $cars_info['Taxownerscar']['state'] == 3 ? false : true;
							}


							//FILTRAMOS POR EL TIPO DE AUTO
							if($result !== false){
								$taxorder_results_return[$i] = $taxorder;
								$Userpreference = ClassRegistry::init('Userpreference');
								$userpreference = $Userpreference->find('all',array('conditions'=>array('Userpreference.user_id'=>$taxorder['Taxorder']['user_id']),
																				'joins'=>array(array('table'=>'carpreferences',
																									'alias'=>'Carpreference',
																									'type'=>'INNER',
																									'conditions'=>array('Carpreference.id= Userpreference.carpreference_id'))),
																				'fields'=>array('Carpreference.description')
																				)
								);
								if(!empty($userpreference))
									$taxorder_results_return[$i]['Userpreference']=$userpreference;

								$taxorder_results_return[$i]['People']['firstname']   = empty($taxorder['People']['firstname']) ? '' : $taxorder['People']['firstname'];
								$taxorder_results_return[$i]['People']['secondname']  = empty($taxorder['People']['secondname']) ? '' : $taxorder['People']['secondname'];
								$taxorder_results_return[$i]['People']['phonenumber'] = empty($taxorder['People']['phonenumber']) ? '' : $taxorder['People']['phonenumber'];
								$taxorder_results_return[$i]['Radiotaxi']['cuit']     = empty($taxorder['Radiotaxi']['cuit']) ? '' : $taxorder['Radiotaxi']['cuit'];
								$taxorder_results_return[$i]['Radiotaxi']['name']     = empty($taxorder['Radiotaxi']['name']) ? '' : $taxorder['Radiotaxi']['name'];
								$taxorder_results_return[$i]['Radiotaxi']['telefono'] = empty($taxorder['Radiotaxi']['telefono']) ? '' : $taxorder['Radiotaxi']['telefono'];
								$i++;
							}
						}
					}

		}else{
			$error = $this->errortoken();
		}
		$this->set('error',$error);
		$this->set('taxorders',$taxorder_results_return);
	}


	/*
	 * Function: permite recuperar las ordenes generadas a futuro.
	 * NOTA: esta funcion se encuentra sin uso es un requerimiento que puede ser activado en otras versiones
	 * */

	public function getorderto(){
		$error = '';
		$taxorders=array();
		if(!empty($this->request->data['key']) && !empty($this->request->data['lat']) && !empty($this->request->data['lng'])){
			if($this->Rsesion->SessionIsOk($this->request->data['key'])){
				$rsesions = $this->Rsesion->rsesiondata($this->request->data['key']);
				$km=100;
				if(!empty($rsesions)){
					//determina el tiempo que paso desde la última llamada
					$taxorders = $this->Taxorder->find('all',array('conditions'=>array('Taxorder.state'=>'0',
							"ST_Distance_Sphere(gpspoint,ST_GeomFromText('POINT(".$this->request->data['lat']." ".$this->request->data['lng'].")', 4326))/1000 <".$km,
							"current_timestamp < Taxorder.date"
					),
							'fields'=>array('ST_X(gpspoint)','ST_Y(gpspoint)','Taxorder.travelto','Taxorder.directiodetails','Taxorder.id','Taxorder.user_id','Taxorder.date'),
							'order'=>array('Taxorder.date'=>'DESC')));
					if(!empty($taxorders)){
						$i=0;
						foreach($taxorders as $taxorder){
							$Userpreference = ClassRegistry::init('Userpreference');
							$userpreference = $Userpreference->find('all',array('conditions'=>array('Userpreference.user_id'=>$taxorder['Taxorder']['user_id']),
									'joins'=>array(array('table'=>'carpreferences',
											'alias'=>'Carpreference',
											'type'=>'INNER',
											'conditions'=>array('Carpreference.id= Userpreference.carpreference_id'))),
									'fields'=>array('Carpreference.description')
							)
							);

							if(!empty($userpreference))
								$taxorders[$i]['Userpreference']=$userpreference;
							$i++;
						}
					}
				}
			}
		}else{
			$error = __('No se definieron coordenadas GPS específicas');
		}
		$this->set('error',$error);
		$this->set('taxorders',$taxorders);
	}

	/*
	 *Function: permite tomar la orden asignando el movil al registro
	 * */
	public function takeorder(){
		  $error = $this->error_public_token;
			$error = '';
			$taxorder_id = '';
			$taxorder_ref = array();
			//validation of key on App controller base class
			if(empty($this->error_public_token) &&
					empty($this->error_private_token) &&
					!empty($this->request->data['orderid']) &&
					!empty($this->rsesions)){

						//control para determinar si el usuario que esta ejecutando la opción es un taxista u dueño
						if($this->rsesions['User']['group_id'] != 2 && $this->rsesions['User']['group_id'] != 1){
							throw new UnauthorizedException('Usuario no autorizado.');
							exit;
						}

						//Determina si el tiempo que paso hasta tomar la orden esta dentro del rango requerido
						$taxorders = $this->Taxorder->find('first',array('conditions'=>array('Taxorder.state'=>'0',
																				'Taxorder.id'=>$this->request->data['orderid'],
																				"date_part('minutes',current_timestamp - Taxorder.date) < 50",
																				"date_part('hours',current_timestamp - Taxorder.date) = 0"),
																		'fields'=>array('Taxorder.travelto','Taxorder.directiodetails','Taxorder.id','Taxorder.user_id','Taxorder.taxturn_id'),
																		'order'=>array('Taxorder.date'=>'DESC')));

						//si la orden se encuentra activa debemos asignar la persona que la tomo orderid
						if(!empty($taxorders)){
							$taxownerdriver = $this->getdetaildriver($this->rsesions['Rsesion']['user_id']);
							if(!empty($taxownerdriver['Taxownerscar']['carcode'])){
								//marcamos la orden como tomada asignamos el turno de la persona que la tomo
								$data['Taxorder']['id']=$taxorders['Taxorder']['id'];
								$data['Taxorder']['state']=1; //orden tomadada
								$data['Taxorder']['taxturn_id']=$taxownerdriver['Taxturn']['id'];
								$this->Taxorder->create();
								//if(!$this->Taxorder->save($data)){
								if(!$this->Taxorder->updateAll(array('Taxorder.state' => 1,
																											'Taxorder.taxturn_id'=>$taxownerdriver['Taxturn']['id']),
																								array('Taxorder.id = '.$taxorders['Taxorder']['id'],'Taxorder.state = 0') )){
									$error = __('No se pudo asignar el pedido intente nuevamente');
								}else{
									//POSIBLE CONCURRENCIA EN DB
									$taxorder_ref = $this->Taxorder->find('first',array('conditions'=>array(
																							'Taxorder.id'=>$this->request->data['orderid'],
																							"date_part('minutes',current_timestamp - Taxorder.date) < 50",
																							"date_part('hours',current_timestamp - Taxorder.date) = 0",
																							"Taxturn.id = Taxorder.taxturn_id",
																							"Taxorder.state = 1",
																							"date_part('month',current_timestamp) = date_part('month',Taxorder.date)",
																							"date_part('year',current_timestamp) = date_part('year',Taxorder.date)",
																							"date_part('day',current_timestamp) = date_part('day',Taxorder.date)",
																							'Taxownerdriver.user_id'=>$this->rsesions['Rsesion']['user_id']

																							),
																							'joins'=>array(
																								array('table'=>'taxturns',
																										'alias'=>'Taxturn',
																										'type'=>'LEFT',
																										'conditions'=>array('Taxturn.id = Taxorder.taxturn_id')),
																								array('table'=>'taxownerdrivers',
																										'alias'=>'Taxownerdriver',
																										'type'=>'LEFT',
																										'conditions'=>array('Taxownerdriver.id = Taxturn.taxownerdriver_id','Taxownerdriver.user_id'=>$this->rsesions['Rsesion']['user_id']))
																									),
																							'fields'=>array('Taxorder.id'),
																							'order'=>array('Taxorder.date'=>'DESC')));

									if(!empty($taxorder_ref)){
										$data['Taxownerscar']['id'] = $taxownerdriver['Taxownerscar']['id'];
										$data['Taxownerscar']['state'] = 1; // auto ocupado actualmente
										$Taxownerscar = ClassRegistry::init('Taxownerscar');
										//$Taxownerscar->updatestate($data);
										//Detalles del auto
										//Get the session for send to user a live channel for process data channe
										$usession = $this->Rsesion->getdetaialsessionuser($taxorders['Taxorder']['user_id']);
										//Excute live msg for de usar catch who is de car with accept de order
										$result[0]['records']=$taxorders;

										//Dirver info
										$driverinfo['firstname'] =  $taxownerdriver['People']['firstname'];
										$driverinfo['secondname'] =  $taxownerdriver['People']['secondname'];
										$driverinfo['picture'] =  $taxownerdriver['Taxownerdriver']['picture'];
										$order[$usession['Rsesion']['sessionkey']] =$driverinfo;
									  $this->_execfirebase('firebase/driverinfo-get/',$order);
										//Cars
										$carsinfo['carcode']=$taxownerdriver['Taxownerscar']['carcode'];
										$carsinfo['registerpermision']=$taxownerdriver['Taxownerscar']['registerpermision'];
										$carsinfo['descriptioncar']=$taxownerdriver['Taxownerscar']['descriptioncar'];
										$carsinfo['lat']=$taxownerdriver['taxownerscar']['lat'];
										$carsinfo['lng']=$taxownerdriver['taxownerscar']['lng'];
										$carsinfo['id']=$taxownerdriver['Taxownerscar']['id'];
										$carsinfo['usrkey'] = $this->sessiontoken;

										$order_2[$usession['Rsesion']['sessionkey']] = $carsinfo;
										$this->_execfirebase('firebase/carinfo-get/',$order_2);

										$order['carinfo'] = $carsinfo;
										//call to sen data to firebase
										$this->_execfirebase('firebase/orders/'.$taxorders['Taxorder']['id'],$order);
										//eliminar todos los pedidos realizados
										$this->_sendordertaxcancelall($taxorders);
									}else{
										$error=__('El movil fue tomado por otro auto');
									}
								}
							}else{
								$error=__('El Usuario actual conectado no se encuentra vinculado a un auto');
							}
						}else{
							//retorna datos solo si es el mismo usuario que acepto el viaje
							$taxorder_ref = $this->Taxorder->find('first',array('conditions'=>array(
																					'Taxorder.id'=>$this->request->data['orderid'],
																					"date_part('minutes',current_timestamp - Taxorder.date) < 50",
																					"date_part('hours',current_timestamp - Taxorder.date) = 0",
																					"Taxturn.id = Taxorder.taxturn_id",
																					"date_part('month',current_timestamp) = date_part('month',Taxorder.date)",
																					"date_part('year',current_timestamp) = date_part('year',Taxorder.date)",
																					"date_part('day',current_timestamp) = date_part('day',Taxorder.date)",
																					'Taxownerdriver.user_id'=>$this->rsesions['Rsesion']['user_id']

																					),
																					'joins'=>array(
																						array('table'=>'taxturns',
																								'alias'=>'Taxturn',
																								'type'=>'LEFT',
																								'conditions'=>array('Taxturn.id = Taxorder.taxturn_id')),
																						array('table'=>'taxownerdrivers',
																								'alias'=>'Taxownerdriver',
																								'type'=>'LEFT',
																								'conditions'=>array('Taxownerdriver.id = Taxturn.taxownerdriver_id','Taxownerdriver.user_id'=>$this->rsesions['Rsesion']['user_id']))
																							),
																					'fields'=>array('Taxorder.id','Taxorder.travelto','Taxorder.directiodetails','Taxorder.id','Taxorder.user_id','Taxorder.taxturn_id'),
																					'order'=>array('Taxorder.date'=>'DESC')));

							if(empty($taxorder_ref))
								$error = __('El viaje fue tomado por otro movil');
						}
			}else{
				$error = $this->errortoken();
			}
		$this->set('error',$error);
		$this->set('taxorder_ref',$taxorder_ref);
	}

	/*
	* Function: permite recuperar los datos del conductor.
	*
	*
	*/
	public function getdetaildriver($user_id = null){
		$Taxownerdriver = ClassRegistry::init('Taxownerdriver');
		$Taxownerdriver->unbindModel(
				array('belongsTo' => array('Taxowner'),
						'hasMany' =>array('Taxjourney','Taxpanic','Taxturn')
				)
		);

		//THIS IS A TEST
		return $Taxownerdriver->find('first',array('conditions'=>array('Taxownerdriver.user_id'=>$user_id,
																																'Taxturn.state = 1'),
				'joins'=>array(
						array('table'=>'taxturns',
								'alias'=>'Taxturn',
								'type'=>'LEFT',
								'conditions'=>array('Taxturn.taxownerdriver_id = Taxownerdriver.id')),
						array('table'=>'taxownerscars',
								'alias'=>'Taxownerscar',
								'type'=>'LEFT',
								'conditions'=>array('Taxownerscar.id = Taxturn.taxownerscar_id')),
						array('table'=>'taxubications',
									'alias'=>'Taxubication',
									'type'=>'LEFT',
									'conditions'=>array('Taxubication.taxownerscar_id = Taxturn.taxownerscar_id'))
				),
				'fields'=>array('Taxownerscar.id',
												'Taxownerscar.carcode',
												'Taxownerscar.registerpermision',
												'Taxownerscar.descriptioncar',
												'Taxturn.id','People.firstname',
												'People.secondname',
												'Taxownerdriver.picture',
												'ST_X(Taxubication.gpspoint) AS Taxownerscar__lat',
												'ST_Y(Taxubication.gpspoint) AS Taxownerscar__lng'),
		));
	}

	/*
	 * Function: retorna las ordenes de usuario solo utilizada por los usuarios
	 * */
	public function getmyorderstate(){
		$error='';
		if(!empty($this->request->data['key'])){
			if($this->Rsesion->SessionIsOk($this->request->data['key'])){
				$rsesions = $this->Rsesion->rsesiondata($this->request->data['key']);
				if(!empty($rsesions)){
					//recupera las ordenes que fueron tomadas por el conductor
					$taxorder = $this->Taxorder->find('first',array('conditions'=>array('Taxorder.user_id'=>$rsesions['Rsesion']['user_id'],
																			'Taxorder.state in(0,1,2)',
																			"date_part('minutes',current_timestamp - Taxorder.date) < 10",
																			"date_part('hours',current_timestamp - Taxorder.date) = 0",
																			"date_part('month',current_timestamp) = date_part('month',Taxorder.date)",
																			"date_part('year',current_timestamp) = date_part('year',Taxorder.date)",
																			"date_part('day',current_timestamp) = date_part('day',Taxorder.date)"),
																			'joins'=>array(
																				array('table'=>'taxturns',
																						'alias'=>'Taxturn',
																						'type'=>'LEFT',
																					'conditions'=>array('Taxturn.id = Taxorder.taxturn_id','Taxturn.state'=>1)),
																						array('table'=>'taxownerscars',
																								'alias'=>'Taxownerscar',
																								'type'=>'LEFT',
																								'conditions'=>array('Taxownerscar.id = Taxturn.taxownerscar_id')),
																						array('table'=>'taxownerdrivers',
																										'alias'=>'Taxownerdriver',
																										'type'=>'LEFT',
																										'conditions'=>array('Taxownerdriver.id = Taxturn.taxownerdriver_id')),
																						array('table'=>'peoples',
																														'alias'=>'People',
																														'type'=>'LEFT',
																														'conditions'=>array('People.id = Taxownerdriver.people_id')),
																						array('table'=>'rsesions',
																														'alias'=>'Rsesion',
																														'type'=>'LEFT',
																														'conditions'=>array('Rsesion.user_id = Taxownerdriver.user_id','Rsesion.state = 1')),
																							array('table'=>'users',
																															'alias'=>'Users',
																															'type'=>'LEFT',
																															'conditions'=>array('Rsesion.user_id = Users.id','Rsesion.state = 1'))
																								),
																	'order'=>array('Taxorder.id DESC'),
																	'fields'=>array('Taxorder.state','Taxorder.taxturn_id','Taxownerscar.carcode','Taxownerscar.id',
																					'Taxownerscar.registerpermision','Taxownerscar.picture','Taxownerscar.descriptioncar','Taxownerdriver.picture',
																				'People.firstname','People.secondname','People.phonenumber','Rsesion.sessionkey', 'Users.picture')));
				}
			}
		}else{
			$error=__('No se encontró indentificador para el usuario');
		}

		$this->set('error',$error);
		$this->set(compact('taxorder'));
	}

	/*
	 * Function: permite recuperar las ordenes realizadas
	 * */
	public function getmyorders(){
		//usuario logueado en el sistema
		$user_id = $this->Session->read('user_id');
		$taxorders=array();
		if(!empty($user_id)){
			$Taxowner = ClassRegistry::init('Taxowner');
			$taxowner=$Taxowner->find('first',array('conditions'=>array('Taxowner.user_id'=>$user_id),
												'fields'=>array('Taxowner.id')
			));
			if(!empty($taxowner)){
				App::uses('CakeTime', 'Utility');
				$filtros_fecha = CakeTime::daysAsSql($this->Taxorder->formatDate($this->request->data['fechadesde']),
						$this->Taxorder->formatDate($this->request->data['fechasta']),
						'date');
				$ls_filtro=array();
				if($this->request->data['taxownerscar_id']!=0){
					$ls_filtro=array('Taxownerscar.id'=>$this->request->data['taxownerscar_id']);
				}

				$taxorders=$this->Taxorder->find('all',array('conditions'=>array(/*'Taxorders.state'=>1,*/$filtros_fecha,'Taxownerscar.carcode <>'=>'',$ls_filtro),
						'joins'=>array(
								array('table'=>'taxturns',
										'alias'=>'Taxturn',
										'type'=>'LEFT',
										'conditions'=>array('Taxturn.id = Taxorder.taxturn_id'/*,'Taxorder.state'=>1*/)),
								array('table'=>'taxownerscars',
										'alias'=>'Taxownerscar',
										'type'=>'LEFT',
										'conditions'=>array('Taxownerscar.id = Taxturn.taxownerscar_id',$ls_filtro))
						),
						'fields'=>array('Taxorder.date','Taxorder.travelto','ST_X(Taxorder.gpspoint) As Taxorder__lat','ST_Y(Taxorder.gpspoint) AS Taxorder__lng','User.picture','Taxownerscar.carcode')
				));
			}
		}
		$this->set(compact('taxorders'));
	}

	/*
	*Function: permite recuperar el total de ordenes tomadaas por el usuario para LA FECHA ACTUAL retorna el total de ordenes.
	*/
	public function totalorders(){
		$user_id = $this->Session->read('user_id');
		//solo usuario administrador
		if(!empty($user_id) && $this->Session->read('tipousr') ==  1){
			$Taxowner = ClassRegistry::init('Taxowner');
			$taxowner=$Taxowner->find('first',array('conditions'=>array('Taxowner.user_id'=>$user_id),
					'fields'=>array('Taxowner.id')
			));
			if(!empty($taxowner)){
				App::uses('CakeTime', 'Utility');
				$fecha = date('Y-m-d');
				$filtros = CakeTime::daysAsSql($this->Taxorder->formatDate($fecha),
						$this->Taxorder->formatDate($fecha),
						'date');
				$taxorders=$this->Taxorder->find('count',array('conditions'=>array('Taxorder.state'=>1,$filtros,'Taxownerscar.carcode <>'=>''),
						'joins'=>array(
								array('table'=>'taxturns',
										'alias'=>'Taxturn',
										'type'=>'LEFT',
										'conditions'=>array('Taxturn.id = Taxorder.taxturn_id','Taxorder.state'=>1)),
								array('table'=>'taxownerscars',
										'alias'=>'Taxownerscar',
										'type'=>'LEFT',
										'conditions'=>array('Taxownerscar.id = Taxturn.taxownerscar_id','Taxownerscar.taxowner_id'=>$taxowner['Taxowner']['id']))
						)
				));
			}
		}else{
			$taxorders=$this->Taxorder->find('count',array('conditions'=>array('Taxorder.state in(1,2)','Taxorder.user_id'=>$user_id,'Taxorder.taxturn_id IS NOT NULL')));
		}
		$this->set(compact('taxorders'));
	}

	/*
	*Function: permite visualizar los pedidos realizados por el usuario que se encuentra activo en sesion
	*/
	public function vieworders(){
		$this->set('title_for_layout',__('Pedidos Realizados'));
		$taxownerscar_id=array();
		$Taxowner = ClassRegistry::init('Taxowner');
		$taxowner=$Taxowner->find('first',array('conditions'=>array('Taxowner.user_id'=>$this->Session->read('user_id')),
				'fields'=>array('Taxowner.id')
		));
		if(!empty($taxowner)){
			$Taxownerscar = ClassRegistry::init('Taxownerscar');
			$taxownerscar_id = $Taxownerscar->find('list',array('fields'=>array('Taxownerscar.id','Taxownerscar.carcode'),
																							'conditions'=>array('Taxownerscar.taxowner_id' => $taxowner['Taxowner']['id']),
																							'order'=>array('Taxownerscar.carcode')));
			$taxownerscar_id[0] =' ';
			asort($taxownerscar_id,2);
		}
		Configure::load('appconf');
		$key_api_maps = Configure::read('key_api_maps');
		$this->set('key_api_maps',$key_api_maps);
		//get all orders
		$this->set(compact('taxownerscar_id'));
	}

	/*
	*Function: permite visualizar las ordenes y su ubicacion GPS recibe de parametros fechadesde,fechasta,taxownerscar_id
	* solo las fechas son obligatorias
	*/
	function wviewmyorders(){
		if(!empty($this->request->data)){
			//usuario logueado en el sistema
			$user_id = $this->Session->read('user_id');

			$taxorders=array();
			if(!empty($user_id)){
				$Taxowner  = ClassRegistry::init('Taxowner');
				$taxowner=$Taxowner->find('first',array('conditions'=>array('Taxowner.user_id'=>$user_id),
													'fields'=>array('Taxowner.id')
				));
				if(!empty($taxowner)){
					App::uses('CakeTime', 'Utility');
					$filtros = CakeTime::daysAsSql($this->Taxorder->formatDate($this->request->data['fecdesde']),
							$this->Taxorder->formatDate($this->request->data['fechasta']),
							'date');
					$ls_filtro=array();
					if($this->request->data['taxownerscar_id']!=0){
						$ls_filtro=array('Taxownerscar.id'=>$this->request->data['taxownerscar_id']);
					}

					$this->paginate=array('limit' => 5,
							'page' => 1,
							'conditions'=>array(/*'Taxorder.state'=>1,*/$filtros,'Taxownerscar.carcode <>'=>'',$ls_filtro),
							'joins'=>array(
									array('table'=>'taxturns',
											'alias'=>'Taxturn',
											'type'=>'LEFT',
											'conditions'=>array('Taxturn.id = Taxorder.taxturn_id'/*,'Taxorder.state'=>1*/)),
									array('table'=>'taxownerscars',
											'alias'=>'Taxownerscar',
											'type'=>'LEFT',
											'conditions'=>array('Taxownerscar.id = Taxturn.taxownerscar_id',$ls_filtro
										)
									)
							),
							'fields'=>array('Taxorder.directiodetails','Taxorder.id','Taxorder.date','Taxorder.travelto',
										'ST_X(Taxorder.gpspoint) As Taxorder__lat','ST_Y(Taxorder.gpspoint) AS Taxorder__lng',
										'Taxownerscar.carcode','Taxorder.state'),
							'order'=>array('Taxorder.date'=>'DESC')
						);
					$taxorders = $this->Paginator->paginate();
				}
			}
		}

		$this->set(compact('taxorders'));
	}

	/*
	 * Funcion: permite recuperar los pedidos realizados por el usuario con json esta
	 * funcion se utiliza para trar las ordendes del radio taxi
	 * */

	public function myorders(){
		$taxorders=array();
		$error = 'NN';
		$user_id = $this->Session->read('user_id');
		$group_id = !empty($this->Session->read('tipousr')) ? $this->Session->read('tipousr') : 0;
		$taxorders=array();
		$error ='';
		if(empty($user_id)  && !empty($this->request->data['key'])){
			if($this->Rsesion->SessionIsOk($this->request->data['key'])){
				$rsesions = $this->Rsesion->rsesiondata($this->request->data['key']);
				$user_id = $rsesions['Rsesion']['user_id'];

			}else{
				$error = __('Sesion invalida para operar');
			}
		}

		if(!empty($user_id)){
			$this->Taxorder->unbindModel(
					array('belongsTo' => array('User')
					)
			);
			if($group_id != 6){
				$taxorders = $this->Taxorder->find('all',array('conditions'=>array('Taxorder.user_id'=>$user_id),
						'joins'=>array(
								array('table'=>'taxturns',
										'alias'=>'Taxturn',
										'type'=>'INNER',
										'conditions'=>array('Taxturn.id = Taxorder.taxturn_id')),
								array('table'=>'taxownerscars',
										'alias'=>'Taxownerscar',
										'type'=>'INNER',
										'conditions'=>array('Taxownerscar.id = Taxturn.taxownerscar_id')),
								array('table'=>'taxownerdrivers',
										'alias'=>'Taxownerdriver',
										'type'=>'INNER',
										'conditions'=>array('Taxownerdriver.id = Taxturn.taxownerdriver_id')),
								array('table'=>'peoples',
										'alias'=>'People',
										'type'=>'INNER',
										'conditions'=>array('People.id = Taxownerdriver.people_id')),
						),
						'fields'=>array('Taxorder.date','Taxorder.directiodetails','Taxorder.travelto','Taxownerscar.carcode','Taxownerscar.registerpermision','Taxownerscar.descriptioncar',
							'People.firstname','People.secondname','Taxownerdriver.picture','Taxownerdriver.user_id','Taxorder.state','Taxorder.id','Taxorder.order_details')
				));
			}else{
				$ls_filter = '1 = 1';
				$ls_filter = !empty($this->request->data['from']) ? $ls_filter." AND Upper(Taxorder.directiodetails) like Upper('%".$this->request->data['from']."%')" : $ls_filter;
				$ls_filter = !empty($this->request->data['to']) ? $ls_filter." AND Upper(Taxorder.travelto) like Upper('%".$this->request->data['to']."%')" : $ls_filter;
				$ls_filter = (!empty($this->request->data['state']) && $this->request->data['state'] != 3) || $this->request->data['state'] == 0 ? $ls_filter.' AND Taxorder.state = '.$this->request->data['state'] : $ls_filter;

				$taxorders = $this->Taxorder->find('all',array('conditions'=>array('Taxorder.user_id'=>$user_id,
																									"date_part('month',current_timestamp) = date_part('month',Taxorder.date)",
																									"date_part('year',current_timestamp) = date_part('year',Taxorder.date)",
																									"date_part('day',current_timestamp) = date_part('day',Taxorder.date)",
																									$ls_filter
																								),
						'joins'=>array(
								array('table'=>'taxturns',
										'alias'=>'Taxturn',
										'type'=>'LEFT',
										'conditions'=>array('Taxturn.id = Taxorder.taxturn_id')),
								array('table'=>'taxownerscars',
										'alias'=>'Taxownerscar',
										'type'=>'LEFT',
										'conditions'=>array('Taxownerscar.id = Taxturn.taxownerscar_id')),
								array('table'=>'taxownerdrivers',
										'alias'=>'Taxownerdriver',
										'type'=>'LEFT',
										'conditions'=>array('Taxownerdriver.id = Taxturn.taxownerdriver_id')),
								array('table'=>'peoples',
										'alias'=>'People',
										'type'=>'LEFT',
										'conditions'=>array('People.id = Taxownerdriver.people_id')),
						),
						'fields'=>array('Taxorder.date','Taxorder.directiodetails','Taxorder.travelto','Taxownerscar.carcode',
														'Taxownerscar.registerpermision','Taxownerscar.descriptioncar','Taxorder.travelto',
							'People.firstname','People.secondname','Taxownerdriver.picture','Taxownerdriver.user_id','Taxorder.state','Taxorder.id','Taxorder.order_details'),
						'order'=>array('Taxorder.state ASC','Taxorder.date DESC')
				));
			}

			$i = 0;
			$resulttaxorder = array();
			foreach($taxorders as $taxorder){
				$resulttaxorder[$i]['date'] 							= $taxorder['Taxorder']['date'];
				$resulttaxorder[$i]['directiodetails'] 		= $taxorder['Taxorder']['directiodetails'];
				$resulttaxorder[$i]['travelto'] 					= $taxorder['Taxorder']['travelto'];
				$resulttaxorder[$i]['carcode'] 						= $taxorder['Taxownerscar']['carcode'];
				$resulttaxorder[$i]['registerpermision'] 	= $taxorder['Taxownerscar']['registerpermision'];
				$resulttaxorder[$i]['descriptioncar'] 		= $taxorder['Taxownerscar']['descriptioncar'];
				$resulttaxorder[$i]['firstname'] 					= $taxorder['People']['firstname'];
				$resulttaxorder[$i]['secondname'] 				= $taxorder['People']['secondname'];
				$resulttaxorder[$i]['picture'] 						= $taxorder['Taxownerdriver']['picture'];
				$resulttaxorder[$i]['state'] 							= $taxorder['Taxorder']['state'];
				$resulttaxorder[$i]['id'] 							  = $taxorder['Taxorder']['id'];
				$resulttaxorder[$i]['order_details']			= $taxorder['Taxorder']['order_details'];
				$i++;
			}
			$taxorders = array();
			$taxorders = $resulttaxorder;
		}else{
			//$error=__('No se encontro un usuario valido');
		}
		$this->set('error',$error);
		$this->set(compact('taxorders'));
	}


  public	function beforeFilter(){
		parent::beforeFilter();

		$this->Auth->allow('*');
		$this->Auth->allow();
		$acepted_func=array('neworder','neworder.json','takeorder','taxordercancel',
												'getorder','getmyorderstate','getmyorders','getorderto',
												'testfirebase','totalorders','getorderang','paginatorpage','getorderx','myorders');
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
				 	return $this->redirect(array('controller' => 'mains','action'=>'securityerror',$this->params['controller'].'-'.$this->params['action']));
				}catch(Exeption $e){
					echo "ERROR!!!!";
				}
		}
	}

	/*
	 * Function: take order
	 * */
	public function taketax(){
		$this->set('title_for_layout',__('Pedido de Taxi Online'));
		$user_id = $this->Session->read('user_id');
		$group_id = $this->Session->read('tipousr');
		//solo pueden acceder usuarios no dueños no drivers
		if(!empty($user_id) && $group_id == 3){
			//recuperamos los datos de la preferencia
			//preferencias del usuario
			$Userpreference = ClassRegistry::init('Userpreference');
			$userpreferences = $Userpreference->find('all',array('conditions'=>array('Userpreference.user_id'=>$user_id),
					'joins'=>array(array('table'=>'carpreferences',
							'alias'=>'Carpreference',
							'type'=>'INNER',
							'conditions'=>array('Carpreference.id= Userpreference.carpreference_id'))),
					'fields'=>array('Carpreference.description','Userpreference.carpreference_id','Userpreference.state')
					)
			);
      $Carpreference = ClassRegistry::init('Carpreference');
			$carpreferences = $Carpreference->find('all');
			$this->set(compact('userpreferences','carpreferences'));
			$this->set('key',$this->Session->read('key'));

			Configure::load('appconf');
			$key_api_maps = Configure::read('key_api_maps');
			$this->set('key_api_maps',$key_api_maps);
		}else{
			$this->redirect(array('controller'=>'mains','action' => 'index'));
			return;
		}
	}


	/*NOT USE*/
	public function taxordersview(){
		$this->set('title_for_layout',__('Historico de Pedidos'));

	}

	public function taxorderview(){
		$this->set('title_for_layout',__('Pedidos realizados'));
		$taxownerscar_id=array();
		$Taxowner  = ClassRegistry::init('Taxowner');
		$taxowner=$Taxowner->find('first',array('conditions'=>array('Taxowner.user_id'=>$this->Session->read('user_id')),
				'fields'=>array('Taxowner.id')
		));
		if(!empty($taxowner)){
			$Taxownerscar = ClassRegistry::init('Taxownerscar');
			$taxownerscar_id = $Taxownerscar->find('list',array('fields'=>array('Taxownerscar.id','Taxownerscar.carcode'),
					'order'=>array('Taxownerscar.carcode')));
			//array_push($taxownerscar_id, '');
			$taxownerscar_id[0] =' ';
			asort($taxownerscar_id,2);
		}
		$this->set(compact('taxownerscar_id'));
	}

	/*
	 * Function: permite listar los pedidos realizados
	 * */
	public function listtaxorders(){
		$this->layout='';
		$user_id = $this->Session->read('user_id');
		$taxorders=array();
		if(!empty($user_id)){
			$Taxowner  = ClassRegistry::init('Taxowner');
			$taxowner=$Taxowner->find('first',array('conditions'=>array('Taxowner.user_id'=>$user_id),
					'fields'=>array('Taxowner.id')
			));
			if(!empty($taxowner)){
				App::uses('CakeTime', 'Utility');
				$filtros = CakeTime::daysAsSql($this->Taxorder->formatDate($this->request->data['fecdesde']),
						$this->Taxorder->formatDate($this->request->data['fechasta']),
						'date');
				$ls_filtro=array();
				if($this->request->data['taxownerscar_id']!=0){
					$ls_filtro=array('Taxownerscar.id'=>$this->request->data['taxownerscar_id']);
				}
				/*Recuperamos las ordenes para el usaurio actualmente conectado*/
				$this->paginate=array('limit' => 5,
						'page' => 1,
						'conditions'=>array('Taxorder.state'=>1,$filtros,'Taxownerscar.carcode <>'=>'',$ls_filtro),
						'joins'=>array(
								array('table'=>'taxturns',
										'alias'=>'Taxturn',
										'type'=>'LEFT',
										'conditions'=>array('Taxturn.id = Taxorder.taxturn_id','Taxorder.state'=>1)),
								array('table'=>'taxownerscars',
										'alias'=>'Taxownerscar',
										'type'=>'LEFT',
										'conditions'=>array('Taxownerscar.id = Taxturn.taxownerscar_id',$ls_filtro)),
								array('table'=>'taxownerdrivers',
										'alias'=>'Taxownerdriver',
										'type'=>'LEFT',
										'conditions'=>array('Taxownerdriver.id = Taxturn.taxownerdriver_id'))
						),
						'orders'=>array('Taxownerscar.carcode DESC','Taxorder.data DESC'),
						'fields'=>array('Taxorder.date','Taxorder.travelto','ST_X(Taxorder.gpspoint) As Taxorder__lat','ST_Y(Taxorder.gpspoint) AS Taxorder__lng'/*,'User.picture'*/,'Taxownerscar.carcode','Taxownerdriver.picture','Taxownerdriver.licencenumber'));
				$taxorders=$this->Paginator->paginate();
			}
		}
		$this->set(compact('taxorders'));
	}

	public function getorders(){
		$taxorders=array();
		if ($this->request->is('get')){
			$taxorders = $this->Taxorder->find('all',array('conditions'=>array('Taxorder.user_id'=>$this->Session->read('user_id'),
																	'Taxorder.state in(0,1,2)',
																	"date_part('month',current_timestamp) = date_part('month',Taxorder.date)",
																	"date_part('year',current_timestamp) = date_part('year',Taxorder.date)",
																	"date_part('day',current_timestamp) = date_part('day',Taxorder.date)"),
																	'joins'=>array(
																		array('table'=>'taxturns',
																				'alias'=>'Taxturn',
																				'type'=>'LEFT',
																			'conditions'=>array('Taxturn.id = Taxorder.taxturn_id')),
																				array('table'=>'taxownerscars',
																						'alias'=>'Taxownerscar',
																						'type'=>'LEFT',
																						'conditions'=>array('Taxownerscar.id = Taxturn.taxownerscar_id')),
																				array('table'=>'taxownerdrivers',
																								'alias'=>'Taxownerdriver',
																								'type'=>'LEFT',
																								'conditions'=>array('Taxownerdriver.id = Taxturn.taxownerdriver_id')),
																				array('table'=>'peoples',
																												'alias'=>'People',
																												'type'=>'LEFT',
																												'conditions'=>array('People.id = Taxownerdriver.people_id')),
																				array('table'=>'rsesions',
																												'alias'=>'Rsesion',
																												'type'=>'LEFT',
																												'conditions'=>array('Rsesion.user_id = Taxownerdriver.user_id'))
																					),
															'order'=>array('Taxorder.id DESC'),
															'fields'=>array('Taxorder.state','Taxorder.state','Taxorder.taxturn_id','Taxownerscar.carcode','Taxownerscar.id',
																			'Taxownerscar.registerpermision','Taxownerscar.picture','Taxownerscar.descriptioncar','Taxownerdriver.picture',
																		'People.firstname','People.secondname','People.phonenumber','Rsesion.sessionkey')));
		}else{
				throw new BadRequestException('Invalid Request');
		}
		$this->set(compact('taxorders'));
	}

	public function paginatorpage(){
		$this->layout='';
	}
}
