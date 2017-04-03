<?php
App::uses('AppModel', 'Model');
/**
 * Buttonuser Model
 *
 * @property User $User
 */
class Button extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'group_id' => array(
<<<<<<< HEAD
			'notBlank' => array(
				'rule' => array('notBlank'),
=======
			'notEmpty' => array(
				'rule' => array('notEmpty'),
>>>>>>> d1dd9254b21e573d5d9674487d0b9be918df744a
				'message' => 'Debe Ingresar un usuario valido'
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'El usuario debe ser un valor numerico'
			),
		),
		'buttondescr' => array(
<<<<<<< HEAD
			'notBlank' => array(
				'rule' => array('notBlank'),
=======
			'notEmpty' => array(
				'rule' => array('notEmpty'),
>>>>>>> d1dd9254b21e573d5d9674487d0b9be918df744a
				'message' => 'Debe Ingresar la descripcion del boton'
			),
		),
		'modelname' => array(
<<<<<<< HEAD
			'notBlank' => array(
				'rule' => array('notBlank'),
=======
			'notEmpty' => array(
				'rule' => array('notEmpty'),
>>>>>>> d1dd9254b21e573d5d9674487d0b9be918df744a
				'message' => 'Debe Ingresar el detalle del modelo ',
				'allowEmpty' => false
			),
			'maxLength' => array(
				'rule' => array('maxLength',30),
				'message' => 'Maxima Cantidad de Caracteres es 30'
			),
		),
		'actionname' => array(
<<<<<<< HEAD
			'notBlank' => array(
				'rule' => array('notBlank'),
=======
			'notEmpty' => array(
				'rule' => array('notEmpty'),
>>>>>>> d1dd9254b21e573d5d9674487d0b9be918df744a
				'message' => 'Debe Ingresar el Nombre de la accion'
			),
			'maxLength' => array(
				'rule' => array('maxLength',30),
				'message' => 'Cantidad Maxima de Caracteres es 30'
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
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
