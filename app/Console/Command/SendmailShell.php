<?php
//App::uses('AppShell', 'Console');

class SendmailShell extends AppShell {
    var $uses = array('Mensaje','Senderlog','User');

    function startup() {
        //App::import('Core', 'Controller');
		    //$this->Controller = new Controller();
        //$this->Email =new EmailComponent(null);
        //$this->Email->initialize($this->Controller);

    }

    function main() {
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
  																		//'Mensaje.tallercito_id'=>$this->Session->read('tallercito_id'),
  																		'Mensaje.enviado = 0 OR Mensaje.enviado IS NULL'),
  										'fields'=>array('Mensaje.bicicleta_id','Mensaje.asunto','Mensaje.detalle','Mensaje.id','Tipomen.descripcion',
  														'Mensaje.userrec_id','Mensaje.tallercito_id')
  		));

  		/*
  		* struct sender email,mensaje,user sys
  		*/
  		$i=0;
  		foreach($mensajes as $mensaje){
  				$str_to_send[$i]['msgcab']		    =	$mensaje['Mensaje']['asunto'];
  				$str_to_send[$i]['msgdetalle']    =	$mensaje['Mensaje']['detalle'];
  				$str_to_send[$i]['tipomen']		    =	$mensaje['Tipomen']['descripcion'];
  				$str_to_send[$i]['tallercito_id']	=	$mensaje['Mensaje']['tallercito_id'];

  				$user = $this->User->find('first',array('conditions'=>array('User.id'=>$mensaje['Mensaje']['userrec_id']),
  															    'fields'=>array('User.email','User.id')));

          $str_to_send[$i]['user_id'] = !empty($user['User']['id']) ? $user['User']['id'] : 0;
					$str_to_send[$i]['email']	  = !empty($user['User']['email']) ? $user['User']['email'] : '';
  				$str_to_send[$i]['mensaje_id']=$mensaje['Mensaje']['id'];
  				$i++;
  		}

  		//$tallercito = $this->Session->read('tallercito');
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
  						$Email->subject('TALLERCITOBIKE'.':'.$str_send['msgcab']);
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

  					$data['Senderlog']['fechaenv']	   = date('Y-m-d H:i:s');
  					$data['Senderlog']['mensaje_id']   = $str_send['mensaje_id'];
  					$data['Senderlog']['correoe']	     = $str_send['email'];
  					$data['Senderlog']['resultado']	   = $resultado;
  					$data['Senderlog']['mensajeerror'] = $error;
  					$data['Senderlog']['tallercito_id']= $str_send['tallercito_id'];
  					$data['Senderlog']['user_id']	     = $str_send['user_id'];

  					$this->Senderlog->create();
  					if (!$this->Senderlog->save($data)) {
  						$error = 'Error en Guardado de Datos de Log';
  						exit;
  					}else{
  						if(empty($error)){
  							//actualizo estado de mensaje con enviado
  							if($str_send['mensaje_id']>0){
  								$mensajemantenimiento['Mensaje']['id']       = $str_send['mensaje_id'];
  								$mensajemantenimiento['Mensaje']['enviado']  = 1;
  								$mensajemantenimiento['Mensaje']['fechasend']= date('Y-m-d');
  								$this->Mensaje->create();
  								$this->Mensaje->Save($mensajemantenimiento);
  							}
  						}
  					}
  				}
  			}
  		}
  }
}
?>
