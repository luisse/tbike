<?php
App::uses('AppModel', 'Model');
/**
 * Radiotaxicar Model
 *
 * @property Radiotaxi $Radiotaxi
 * @property Taxownerscar $Taxownerscar
 */
class Radiotaxicar extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'radiotaxi_id' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'taxownerscar_id' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'state' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
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
	public $belongsTo = array(
		'Radiotaxi' => array(
			'className' => 'Radiotaxi',
			'foreignKey' => 'radiotaxi_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Taxownerscar' => array(
			'className' => 'Taxownerscar',
			'foreignKey' => 'taxownerscar_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
