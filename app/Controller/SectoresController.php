<?php

class SectoresController extends AppController {
	var $uses = array('Sectore');
  public $components = array('RequestHandler');

  /*
  * Function: Get all cart on the remote DB
  */
  public function getsectores(){
    $Publickey = $this->request->header('Security-Access-PublicToken');
    $token = $this->request->header('Security-Access-Token');
    $error='';
    $cart = array();
    Configure::load('appconf');
    $securedata = Configure::read('securedata');
    //verificamos que la clave publica coincida con la clave primaria
    //print_r($this->request->data);
    if($securedata == $Publickey){
      $sectores = $this->Sectore->find('all');
    }else{
      $error = __('No se puede acceder al servicio WEB');
    }
    $this->set('error',$error);
    $this->set(compact('sectores'));
  }

  /*
  *Create new Cart
  */
  public function savesectores(){
    $Publickey = $this->request->header('Security-Access-PublicToken');
    $token = $this->request->header('Security-Access-Token');
    $error='';
    $cart = array();
    Configure::load('appconf');
    $securedata = Configure::read('securedata');
    //verificamos que la clave publica coincida con la clave primaria
    //print_r($this->request->data);
    if($securedata == $Publickey && !empty($this->request->data)){
      //si existe el id no lo ingreso
      $cantidad = $this->Sectore->find('count',array('conditions'=>array('Sectore.id'=>$this->request->data['id'])));
      if($cantidad <= 0){
        $data['Sectore']['id'] = $this->request->data['id'];
        $data['Sectore']['cod_sector'] = $this->request->data['cod_sector'];
        $data['Sectore']['nombre'] = $this->request->data['nombre'];
        if(!$this->Sectore->save($data)){
          $error = __('No se pudieron actualizar los datos');
        }
      }else{
        $error = __('Ya existe el id en la Db');
      }
    }else{
      $error = __('No se puede acceder al servicio WEB');
    }
    $this->set('error',$error);
  }
}
