<?php
App::uses('AppModel', 'Model');
/**
 * Taxjourney Model
 *
 * @property Taxturn $Taxturn
 */
class Taxjourney extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'taxturn_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	/***
	public $belongsTo = array(
		'Taxturn' => array(
			'className' => 'Taxturn',
			'foreignKey' => 'taxturn_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);***/
	
	function beforeSave($options=array())
	{
		if(!empty($this->data['Taxjourney']['init_lat']) && !empty($this->data['Taxjourney']['init_lng'])){
			$db=$this->getDataSource();
			$this->data['Taxjourney']['initjourney']=(object) $db->expression("ST_GeomFromText('POINT(" .$this->data['Taxjourney']['init_lat'] . " " . $this->data['Taxjourney']['init_lng'] . ")',4326)");
			return true;
		}
		if(!empty($this->data['Taxjourney']['end_lat']) && !empty($this->data['Taxjourney']['end_lng'])){
			$db=$this->getDataSource();
			$this->data['Taxjourney']['endjourney']=(object) $db->expression("ST_GeomFromText('POINT(" .$this->data['Taxjourney']['end_lat'] . " " . $this->data['Taxjourney']['end_lng'] . ")',4326)");
			return true;
		}
		
	}	
}
