<?php
App::uses('AppController', 'Controller');
/**
 * Locations Controller
 *
 * @property Location $Location
 * @property PaginatorComponent $Paginator
 */
class LocationsController extends AppController {

/**
 * Components
 *
 * @var array
 */
 function retornalxmllocations($department_id){
	 $this->layout = '';
	 $locations = $this->Location->find('all',array('conditions'=>array('Location.department_id'=>$department_id),
																							 'fields'=>array('Location.id','Location.name')));
	 $this->set(compact('locations'));
 }

 /*Siempre se puede ejecutar no requiere de seguridad*/
 public function beforeFilter() {
		 parent::beforeFilter();

		 // For CakePHP 2.0
		 $this->Auth->allow('*');

		 // For CakePHP 2.1 and up
		 $this->Auth->allow();
 }

}
