<?php
App::uses('AppModel', 'Model');
/**
 * Subtypeproduct Model
 *
 * @property User $User
 * @property Provincia $Provincia
 * @property Departamento $Departamento
 * @property Localidade $Localidade
 */

class Subtypeproduct extends AppModel {
/**
 * Validation rules
 *
 * @var array
 */
	
	var $validate = array(
		'descripction' => array(
<<<<<<< HEAD
			'notBlank' => array(
				'rule' => array('notBlank'),
=======
			'notempty' => array(
				'rule' => array('notempty'),
>>>>>>> d1dd9254b21e573d5d9674487d0b9be918df744a
				'message' => 'Debe Ingresar una Descripción',
				'required' => true
			),
			'esunico'=>array('rule'=>'subtypeunique','message'=>'Ya existe el subtipo ingresado')
		),
		'est' => array(
			'numeric' => array(
				'rule' => array('numeric')
			),
		),
		'tiponegocio_id' => array(
<<<<<<< HEAD
			'notBlank' => array(
				'rule' => array('notBlank'),
=======
			'notempty' => array(
				'rule' => array('notempty'),
>>>>>>> d1dd9254b21e573d5d9674487d0b9be918df744a
				'message' => 'No se encontro el tipo de Negocio',
			),
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
	);
	
	/*
	 * Funcion:Determinamos que no exista un subtipo ya ingresado
	 * */
	function subtypeunique(){
				return $this->isUnique(array('descripction'=>$this->data['Subtypeproduct']['descripction']));
	}
	
	/*
	 * Funcion: permite retornar todas los subtypos para el departamento indicado
	 * */
	function retornarsubtypeproduct(){
		return $this->find('list',
				array('fields'=>array('Subtypeproduct.id','Subtypeproduct.descripction'),
				'order'=>array('Subtypeproduct.descripction')));
	}
}
?>