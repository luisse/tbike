<?php
App::uses('AppController', 'Controller');
/**
 * Contacts Controller
 *
 * @property Contact $Contact
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class RsesionsController extends AppController {

  public $components = array('RequestHandler');
	public $uses=array('Rsesion');

  /*
  *Function: proccess to update the sessión state
  */
  public function changestate(){
    $taxorders=array();
    $error='';
    $state=0;
    if(empty($this->error_public_token) &&
        empty($this->error_private_token) &&
        !empty($this->rsesions)){
          $state = 1;
          if($this->rsesions['Rsesion']['state'] == 1) $state = 2;
          $rsesions['Rsesion']['id'] = $this->rsesions['Rsesion']['id'];
          $rsesions['Rsesion']['state'] = $state;
          $this->Rsesion->create();
          $this->Rsesion->save($rsesions);
    }else{
			$error = $this->errortoken();
    }
    $this->set('error',$error);
    $this->set('state',$state);
  }

  public	function beforeFilter(){
    parent::beforeFilter();
  }
}

?>
