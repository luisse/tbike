<?php
App::uses('AppModel', 'Model');
/**
 * Tipomen Model
 *
 */
class Tipomen extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'descripcion' => array(
<<<<<<< HEAD
			'notBlank' => array(
				'rule' => array('notBlank'),
=======
			'notEmpty' => array(
				'rule' => array('notEmpty'),
>>>>>>> d1dd9254b21e573d5d9674487d0b9be918df744a
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'sintetico' => array(
<<<<<<< HEAD
			'notBlank' => array(
				'rule' => array('notBlank'),
=======
			'notEmpty' => array(
				'rule' => array('notEmpty'),
>>>>>>> d1dd9254b21e573d5d9674487d0b9be918df744a
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
