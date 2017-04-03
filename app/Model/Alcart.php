<?php
App::uses('AuthComponent', 'Controller/Component');

class Alcart extends AppModel {
  public $name        = 'Alcarts';
  public $useTable    = 'cart';
  public $primaryKey  = 'id';
  public $useDbConfig = 'dbremote';

  public function getcart(){
    $result = $this->find('all');
  }
}
