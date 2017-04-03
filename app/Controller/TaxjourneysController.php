<?php
App::uses('AppController', 'Controller');
/**
 * Taxjourneys Controller
 *
 * @property Taxjourney $Taxjourney
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TaxjourneysController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('RequestHandler');
	public $uses=array('Taxjourney','Rsesion');

	/*
	 * Function: inicializa un nuevo viaje
	 * */
	public function initjourney(){
		$error="";
		$rid='';
		if(!empty($this->request->data['key']) && !empty($this->request->data['orderid'])){
			if($this->Rsesion->SessionIsOk($this->request->data['key'])){
					//la orden debe existir en estado activo de lo contrario no hacemos nada
					$Taxorder = ClassRegistry::init('Taxorder');
					$taxorder = $Taxorder->find('first',array('conditions'=>array('Taxorder.id'=>$this->request->data['orderid'],'Taxorder.state'=>1),
																	'fields'=>array('Taxorder.id')
					));
					if(!empty($taxorder)){
						//Verificamos que no exista ya la orden asociada al viaje
						$taxjournye=$this->Taxjourney->find('count',array('conditions'=>array('Taxjourney.taxorder_id'=>$taxorder['Taxorder']['id'])));
						if(empty($taxjournye) || $taxjournye == 0){
							$data['Taxjourney']['taxorder_id']=$this->request->data['orderid'];
							$data['Taxjourney']['datejourney']=date('Y-m-d H:i:s');
							$data['Taxjourney']['state']=1;
							if(!empty($this->request->data['lat']))
								$data['Taxjourney']['init_lat']=$this->request->data['lat'];
							if(!empty($this->request->data['lng']))
								$data['Taxjourney']['init_lng']=$this->request->data['lng'];
							$this->Taxjourney->create();
							if(!$this->Taxjourney->save($data)){
								$error=__('No se pudo iniciar el viaje. Intente nuevamente');
							}else{
								$id = $this->Taxjourney->id;
								$rid = $this->data_crypt($id,false);
								$journye[$this->request->data['key']] = $rid;
							}
						}else{
							$error=__('Ya se encuentra un viaje activo.');
						}
					}else{
						$error=__('No se puede iniciar el viaje para la orden requerida.');
					}
			}
		}else{
			$error=__('Parametros no especificados correctamente');
		}
		$this->set('error',$error);
		$this->set('idjourny',$rid);
	}

	public function endjourney(){
		$rid='';
		$error='';
		if(!empty($this->request->data['key']) && !empty($this->request->data['keyjourny'])){
			if($this->Rsesion->SessionIsOk($this->request->data['key'])){
				//desencriptamos la clase usando la misma key para encryptar
				$result = $this->data_crypt($this->request->data['keyjourny'],true);
				//verificamos que no exista el turno ya actualizado
				$taxjournye=$this->Taxjourney->find('first',array('conditions'=>array('Taxjourney.id'=>$result[1],'Taxjourney.state'=>1),
																															'fields'=>array('Taxjourney.taxorder_id')
																					));
				if(!empty($taxjournye)){
					if(!empty($result[1])){
						$rid=$result[1];
						$data['Taxjourney']['id']=$result[1];
						$data['Taxjourney']['state']=2;
						$data['Taxjourney']['end_lat']=$this->request->data['lat'];
						$data['Taxjourney']['end_lng']=$this->request->data['lng'];
						if(!$this->Taxjourney->save($data)){
							$error=__('No se pudo actualizar el estado del pedido');
						}else{
							$this->_execfirebase('firebase/orders/'.$taxjournye['Taxjourney']['taxorder_id'],[''],'del');
						}
					}else{
						$error = __('No se pudo establecer un pedido correcto');
					}
				}else{
					$rid='';
					$error = __('Viaje ya Finalizado');
				}
			}
		}else{
			$error=__('Parametros no especificados correctamentesss');
		}
		$this->set('error',$error);
		$this->set('idjourny',$rid);
	}
}
