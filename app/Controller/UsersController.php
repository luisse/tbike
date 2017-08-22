<?php
App::uses('AuthComponent', 'Controller/Component');
class UsersController extends AppController{
	var $name = 'Users';
	var $components = array('RequestHandler','Session','Email','Paginator', 'Acl', 'Security','Cimage');
	var $uses = array('User','Cliente','Tallercito','Sysconfig');
	var $helpers = array('Html','Form','Time');
    public $actsAs = array('Acl' => array('type' => 'requester'));

	//Funcion principal para visualizar todos los usuarios
	function index(){
		$this->User->recursive = 0;
        $this->set('title_for_layout',__('Administracion Datos de Usuario'));
		$this->set('tipousr',$this->Session->read('tipousr'));

	}

	function listusers(){
		$this->User->recursive = 0;
		//save for session read
		$this->Session->write('fil_documento', $this->request->data['Cliente']['documento']);
		$this->Session->write('fil_nombre', $this->request->data['Cliente']['nombre']);
		$this->Session->write('fil_apellido', $this->request->data['Cliente']['apellido']);



		$ls_filtro = ' 1=1 ';
		if($this->Session->read('tipousr') == 1){
			$ls_filtro = ' 1=1 AND User.tallercito_id='.$this->Session->read('tallercito_id');
		}else{
			$ls_filtro = ' AND User.id = '.$this->Session->read('user_id').' AND User.tallercito_id = '.$this->Session->read('tallercito_id').' ';
		}
		$ls_filtronotexist=' 1=1 ';
		$ls_notexist = '';
		if( !empty( $this->request->data) ){
				if( $this->request->data['Cliente']['documento'] != null &&
					$this->request->data['Cliente']['documento'] != '')
					$ls_filtronotexist = $ls_filtronotexist.' AND clientes.documento = '.str_replace('.', '', $this->request->data['Cliente']['documento']);
				if( $this->request->data['Cliente']['nombre'] != null &&
					$this->request->data['Cliente']['nombre'] != '')
					$ls_filtronotexist = $ls_filtronotexist." AND clientes.nombre like '%".$this->request->data['Cliente']['nombre']."%'";
				if( $this->request->data['Cliente']['apellido'] != null &&
					$this->request->data['Cliente']['apellido'] != '')
					$ls_filtronotexist = $ls_filtronotexist." AND clientes.apellido like '%".$this->request->data['Cliente']['apellido']."%'";

				if(($this->request->data['Cliente']['documento'] != null &&
					$this->request->data['Cliente']['documento'] != '') OR ($this->request->data['Cliente']['nombre'] != null &&
					$this->request->data['Cliente']['nombre'] != '') OR ($this->request->data['Cliente']['apellido'] != null &&
					$this->request->data['Cliente']['apellido'] != ''))
					$ls_notexist = ' AND EXISTS(SELECT id FROM clientes WHERE '.$ls_filtronotexist.' AND user_id = User.id)';
		}
		$this->paginate=array('limit' => 8,
						'page' 	=> 1,
						'fields'=> array('User.id','User.username','User.email','Cliente.nombre','Cliente.apellido','Cliente.documento'),
						'order'	=> array('username'=>'asc'),
						'joins'	=> array(array('table'=>'clientes',
															'alias'=>'Cliente',
															'type'=>'LEFT',
															'conditions'=>array('Cliente.user_id = User.id'))),
						'conditions' => $ls_filtro.$ls_notexist);
		$this->set('users', $this->paginate());
	}

	function login2(){
		//enabled only remote consult
	}

