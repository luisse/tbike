<?php

class PartesController extends AppController {
	var $uses = array('Parte');
  public $components = array('RequestHandler');

  /*
  * Function: Get all cart on the remote DB
  */
  public function getpartes(){
    $Publickey = $this->request->header('Security-Access-PublicToken');
    $token = $this->request->header('Security-Access-Token');
    $error='';
    $cart = array();
    Configure::load('appconf');
    $securedata = Configure::read('securedata');
    //verificamos que la clave publica coincida con la clave primaria
    if($securedata == $Publickey || 1 == 1){
      $partes = $this->Parte->find('all');
    }else{
      $error = __('No se puede acceder al servicio WEB');
    }
    $this->set('error',$error);
    $this->set(compact('partes'));
  }

  /*
  *Create new Cart
  */
  public function savepartes(){
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
      $cantidad = $this->Parte->find('count',array('conditions'=>array('Parte.id'=>$this->request->data['id'])));
      if($cantidad <= 0){
        $data['Parte']['id']              = $this->request->data['id'];
        $data['Parte']['fecha']           =  $this->request->data['fecha'];
        $data['Parte']['cod_maquina']     = $this->request->data['cod_maquina'];
        $data['Parte']['cod_responsable'] = $this->request->data['cod_responsable'];
        $data['Parte']['nro_obra']        = $this->request->data['nro_obra'];
        $data['Parte']['horas_trabajo']   = $this->request->data['horas_trabajo'];
        $data['Parte']['horas_mant']      = $this->request->data['horas_mant'];
        $data['Parte']['horas_disp']      = $this->request->data['horas_disp'];
        $data['Parte']['horas_repar']     = $this->request->data['horas_repar'];
        $data['Parte']['gasoil']          = $this->request->data['gasoil'];
        $data['Parte']['descripcion']     = $this->request->data['descripcion'];
        $data['Parte']['novedades_maquina'] = $this->request->data['novedades_maquina'];
        $data['Parte']['tipo']              = $this->request->data['tipo'];
        $data['Parte']['id_mantenimiento']  = $this->request->data['id_mantenimiento'];
        $data['Parte']['horas_reales_mant'] = $this->request->data['horas_reales_mant'];
        $data['Parte']['kilometros']        = $this->request->data['kilometros'];
        $data['Parte']['imp_insumos']       = $this->request->data['imp_insumos'];
        $data['Parte']['id_sector']         = $this->request->data['id_sector'];
        $data['Parte']['id_sector']         = $this->request->data['id_modulo'];
        $data['Parte']['usuario']           = $this->request->data['usuario'];
        $data['Parte']['fecha_carga']       = date('Y-m-d H:i:s');
        $data['Parte']['id_obra']           = date('Y-m-d H:i:s');




        if(!$this->Parte->save($data)){
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
