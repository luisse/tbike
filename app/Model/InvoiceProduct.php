<?php
App::uses('AuthComponent', 'Controller/Component');

class InvoiceProduct extends AppModel {
  public $name        = 'InvoiceProduct';
  public $useTable    = 'invoice_products';
  public $primaryKey  = 'id';
  public $useDbConfig = 'dbremote';

}
