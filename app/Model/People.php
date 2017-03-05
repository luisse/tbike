<?php
App::uses('AppModel', 'Model');
/**
 * People Model
 *
 * @property Country $Country
 * @property Province $Province
 * @property Location $Location
 * @property Department $Department
 * @property Userpeople $Userpeople
 */
class People extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'peoples';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'countrie_id' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar el País'
			),
		),
		'province_id' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar la Provincia'
			),
		),
		'location_id' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar Localidad'
			),
		),
		'department_id' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar el Departamento'
			),
		),
		'firstname' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar el Nombre'
			),
		),
		'secondname' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar el Nombre'
			),
		),
		'document' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar el Documento'
			),
			'existdocument' => array(
				'rule' => array('existdocument'),
				'message' => 'Ya existe Registrado el Número de Documento',
				'on' => 'create'
			),
			'rango' => array(
				'rule' => array('range', 1,999999999999),
				'message' => 'El número de documento no debe superar los 12 dígitos',
				'on' => 'create'
			),			
		),
		'address' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar la dirección'
			),
		),
		'number' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar calle número'
			),
		),
		'birthdate' => array(
			'date' => array(
				'rule' => array('date'),
				'message' => 'Debe Ingresar una Fecha valida Día/Mes/Año'
			),
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar Fecha de Nacimiento'
			),
		),
		'gender' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar el Genero'
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
		'Countrie' => array(
			'className' => 'Countrie',
			'foreignKey' => 'countrie_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Province' => array(
			'className' => 'Province',
			'foreignKey' => 'province_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Location' => array(
			'className' => 'Location',
			'foreignKey' => 'location_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Department' => array(
			'className' => 'Department',
			'foreignKey' => 'department_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Userpeople' => array(
			'className' => 'Userpeople',
			'foreignKey' => 'people_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	public function existdocument($data = null){
		$noexiste = true;
		if(!empty($data) && $data['document'] != 0){
				$cantidad  = $this->find('count',array('conditions'=>array('People.document'=>$data['document'])));
				if($cantidad > 0){
					$noexiste=false;
				}
		}
		return $noexiste;
	}

	/*
	* Funcion: antes de guardar es importante convertir la fecha al formato Unix/Mysql
	*/
	function beforeSave($options=array())
	{
		if(!empty($this->data['People']['birthdate']))
			$this->data['People']['birthdate'] = $this->formatDate($this->data['People']['birthdate']);
			return true;
	}

	function beforeValidate($options=array())
	{
		if(!empty($this->data['People']['birthdate']))
			$this->data['People']['birthdate'] = $this->formatDate($this->data['People']['birthdate']);
			return true;
	}
}
