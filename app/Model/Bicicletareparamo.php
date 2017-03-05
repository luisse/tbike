<?php
App::uses('AppModel', 'Model');
/**
 * Bicicletareparamo Model
 *
 * @property Cliente $Cliente
 * @property Bicicleta $Bicicleta
 * @property Bicicletareparamorepuesto $Bicicletareparamorepuesto
 */
class Bicicletareparamo extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'fechaingreso' => array(
			'date' => array(
				'rule' => array('date'),
				'message' => 'Debe Ingresar una fecha de Ingreso Válida'
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar una Fecha de Ingreso'
			),
		),
		'fechaegreso' => array(
			'date' => array(
				'rule' => array('date'),
				'message' => 'Debe Ingresar una Fecha de Salida Probable'
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar una Fecha de Egreso Probable'
			),
		),
		'detallereparacion' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar un Detalle del Trabajo a Realizar'
			),
			'minLength' => array(
				'rule' => array('minLength',10),
				'message' => 'Ingreso un detalle de mas de 10 Caracteres'
			),
			'maxLength' => array(
				'rule' => array('maxLength',255),
				'message' => 'El Detalle Debe tener menos de 255 Caracteres'
			)
		),
		'importetotal' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar un Importe'
			),
			'decimal' => array(
				'rule' => array('decimal'),
				'message' => 'El Importe no es valido'
			),
		),
		'cliente_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'bicicleta_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'descuento' => array(
				'valor' =>array('rule'=> array('between', 0,100),
									'message' => 'El Descuento debe estar entre el 0 - 100%')
		)		
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Cliente' => array(
			'className' => 'Cliente',
			'foreignKey' => 'cliente_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Bicicleta' => array(
			'className' => 'Bicicleta',
			'foreignKey' => 'bicicleta_id',
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

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Bicicletareparamorepuesto' => array(
			'className' => 'Bicicletareparamorepuesto',
			'foreignKey' => 'bicicletareparamo_id',
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
	
	
	function beforeSave($options=array())
	{
		$this->data['Bicicletareparamo']['fechaingreso'] = $this->formatDate($this->data['Bicicletareparamo']['fechaingreso']);
		$this->data['Bicicletareparamo']['fechaegreso'] = $this->formatDate($this->data['Bicicletareparamo']['fechaegreso']);
		$this->data['Bicicletareparamo']['importetotal'] = str_replace('$','',$this->data['Bicicletareparamo']['importetotal']);
		$this->data['Bicicletareparamo']['importetotal'] = str_replace(' ','',$this->data['Bicicletareparamo']['importetotal']);
		return true;
	}	
	
	function beforeValidate($options=array())
	{
		$this->data['Bicicletareparamo']['fechaingreso'] = $this->formatDate($this->data['Bicicletareparamo']['fechaingreso']);
		$this->data['Bicicletareparamo']['fechaegreso'] = $this->formatDate($this->data['Bicicletareparamo']['fechaegreso']);	
		$this->data['Bicicletareparamo']['importetotal'] = str_replace('$','',$this->data['Bicicletareparamo']['importetotal']);
		$this->data['Bicicletareparamo']['importetotal'] = str_replace(' ','',$this->data['Bicicletareparamo']['importetotal']);
		return true;
	}	
}
