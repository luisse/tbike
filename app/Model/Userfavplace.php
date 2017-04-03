<?php
App::uses('AppModel', 'Model');
/**
 * Userfavplace Model
 *
 * @property User $User
 */
class Userfavplace extends AppModel {


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
	
	
	function beforeSave($options=array())
	{
		if(!empty($this->data['Userfavplace']['lat']) && !empty($this->data['Userfavplace']['lng'])){
			$db=$this->getDataSource();
			$this->data['Userfavplace']['gpspoint']=(object) $db->expression("ST_GeomFromText('POINT(" .$this->data['Userfavplace']['lat'] . " " . $this->data['Userfavplace']['lng'] . ")',4326)");
			return true;
		}
	}
}
