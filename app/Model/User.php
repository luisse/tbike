<?php
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel{
   	public $actsAs = array('Acl' => array('type' => 'requester', 'enabled' => false));
	var $name = 'User';
	var $validate=array('username'=>array('alphaNumeric'=>
								      array('rule'=>'alphaNumeric','requiered'=>true,
								            'message'=>'Solo puede Ingresar Letras y Numeros'),
								            'userunique'=>array('rule'=>'userunique','message'=>'(*) Usuario Existente'),
								'caracteres'=>array('rule'=>array('between',5,20),
								                'message'=>'(*) El Usuario Debe Contener entre 5 y 20 Caracteres')),

								'password'=>array('passwordequal'=>array('rule'=>'passwordequal',
								                'message'=>'(*) Los Password Ingresados deben ser Iguales')),
                                
								'email'=>array('emails'=>array('rule'=>'email',
								                'message'=>'(*) El Email es incorrecto','requiered'=>true),
								'mailunico'=>array('rule'=>'mailunico',
								                'message'=>'(*) El Email Ingresado ya Existe')));
/**
 * belongsTo associations
 *
 * @var array
 */
        public $belongsTo = array(
                'Group' => array(
                        'className' => 'Group',
                        'foreignKey' => 'group_id',
                        'conditions' => '',
                        'fields' => '',
                        'order' => ''
                )
        );

	/*
	 * Funcion: permite validar el login para el inicio de sesion'
	 */
	function validateLogin($data){
		if(strlen($data['username'])<=0) return false;
		if(strlen($data['password'])<=0) return false;
		$user = $this->find('first',array('conditions' => array('User.username'=>$data['username'],'User.password'=>AuthComponent::password($data['password']),'User.state'=>'1'),
											'joins'=>array(array('table'=>'clientes',
															'alias'=>'Cliente',
															'type'=>'LEFT',
															'conditions'=>array('Cliente.user_id = User.id'))),
											'fields'=>array('User.id','User.group_id','Cliente.foto','User.username','Cliente.id',
															'Cliente.apellido','Cliente.nombre','User.email','User.tallercito_id','User.cambiarcontrasenia')
											));
		if(empty($user) == false){
			return $user;
		}
		return false;
	}

	/*
	 * Funcion: Permite validar si el usuario que se quiere dar de alta ya existe
	 */

	function userunique($data){
		return $this->isUnique(array('username'=>$this->data['User']['username']));
	}

	/*
	 * Funcion: permite determinar si las password ingresadas son iguales
	 */
	function passwordequal($data){
		$valid = false;
		if($this->data['User']['password'] == $this->data['User']['password_repit']) $valid = true;
		return $valid;
	}

	/*
	* Funcion: permite validar que el correo electrnico sea unico
	*/
	function mailunico(){
		return true;
		//return $this->isUnique(array('email'=>$this->data['User']['email']));
	}

	/*
	 * Funcion: permite insertar un nuevo usuario
	 * */
	function addusersall($data = null){
		if(!empty($data)){
			$datasource = $this->getDataSource();
			ClassRegistry::init('Cliente');
			$Cliente = new Cliente();
			$this->create();
			$datasource->begin($this);
			$data['User']['password']      =AuthComponent::password($data['User']['password']);
			$data['User']['password_repit']=AuthComponent::password($data['User']['password_repit']);
			if($this->save($data)){
				$data['Cliente']['user_id'] = $this->id;
				$result = $Cliente->GuardarCliente($data['Cliente']);
					if($result == true){
								$datasource->commit($this);
								$datasource->commit($this);
								return true;
					}else{
								$datasource->rollback($this);
								$datasource->rollback($this);
								return false;
					}
			}else{
				$datasource->rollback($this);
				return false;
			}
		}
	}


	function beforeSave($options= array())
	{

			//return parent::beforeSave($options);
			return true;
	}

	function beforeValidate($options = array()){
		//$this->data['Alumno']['nrolegajo']=str_replace('.', '', $this->data['Usersalumno']['document']);
		return true;
	}

	function getUsers($id = null){
		return $this->find('first',array('conditions' => array('User.id'=>$id,'User.state'=>1)));
	}

	function getUserDetails($group_id=null,$user_id = null){
		$userdetails = array();
		if($group_id == 2){
			ClassRegistry::init('Cliente');
			$Cliente = new Cliente();
			$datos =$Cliente->find('first',array('conditions'=>array('user_id'=>$user_id)));
			$userdetails['User']['group_id']=$group_id;
			$userdetails['User']['cliente_id']=$datos['Cliente']['id'];
			ClassRegistry::init('Bicicleta');
			$ClienteBicicleta = new Bicicleta();
			$datos =  $ClienteBicicleta->find('all',array('conditions'=>array('cliente_id'=>$userdetails['User']['cliente_id'])));
			$grupos_id='0';
			//cargamos todos los grupos asociados al usuario
			foreach($datos as $dato){
				$grupos_id=$grupos_id.','.$dato['Bicicleta']['id'];
			}
			$userdetails['User']['bicicleta_id']=$grupos_id;
		}else{
			//ADMIN NO RETURN DATA
		}
		return $userdetails;
	}

	public function parentNode() {
        	if (!$this->id && empty($this->data)) {
            		return null;
        	}
        	if (isset($this->data['User']['group_id'])) {
            		$groupId = $this->data['User']['group_id'];
        	} else {
            		$groupId = $this->field('group_id');
        	}
        	if (!$groupId) {
            		return null;
        	} else {
            		return array('Group' => array('id' => $groupId));
        	}
    }

	function bindNode($user) {
	    return array('model' => 'Group', 'foreign_key' => $user['User']['group_id']);
	}

}

?>
