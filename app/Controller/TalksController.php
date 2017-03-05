<?php
App::uses('AppController', 'Controller');
/**
 * Talks Controller
 *
 * @property Talk $Talk
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TalksController extends AppController {

/**
 * Components
 *
 * @var arrayil.
 */
	public $components = array('RequestHandler');
	public $uses=array('Talk','Rsesion','Userpeople','Talkdetail');

	 public function inittalk(){
		 $error='';
		 if(empty($this->error_public_token) && empty($this->error_private_token) && !empty($this->request->data['user_contact_id']) && !empty($this->rsesions)){
						 //verificamos el el usuario tiene una sesion activa
						 $contact_session = $this->Rsesion->find('first',array('conditions'=>array('Rsesion.user_id'=>$this->request->data['user_contact_id'],'Rsesion.state = 1')));
						 if(!empty($contact_session)){
							 		$data['Talk']['user_contact_id'] = $contact_session['Rsesion']['user_id'];
									$data['Talk']['user_init_id']		 = $this->rsesions['Rsesion']['user_id'];
									$data['Talk']['state']					 = 2; //chat activo/aceptado
									$this->Talk->create();
									if(!$this->Talk->save($data)){
										$error=__('No se pudo inicializar la sesion');
									}else{
										//recuperamos el nombre para enviarlo por firebase al cliente/drivers
										$userpeple = $this->Userpeople->find('first',array('conditions'=>array('Userpeople.user_id'=>$this->rsesions['Rsesion']['user_id']),
																													'fields'=>array('People.firstname','People.secondname')));
										$talkuser[$contact_session['Rsesion']['sessionkey']]=$userpeple;
										$this->_execfirebase('talk-init',$userpeple);
									}
						 }else{
							 $error = __('El usuario al actual quiere contactar no se encuentra activo.');
						 }
		 }else{
			 $error = $this->errortoken();
		 }
		 $this->set('error',$error);
	 }

	 public function accepttalk(){
		 $error = '';
		 //verificamos que la clave publica coincida con la clave primaria
		 if(empty($this->error_public_token) &&
		 			empty($this->error_private_token) &&
					!empty($this->request->data['accept']) &&
					!empty($this->rsesions)){
						 //recuperamos la sesion talk iniciada
						 $talks = $this->Talk->find('first',array('conditions'=>array('Talk.user_contact_id'=>$this->rsesions['Rsesion']['user_id'],'Talk.state = 1'),
					 																						'order'=>array('Talk.id DESC')));
						 if(!empty($talks)){
							 $talks['Talk']['state']=$this->request->data['accept'];
							 	if(!$this->Talk->save($talks)){
									$error = __('No se pudo conectar a la sesion iniciada');
								}else{
									$contact_session = $this->Rsesion->find('first',array('conditions'=>array('Rsesion.user_id'=>$talks['Talk']['user_init_id'],'Rsesion.state = 1')));
									$session['talk_id'] = $talks['Talk']['id'];
									$sessionaccept[$contact_session['Rsesion']['sessionkey']] = $this->sessiontoken;
									$this->_execfirebase('talk-accept',$sessionaccept);
								}
						}
		 }else{
			 $error = $this->errortoken();
		 }
		 $this->set('error',$error);

	 }


	 function beforeFilter(){
		 parent::beforeFilter();
		 $this->Auth->allow('*');
		 $this->Auth->allow();
	 }

	 /*
	 *Function: permite realizar el envió de mensajes de correo electrónico
	 */
		 public function sendmsg(){
		 $error='';
		 if(empty($this->error_public_token) &&
		 				empty($this->error_private_token) &&
		 			 !empty($this->request->data['sendto']) &&
					 !empty($this->request->data['message'])){
						 	  $data['Talkdetail']['user_rec_id']	= $this->request->data['sendto'];
								$data['Talkdetail']['user_send_id']	= $this->rsesions['Rsesion']['user_id'];
								$data['Talkdetail']['message']			= $this->request->data['message'];
								if(!empty($this->request->data['talk_id']))
									$data['Talkdetail']['talk_id']			= $this->request->data['talk_id'];
								else{
									$talk = $this->Talk->find('first',array('conditions'=>array('Talk.user_init_id'=>$this->rsesions['Rsesion']['user_id'],
																															'Talk.state = 2',//aceptadadas
																															'Talk.user_contact_id'=>$this->request->data['sendto']),
																														'order'=>array('Talk.created DESC')));
									if(!empty($talk)){
										$data['Talkdetail']['talk_id'] = $talk['Talk']['id'];
									}
								}
						 		$this->Talkdetail->create();
								if(!$this->Talkdetail->save($data)){
									$error = __('No se pudo generar el chat');
								}else{
								 	$contact_session = $this->Rsesion->find('first',array('conditions'=>array('Rsesion.user_id'=>$data['Talkdetail']['user_rec_id'],'Rsesion.state = 1')));
									if(!empty($contact_session)){
										$msg[$contact_session['Rsesion']['sessionkey']]=array('message'=>$this->request->data['message']);
										$this->_execfirebase('/firebase/talk-msg/',$msg);
									}else{
										$error=__('No se pudo contactar con el usuario');
									}
								}
		 }else{
			 $error = $this->errortoken();
		 }
		 $this->set('error',$error);
	 }
}
