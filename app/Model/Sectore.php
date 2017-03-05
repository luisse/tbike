<?php
App::uses('AuthComponent', 'Controller/Component');

class Sectore extends AppModel {
  public $name        = 'sectores';
  public $useTable    = 'sectores';
  public $primaryKey  = 'id';
  public $useDbConfig = 'dbremote';

  public function getcart(){
    $result = $this->find('all');
  }
}
