<?php
App::uses('AppModel', 'Model');
/**
 * Taxpanic Model
 *
 * @property Taxownerdriver $Taxownerdriver
 */
class Taxpanic extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'taxownerdriver_id' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar el Conductor'
			),
		),
		'datepanic' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar Fecha de Alarma'
			),
			'datetime' => array(
				'rule' => array('datetime'),
				'message' => 'Debe Ingresar una Fecha valida'
			),
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Taxownerdriver' => array(
			'className' => 'Taxownerdriver',
			'foreignKey' => 'taxownerdriver_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);



	function beforeSave($options=array())
	{
		if(!empty($this->data['Taxpanic']['lat']) && !empty($this->data['Taxpanic']['lng'])){
			$db=$this->getDataSource();
			$this->data['Taxpanic']['gpspoint']=(object) $db->expression("ST_GeomFromText('POINT(" .$this->data['Taxpanic']['lat'] . " " . $this->data['Taxpanic']['lng'] . ")',4326)");
			return true;
		}
	}

	function getTotalPanic($is_test = true){
		//echo "SELECT * FROM sp_panic_now(".$is_test.")";
		return $this->query("SELECT * FROM sp_panic_now(".$is_test.")");
	}

}
?>