	/*
	*Funcion: permite realizar el login de los datos
	*/
	function login(){
		$this->layout = 'login';
		//$this->viewBuilder()->layout('login');
		$this->set('title_for_layout',__('Bici-Taller'));
		if(!empty($this->request->data)){
			if ($this->Auth->login()) {
				$user = $this->User->validateLogin($this->request->data['User']);
				if(!empty($user) ){
					//Guardamos los datos de usuario y configuraciones en las sesion del usuario
					$result = $this->User->getUserDetails($user['User']['group_id'],$user['User']['id']);
					//SAVE SESSION
					$this->Session->write( 'username', $user['User']['username']);
					$this->Session->write( 'user_id', $user['User']['id']);
					$this->Session->write( 'tipousr', $user['User']['group_id']);
					$this->Session->write( 'userfoto', $user['Cliente']['foto']);
					$this->Session->write( 'nomap', $user['Cliente']['apellido'].', '.$user['Cliente']['nombre']);
					$this->Session->write( 'email', $user['User']['email']);
					$this->Session->write( 'cliente_id', $user['Cliente']['id']);
					$this->Session->write( 'tallercito_id', $user['User']['tallercito_id']);
					$tallercito = $this->Tallercito->find('first',array('conditions' => array('Tallercito.id' => $user['User']['tallercito_id'])));
					$this->Session->write('tallercito',$tallercito);
					//SYSCONFIG
					$sysconfig = $this->Sysconfig->find('first',array('conditions' => array('Sysconfig.tallercito_id' => $user['User']['tallercito_id']),
																	'fields' => array('Sysconfig.mailtransport','Sysconfig.mailfrom','Sysconfig.mailhost','Sysconfig.mailport','Sysconfig.mailuser','Sysconfig.mailpassword','Sysconfig.stockrestrict')));
					if(!empty($sysconfig))
						$this->Session->write('sysconfig',$sysconfig);
					//END SAVE SESSION
					if($user['User']['cambiarcontrasenia']==1){
						$this->redirect(array('controller'=>'users','action'=>'cambiarcontraseniauser'));
						exit();
					}

					if($user['User']['group_id'] == 2){
						$this->Session->write('bicicleta_id',$result['User']['bicicleta_id']);
					}else{

					}
					$this->redirect(array('controller'=>'accesorapidos','action'=>'index'));
					exit();
				}else{
					$this->Session->setFlash(__('El usuario o Password son incorrectos.',true));
				}
			}else{
					$this->Session->setFlash(__('Acl: El usuario o Password son incorrectos.',true));
					$this->redirect('login');
			}
		}
	}


	//Permite salir de la aplicacion y cerrar la sesion activa
	function logout(){
		   $this->Session->destroy();
		   $this->redirect($this->Auth->logout());
	}


	function confirmmail($msgmail = null){
		if($msgmail == null)
			$this->set('msgmail','No se pudo enviar el correo de confirmación: '.$errormail);
		else
			$this->set('msgmail','Verifique en su correo el mail de confirmación de usuario');
	}

	//Registrar nuevo usuario al sistema

	function add(){
		$this->layout = 'usersadd';
		$this->set('title_for_layout','Registración de Usuario');
		$this->set('errorval','');
		if($this->request->is('post')){
			$this->User->create();
			$this->request->data['User']['state'] = 2; //Usuario inhabilitado para operar al dar de alta
			//Encryptamos la contraseña con MD5
			$this->User->set($this->request->data);
			$this->Cliente->set($this->request->data);
			$validaUser = $this->User->validates();
			$validaDatosGen= $this->Cliente->validates();
			if(($validaDatosGen == true || empty($validaDatosGen)) && $validaUser = 1){
				if($this->User->addusersall($this->request->data)){
					//enviamos un correo para poder realizar la confirmación del mail
					App::uses('CakeEmail', 'Network/Email');
					$Email = new CakeEmail('smtp');
					//$Email->template('welcome')
					$Email->viewVars(array('usuarionomap' => $this->request->data['Cliente']['apellido'].', '.$this->request->data['Cliente']['nombre']));
					$Email->to($this->request->data['User']['email']);
					$usrencrypt = AuthComponent::password($this->request->data['User']['username']);
					$Email->subject('Tallercito Bike');
					//$Email->send("http://localhost:8080/users/usersactive/".$usrencrypt);
					$this->redirect(array('action' => 'login',$this->Email->smtpError));
				} else {
					$this->Session->setFlash(__('El usuario no se pudo dar de Alta.', true));
				}
			}
		}
	}


