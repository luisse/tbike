<?php
App::uses('AppModel', 'Model');
/**
 * Help Model
 *
 */
class Help extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'controller' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar el Nombre del Controlador'
			),
		),
		'action' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar la acción'
			),
		),
		'helpdetail' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar el detalle'
			),
		),
	);
}
