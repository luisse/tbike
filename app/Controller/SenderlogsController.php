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
	public $components = array('Paginator','Email','RequestHandler');
 	public $uses = array('Senderlog','Mensaje','User');
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
						'joins'=>array(array('table'=>'mensajes',
											'alias'=>'Mensaje',
											'type'=>'LEFT',
											'conditions'=>array('Mensaje.id = Senderlog.mensaje_id'))),
						'fields'=>array('Senderlog.fechaenv,Senderlog.correoe','Senderlog.resultado','Mensaje.asunto','Mensaje.detalle'));
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
		    $this->Auth->allow();
	}

/**
 * sendallmsj method enviar correos electronicos masivos
 *
 * @throws NotFoundException
 * @param string $mensaje_id permite enviar un mensaje de lo contrario envía todos los mensajes para la fecha actual
 * @return void
 */
	public function sendallmsj($mensaje_id = null){
		App::uses('CakeEmail', 'Network/Email');
		$this->layout='';
		//Recuperamos todos los mensajes para la fecha
		$filter_send='1=1';

		if(!empty($mensaje_id)){
			$filter_send = 'Mensaje.id ='.$mensaje_id;
		}else{
			$filter_send = 'Mensaje.fechasendauto = "'.date('Y-m-d').'" AND Mensaje.mailauto = 1';
		}
		$mensajes=$this->Mensaje->find('all',array('conditions'=>array($filter_send,
																		'Mensaje.tallercito_id'=>$this->Session->read('tallercito_id'),
																		'Mensaje.enviado = 0 OR Mensaje.enviado IS NULL'),
										'fields'=>array('Mensaje.bicicleta_id','Mensaje.asunto','Mensaje.detalle','Mensaje.id','Tipomen.descripcion',
														'Mensaje.userrec_id')
		));

		/*
		* struct sender email,mensaje,user sys
		*/
		$i=0;
		foreach($mensajes as $mensaje){
				$str_to_send[$i]['msgcab']		=	$mensaje['Mensaje']['asunto'];
				$str_to_send[$i]['msgdetalle']	=	$mensaje['Mensaje']['detalle'];
				$str_to_send[$i]['tipomen']		=	$mensaje['Tipomen']['descripcion'];

				$user = $this->User->find('first',array('conditions'=>array('User.id'=>$mensaje['Mensaje']['userrec_id']),
															'fields'=>array('User.email','User.id')));
				if(!empty($user)){
					$str_to_send[$i]['user_id'] =$user['User']['id'];
					$str_to_send[$i]['email']	=$user['User']['email'];;
				}else{
					$str_to_send[$i]['user_id']=0;
					$str_to_send[$i]['email']='';
				}

				$str_to_send[$i]['mensaje_id']=$mensaje['Mensaje']['id'];
				$i++;
		}

		$tallercito = $this->Session->read('tallercito');
		$error='';

		try{
			$Email = new CakeEmail('smtp');
		}catch(SocketException $e){
			$error = $e->getMessage();

		}
		if(!empty($str_to_send) && empty($error)){

			foreach($str_to_send as $str_send){
				//enviamos todos los correos
				if($str_send['user_id']>0){
					$error='';
					$resultado=0;
					try{
						$Email->to($str_send['email'])->emailFormat('html');
						$Email->subject($tallercito['Tallercito']['razonsocial'].':'.$str_send['msgcab']);
						try{
							$Email->send($str_send['msgdetalle']);
							$resultado = 1;
						}catch(SocketException $e){
							$error = $e->getMessage();
							$resultado = 0;
						}
					}catch(SocketException $e){
							$error = $e->getMessage();
							$resultado = 0;
					}

					$this->request->data['Senderlog']['fechaenv']	=date('Y-m-d H:i:s');
					$this->request->data['Senderlog']['mensaje_id']	=$str_send['mensaje_id'];
					$this->request->data['Senderlog']['correoe']	=$str_send['email'];
					$this->request->data['Senderlog']['resultado']	=$resultado;
					$this->request->data['Senderlog']['mensajeerror']=$error;
					$this->request->data['Senderlog']['tallercito_id']=$this->Session->read('tallercito_id');
					$this->request->data['Senderlog']['user_id']	=$str_send['user_id'];

					$this->Senderlog->create();
					if (!$this->Senderlog->save($this->request->data)) {
						$error = 'Error en Guardado de Datos de Log';
						exit;
					}else{
						if(empty($error)){
							//actualizo estado de mensaje con enviado
							if($str_send['mensaje_id']>0){
								$mensajemantenimiento['Mensaje']['id']=$str_send['mensaje_id'];
								$mensajemantenimiento['Mensaje']['enviado']=1;
								$mensajemantenimiento['Mensaje']['fechasend']=date('Y-m-d');
								$this->Mensaje->create();
								$this->Mensaje->Save($mensajemantenimiento);
							}
						}
					}
				}
			}
		}
		$this->set('error',$error);
	}

/**
 * maxdateprocesada method
 * Retorna la ultima fecha desde que se envió el correo si detecta que se paso mas de una hora retorna 1 caso contrario 0
 * @throws NotFoundException
 * @return void
 */
	function maxdateprocesada(){
		$this->layout='';
		//mintos pasados desde el último envio de datos
		$senderlogs = $this->Senderlog->find('first',array('fields'=>array('(TIMESTAMPDIFF(SECOND,Senderlog.fechaenv,now()) % 86400) DIV 60 AS Minutos'),
														'order'=>'Senderlog.fechaenv DESC'));
		$tiempopas=0;
		if($senderlogs[0]['Minutos'] < 0)$senderlogs[0]['Minutos'] = $senderlogs[0]['Minutos']*-1;
		if($senderlogs[0]['Minutos'] > 60) $tiempopas=1;
		$tiempopas=1;
		$this->set('tiempopas',$tiempopas);

	}

	public function sendmsg(){
		$this->layout = '';
		$cod_error = 0;
		App::uses('CakeEmail', 'Network/Email');
		try{
			$Email = new CakeEmail('smtp');
		}catch(SocketException $e){
			$cod_error = 1;
			$error = $e->getMessage();
		}

		if(empty($this->request->query['name']))
			$error = __('Debe Ingresar su nombre');
		if(empty($this->request->query['surname']))
			$error = __('Debe Ingresar su apellido');
		if(empty($this->request->query['email']))
				$error = __('Debe Ingresar su email');
		if(empty($this->request->query['message']))
				$error = __('Debe Ingresar su consulta');

		if(empty($error)){
			try{
				$Email->to('administrador@tallercitobike.esy.es')->emailFormat('html');
				$Email->subject('Consulta de Producto...');
				try{
					$Email->send($this->request->query['name'].'<br>'.$this->request->query['surname'].'<br>'.$this->request->query['email'].'<br>'.$this->request->query['message']);
					$error = 'Correo Electronico Enviado';
				}catch(SocketException $e){
					$cod_error = 1;
					$error = $e->getMessage();
				}
			}catch(SocketException $e){
					$cod_error = 1;
					$error = $e->getMessage();
			}
		}else{
			$cod_error = 1;
		}
		$this->set('error',$error);
		$this->set('cod_error',$cod_error);
	}

}
