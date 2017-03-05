<?php
App::uses('AuthComponent', 'Controller/Component');

class Parte extends AppModel {
  public $name        = 'partes';
  public $useTable    = 'partes';
  public $primaryKey  = 'id';
  public $useDbConfig = 'dbremote';

  public function getcart(){
    $result = $this->find('all');
  }
}

?>
