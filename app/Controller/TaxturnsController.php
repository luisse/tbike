<?php
App::uses('AppController', 'Controller');
/**
 * Taxturns Controller
 *
 * @property Taxturn $Taxturn
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TaxturnsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session','RequestHandler');
	public $uses=array('Taxturn','Rsesion');

	 /**
	 * Function: permite crear un nuevo turno
 	 * @throws NotFoundException
   * @param string $key $taxownerscar_id
	 * @return void
	 * */
		public function createturn(){
		$error='';
		$result='';
		if(!empty($this->request->data['key']) && !empty($this->request->data['taxownerscar_id'])){
			if($this->Rsesion->SessionIsOk($this->request->data['key'])){
				$rsesions = $this->Rsesion->rsesiondata($this->request->data['key']);

				if(!empty($rsesions)){
					//solo dueños y taxistas pueden ejecutar esta API
					if($rsesions['User']['group_id'] != 2 && $rsesions['User']['group_id'] != 1){
						throw new UnauthorizedException('Usuario no autorizado.');
						exit;
					}
					list($result,$id) = $this->Taxturn->turnmanagen($rsesions['Rsesion']['user_id'],$this->request->data['taxownerscar_id']);
				}else{
					$result=__('No se encontro una sesion valida para operar');
				}
			}else{
				$result = __('Error en inicio de sesion');
			}
		}else{
			$result = __('Sesion invalida para operar');
		}
		$this->set('id',$id);
		$this->set('error',$result);
	}

	/**
	* Function: permite crear un nuevo turno
	* @throws NotFoundException
	* @param string $key $taxownerscar_id
	* @return void
	* */
	public function endturn(){
		$error='';
		$result='';
		if(!empty($this->request->data['key']) && !empty($this->request->data['taxownerscar_id'])){
			if($this->Rsesion->SessionIsOk($this->request->data['key'])){
				$rsesions = $this->Rsesion->rsesiondata($this->request->data['key']);
				if(!empty($rsesions)){
					//solo dueños y taxistas pueden ejecutar esta API
					if($rsesions['User']['group_id'] != 2 && $rsesions['User']['group_id'] != 1){
						throw new UnauthorizedException('Usuario no autorizado.');
						exit;
					}
					list($result,$id) = $this->Taxturn->turnmanagen($rsesions['Rsesion']['user_id'],$this->request->data['taxownerscar_id'],2);
				}else{
					$result=__('No se encontro una sesion valida para operar');
				}
			}else{
				$result = __('Error en inicio de sesion');
			}
		}else{
			$result = __('Sesion invalida para operar');
		}
		$this->set('error',$result);
	}

	function beforeFilter(){
		parent::beforeFilter();
		// For CakePHP 2.0
		$this->Auth->allow('*');

		// For CakePHP 2.1 and up
		$this->Auth->allow();
	}

}
