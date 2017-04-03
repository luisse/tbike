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
<<<<<<< HEAD
			'notBlank' => array(
				'rule' => array('notBlank'),
=======
			'notEmpty' => array(
				'rule' => array('notEmpty'),
>>>>>>> d1dd9254b21e573d5d9674487d0b9be918df744a
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
