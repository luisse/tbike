<?php
App::uses('AppModel', 'Model');
/**
 * Rsesion Model
 *
 * @property User $User
 */
class Rsesion extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'user_id' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar el Usuario'
			),
		),
		'sessionkey' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar la Clave'
			),
		),
		'initsession' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar la Fecha'
			),
		),
		'endsession' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar Fecha Final'
			),
		),
		'ipconnect' => array(
			'ip' => array(
				'rule' => array('ip'),
				'message' => 'Debe Ingresar la IP'
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	/*
	*Function: permite crear una nueva sesion para realizar consultas json
	*/
	public function AddSession($data){
		if(!empty($data)){
			$finalsession=date('Y-m-d H:i:s', (strtotime ("+6 Hours")));
			$datasource = $this->getDataSource();
			$this->create();
			$datasource->begin($this);
			//verificamos es una actualización
			if(!empty($data['id'])){
				$rsesion['Rsesion']['id'] 			= $data['id'];
				$rsesion['Rsesion']['phone_id'] = $data['phone_id'];
			}else{
				$rsesion['Rsesion']['user_id'] 		= $data['user_id'];
				$rsesion['Rsesion']['sessionkey'] = $data['sessionkey'];
				$rsesion['Rsesion']['initsession']= date('Y-m-d H:i:s');
				$rsesion['Rsesion']['endsession'] = $finalsession;
				$rsesion['Rsesion']['ipconnect'] 	= $data['ipconnect'];
				$rsesion['Rsesion']['state'] 			= 1;
				$rsesion['Rsesion']['phone_id']   = $data['phone_id'];
			}

			if($this->save($rsesion)){
				$datasource->commit($this);
				return true;
			}else{
				$datasource->rollback($this);
				return false;
			}
		}
	}

	/*
	*Function: permite cerrar la sesion habierta
	*/
	public function CloseSession($session = null){
		if(!empty($session)){
			$datasource = $this->getDataSource();
			$this->create();
			$datasource->begin($this);
			if($this->updateAll(array('Rsesion.state'=>0),array('Rsesion.sessionkey'=>$session,'Rsesion.state in(1,2)'))){
				$datasource->commit($this);
				return true;
			}else{
				$datasource->rollback($this);
				return false;
			}
		}
	}

	/*
	*Function: valida que la sesion se encuentre activa por ahora nocontrola la Fecha/Hora
	*/
	public function SessionIsOk($session_key = null){
		if(!empty($session_key)){
				App::uses('CakeTime', 'Utility');
				$keys = $this->find('first',array('conditions'=>array('Rsesion.sessionkey'=>$session_key,
																																	'Rsesion.state in(1,2)'/*,
																																'Rsesion.endsession >='."'".date('Y-m-d H:i:s')."'"*/)));
        if(!empty($keys)){
					return true;
				}else{
					return false;
				}
		}
	}

	/*
	*Function: permite retornat datos de la sesion
	*/
	public function rsesiondata($session_key = null){
		$rsesion=array();
		if(!empty($session_key)){
				$rsesion=$this->find('first',array('conditions'=>array('Rsesion.sessionkey'=>$session_key,
																																'Rsesion.state in(1,2)'/*,
																																'Rsesion.endsession >='."'".date('Y-m-d H:i:s')."'"*/),
																					'fields'=>array('Rsesion.id','Rsesion.user_id','Rsesion.sessionkey','Rsesion.initsession','Rsesion.endsession','Rsesion.ipconnect','Rsesion.state','User.is_test','User.group_id')));

		}
		return $rsesion;
	}

	/*
	* Function: detalles del usaurio conectado a la sesión.
	*/
	public function getdetaialsessionuser($user_id = null){
		$ression=array();
		if(!empty($user_id)){
			$ression =$this->find('first',array('conditions'=>array('Rsesion.user_id'=>$user_id,
									'Rsesion.state in(1,2)'),
									'fields'=>array('Rsesion.user_id','Rsesion.sessionkey','Rsesion.initsession','Rsesion.endsession','Rsesion.ipconnect','Rsesion.state')));
		}
		return $ression;
	}
}
