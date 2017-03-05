<?php
App::uses('AppController', 'Controller');
/**
 * Taxubications Controller
 *
 * @property Taxubication $Taxubication
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TaxubicationsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array( 'Session','RequestHandler');
	public $uses=array('Taxubication','Rsesion','Taxturn','Taxorder');

/**
 * savepoint add new point GPS to DB and replicate this data
 *
 * @throws NotFoundException
 * @param parm
 * @return void
 */
	public function savepoint(){
			$error='';
			if(!empty($this->request->data['key']) && !empty($this->request->data['lat']) && !empty($this->request->data['lng'])){
									$taxuinfo = $this->Taxubication->get_ubication($this->request->data['key']);

									if(!empty($taxuinfo)){
										$data=array();
										//if register existe only update the ubication table
										if(empty($taxuinfo[0]['taxownerscar_id']) ||
											 strlen($taxuinfo[0]['taxownerscar_id']) <= 0){
												 exit(1);
												 return;
											 }



										if(!empty($taxuinfo[0]['taxubication_id'])){
											//update
											$data['Taxubication']['id']  = $taxuinfo[0]['taxubication_id'];
											$data['Taxubication']['lat'] = $this->request->data['lat'];
											$data['Taxubication']['lng'] = $this->request->data['lng'];
											$data['Taxubication']['taxownerscar_id'] = !empty($taxuinfo[0]['taxownerscar_id']) ? $taxuinfo[0]['taxownerscar_id'] : 0;
										}else{
											//insert
											$data['Taxubication']['date']  = date('Y-m-d');
											$data['Taxubication']['state'] = 1;
											$data['Taxubication']['lat']   = $this->request->data['lat'];
											$data['Taxubication']['lng']   = $this->request->data['lng'];
											$data['Taxubication']['taxownerscar_id'] = !empty($taxuinfo[0]['taxownerscar_id']) ? $taxuinfo[0]['taxownerscar_id'] : 0;
										}
										if(!$this->Taxubication->save($data)){
												//throw new BadRequestException('No se pudo guardar la información');
												$error=__('Error al Guardar puntos GPS');
										}
									}
		}else{
				//throw new BadRequestException('Data invalid for proccess');
				$error=__('Parametros invalidos');
		}
			$this->set('error',$error);
	}

	//token request
	public function getubication(){
		$error='';
		$taxubication=array();
		if(!empty($this->request->data['key'])){
						if($this->Rsesion->SessionIsOk($this->request->data['key'])){
							$rsesions = $this->Rsesion->rsesiondata($this->request->data['key']);
							if(!empty($rsesions)){
								$taxubication = $this->Taxubication->find('first',array('conditions'=>array('Taxubication.taxownerscar_id'=>$this->request->data['id']),
																																				'fields'=>array('ST_X(gpspoint) AS lat','ST_Y(gpspoint) AS lng')));



							}
						}
		}

		$this->set(compact('taxubication'));
	}

	public function getubicationnt(){
		$error='';
		$taxubication=array();
		$taxubication = $this->Taxubication->find('first',array('conditions'=>array('Taxubication.taxownerscar_id'=>$this->request->data['id']),
																																				'fields'=>array('ST_X(gpspoint) AS lat','ST_Y(gpspoint) AS lng')));
		$this->set(compact('taxubication'));
	}

	public function getposcar(){
		$taxupositions = array();
		$error='';
		if(empty($this->error_public_token) &&
				empty($this->error_private_token) &&
				!empty($this->request->data['lat']) &&
				!empty($this->request->data['lng']) &&
				!empty($this->rsesions)){

					$taxupositions = $this->Taxorder->get_car_for_position($this->request->data['lat'],$this->request->data['lng'],3);
					if(empty($taxupositions))	throw new NotFoundException('No se encontraron datos');
		}else{
				  throw new BadRequestException('Datos invalidos para procesamiento');
					//$error = $this->errortoken();
		}
		$this->set('error',$error);
		$this->set('taxupositions',$taxupositions);
	}
}
