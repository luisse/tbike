<?php
App::uses('AppController', 'Controller');
/**
 * Gpspoints Controller
 *
 * @property Gpspoint $Gpspoint
 * @property PaginatorComponent $Paginator
 */
class GpspointsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('RequestHandler');

	public function savegps(){
		$this->layout='';
		$error='';

		if(!empty($this->request->query)){
			if(!empty($this->request->query['lat']))
				$latitude=$this->request->query['lat'];
			if(!empty($this->request->query['lng']))
				$longitude=$this->request->query['lng'];
		}
		if(!empty($latitude) && !empty($longitude) && is_numeric($latitude) && is_numeric($longitude)){
			//$db = ConnectionManager::getDataSource($this->useDbConfig);
			$this->request->data['Gpspoint']['lat']=$latitude;
			$this->request->data['Gpspoint']['lon']=$longitude;
			//$this->request->data['Gpspoint']['gpspoint'] = (object) $db->expression("GeomFromText('POINT(" .$latitude . " " . $longitude . ")')");
			$this->request->data['Gpspoint']['intensity'] = 1;
			if(!$this->Gpspoint->save($this->request->data)){
				$error= __('No Save Point GPS');
			}
		}else{
			$error=__('No Point Gps To Save or Point no is a number');
		}
		$this->set('error',$error);
	}

	public function returnallgpspoint(){
		$this->layout='';
		$gpspoints = $this->Gpspoint->find('all',array('conditions'=>array(''),
																								'fields'=>array('ST_X(gpspoint)','ST_Y(gpspoint)')
																			));
		$this->set(compact('gpspoints'));

	}

	public function returnpointonly($km = null,$lat = null,$lng = null){
		$gpspoints=array();
		//print_r($this->request->query);
		if(!empty($this->request->query)){
			$km		=$this->request->query['km'];
			$lat	=$this->request->query['lat'];
			$lng	=$this->request->query['lng'];
		}
		if(!empty($km)){
			$gpspoints = $this->Gpspoint->find('all',array('conditions'=>array("ST_Distance_Sphere(gpspoint,ST_GeomFromText('POINT(".$lat." ".$lng.")', 4326))/1000 <".$km),
																									'fields'=>array('ST_X(gpspoint)','ST_Y(gpspoint)')
																				));
		}
		$this->set('gpspoints',$gpspoints);
	}

	function beforeFilter(){
			parent::beforeFilter();
			// For CakePHP 2.0
			$this->Auth->allow('*');
			// For CakePHP 2.1 and up
			$this->Auth->allow();
	}

}
