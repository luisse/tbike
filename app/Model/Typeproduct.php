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

class Typeproduct extends AppModel {
	var $displayField = 'id';
/**
 * Validation rules
 *
 * @var array
 */
	
	var $validate = array(
		'descripction' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar la Descripción del tipo de producto',
				'required' => true
			),
			'esunico'=>array('rule'=>'userunique',
						'message'=>'(*) El tipo de producto ya existe')
		),
		'est' => array(
			'numeric' => array(
				'rule' => array('numeric')
			)
		)
	);
	
	/*
	 * Funcion: Permite validar si el tipo de producto que se quiere dar de alta ya existe
	 */
	
	function userunique($data){
		return $this->isUnique(array('descripction'=>$this->data['Typeproduct']['descripction']));
	}

	/*
	 * Funcion: permite retornar todas los subtypos para el departamento indicado
	 * */
	function retornartypeproduct(){
		return $this->find('list',
				array('fields'=>array('Typeproduct.id','Typeproduct.descripction'),
				'order'=>'Typeproduct.descripction'/*,
				'conditions'=>array('Localidade.departamento_id'=>$typeproduct_id)*/));
	}
	
}
?>
