<?php
App::uses('AppModel', 'Model');
/**
 * Senderlog Model
 *
 * @property Senderlog $Senderlog
 */
class Senderlog extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */

	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	/**public $hasMany = array(
		'Mensajeservice' => array(
			'className' => 'Mensajeservice',
			'foreignKey' => 'mensajeservice_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Mensajesmantenimiento' => array(
			'className' => 'Mensajesmantenimiento',
			'foreignKey' => 'mensajesmantenimiento_id',
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
	);***/
}
