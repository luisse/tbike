<?php
App::uses('AppModel', 'Model');
/**
 * Userbuttonget Model
 *
 * @property User $User
 * @property Buttonuser $Buttonuser
 */
class Buttonuser extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'user_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar el usuario'
			),
		),
		'buttonuser_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar el boton'
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Valor de asignación debe ser numérico'
			),
		),
		'active' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'Valor de activacion debe ser booleano'
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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Button' => array(
			'className' => 'Button',
			'foreignKey' => 'button_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
