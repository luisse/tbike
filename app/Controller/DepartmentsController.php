<?php
App::uses('AppController', 'Controller');
/**
 * Departments Controller
 *
 * @property Department $Department
 * @property PaginatorComponent $Paginator
 */
class DepartmentsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	function retornalxmldepartments($province_id){
		$this->layout = '';
		$departments = $this->Department->find('all',array('conditions'=>array('Department.province_id'=>$province_id),
																								'fields'=>array('Department.id','Department.name')));
		$this->set(compact('departments'));
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
