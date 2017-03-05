<?php
App::uses('AppModel', 'Model');
/**
 * Tallercito Model
 *
 * @property User $User
 * @property Provincia $Provincia
 * @property Departamento $Departamento
 * @property Localidade $Localidade
 */
class Tallercito extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'CUIT' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'EL CUIT DEBEN SER SOLO NUMEROS'
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar el CUIT'
			),
		),
		'razonsocial' => array(
			'maxLength' => array(
				'rule' => array('maxLength',60),
				'message' => 'La Razon Social no debe sobrepasar los 60 Caracteres'
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar la Razon Social'
			),
		),
		'direccion' => array(
			'maxLength' => array(
				'rule' => array('maxLength',60),
				'message' => 'Debe Ingresar la Direccion'
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar la Direccion'
			),
		),
		'telefono' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar el Telefono'
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Debe Ingresar un Email correcto'
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar el Correo Electrónico'
			),
		),
		'webpage' => array(
			'url' => array(
				'rule' => array('url'),
				'message' => 'La Página Web no es correcta'
			),
		),
		'provincia_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Seleccionar la Provincia'
			),
		),
		'departamento_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Seleccionar el Departamento'
			),
		),
		'localidade_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Seleccionar la Localidad'
			),
		),
		'logotallercito' => array(
			/***'extensiones' => array(
				'rule' =>array('extension',array('jpg','jpeg')),
				'message' => 'Solo se permiten imagenes en jpg.'
			),
			'size' =>array(
				'rule' => array('fileSize', '<=', '1MB'),
		        'message' => 'La Imagen debe tener menos de 1MB'			
			)***/
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Provincia' => array(
			'className' => 'Provincia',
			'foreignKey' => 'provincia_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Departamento' => array(
			'className' => 'Departamento',
			'foreignKey' => 'departamento_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Localidade' => array(
			'className' => 'Localidade',
			'foreignKey' => 'localidade_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function beforeSave($options=array()){
		$this->data['Tallercito']['CUIT'] = str_replace('-','',$this->data['Tallercito']['CUIT']);
		$this->data['Tallercito']['CUIT'] = str_replace('.','',$this->data['Tallercito']['CUIT']);
	}
	
	function beforeValidate($options=array()){
		$this->data['Tallercito']['CUIT'] = str_replace('-','',$this->data['Tallercito']['CUIT']);
		$this->data['Tallercito']['CUIT'] = str_replace('.','',$this->data['Tallercito']['CUIT']);
	}
}
