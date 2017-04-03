<?php
App::uses('AppModel', 'Model');
/**
 * Sysconfig Model
 *
 * @property Tallercito $Tallercito
 */
class Sysconfig extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'stockrestrict' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'tallercito_id' => array(
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
	/***public $belongsTo = array(
		'Tallercito' => array(
			'className' => 'Tallercito',
			'foreignKey' => 'tallercito_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);***/
}
