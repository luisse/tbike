<?php
App::uses('AppModel', 'Model');
/**
 * Typeproduct Model
 *
 * @property User $User
 * @property Provincia $Provincia
 * @property Departamento $Departamento
 * @property Localidade $Localidade
 */

class Rubro extends AppModel {
/**
 * Validation rules
 *
 * @var array
 */
	var $validate = array(
		'id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Debe Ingresar solo valores numericos para el id',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'descripcion' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar la descripcion',
				'allowEmpty' => true,
				'last' => true 
			),
			'unico'=>array(
						'rule'=>'isUnique',
						'message'=>'Ya Existe el Rubro con la descripción Especificada')
		),
		'sintetico' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar el sintetico'
			),
		),
		'estado' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'El estado debe ser un valor tipo número'
			),
		),
		'negocios_id' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar el Negocio'
			),
		),
	);
	
	/*
	 * Funcion: permite retornar todos los rubros para el negocio especificado
	 * */
	function retornarubro($negocio_id = null){
		return $this->find('list',
				array('fields'=>array('Rubro.id','Rubro.descripcion'),
				'order'=>array('Rubro.descripcion'),
				'condition'=>array('Rubro.negocio_id'=>$negocio_id,'Rubro.estado'=>'1')));
	}
	
	
}
?>
