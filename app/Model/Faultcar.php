<?php
App::uses('AppModel', 'Model');
/**
 * Faultcar Model
 *
 * @property Taxownerscar $Taxownerscar
 * @property User $User
 */
class Faultcar extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'taxownerscar_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Debe Ingresar el código de movil'
			),
		),
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Debe Ingresar el usuario'
			),
		),
		'details' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe ingresar el detalle'
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
		'Taxownerscar' => array(
			'className' => 'Taxownerscar',
			'foreignKey' => 'taxownerscar_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
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
		if(!empty($this->data['Faultcar']['lat']) && !empty($this->data['Faultcar']['lng'])){
			$db=$this->getDataSource();
			$this->data['Faultcar']['gpspoint']=(object) $db->expression("ST_GeomFromText('POINT(" .$this->data['Faultcar']['lat'] . " " . $this->data['Faultcar']['lng'] . ")',4326)");
			return true;
		}
	}

}
