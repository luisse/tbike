<?php
App::uses('AppController', 'Controller');
/**
 * Taxownerdrivers Controller
 *
 * @property Taxownerdriver $Taxownerdriver
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TaxownerdriversController extends AppController {

/**
 * Components
 *
 * @var array
 */

	public $components = array('Paginator', 'Session','Cimage','RequestHandler');
	public $uses= array('Taxownerdriver','People','User','Rsesion','Taxowner');
/**
 * index method
 *
 * @return void
 */
	public function index($taxowner_id = null) {
		$this->set('title_for_layout',__('Mis Choferes'));
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

	/**
	* listtaxownerdriver listar los drivers
	* @return void
	*/
	public function listtaxownerdrivers(){
		//determinamo si tenemos valor de sesion de usuario normal u administrador para procesar el index
		$taxonwer_id = !empty($this->Session->read('taxowner_id')) ? $this->Session->read('taxowner_id') : $this->Session->read('admin_taxowner_id');
		$this->layout = '';
		$this->Taxownerdriver->recursive = 0;
		$this->paginate=array('limit' => 4,
						'page' => 1,
						'joins'=>array(array('table'=>'users',
																'alias'=>'User',
																'type'=>'LEFT',
																'conditions'=>array('User.id = Taxownerdriver.user_id'))),
						'fields'=>array('Taxownerdriver.id','Taxownerdriver.picture','People.document','People.id',
													'People.firstname','People.secondname','Taxownerdriver.licencenumber',
													'Taxownerdriver.state','Taxownerdriver.created','User.username'),
						'conditions'=>array('Taxownerdriver.taxowner_id'=>$taxonwer_id));
		$this->set('taxownerdrivers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Taxownerdriver->exists($id)) {
			throw new NotFoundException(__('Invalid taxownerdriver'));
		}
		$options = array('conditions' => array('Taxownerdriver.' . $this->Taxownerdriver->primaryKey => $id));
		$this->set('taxownerdriver', $this->Taxownerdriver->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($taxowner_id = null) {
		$this->set('title_for_layout',__('Agregar de Nuevo Conductor'));
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

			$this->request->data['Taxownerdriver']['taxowner_id'] = !empty($this->Session->read('taxowner_id')) ? $this->Session->read('taxowner_id') : $taxowner_id;
			$this->request->data['People']['document'] = str_replace('.', '', $this->request->data['People']['document']);
			$this->request->data['Taxownerdriver']['state'] = 1;

			$this->Taxownerdriver->create();
			if(empty($this->request->data['Taxownerdriver']['picture']['name']))
				unset($this->request->data['Taxownerdriver']['picture']);
			$this->Taxownerdriver->set($this->request->data);
			$this->People->set($this->request->data);

			if(empty($this->request->data['People']['countrie_id']) || $this->request->data['People']['countrie_id'] == 3)
				$this->request->data['People']['countrie_id']=1;
			if(empty($this->request->data['People']['province_id']))
				$this->request->data['People']['province_id']=1;
			if(empty($this->request->data['People']['location_id']))
				$this->request->data['People']['location_id']=1;
			if(empty($this->request->data['People']['department_id']))
				$this->request->data['People']['department_id']=1;

			if($this->request->data['Taxownerdriver']['newuser'] == 0){
				$this->User->set($this->request->data);
				$val_user = $this->User->validates();
				$errors = $this->User->validationErrors;
			}else{
				$this->request->data['Taxownerdriver']['user_id'] = $this->Session->read('user_id');
				$val_user=true;
			}

			$val_taxownerdriver = $this->Taxownerdriver->validates();
			$errors = $this->Taxownerdriver->validationErrors;
			if(empty($this->request->data['People']['id'])){
				$val_people=$this->People->validates();
				$errors = $this->People->validationErrors;
			}else{
				$val_people=true;
			}

			if(($val_people == true || !empty($val_people)) && ($val_user == true || !empty($val_user)) &&  $val_taxownerdriver == 1){
				if ($this->Taxownerdriver->savedriver($this->request->data)) {
					$this->Session->setFlash(__('Los datos fueron guardados.'));
					//Debemos enviar el email si el usuario que se esta registando es nuevo
					if($this->request->data['Taxownerdriver']['newuser'] == 0){
						//enviamos un correo para poder realizar la confirmación del mail
						try {
							App::uses('CakeEmail', 'Network/Email');
							$Email = new CakeEmail('smtp');
							//$Email->template('welcome');
							$Email->emailFormat('html');
							$Email->viewVars(array('usuarionomap' => $this->request->data['People']['firstname'].', '.$this->request->data['People']['secondname']));
							$Email->to(trim($this->request->data['User']['email']));

							$usrencrypt = MD5($this->request->data['User']['username']);
							$Email->subject(__('Taxiar - IMPORTANTE - Completa tu Registro'));
							Configure::load('appconf');
							$ipaddres = Configure::read('IPSERVER');

							$body = '';
							$body = $body.'Hola!<br><br>';
							$body = $body.'<b>Por favor no responda este email</b><br>';
							$body = $body.'Usted fue asignado como un chofer de una unidad. Ya está muy cerca de utilizar Taxiar<br><br>';
							$body = $body.'Solamente falta que active la cuenta haciendo click en el siguiente link<br><br>';
							$body = $body.$ipaddres."/users/usersactive/".$usrencrypt."<br><br>";
							$body = $body.'Recuerde que su Nombre de Usuario es: '.$this->request->data['User']['username'].' - Constraseña: '.$this->request->data['User']['password']."<br><br>";
							$body = $body.'Una vez activada su cuenta podrá recivir pedidos de clientes en forma segura<br><br>';
							$body = $body.'Cualquier duda o sugerencia contactenos<br>';
							$body = $body.'Por facebook https://www.facebook.com/Taxi-Argentina-194221830916008/<br>';
							$body = $body.'o nuestro web site '.$ipaddres.'<br><br>';
							$body = $body.'Gracias por usar Taxiar<br><br>';
							$Email->send($body);
						}catch(SocketException $e){
							$error = $e->getmessage();
							$this->Session->setFlash(__('Alta de Usuario. Envío de Correo con error: '.$error));
						}
					}
					return $this->redirect(array('action' => 'index'));
				} else {
					print_r($this->People->validationErrors);
					$this->Session->setFlash(__('No se pudo guardar los datos. Por Favor intente de nuevo.'));
				}
			}else{
				print_r($this->Taxownerdriver->validationErrors);
			}
		}
		$this->set('taxowner_id',$taxowner_id);
		$this->set('username',$username);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('title_for_layout',__('Actualizar datos de Conductor'));
		if (!$this->Taxownerdriver->exists($id)) {
			throw new NotFoundException(__('Identificador Invalido'));
		}
		$taxowner_id = 0;
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
			if(empty($this->request->data['Taxownerdriver']['picture']['name'])){
				//$this->log('BORRANDO IMAGEN'. print_r($this->request->data['Taxownerdriver']['picture'], true ));
				unset($this->request->data['Taxownerdriver']['picture']);
			}

			if ($this->Taxownerdriver->saveall($this->request->data)) {
				$this->Session->setFlash(__('Los datos fueron actualizados.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				print_r($this->Taxownerdriver->invalidFields());
				$this->Session->setFlash(__('No se pudieron guardar los datos. Por favor intente de nuevo.'));
			}
		} else {
			//only for adminitrator

			if($this->Session->read('tipousr') == 1 || $this->Session->read('tipousr') == 4 ){
				$options = array('conditions' => array('Taxownerdriver.' . $this->Taxownerdriver->primaryKey => $id,'Taxownerdriver.taxowner_id'=>!empty($this->Session->read('taxowner_id')) ? $this->Session->read('taxowner_id') : $taxowner_id),
						'fields'=>array('Taxownerdriver.id','Taxownerdriver.taxowner_id','"Taxownerdriver"."picture" AS "Taxownerdriver__image"',
										'Taxownerdriver.state','People.id','People.document','People.birthdate','People.firstname',
										'People.secondname','People.gender','People.phonenumber','People.countrie_id','People.province_id',
										'People.department_id','People.location_id','People.address','People.number','People.depto',
										'People.block','Taxownerdriver.licencenumber','Taxownerdriver.fecvenclicence','Taxownerdriver.picture')
			);
				$this->request->data = $this->Taxownerdriver->find('first', $options);
				//print_r($this->request->data);
			}else{
				return  $this->redirect(array('action' => 'index'));
			}
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
		$this->Taxownerdriver->id = $id;
		if (!$this->Taxownerdriver->exists()) {
			throw new NotFoundException(__('Identificador Invalido'));
		}

		//solo puede borrar sus moviles asociados
		$taxownerdriver=$this->Taxownerdriver->find('first',array('conditions'=>array('Taxownerdriver.id'=>$id),
																						'fields'=>array('Taxownerdriver.taxowner_id','Taxownerdriver.picture')));
		if($taxownerdriver['Taxownerdriver']['taxowner_id'] != $this->Session->read('taxowner_id')){
				$this->Session->setFlash(__('No se puede eliminar el registro. Bloqueado por otro usuario'));
				return $this->redirect(array('action' => 'index'));
		}
		try {
			if ($this->Taxownerdriver->delete()) {
				$file = new File(WWW_ROOT.$taxownerdriver['Taxownerdriver']['picture']);
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


	public function beforeRender(){
		if($this->params['action'] == 'add'){

		}

		/*Agregado provincia */
		if($this->params['action']=='add' ||
			$this->params['action']=='edit' ){
				//create class
				$Countrie 	= ClassRegistry::init('Countrie');
				$Province 	= ClassRegistry::init('Province');
				$Department = ClassRegistry::init('Department');
				$Location 	= ClassRegistry::init('Location');

				$countries = $Countrie->find('list',array('fields'=>array('Countrie.id','Countrie.name'),
																'order'=>array('Countrie.name')));
				array_push($countries, '');
				asort($countries,2);
				$this->set(compact('countries'));
					//$provincias = $this->Provincia->find('list',array('fields'=>array('Provincia.id','Provincia.nombre')));
			if($this->params['action'] == 'edit' || $this->params['action'] == 'add'){

				if(!empty($this->request->data['People']['countrie_id']))
					$provinces = $Province->find('list',array('fields'=>array('Province.id','Province.name'),'conditions'=>array('Province.countrie_id'=>$this->request->data['People']['countrie_id'])));
				if(!empty($this->request->data['People']['province_id']))
					$departments = $Department->find('list',array('fields'=>array('Department.id','Department.name'),'conditions'=>array('Department.province_id'=>$this->request->data['People']['province_id'])));
				if(!empty($this->request->data['People']['location_id']))
					$locations = $Location->find('list',array('fields'=>array('Location.id','Location.name'),'conditions'=>array('Location.department_id'=>$this->request->data['People']['location_id'])));
				$this->set(compact('provinces','locations','departments'));
			}
		}
		parent::beforeRender();
	}

	function beforeFilter(){
		parent::beforeFilter();
		// For CakePHP 2.0
		//$this->Auth->allow('*');

		// For CakePHP 2.1 and up
		//$this->Auth->allow();
		$this->Auth->allow('*');
		$this->Auth->allow();

		$acepted_func=array('getdriverinfo','setworkstate');
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
			 	$this->redirect(array('controller' => 'mains','action'=>'securityerror',$this->params['controller'].'-'.$this->params['action']));
			}catch(Exeption $e){
			}

		}
	}

	public function mostrarimagenthumbs($id = null){
		$this->layout='';
		$noimage='';
		$filename=WWW_ROOT."/files/img/".$id.'taxownerdriver.jpeg';
		if(!file_exists($filename)){
			$file = new File($filename,true,0644);
			$taxownerdriver = $this->Taxownerdriver->find("first",array('fields'=>
													array('Taxownerdriver.picture'),
													'conditions'=>array('Taxownerdriver.id'=>$id)
												));
			if(!empty($taxownerdriver)){
				$cimage = new CimageComponent(new ComponentCollection());
				if(strpos($taxownerdriver['Taxownerdriver']['picture'],'base64') > 0){
					$image = substr($taxownerdriver['Taxownerdriver']['picture'],23,strlen($taxownerdriver['Taxownerdriver']['picture']));
				}else{
					$image = $taxownerdriver['Taxownerdriver']['picture'];
				}
				$file->write(base64_decode($image),'wb',true);
				$file->close();
				$cimage->view(base64_decode($image),'jpeg');
			}else{
				$file->close();
				$noimage='../img/noimage.png';
			}

		}else{
			$file = new File($filename);
			$file->open('r',true);
			$result = $file->read($filename,'rb',true);
			$file->close();
			$cimage = new CimageComponent(new ComponentCollection());
			$cimage->view($result,'image/jpeg');
		}
		$this->set('noimage',$noimage);
	}

	/*
	* Function: recupera datos del driver
	*/
	public function getdriverinfo(){
	$error='';
			if(!empty($this->request->data['key']) && !empty($this->request->data['taxturn_id'])){
			if($this->Rsesion->SessionIsOk($this->request->data['key'])){
				$rsesions = $this->Rsesion->rsesiondata($this->request->data['key']);
				if(!empty($rsesions)){
					$Taxturn = ClassRegistry::init('Taxturn');
					$taxturns = $Taxturn->find('first',array('conditions'=>array('Taxturn.id'=>$this->request->data['taxturn_id'])));
					//print_r($taxturns);
					if(!empty($taxturns)){
						//recupera las ordenes que fueron tomadas por el conductor
						$taxownerdriver = $this->Taxownerdriver->find('first',array('conditions'=>array('Taxownerdriver.id'=>$taxturns['Taxturn']['taxownerdriver_id']),
																											'joins'=>array(
																													array('table'=>'taxturns',
																															'alias'=>'Taxturn',
																															'type'=>'INNER',
																															'conditions'=>array('Taxturn.taxownerdriver_id = Taxownerdriver.id and Taxturn.state = 0')),
																													array('table'=>'taxownerscars',
																															'alias'=>'Taxownerscar',
																															'type'=>'INNER',
																															'conditions'=>array('Taxownerscar.id = Taxturn.taxownerscar_id'))),
																															'fields'=>array('Taxownerscar.id','Taxownerscar.carcode','Taxownerscar.descriptioncar',
																																							'Taxownerscar.registerpermision','People.firstname','People.secondname',
																																							'Taxownerdriver.picture','Taxownerdriver.user_id','Taxownerdriver.id')
																														)
																											);


							$key_user_session = $this->Rsesion->find('first',array('conditions'=>array('Rsesion.user_id'=>$taxownerdriver['Taxownerdriver']['user_id'],'Rsesion.state = 1'),
																															'fields'=>array('Rsesion.user_id','Rsesion.sessionkey')));
							if(empty($key_user_session)){
								$error = __('No se encontro una sesion activa para el Usuario');
							}

							if(empty($taxownerdriver)){
								$error = __('No se encontro informacion para el chofer');
							}
							//print_r($key_user_session);
							$taxownerdriver['Taxownerdriver']['rmk'] = $rsesions['Rsesion']['sessionkey'];
					}else{
							$error = __('No se encontro el turno');
					}
				}
			}
		}else{
			$error=__('No se encontró indentificador para el usuario');
		}
		$this->set('error',$error);
		$this->set(compact('taxownerdriver'));
	}

}
