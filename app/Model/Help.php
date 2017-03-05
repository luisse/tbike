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
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar el Nombre del Controlador'
			),
		),
		'action' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar la acción'
			),
		),
		'helpdetail' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar el detalle'
			),
		),
	);
}
