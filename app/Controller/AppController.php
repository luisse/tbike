<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
 session_start();
class AppController extends Controller {
    	public $components = array(
        	'Acl',
        	'Auth' => array(
            	'authorize' => array(
                	'Actions' => array('actionPath' => 'controllers')
            	)
        	),
        	'Session'
    		);
        public $error_public_token;
        public $error_private_token;
        public $rsesions;
        public $msgtoken;
        public $sessiontoken;
	/**
	 * uploads files to the server
	 * @params:
	 *		$folder 	= the folder to upload the files e.g. 'img/files'
	 *		$formdata 	= the array containing the form files
	 *		$itemId 	= id of the item (optional) will create a new sub folder
	 * @return:
	 *		will return an array with the success of each file upload
	 */
	public function beforeRender(){
		$this->set('action',$this->params['action']);
		$this->set('controller',$this->request['controller']);
	}

	public function  beforeFilter(){
    parent::beforeFilter();
		$this->Auth->actionPath = 'controllers/';
		$this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
    $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');

    /*Funciones ejecutadas para procesos que requieren token*/
       $this->publictoken($this->request->header('Security-Access-PublicToken'));
       $this->privatetoken($this->request->header('Security-Access-Token'));
       if(empty($this->sessiontoken))
        if(!empty($this->request->data['key'])){
            $this->privatetoken($this->request->data['key']);
        }

    $array_allow = array('userajaxlogin','usersactive','remoteajax','userajaxloginremote','detalletaller','display','sendmsg',
            'confirmarusuario','usersactive','login','detalletaller');
	  $this->Auth->allow($array_allow);

    $array_json = array('userajaxlogin','addclientajax');
    if( in_array($this->action,$array_json) )
      $this->RequestHandler->ext = 'json';

		//Usuario siempre debe tener una sesion para operar en el sistema
		if( !in_array($this->action,$array_allow) ){
				if($this->Session->check('username') == false){
					$this->redirect(array('controller' => 'users','action' => 'login'));
					$this->Session->setFlash(__('La direccion requerida requiere de login'));
				}
		}
	}

  public function publictoken($token = null){
      $this->error_public_token = '';
      if(!empty($token)){
        Configure::load('appconf');
        $securedata = Configure::read('securedata');
        //verificamos que la clave publica coincida con la clave primaria
        if($securedata != $token){
          $this->error_public_token = __('Token publico invalido para operar');
        }
      }
    }

    public function privatetoken($token = null){
      $this->error_private_token = '';
      $this->rsesion = '';
      $this->sessiontoken = '';
      if(!empty($token)){
        $this->sessiontoken = $token;
  		 if($this->Rsesion->SessionIsOk($token)){
         $rsesions = $this->Rsesion->rsesiondata($token);
         if(!empty($rsesions)){
           $this->rsesions = $rsesions;
         }else{
           $this->error_private_token = __('No se encontro una sesion valida para operar');
         }
       }else{
         $this->error_private_token = __('Sesion inactiva u invalida');
       }
      }
    }

    public function errortoken(){
      if(!empty($this->error_public_token))
         $errortoken = $this->error_public_token;
       else
         $errortoken = $this->error_private_token;
       if(empty($this->rsesions))
         $errortoken = __('Sesion invalida para operar verifique Tokens'.$this->error_private_token);
      //si no es error de sesion posiblemente los parametros enviados son invalidos
       if(empty($errortoken))
         $errortoken = __('Parametros invalidos para operar');
       return  $errortoken;
    }

	/*
	*Function: valida las aplicaciones que pueden ejecutar sin necesidad de estar logueados.
	*/
    function __validateLoginStatus(){

		if($this->action != 'login' &&
                $this->action != 'logout' &&
                $this->action != 'userajaxlogin' &&
        				$this->action != 'confirmarusuario' &&
        				$this->action != 'usersactive' &&
        				$this->action != 'detalletaller' &&
        				$this->action != 'mostrarimagen'){
            if($this->Session->check('username') == false){
                    $this->redirect(array('controller' => 'users','action' => 'login'));
                    $this->Session->setFlash('La direccion requerida requiere de login');
                }
        }else{
			//$this->set('usuario',$this->Session->read('username');
		}
    }

