<?php
App::uses('AppModel', 'Model');
/**
 * Userpeople Model
 *
 * @property PeoplesProvince $PeoplesProvince
 * @property User $User
 * @property People $People
 */
class Userpeople extends AppModel {


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
		),
		'People' => array(
			'className' => 'People',
			'foreignKey' => 'people_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public function adduserpeople($user_id = null,$people_id = null){
		$userpeople=array();
		if(!empty($user_id) && !empty($people_id))
			$userpeople =$this->find('first',array('conditions'=>array('Userpeople.user_id'=>$user_id,
														'Userpeople.people_id'=>$people_id)));
		if(empty($userpeople)){
			$datasource = $this->getDataSource();
			$this->create();
			$datasource->begin($this);
			$data['Userpeople']['user_id']=$user_id;
			$data['Userpeople']['people_id']=$people_id;
			if($this->save($data)){
				$datasource->commit($this);
				return true;
			}else{
				$datasource->rollback($this);
				return false;
			}	
		}
		//si existe por defecto retorno true
		return true;
	}
}
