<?php
App::uses('AppController', 'Controller');
/**
 * Provinces Controller
 *
 * @property Province $Province
 * @property PaginatorComponent $Paginator
 */
class ProvincesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	function retornalxmlprovinces($countrie_id){
		$this->layout = '';
		$provinces = $this->Province->find('all',array('conditions'=>array('Province.countrie_id'=>$countrie_id),
																								'fields'=>array('Province.id','Province.name')));
		$this->set(compact('provinces'));
	}

	/*Siempre se puede ejecutar no requiere de seguridad*/
	public function beforeFilter() {
			//parent::beforeFilter();

			// For CakePHP 2.0
			$this->Auth->allow('*');

			// For CakePHP 2.1 and up
			$this->Auth->allow();
	}

}