    /*
    * Function: Genera un token basado en JWT estandares
   */
   public function gennewtoken($data = null){
       if(!empty($data)){
         if (!include (APP .'Vendor'. DS .'vendor'. DS.'lcobucci'.DS.'jwt'. DS .'autoload.php')) {
   				trigger_error("Unable to load composer autoloader.", E_USER_ERROR);
   				exit(1);
   			}
         $signer = new Lcobucci\JWT\Signer\Hmac\Sha256();
         $token = (new Lcobucci\JWT\Builder())->setIssuer('https://tallercitobike.esy.es/') // Configures the issuer (iss claim)
                                 ->setAudience('https://tallercitobike.esy.es/') // Configures the audience (aud claim)
                                 ->setId($data, true) // Configures the id (jti claim), replicating as a header item
                                 ->setIssuedAt(time()) // Configures the time that the token was issue (iat claim)
                                 ->setNotBefore(time() + 60) // Configures the time that the token can be used (nbf claim)
                                 ->setExpiration(time() + 3600) // Configures the expiration time of the token (exp claim)
                                 ->set('uid', 1) // Configures a new claim, called "uid"
                                 ->sign($signer, '3isAsis43KsjdapWe94sJksla') //configure signet for data transfer
                                 ->getToken();
         return $token;
       }
     }
   /*
   *Function: retorna los detalles de un token determinado
   */
     public function getdetailtokem($token = null){
       $data = array();
       if(!empty($token)){
         if (!include (APP .'Vendor'. DS .'vendor'. DS.'lcobucci'.DS.'jwt'. DS .'autoload.php')) {
   				trigger_error("Unable to load composer autoloader.", E_USER_ERROR);
   				exit(1);
   			}
         $token = (new Lcobucci\JWT\Parser())->parse((string)$token);
         $token->getHeaders();
         $token->getClaims();
         //echo   $token->getHeader('jti');
         $data['jti'] =  $token->getHeader('jti');
         $data['exp'] =  $token->getHeader('exp');
         //print_r($data);
       }
       return $data;
     }
     /*
     * Function: valida si el token es correcto
     */
     public function validatejwt($token){
       if(!empty($token)){
         if (!include (APP .'Vendor'. DS .'vendor'. DS.'lcobucci'.DS.'jwt'. DS .'autoload.php')) {
   				trigger_error("Unable to load composer autoloader.", E_USER_ERROR);
   				exit(1);
   			}
         //FIRMA
         $signer = new Lcobucci\JWT\Signer\Hmac\Sha256();
         //TOKEN
         $token = (new Lcobucci\JWT\Parser())->parse((string)$token);
         $validador = new Lcobucci\JWT\ValidationData();
         $validador->setIssuer('https://taxiup-app.ddns.net/');
         $validador->setAudience('https://taxiup-app.ddns.net/');
         $validador->setId('e7c05b5d09559defd8a1f26f86a37456e467214b');
         var_dump($token->verify($signer,'3isAsis43KsjdapWe94sJksla'));
         var_dump($token->validate($validador));
         $validador->setCurrentTime(time() + 4000);
         var_dump($token->validate($validador));
     }
   }

	function uploadFiles($folder, $formdata, $itemId = null) {
		// setup dir names absolute and relative
		$folder_url = WWW_ROOT.$folder;
		$rel_url = $folder;

		// create the folder if it does not exist
		if(!is_dir($folder_url)) {
			mkdir($folder_url);
		}

		// if itemId is set create an item folder
		if($itemId) {
			// set new absolute folder
			$folder_url = WWW_ROOT.$folder.'/'.$itemId;
			// set new relative folder
			$rel_url = $folder.'/'.$itemId;
			// create directory
			if(!is_dir($folder_url)) {
				mkdir($folder_url);
			}
		}
		// list of permitted file types, this is only images but documents can be added
		$permitted = array('image/gif','image/jpeg','image/pjpeg','image/png','application/pdf','application/vnd.openxmlformats-officedocument.wordprocessingml.document','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		// loop through and deal with the files

		foreach($formdata as $file) {
			// replace spaces with underscores
			$filename = str_replace(' ', '_', $file['name']);
			// assume filetype is false
			$typeOK = false;
			// check filetype is ok
			foreach($permitted as $type) {
				if($type == $file['type']) {
					$typeOK = true;
					break;
				}
			}

			// if file type ok upload the file
			if($typeOK) {
				// switch based on error code
				switch($file['error']) {
					case 0:
						// check filename already exists
						if(!file_exists($folder_url.'/'.$filename)) {
							// create full filename
							$full_url = $folder_url.'/'.$filename;
							$url = $rel_url.'/'.$filename;
							// upload the file
							$success = move_uploaded_file($file['tmp_name'], $url);
						} else {
							// create unique filename and upload file
							ini_set('date.timezone', 'Europe/London');
							$now = date('Y-m-d-His');
							$full_url = $folder_url.'/'.$now.$filename;
							$url = $rel_url.'/'.$now.$filename;
							$success = move_uploaded_file($file['tmp_name'], $url);
						}
						// if upload was successful
						if($success) {
							// save the url of the file
							$result['urls'][] = $url;
						} else {
							$result['errors'][] = "Error al subir el archivo $filename. Por favor intente de nuevo.";
						}
						break;
					case 3:
						// an error occured
						$result['errors'][] = "Error al cargar archivo $filename. Por favor intente de nuevo.";
						break;
					default:
						// an error occured
						$result['errors'][] = "Error del sistema al subir el archivo $filename. Contacte con el Administrador del Sitio Web.";
						break;
				}
			} elseif($file['error'] == 4) {
				// no file was selected for upload
				$result['nofiles'][] = "No se selecciono un archivo";
			} else {
				// unacceptable file type
				$result['errors'][] = "$filename no se pudo subir el archivo. Se Aceptan Archivos: gif, jpg, png,pdf.,xls,docx";
			}
		}
	return $result;
	}

	/*
	*Funcion: permite convertir la fecha en un formato determinado para guardar la misma
	*/
	function formatDate($dateToFormat){
	    $pattern1 = '/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/i';
	    $pattern2 = '/^([0-9]{4})\/([0-9]{2})\/([0-9]{2})$/i';
	    $pattern3 = '/^([0-9]{2})-([0-9]{2})-([0-9]{4})$/i';
	    $pattern4 = '/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/i';

	    $coincidences = array();

	    if(preg_match($pattern1, $dateToFormat)){
	        $newDate = $dateToFormat;
	    }elseif(preg_match($pattern2, $dateToFormat, $coincidences)){
	        $newDate = $coincidences[1] . '-' . $coincidences[2] . '-' . $coincidences[3];
	    }elseif(preg_match($pattern3, $dateToFormat, $coincidences)){
	        $newDate = $coincidences[3] . '-' . $coincidences[2] . '-' . $coincidences[1];
	    }elseif(preg_match($pattern4, $dateToFormat, $coincidences)){
	        $newDate = $coincidences[3] . '-' . $coincidences[2] . '-' . $coincidences[1];
	    }else{
	        $newDate = null;
	    }
	    return $newDate;
	}
}
