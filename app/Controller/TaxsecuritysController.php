<?php
App::uses('AppController', 'Controller');
/**
 * Taxsecurities Controller
 *
 * @property Taxsecurity $Taxsecurity
 * @property PaginatorComponent $Paginator
 */
class TaxsecuritysController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('RequestHandler');
	public $uses =array('Taxsecurity','Rsesion');

	/*
	 * Function: permite agregar una nueva marca de seguridad
	 * */



	public function addsecuritys(){
		$rid='';
		$error='';
		if(empty($this->error_public_token) &&
				empty($this->error_private_token) &&
				!empty($this->request->data['idjourny']) &&
				!empty($this->request->data['lat'])  &&
				!empty($this->request->data['lng'])){
				//desencriptamos la clase usando la misma key para encryptar
				$key='4edRdaSsW3eerfkslapSdXdpsASLsaQxcSSls';
				$rid=base64_decode($this->request->data['idjourny']);
				$rid = Security::decrypt($rid,$key);
				$result=explode('$$$', $rid);
				$Taxjourney = ClassRegistry::init('Taxjourney');
				$taxjournye=$Taxjourney->find('count',array('conditions'=>array('Taxjourney.id'=>$result[1],'Taxjourney.state'=>1)));

				if(!empty($taxjournye) and $taxjournye >= 1){
					if(!empty($result[1])){
						$data['Taxsecurity']['taxjourney_id'] = $result[1];
						//$data['Taxsecurity']['image']=$this->request->data['image'];
						$data['Taxsecurity']['datesec']=date('Y-m-d H:i:s');
						$data['Taxsecurity']['lat']=$this->request->data['lat'];
						$data['Taxsecurity']['lng']=$this->request->data['lng'];
						$this->Taxsecurity->create();
						if(!$this->Taxsecurity->save($data)){
							$error=__('No se pudo guardar los datos intente nuevamente');
						}
					}
				}else{
					$error=__('No Existe el viaje especificado');
				}
		}else{
			if(!empty($this->error_public_token) || !empty($this->error_private_token))
						$error = $this->errortoken();
			if(empty($this->request->data))
				$error=__('Faltan parametros para procesar');
		}
		$this->set('error',$error);
	}

	public function addimageremote(){
		$token='';
		$error='';
		if(empty($this->error_public_token) &&
				empty($this->error_private_token) &&
				!empty($_FILES['picture'])){
					$rsesion = $this->Rsesion->rsesiondata($this->sessiontoken);
					if(!empty($rsesion)){
						if(!empty($_FILES['picture'])){
							$this->request->data['Taxsecurity']['id'] = $this->request->data['taxsecurity_id'];
							$this->request->data['Taxsecurity']['image'] = $_FILES['picture'];
							if(!$this->Taxsecurity->save($this->request->data)){
								$errors = $this->Taxsecurity->invalidFields();
								foreach($errors as $errorget){
									foreach($errorget as $errormsg){
										$error = $error."<br>".$errormsg;
									}
								}
								if(empty($error))
									$error = __('No se pudieron guardar los datos');
							}
						}else{
							$error = __('No se encontro una imagen para asociar');
						}
					}
				}else{
					if(!empty($this->error_public_token) || !empty($this->error_private_token))
						$error = $this->errortoken();
					if(empty($_FILES['picture']))
						$error = __('No image to proccess. Need picture have hungrie');
				}
		$this->set('error',$error);
	}


	public function beforeFilter(){
		parent::beforeFilter();
	}
}
