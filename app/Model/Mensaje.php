<?php
App::uses('AppModel', 'Model');
/**
 * Mensaje Model
 *
 * @property Tallercito $Tallercito
 * @property Bicicleta $Bicicleta
 * @property Tipomen $Tipomen
 */
class Mensaje extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'asunto' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar el asunto',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'detalle' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar el detalle',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'fechasend' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Debe Ingresar una fecha valida dd/mm/yyyy',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar la fecha',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
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
		'Tallercito' => array(
			'className' => 'Tallercito',
			'foreignKey' => 'tallercito_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		/**'Bicicleta' => array(
			'className' => 'Bicicleta',
			'foreignKey' => 'bicicleta_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),***/
		'Tipomen' => array(
			'className' => 'Tipomen',
			'foreignKey' => 'tipomen_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function beforeSave($options=array())
	{
		if(!empty($this->data['Mensaje']['fechasendauto'])) $this->data['Mensaje']['fechasendauto'] = $this->formatDate($this->data['Mensaje']['fechasendauto']);
		return true;
	}	
	
	function beforeValidate($options=array())
	{
		if(!empty($this->data['Mensaje']['fechasendauto'])) $this->data['Mensaje']['fechasendauto'] = $this->formatDate($this->data['Mensaje']['fechasendauto']);
		return true;
	}		
}