	function beforeFilter(){
	    parent::beforeFilter();
		if($this->params['action'] == 'userajaxlogin' ||
		$this->params['action'] == 'login' ||
		$this->params['action'] == 'listusers' ||
		$this->params['action'] == 'cambiarcontrasenia' ||
		$this->params['action'] == 'cambiarcontraseniauser' ||
		$this->params['action'] ==  'addclientajax'){
	    		$this->Security->unlockedActions=true;
		}else{
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

		if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost()) && $this->action == 'addcliente'){
                $this->Security->validatePost = false;
                $this->Security->enabled = false;
                $this->Security->csrfCheck = false;
        }

		//$this->initDB();
	}

    public function initDB(){
                $group = $this->User->Group;
                //root todos los permisos
                //$group->id=1;
                //$this->Acl->allow($group,'controllers');
                //Clientes
                $group->id=1;

				$this->Acl->allow($group,'controllers/Alquileres/index');
				$this->Acl->allow($group,'controllers/Alquileres/index');
				$this->Acl->allow($group,'controllers/Alquileres/add');
				$this->Acl->allow($group,'controllers/Alquileres/edit');
				$this->Acl->allow($group,'controllers/Alquileres/delete');
				$this->Acl->allow($group,'controllers/Alquileres/listalquileres');
				$this->Acl->allow($group,'controllers/Alquileres/newrow');
				$this->Acl->allow($group,'controllers/Alquileres/verdetallealquileres');
				$this->Acl->allow($group,'controllers/Alquileres/imprimirticket');
				$this->Acl->allow($group,'controllers/Alquileres/eliminardetalle');
				$this->Acl->allow($group,'controllers/Alquileres/marcarentregado');
				$this->Acl->allow($group,'controllers/Alquileres/marcarpagado');
				$this->Acl->allow($group,'controller/Bicicletasparaalquileres/seleccionarbicicleta');
                exit;
    }

	//Funcion para despues de renderizar permite cargar los ddw y ejecutar otras funciones
	function beforeRender(){
		if($this->params['action'] == 'add' ||
			$this->params['action']=='edit' ||
			$this->params['action']=='addusrneg'){

			//si contiene datos el data es por que se activo la validacion
		}

		if($this->params['action']=='addcliente'){
			$provincias = $this->Tallercito->Provincia->find('list',array('fields'=>array('Provincia.id','Provincia.nombre')));
			array_push($provincias, '');
			asort($provincias,2);
			$this->set(compact('provincias'));

		}
		parent::beforeRender();
	}
	//Funcion: permite realizar el borrado de un Usuario
	function delete($id = null){
			//Control de errores sin validar
			/***$registros = $this->User->find('count',array('conditions'=>array('User.id'=>$id,'User.tallercito_id'=>$this->Session->read('tallercito_id'))));
			if($registros > 0){
				try {
						if( $this->User->delete($id) ){
								$this->Session->Setflash(__('Los Datos Fueron Borrados satisfactoriamente',true));
								$this->redirect(array('action'=>'index'));
						}
					}catch(Exception $e){
						$this->Session->setFlash(__('Error: No se puede eliminar el registro. Atributo asignado a registro'));
					}
			}***/
			return $this->redirect(array('action' => 'index'));
	}

	//Codigo necesario para actualizar los ACOS
	function edit($id = null){
		$this->set('errorval','');
		/*Seguridad UPDATE */
		$registros = $this->User->find('count',array('conditions'=>array('User.id'=>$id,'User.tallercito_id'=>$this->Session->read('tallercito_id'))));
		if($registros > 0){

			if($this->Session->read('tipousr') == 2 ) $id = $this->Session->read('user_id');
	        $this->User->id = $id;
        	$this->set('title_for_layout','Actualizar Datos de Usuario');
        	if($this->request->is('get')){
        		$this->data = $this->User->read();
				$clientes = array();
				$clientes = $this->Cliente->find('first',array('fields'=>array('Cliente.id','Cliente.documento','Cliente.fechanac','Cliente.apellido','Cliente.nombre','Cliente.domicilio',
																	'Cliente.telefono','Cliente.dpto','Cliente.piso','Cliente.block','Cliente.tallercito_id','Cliente.foto'),
							'conditions'=>array('Cliente.user_id'=>$id)));
				$this->set('clientes',$clientes);
        	}else{
					if($this->User->save($this->request->data['User'])){
						$this->Session->Setflash(__('Los datos del Usuario Fueron Actualizados',true));
						$this->redirect(array('action'=>'index'));
					}else{
						$this->Session->Setflash(__('Error al Actualizar datos del Usuario',true));
						$this->redirect(array('action'=>'index'));
					}
			}
		}else{
			$this->Session->Setflash(__('Usuario no encontrado para eliminar'));
		}
	}

	//metodo para buscar clientes
	function buscarclientes(){
		$this->layout ='buscaralumnos';
	}


	/*Permite ver el detalle de un usuario*/
	function verdetalleusuario($user_id = null){
		$this->layout='buscar';
		$js_funciones = array('fmensajes.js','dateformat.js');
		$this->set('js_funciones',$js_funciones);

		$users = $this->User->getUsers($user_id);
		$this->set('users',$users);
	}

	/*
	 * Funcion: permite realizar el proceso de login mediante ajax
	 * */
	function userajaxlogin(){
		$this->layout = '';
		$error='';
		App::uses('AuthComponent', 'Controller/Component');
		$users = $this->User->find('first',array('conditions' => array('User.username'=>$this->request->data['User']['username'],
				'User.password'=>AuthComponent::password($this->request->data['User']['password']))));
		if ($this->Auth->login()) {
			if(!empty($users)){
				if($users['User']['state'] == 2){
					$error = __('El Usuario no finalizo la registración',true);
				}else{
					if($users['User']['state'] <> 1){
						$error = __('Usuario con estado inválido para operar',true);
					}
				}
			}else{
				$error =__('El usuario o contraseña son incorrectos',true);
			}
		}else{
			$error = __('El usuario o contraseña son incorrectos',true);
		}
		$this->set('error',$error);
	}


	/*
	 * Funcion: permite realizar el proceso de login mediante ajax
	 * */
