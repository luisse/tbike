<?php 
App::uses('AppController', 'Controller');

class LocalidadesController extends AppController{
	var $name='Localidades';

	/*Funcion: permite retornar el xml con las provincias asociadas al país*/
	function retornalxmllocalidades($departamento_id){
		$this->layout = '';
		$this->set('localidades',$this->Localidade->find('all',array('conditions'=>
					array('Localidade.departamento_id'=>$departamento_id),
					'order'=>array('nombre'=>'asc'))));
	}
	
	public function beforeFilter(){
		// For CakePHP 2.0
		$this->Auth->allow('*');
		
		// For CakePHP 2.1 and up
		$this->Auth->allow();		
	}
}
?>	