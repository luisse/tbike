<?php
App::uses('AppController', 'Controller');
/**
 * senderlogs Controller
 *
 * @property Senderlog $Senderlog
 * @property PaginatorComponent $Paginator
 */
class SenderlogsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Email');
 	public $uses = array('Senderlog','Mensajeservice','Mensajesmantenimiento','Cliente','Bicicleta');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('title_for_layout','Log de Envios de Correo');
	}
	
	public function listsenderlogs(){
		$this->layout='';
		$this->Senderlog->recursive = 0;
		App::uses('CakeTime', 'Utility');
		$filtros = CakeTime::daysAsSql($this->Senderlog->formatDate($this->request->data['Senderlog']['fecdesde']),
																	$this->Senderlog->formatDate($this->request->data['Senderlog']['fechasta']),
																	'fechaenv');		
		$this->paginate=array('limit' => 10,
						'page' => 1,
						'conditions'=>array('Senderlog.tallercito_id'=>$this->Session->read('tallercito_id'),$filtros),
						'joins'=>array(array('table'=>'mensajeservices',
											'alias'=>'Mensajeservice',
											'type'=>'LEFT',
											'conditions'=>array('Mensajeservice.id = Senderlog.mensajeservice_id')),
										array('table'=>'mensajesmantenimientos',
											'alias'=>'Mensajesmantenimiento',
											'type'=>'LEFT',
											'conditions'=>array('Mensajesmantenimiento.id = Senderlog.mensajesmantenimiento_id',$filtros))
											),
						'fields'=>array('Senderlog.fechaenv,Senderlog.correoe','Senderlog.resultado','Mensajesmantenimiento.objetorevisar','Mensajesmantenimiento.observaciones',
										'Mensajeservice.detalleservice'));
		$this->set('senderlogs', $this->Paginator->paginate());
	}

/**
 * Helpers
 *
 * @var array
 */	
	var $helpers=array('Time');	
	
