<?php
/**
 * Departamento Model
 *
 * @property Provincia $Provincia
 */
class Departamento extends AppModel {
	var $name = 'Departamento';

	/*
	 * Funcion: permite retornar los departamentos para la provincia indicada
	 * */
	function retornardepartemtos($provincia_id = null){
		return $this->find('list',
					array('fields'=>array('Departamento.id','Departamento.nombre'),
					'conditions'=>array('Departamento.provincia_id'=>$provincia_id)));	
	}
}
?>