/*	function userajaxloginremote($user = null,$passowrd = null){
		$this->layout = '';
		$users = $this->User->find('first',array('username'=>$user,
				'password'=>AuthComponent::password($passowrd)));
		$error = ''; //not error
		//Nuevo Login con Athority
		if ($this->Auth->login()) {
			if(!empty($users)){
				if($users['User']['state'] == 2){
					$error = __('El Usuario no finalizo la registración',true);
				}else{
					if($users['User']['state'] <> 1){
						$error = __('Usuario con estado inválido para operar',true);
					}
				}
			}else{
				$error =__('El usuario o contraseña son incorrectos',true);
			}
		}else{
			$error =__('AUTH: El usuario o contraseña son incorrectos',true);
		}
		$this->set('error',$error);
	}*/

	/*
	 * Funcion: permite realizar el proceso de login mediante
	 * */
	function userajaxloginremote(){
		$this->layout = '';
		$user_id = '';
		$error = ''; //not error
		$error_code='';
		$keyremote='';
		$fbtoken='';
		//if($securedata == $Publickey){
			if(!empty($this->request->data['user']) && 
				!empty($this->request->data['password'])){
				$users = $this->User->find('first',array('conditions'=>
						array('OR'=>array("Upper(User.username) = Upper('".$this->request->data['user']."')",'lower(User.email)'=>strtolower($this->request->data['user'])),
						'User.password'=>AuthComponent::password($this->request->data['password']))));
				//RECUPERAMOS EL IDENTIFICADOR DE TELEFONO EN CASO DE EXISTIR
				$data['phone_id']	= '';
				//if(!empty($this->request->data['phone_id']))
				$data['phone_id']		= !empty($this->request->data['phone_id']) ? $this->request->data['phone_id'] : '';

				if(!empty($users)){
						$user_id = $users['User']['id'];
						$keys=$this->Rsesion->find('first',array('conditions'=>array('Rsesion.user_id'=>$users['User']['id'],
													'Rsesion.state'=>1)));

						

						if(empty($keys)){
							$keyremote					= Security::generateAuthKey();
							$data['ipconnect']	= $this->request->clientIp();
							$data['sessionkey']	= $keyremote;
							$data['user_id']		= $users['User']['id'];
							if(!$this->Rsesion->AddSession($data)){
								$keyremote = '';
								$error=__('Error al registrar sesion remota');
							}
						}else{

							//$keyremote = $this->gennewtoken($keys['Rsesion']['sessionkey']);
							$data['id'] = $keys['Rsesion']['id'];
							$this->Rsesion->AddSession($data);
							$keyremote=$keys['Rsesion']['sessionkey'];
							//No permitir multiples sesiones desde el exterior
							if(!empty($data['phone_id']) &&  ( $users['User']['group_id'] == 1 || $users['User']['group_id'] == 2)){
									$keyremote = '';
									$user_id='';
									$error = __('El usuario posee una sesión activa. Ingrese al sitio web para cerrar la sesión');
							}
						}
						//$fbtoken = $this->gennewtoken($users['User']['id']);

						if($users['User']['state'] == 2){
							$keyremote='';
							$fbtoken = '';
							$error_code = 'SUBSCRIPCION_INCOMPLETA';
							$error = __('Su dirección de email aun no fue verificada.',true);
						}else{
							if($users['User']['state'] <> 1){
								$error = __('Usuario bloqueado para operar. Contacte con Taxiar',true);
							}
						}
					}else{
						$error =__('El usuario o contraseña son incorrectos',true);
					}
			}else{
				$error=__('Usuario u Contraseña invalidos');
			}
		//}else{
		//	$error= __('Request Insecure');
		//}
		$this->set('error',$error);
		$this->set('user_id',$user_id);
		$this->set('keyremote',$keyremote);
		$this->set('fbtoken',$fbtoken);
	}

	/*
	 * Funcion: un usuario profesor puede dar de alta usuarios alumnos
	 * */
	function addcliente(){
		//$this->layout = 'usersadd';
		$this->set('title_for_layout',__('Registración de Usuario Cliente'));
		$this->set('errorval','');
		if($this->request->is('post')){
			$this->User->create();
			if(empty($this->request->data['Cliente']['documento'])) $this->request->data['Cliente']['documento']='0';
			$this->request->data['User']['group_id'] = 2;
			$this->request->data['User']['tallercito_id'] = $this->Session->read('tallercito_id');
			$this->request->data['User']['state'] = 2;
			$this->request->data['User']['username'] = strtolower ($this->request->data['User']['username']);
			$this->request->data['User']['cambiarcontrasenia'] = 1;
			$this->request->data['Cliente']['tallercito_id'] = $this->Session->read('tallercito_id');
			$this->request->data['Cliente']['documento'] = str_replace('.', '', $this->request->data['Cliente']['documento']);

			$this->User->set($this->request->data);
			$this->Cliente->set($this->request->data);
			$validaUser = $this->User->validates();
			$validaDatosGen= $this->Cliente->validates();
			if(($validaDatosGen == true || empty($validaDatosGen)) && $validaUser = 1){
				if($this->User->addusersall($this->request->data)){
					//enviamos un correo para poder realizar la confirmación del mail
					App::uses('CakeEmail', 'Network/Email');

					$Email = new CakeEmail('smtp');
					$Email->template('welcome');
					$Email->emailFormat('html');
					$Email->viewVars(array('usuarionomap' => $this->request->data['Cliente']['apellido'].', '.$this->request->data['Cliente']['nombre']));
					$Email->to($this->request->data['User']['email']);

					$usrencrypt = MD5($this->request->data['User']['username']);
					$tallercito = $this->Session->read('tallercito');
					if(!empty($tallercito))
						$Email->subject('Confirmación de Usuario - '.$tallercito['Tallercito']['razonsocial']);
					else
						$Email->subject('Confirmación de Usuario');
					$tallercito = $this->Session->read('tallercito');
					if(!empty($tallercito)){
						$server = $tallercito['Tallercito']['webpage']."/users/usersactive/";
					}else{
						$server = "http://localhost/users/usersactive/";
					}
					$body = 'Hola! estas a un paso para finalizar la registración'."<br>";
					$body = $body.'Para poder acceder al sitema de gestion online de tu bicicicleta debes hacer click en el link adjunto<br>';
					$body = $body.'Si no ves activo el link copia y pega la dirección que te enviamos en el navegador<br>';
					$body = $body.'Una ves que finalizes la registración podrás acceder al sistema de taller con tu usuario y contraseña<br>';
					$body = $body.'<b>Usuario:</b>'.$this->request->data['User']['username']."<br>";
					$body = $body.'<b>Contraseña:</b>'.$this->request->data['User']."<br>";
					$body = $body.'Link: '.$server.$usrencrypt;

					$Email->send($body);
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('El usuario no se pudo dar de Alta.', true));
				}
			}
		}
	}

	function addclientajax(){
		$cliente_id ='';
		$error='';
		if(empty($this->request->data['nombre']))
			$error = __('Debe Ingresar Nombre');
		if(empty($this->request->data['apellido']))
				$error = __('Debe Ingresar el Apellido');
		if(empty($this->request->data['telefono']))
				$error = __('Debe Ingresar el Telefono');
		if(empty($this->request->data['domicilio']))
				$error = __('Debe Ingresar el Domicilio');
		if(empty($this->request->data['email']))
				$error = __('Debe Ingresar el email');

		if(empty($error)){
			$this->request->data['nombre'] = str_replace("  "," ", $this->request->data['nombre']);
			$array_name = explode(" ", $this->request->data['nombre']);
			$username = '';
			$cant = count($array_name);
			for($i=0; $i < $cant; $i++){
					$username = $username.$array_name[$i][0];
			}
			$username = $username.$this->request->data['apellido'];

			$this->User->create();
			if(empty($this->request->data['dni']))
				$data['Cliente']['documento']='0';
			else
				$data['Cliente']['documento']=str_replace('.', '',$this->request->data['dni']);
			$data['User']['group_id'] = 2;
			$data['User']['tallercito_id'] = $this->Session->read('tallercito_id');
			$data['User']['state'] = 2;
			$data['User']['username'] = str_replace(' ','',strtolower($username));
			$data['User']['email'] = $this->request->data['email'];
			$data['User']['password'] = date('ymd');
			$data['User']['password_repit'] = $data['User']['password'];

			$data['User']['cambiarcontrasenia'] = 1;
			$data['Cliente']['tallercito_id'] = $this->Session->read('tallercito_id');
			$data['Cliente']['fechanac'] = '01/01/1990';
			$data['Cliente']['nombre'] = $this->request->data['nombre'];
			$data['Cliente']['apellido'] = $this->request->data['apellido'];
			$data['Cliente']['sezo'] = 'M';
			$data['Cliente']['telefono'] = $this->request->data['telefono'];
			$data['Cliente']['domicilio'] = $this->request->data['domicilio'];

			$this->User->set($data);
			$this->Cliente->set($data);
			$validaUser = $this->User->validates();
			$validaDatosGen= $this->Cliente->validates();

			if(($validaDatosGen == true || empty($validaDatosGen)) && $validaUser = 1){
					if($this->User->addusersall($data)){
						$error = 'OK';
						$cliente= $this->Cliente->find('first',array('conditions'=>array('Cliente.user_id'=>$this->User->id),
																'fields'=>array('Cliente.id')
															));
						if(!empty($cliente))
							$cliente_id = $cliente['Cliente']['id'];
					}else{
						$errors='';
						foreach($this->User->validationErrors as $error)
							$errors=$errors.$error[0];
						$error = 'No se pudo dar de alta el Cliente. '.$errors.$data['User']['username'];
					}
			}else{
				$error = 'Verifique los datos ingresados';
			}
		}
		//$error = $username;
		$this->set('error',$error);
		$this->set('cliente_id',$cliente_id);
		$this->set('user_id',$this->User->id);
	}

	/*PERMITE ACTIVAR EL USUARIO DE FORMA REMOTA CON EL MAIL DEL USUARIO*/
	function usersactive($autcode = null){
		$this->set('title_for_layout','Confirmación de Cliente');
		$this->layout = 'usersadd';
		$this->set('errorval','');
		if(!empty($autcode)){
			$usersdata = $this->User->find('first',array('conditions'=>array('Md5(User.username)'=>$autcode,'User.state'=>2)));
			if(!empty($usersdata)){
				$clientes = $this->Cliente->find('first',array('fields'=>array('Cliente.id','Cliente.documento','Cliente.fechanac','Cliente.apellido','Cliente.nombre','Cliente.domicilio',
						'Cliente.telefono','Cliente.dpto','Cliente.piso','Cliente.block'),
						'conditions'=>array('Cliente.user_id'=>$usersdata['User']['id'])));
				$this->set('usersdata',$usersdata);
				$this->set('clientes',$clientes);
			}
		}
	}

	function confirmarusuario(){
		if($this->request->is('post')){
				$this->request->data['User']['state']=1;
				if($this->User->save($this->request->data)){
					$this->redirect(array('action'=>'login'));
				}else{
					$this->Session->setFlash(__('No se pudo Confirmar el Usuario. Intente Nuevamente', true));
				}
		}else{
			$this->Session->setFlash(__('No se pudo Confirmar el Usuario. Intente Nuevamente', true));
		}
		$this->redirect(array('action' => 'login'));
	}

	function emailmensaje($mensaje = null){
		$this->layout = 'usersadd';
		$this->set('mensaje',$mensaje);
	}

	//validar borrado de los datos
	function valdelete($id = null){
		$error = '';
		$resultgrupo = array();
		$resultuser = array();
		$resultcliente = $this->Cliente->find('first',array('conditions'=>array('user_id'=>$id),
								'limit'=>1,
								'fields'=>array('Cliente.id')
					)
				);

		if(!empty($resultcliente) || !empty($resultprof)){
			if(!empty($resultcliente)) $this->set('cliente',$this->Cliente->read(null, $resultcliente['Cliente']['id']));

			$error = 'No se puede eliminar el Usuario ya que se encuentran asociada a un Cliente.';
		}else{
			$this->redirect(array('action'=>'delete',$id));
		}
		$this->set('error',$error);
	}

	public function cambiarcontrasenia(){
		if ($this->request->is(array('post', 'put'))) {
			$user = $this->User->read(null, $this->request->data['User']['id']);
			$user['User']['password'] = AuthComponent::password($this->request->data['User']['passwordc']);
			$user['User']['password_repit'] = AuthComponent::password($this->request->data['User']['passwordrepit']);
			if ($this->User->save($user)) {
				$this->Session->setFlash(__('Los Datos han sido Actualizado.'));
			} else {
				$this->Session->setFlash(__('No se pudo guardar los datos. Por favor, intente de nuevo.'));
			}
			$this->redirect(array('controller' => 'users','action'=>'edit',$this->request->data['User']['id']));
		}
	}

	public function cambiarcontraseniauser(){
		$this->set('title_for_layout',__('Cambiar Contraseña de Usuario'));
		$this->layout='usersadd';
		if ($this->request->is(array('post', 'put'))) {
			$user = $this->User->read(null, $this->request->data['User']['id']);
			$user['User']['cambiarcontrasenia'] = 0;
			$user['User']['password'] = AuthComponent::password($this->request->data['User']['passwordc']);
			$user['User']['password_repit'] = AuthComponent::password($this->request->data['User']['passwordrepit']);
			if ($this->User->save($user)) {
				$this->Session->setFlash(__('Los Datos han sido Actualizado.'));
			} else {
				$this->Session->setFlash(__('No se pudo guardar los datos. Por favor, intente de nuevo.'));
			}
			$this->redirect(array('controller' => 'users','action'=>'logout'));
		}else{
			$usersdata = $this->User->find('first',array('conditions'=>array('User.id'=>$this->Session->read('user_id'),'User.state'=>1)));
			if(!empty($usersdata)){
				$clientes = $this->Cliente->find('first',array('fields'=>array('Cliente.id','Cliente.documento','Cliente.fechanac','Cliente.apellido','Cliente.nombre','Cliente.domicilio',
						'Cliente.telefono','Cliente.dpto','Cliente.piso','Cliente.block'),
						'conditions'=>array('Cliente.user_id'=>$usersdata['User']['id'])));
				$this->set('usersdata',$usersdata);
				$this->set('clientes',$clientes);
			}
			$this->set(compact('usersdata','clientes'));
		}
	}


	/*
	* Funcion: permite mostrar la imagen del usuario
	*/
	public function mostrarusuario(){
			$cimage = new CimageComponent(new ComponentCollection());
			//echo $this->Session->read('image');
			$cimage->view(base64_decode($this->Session->read('userfoto')),'jpg');
	}

}

?>
