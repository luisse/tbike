<?php
App::uses('AppModel', 'Model');
/**
 * Proveedore Model
 *
 * @property Product $Product
 */
class Proveedore extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'CUIT' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'El CUIT debe contener solo números'
			),
		),
		'denominacion' => array(
<<<<<<< HEAD
			'notBlank' => array(
				'rule' => array('notBlank'),
=======
			'notEmpty' => array(
				'rule' => array('notEmpty'),
>>>>>>> d1dd9254b21e573d5d9674487d0b9be918df744a
				'message' => 'Debe Ingresar la Denominación'
			),
			'maxLength' => array(
				'rule' => array('maxLength',45),
				'message' => 'La Denominación debe contener menos de 45 Catacteres'
			),
		),
		'mail' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Debe Ingresar un Correo Electrónico válido'
			),
<<<<<<< HEAD
			'notBlank' => array(
				'rule' => array('notBlank'),
=======
			'notEmpty' => array(
				'rule' => array('notEmpty'),
>>>>>>> d1dd9254b21e573d5d9674487d0b9be918df744a
				'message' => 'Debe Ingresar el Corre Electrónico'
			),
		),
		'url' => array(
			'url' => array(
				'rule' => array('url'),
				'message' => 'La Página Web no es válida'
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'proveedore_id',
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
	);

	/*
	 * Funcion: antes de guardar es importante convertir la fecha al formato Unix/Mysql
	 */
	function beforeSave($options=array())
	{
		if(!empty($this->data['Proveedore']['CUIT'])){
			$this->data['Proveedore']['CUIT'] = str_replace('.','',$this->data['Proveedore']['CUIT']);
			$this->data['Proveedore']['CUIT'] = str_replace('-','',$this->data['Proveedore']['CUIT']);
		}
		return true;
	}	
	
	function beforeValidate($options=array())
	{
		if(!empty($this->data['Proveedore']['CUIT'])){
			$this->data['Proveedore']['CUIT'] = str_replace('.','',$this->data['Proveedore']['CUIT']);
			$this->data['Proveedore']['CUIT'] = str_replace('-','',$this->data['Proveedore']['CUIT']);
		}
		return true;
	}	
		
}
