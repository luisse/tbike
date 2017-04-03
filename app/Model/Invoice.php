<?php
App::uses('AuthComponent', 'Controller/Component');

class Invoice extends AppModel {
  public $name        = 'Invoice';
  public $useTable    = 'invoice';
  public $primaryKey  = 'id';
  public $useDbConfig = 'dbremote';

  /**
   * belongsTo associations
   *
   * @var array
   */
  	public $hasMany = array(
  		'InvoiceProduct' => array(
  			'className' => 'InvoiceProduct',
  			'foreignKey' => 'id_invoice',
  			//'conditions' => array('InvoiceProduct.id_invoice = Invoice.id'),
  			'fields' => '',
  			'order' => ''
  		)
    );


  public function getInvoice($id = null){
    if(!empty($id)){
      $setdata = array('conditions'=>array('Invoice.id'=>$id));
    }
    return $this->find('all',$setdata);
  }
}
