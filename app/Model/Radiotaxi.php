<?php
App::uses('AppModel', 'Model');
/**
 * Radiotaxi Model
 *
 */
class Radiotaxi extends AppModel {

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
				'message' => 'Debe Ingresar la razón social'
			),
			'notUnique' => array(
				'rule' => array('razonsocialunica'),
				'message'=>'(*) La razón social ya existe'
			),
		),
		'cuit' => array(
			'decimal' => array(
				'rule' => array('decimal'),
				'message' => 'Debe Ingresar un CUIT valido'
			),
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar el CUIT'
			),
			'notUnique' => array(
				'rule' => array('cuitunico'),
				'message'=>'(*) El CUIT ingresado ya existe'
			),
		),
		'domicilio' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar el Domicilio'
			),
		),
		'telefono' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar el numero de telefono'
			),
		),
	);

	/*
	* Funcion: permite validar que el correo electrnico sea unico
	*/
	function razonsocialunica(){
		return $this->isUnique(array('name'=>$this->data['Radiotaxi']['name']));
	}

	function cuitunico(){
		return $this->isUnique(array('cuit'=>$this->data['Radiotaxi']['cuit']));
	}
}