/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Senderlog->create();
			if ($this->Senderlog->save($this->request->data)) {
				$this->Session->setFlash(__('The Senderlog has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Senderlog could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Senderlog->exists($id)) {
			throw new NotFoundException(__('Invalid Senderlog'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Senderlog->save($this->request->data)) {
				$this->Session->setFlash(__('The Senderlog has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Senderlog could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Senderlog.' . $this->Senderlog->primaryKey => $id));
			$this->request->data = $this->Senderlog->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Senderlog->id = $id;
		if (!$this->Senderlog->exists()) {
			throw new NotFoundException(__('Invalid Senderlog'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Senderlog->delete()) {
			$this->Session->setFlash(__('The Senderlog has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Senderlog could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function beforeFilter() {
    		parent::beforeFilter();
		    $this->Auth->allow('*');
		    // For CakePHP 2.1 and up
		    $this->Auth->allow();    		
    		// For CakePHP 2.1 and up
    		//$this->Auth->allow();
	}

	public function Sendallmsj(){
		$this->layout='';
		//Recuperamos todos los mensajes para la fecha
		$fechaactual = date('Y-m-d');
		$mensajesmantenimientos = $this->Mensajesmantenimiento->find('all',array('conditions'=>array('Mensajesmantenimiento.fechacontrol'=>$fechaactual,
																									'Mensajesmantenimiento.enviarcorreo'=>1,
																									'Mensajesmantenimiento.tallercito_id'=>$this->Session->read('tallercito_id'))));
																									
		$mensajeservices = $this->Mensajeservice->find('all',array('conditions'=>array('Mensajeservice.fechaaprox'=>$fechaactual,
																						'Mensajeservice.enviarcorreo'=>1,
																						'Mensajeservice.confirmadocliente'=>0,
																						'Mensajeservice.cantmensajes > 0',
																						'Mensajeservice.tallercito_id'=>$this->Session->read('tallercito_id'))));
		/*
		* struct sender email,mensaje,user sys
		*/
		$i=0;
		//print_r($mensajesmantenimientos);
		foreach($mensajesmantenimientos as $mensajesmantenimiento){
			$bicicleta = $this->Bicicleta->find('first',array('conditions'=>array('Bicicleta.id'=>$mensajesmantenimiento['Mensajesmantenimiento']['bicicleta_id'])));
			if(!empty($bicicleta)){
				//echo 'Mensajes de mantenimiento OK';
				$str_to_send[$i]['msg']	=  $mensajesmantenimiento['Mensajesmantenimiento']['objetorevisar'].' - '.$mensajesmantenimiento['Mensajesmantenimiento']['observaciones'];
				$cliente = $this->Cliente->find('first',array('conditions'=>array('Cliente.id'=>$bicicleta['Bicicleta']['cliente_id'])));
				if(!empty($cliente)){
					$str_to_send[$i]['user_id'] = $cliente['User']['id'];
					$str_to_send[$i]['email']=$cliente['User']['email'];;
				}else{
					$str_to_send[$i]['user_id']=0;
					$str_to_send[$i]['email']='';
				}

				$str_to_send[$i]['mensajesmantenimiento_id']=$mensajesmantenimiento['Mensajesmantenimiento']['id'];
				$str_to_send[$i]['mensajeservice_id']=0;				
				$i++;
			}
		}

		foreach($mensajeservices as $mensajeservice){
			$bicicleta = $this->Bicicleta->find('first',array('conditions'=>array('Bicicleta.id'=>$mensajeservice['Mensajeservice']['bicicleta_id'])));
			if(!empty($bicicleta)){
				$str_to_send[$i]['msg']	=  $mensajeservice['Mensajeservice']['detalleservice'];
				$cliente = $this->Cliente->find('first',array('conditions'=>array('Cliente.id'=>$bicicleta['Bicicleta']['cliente_id'])));
				//print_r($cliente);
				if(!empty($cliente)){
					$str_to_send[$i]['user_id'] = $cliente['User']['id'];
					$str_to_send[$i]['email']=$cliente['User']['email'];;
				}else{
					$str_to_send[$i]['email']='';
				}
				$str_to_send[$i]['mensajeservice_id']=$mensajeservice['Mensajeservice']['id'];	
				$str_to_send[$i]['cantmensajes']=$mensajeservice['Mensajeservice']['cantmensajes'];	
				$str_to_send[$i]['mensajesmantenimiento_id']=0;
				$i++;				
			}
		}
		$tallercito = $this->Session->read('tallercito');
		$error='';
		if(!empty($str_to_send)){
			
			foreach($str_to_send as $str_send){
				//enviamos todos los correos
				if($str_send['user_id']>0){
					App::uses('CakeEmail', 'Network/Email');
					$error='';
					$resultado=0;
					$Email = new CakeEmail('smtp');
					try{
						$Email->to($str_send['email']);
						$Email->subject('Mensaje de '.$tallercito['Tallercito']['razonsocial']);
						try{
							$Email->send($str_send['msg']);
							$resultado = 1;
						}catch(SocketException $e){
							$error = $e->getMessage();
							$resultado = 0;
						}
					}catch(SocketException $e){
							$error = $e->getMessage();
							$resultado = 0;			
					}
					
					$this->request->data['Senderlog']['fechaenv']=date('Y-m-d H:i:s');
					$this->request->data['Senderlog']['mensajeservice_id']=$str_send['mensajeservice_id'];
					$this->request->data['Senderlog']['mensajesmantenimiento_id']=$str_send['mensajesmantenimiento_id'];
					$this->request->data['Senderlog']['correoe']=$str_send['email'];
					$this->request->data['Senderlog']['resultado']=$resultado;
					$this->request->data['Senderlog']['mensajeerror']=$error;
					$this->request->data['Senderlog']['tallercito_id']=$this->Session->read('tallercito_id');
					$this->request->data['Senderlog']['user_id']=$str_send['user_id'];
					
					$this->Senderlog->create();
					if (!$this->Senderlog->save($this->request->data)) {
						$error = 'Error en Guardado de Datos de Log';
						exit;
					}else{
						//actualizo estado de mensajemantenimiento
						if($str_send['mensajesmantenimiento_id']>0){
							$mensajemantenimiento['Mensajesmantenimiento']['id']=$str_send['mensajesmantenimiento_id'];
							$mensajemantenimiento['Mensajesmantenimiento']['enviarcorreo']=0;
							$this->Mensajesmantenimiento->Save($mensajemantenimiento);
						}
						//actualizo cantidad de mensajes enviados
						if($str_send['mensajeservice_id']>0){
							$mensajesservices['Mensajeservice']['id']=$str_send['mensajeservice_id'];
							$mensajesservices['Mensajeservice']['cantmensajes']=$str_send['cantmensajes'] - 1;
							$this->Mensajeservice->Save($mensajesservices);
						}
					}			
				}
			}
		}
		$this->set('error',$error);
	}
	
/**
 * maxdateprocesada method
 * Retorna la ultima fecha desde que se envió el correosi detecta que se paso mas de una hora retorna 1 caso contrario 0
 * @throws NotFoundException
 * @return void
 */
	function maxdateprocesada(){
		$this->layout='';
		//mintos pasados desde el último envio de datos
		$senderlogs = $this->Senderlog->find('first',array('fields'=>array('(TIMESTAMPDIFF(SECOND,Senderlog.fechaenv,now()) % 86400) DIV 60 AS Minutos'),
														'order'=>'Senderlog.fechaenv DESC'));
		$tiempopas=0;
		//print_r($senderlogs);
		if($senderlogs[0]['Minutos'] < 0)$senderlogs[0]['Minutos'] = $senderlogs[0]['Minutos']*-1;
		if($senderlogs[0]['Minutos'] > 60) $tiempopas=1;
		
		$this->set('tiempopas',$tiempopas);													
		
	}

}
