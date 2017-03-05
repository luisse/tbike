<?php
App::uses('AppModel', 'Model');
/**
 * Provincia Model
 *
 * @property Provincia $Provincia
 */
class Provincia extends AppModel {
	/*
	 * Funcion: permite retornar todas las provincias para su procesamiento
	 * */
	function retornarprovincias(){
		$provincias = $this->find('list',
							array('fields'=>array('Provincia.id','Provincia.nombre')));
		return $provincias;
	}
}
?>