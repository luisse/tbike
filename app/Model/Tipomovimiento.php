<?php
App::uses('AppModel', 'Model');
/**
 * Tipomovimiento Model
 *
 */
class Tipomovimiento extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'descripcion' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar una descripción'
			),
		),
		'signo' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'El Signo debe ser un valor numérico',
			),
		),
	);
}
