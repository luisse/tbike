<?php
App::uses('AppController', 'Controller');
/**
 * Licences Controller
 *
 * @property Licence $Licence
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class LicencesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('RequestHandler');




	function beforeFilter(){
		parent::beforeFilter();
		// For CakePHP 2.0
		$this->Auth->allow('*');

		// For CakePHP 2.1 and up
		$this->Auth->allow();
	}

	public function existlicence(){
		$licence=array();
		if(!empty($this->request->data['licence'])){
			$licence = $this->Licence->find('first',array('conditions'=>array('Licence.licence'=>$this->request->data['licence'])));
		}
		$this->set(compact('licence'));
	}
}
