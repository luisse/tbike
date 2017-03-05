<?php
App::uses('AuthComponent', 'Controller/Component');

class Modulo extends AppModel {
  public $name        = 'modulos';
  public $useTable    = 'modulos';
  public $primaryKey  = 'id';
  public $useDbConfig = 'dbremote';

  public function getcart(){
    $result = $this->find('all');
  }
}

?>
