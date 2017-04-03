<?php
App::uses('AppController', 'Controller');
/**
 * Provinces Controller
 *
 * @property Province $Province
 * @property PaginatorComponent $Paginator
 */
class CarmodelsController extends AppController {

/**
 * Components
 *
 * @var array
 */

	function getmodels($brandcar_id = null){
		$this->layout = '';
		$carmodels = $this->Carmodel->find('all',array('conditions'=>array('Carmodel.brandcar_id'=>$brandcar_id),
																								'fields'=>array('Carmodel.id','Carmodel.name'),
                                                'order'=>array('Carmodel.name ASC') ));
		$this->set(compact('carmodels'));
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
