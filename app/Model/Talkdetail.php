<?php
App::uses('AppModel', 'Model');
/**
 * Talkdetail Model
 *
 * @property UserRec $UserRec
 * @property UserSend $UserSend
 * @property Talk $Talk
 */
class Talkdetail extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'user_rec_id' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'user_send_id' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'talk_id' => array(
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
	public $belongsTo = array(
		'UserRec' => array(
			'className' => 'UserRec',
			'foreignKey' => 'user_rec_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'UserSend' => array(
			'className' => 'UserSend',
			'foreignKey' => 'user_send_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Talk' => array(
			'className' => 'Talk',
			'foreignKey' => 'talk_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
