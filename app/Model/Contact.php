<?php
App::uses('AppModel', 'Model');
/**
 * Contact Model
 *
 */
class Contact extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar el Nombre'
			),
		),
		'email' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar el E-mail'
			),
			'email' => array(
				'rule' => array('email'),
				'message' => 'Debe Ingresar un Email Valido'
			),
		),
		'message' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar el Mensaje'
			),
		),
	);
}
