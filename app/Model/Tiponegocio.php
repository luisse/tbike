<?php
App::uses('AppModel', 'Model');
/**
 * Tiponegocio Model
 *
 * @property User $User
 * @property Provincia $Provincia
 * @property Departamento $Departamento
 * @property Localidade $Localidade
 */

class Tiponegocio extends AppModel{

	/*
	 * Funcion: permite retornar todas las provincias para su procesamiento
	 * */
	function retornartiponegocio(){
		$provincias = $this->find('list',
							array('fields'=>array('Tiponegocio.id','Tiponegocio.descripcion')));
		return $provincias;
	}
	
}