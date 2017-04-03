<?php
App::uses('AppModel', 'Model');
/**
 * Bicicletareparamorepuesto Model
 *
 * @property Bicicletareparamo $Bicicletareparamo
 */
class Bicicletareparamorepuesto extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'repuestodescr' => array(
<<<<<<< HEAD
			'notBlank' => array(
				'rule' => array('notBlank'),
=======
			'notEmpty' => array(
				'rule' => array('notEmpty'),
>>>>>>> d1dd9254b21e573d5d9674487d0b9be918df744a
				'message' => 'Debe Ingresar la descripción del repuesto'
			),
		),
		'precio' => array(
			'decimal' => array(
				'rule' => array('decimal'),
				'message' => 'El Precio Posee formato Incorrecto'
			)
		),
		'cantidad' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'La Cantidad debe ser numerica',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
<<<<<<< HEAD
			'notBlank' => array(
				'rule' => array('notBlank'),
=======
			'notEmpty' => array(
				'rule' => array('notEmpty'),
>>>>>>> d1dd9254b21e573d5d9674487d0b9be918df744a
				'message' => 'Debe Ingresar la Cantidad'
			)
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Bicicletareparamo' => array(
			'className' => 'Bicicletareparamo',
			'foreignKey' => 'bicicletareparamo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function beforeSave($options=array())
	{
		$this->data['Bicicletareparamorepuesto']['precio'] = trim(str_replace('$','',$this->data['Bicicletareparamorepuesto']['precio']));
		return true;
	}
	
	function beforeValidate($options=array())
	{
		$this->data['Bicicletareparamorepuesto']['precio'] = trim(str_replace('$','',$this->data['Bicicletareparamorepuesto']['precio']));
		return true;
	}
}
