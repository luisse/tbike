<?php
App::uses('AppModel', 'Model');
/**
 * Localidade Model
 *
 * @property Provincia $Provincia
 */
class Localidade extends AppModel {
	var $name = 'Localidade';

	/*
	 * Funcion: permite retornar todas las localidades para el departamento indicado
	 * */
	function retornarlocalidades($departamento_id = null){
		return $this->find('list',
				array('fields'=>array('Localidade.id','Localidade.nombre'),
				'conditions'=>array('Localidade.departamento_id'=>$departamento_id)));
	}
}
?>