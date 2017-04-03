<?php
App::uses('AppModel', 'Model');
/**
 * Talk Model
 *
 * @property UserContact $UserContact
 * @property UserInit $UserInit
 * @property Talkdetail $Talkdetail
 */
class Talk extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
 /***
	public $validate = array(
		'user_contact_id' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'user_init_id' => array(
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
***/
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
 /***
	public $belongsTo = array(
		'UserContact' => array(
			'className' => 'UserContact',
			'foreignKey' => 'user_contact_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'UserInit' => array(
			'className' => 'UserInit',
			'foreignKey' => 'user_init_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
***/
/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Talkdetail' => array(
			'className' => 'Talkdetail',
			'foreignKey' => 'talk_id',
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

}
