<?php
App::uses('AppController', 'Controller');
/**
 * Contacts Controller
 *
 * @property Contact $Contact
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class KpisController extends AppController {
  public $components = array('RequestHandler');
  public $uses=array('Kpi');

  public function kpis(){
    $jkpi=array();
    if(empty($this->request->data['status'])) $this->request->data['status'] ='';
    $date = date('Y-m-d H:m');
    $kpies = $this->Kpi->getkpi($date,$this->request->data['status']);
    foreach($kpies as $kpi){
      $jkpi[]=$kpi[0];
    }
    $this->set(compact('jkpi'));
  }

  public function kpis_count(){
    $radiotaxi_id = empty($this->Session->read('radiotaxi_id')) ? 0 : $this->Session->read('radiotaxi_id');
    if(empty($this->request->data['status'])) $this->request->data['status'] ='';
		$is_test = $this->request->query['is_test'] == 1 ? 'true' : 'false';
    $date = date('Y-m-d h:m');



    $kpi_libre_list = $this->Kpi->kpinow('Libre', $is_test, $radiotaxi_id);
    $kpi_libre = count($kpi_libre_list );

    $kpi_ocupado_list = $this->Kpi->kpinow('Ocupado', $is_test, $radiotaxi_id);
    $kpi_ocupado = count($kpi_ocupado_list);

    $kpi_en_camino_list = $this->Kpi->kpinow('En camino', $is_test, $radiotaxi_id);
    $kpi_en_camino = count($kpi_en_camino_list);

    $kpi_fuera_servicio_list = $this->Kpi->kpinow('Fuera de servicio',$is_test, $radiotaxi_id);
    $kpi_fuera_servicio = count($kpi_fuera_servicio_list);

    $kpi_libre_json = array();
   foreach($kpi_libre_list as $kpi_libre_get){
      $kpi_libre_json[]=$kpi_libre_get[0];
    }

    $kpi_ocupado_json = array();
    foreach($kpi_ocupado_list as $kpi_ocupado_get){
      $kpi_ocupado_json[]=$kpi_ocupado_get[0];
    }

    $kpi_en_camino_json = array();
    foreach($kpi_en_camino_list as $kpi_en_camino_get){
      $kpi_en_camino_json[]=$kpi_en_camino_get[0];
    }

    $kpi_fuera_servicio_json = array();
    foreach($kpi_fuera_servicio_list as $kpi_fuera_servicio_get){
      $kpi_fuera_servicio_json[]=$kpi_fuera_servicio_get[0];
    }

    $this->set(compact('kpi_libre_json','kpi_ocupado_json','kpi_en_camino_json','kpi_fuera_servicio_json'));
    $this->set('kpi_libre',$kpi_libre);
    $this->set('kpi_ocupado',$kpi_ocupado);
    $this->set('kpi_en_camino',$kpi_en_camino);
    $this->set('kpi_fuera_servicio',$kpi_fuera_servicio);
  }

  public function getorders(){
    $jorders=array();
    $desde = $this->request->query['fecha_desde'];
    $hasta = $this->request->query['fecha_hasta'];


    if(empty($desde)) {
      $desde = date('Y-m-d');
    }

    if(empty($hasta)) {
      $hasta = date('Y-m-d');
    }


    $orders = $this->Kpi->getOrders($desde,$hasta);
    foreach($orders as $order){
      $jorders[]=$order[0];
    }
    $this->set(compact('jorders'));
  }


  //ALL HACK THIS FUNCTION ;-)
  public function beforeFilter(){
    $this->Auth->allow('*');
    // For CakePHP 2.1 and up
    $this->Auth->allow();
  }


}
