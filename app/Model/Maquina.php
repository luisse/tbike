<?php
App::uses('AuthComponent', 'Controller/Component');

class Maquina extends AppModel {
  public $name        = 'maquinas';
  public $useTable    = 'maquinas';
  public $primaryKey  = 'id';
  public $useDbConfig = 'dbremote';

  public function getcart(){
    $result = $this->find('all');
  }
}

?>
