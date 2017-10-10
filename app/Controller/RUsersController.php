<?php
App::uses('AuthComponent', 'Controller/Component');
class RUsersController extends AppController{
  public $uses = array('User','Rsesion');
  public $helpers = array('Html', 'Form');
  public $components = array('RequestHandler');


  public function beforeFilter(){
    parent::beforeFilter();
    $this->RequestHandler->ext = 'json';
  }

  function login(){
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

  function view($id){
    

  }

  function add(){
    if(!$this->request->is('post')) throw new BadRequestException('Request invalid');
    if( !empty($this->request->data['User']['username']) &&
        !empty($this->request->data['User']['email']) &&
        !empty($this->request->data['User']['password']) &&
        !empty($this->request->data['User']['password_repit']) &&
        !empty($this->request->data['Cliente']['documento']) &&
        !empty($this->request->data['Cliente']['nombre']) &&
        !empty($this->request->data['Cliente']['apellido']) &&
        !empty($this->request->data['Cliente']['domicilio'])){

          $this->request->data['User']['group_id']           = 2;
          $this->request->data['User']['state']              = 2;
          $this->request->data['User']['tallercito_id']      = 2;
          $this->request->data['User']['cambiarcontrasenia'] = 1;
          $this->request->data['User']['username']           = strtolower ($this->request->data['User']['username']);

          $this->request->data['Cliente']['tallercito_id']   = 2;
          $this->request->data['Cliente']['documento']       = str_replace('.', '', $this->request->data['Cliente']['documento']);
          $this->User->set($this->request->data);
    			$this->Cliente->set($this->request->data);
    			$validaUser = $this->User->validates();
    			$validaDatosGen= $this->Cliente->validates();

    			if(($validaDatosGen == true || empty($validaDatosGen)) && $validaUser = 1){
    				if($this->User->addusersall($this->request->data)){
              App::uses('CakeEmail', 'Network/Email');

              $Email = new CakeEmail('smtp');
              $Email->template('welcome');
              $Email->emailFormat('html');
              $Email->viewVars(array('usuarionomap' => $this->request->data['Cliente']['apellido'].', '.$this->request->data['Cliente']['nombre']));
              $Email->to($this->request->data['User']['email']);
              $usrencrypt = MD5($this->request->data['User']['username']);

              if(!empty($tallercito))
                $Email->subject('Confirmación de Usuario');
              else
                $Email->subject('Confirmación de Usuario');

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

            }else{
              $errors = $this->User->validationErrors;
              foreach( $errors as $errores )
                $error[] = array('User' => $errores[0]);

              $errors = $this->Cliente->validationErrors;
              foreach( $errors as $errores )
                $error[] = array('Cliente' => $errores[0]);

              //throw new BadRequestException('No se pudo dar de alta el usuario');
            }
          }else{
            $this->set(array(
                  'message' => $message,
                  '_serialize' => array('message')
            ));
          }
    }else{
           throw new BadRequestException('Invalid data for add client');
    }
  }
}
