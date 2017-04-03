<?php
App::uses('AppController', 'Controller');
/**
 * Favcars Controller
 *
 * @property Favcar $Favcar
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class FavcarsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session','RequestHandler');
	public $uses=array('Favcar','Rsesion','Taxownerscar');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('title_for_layout',__('Autos Favoritos'));
		$this->Favcar->recursive= 0;
		/*Recuperamos las ordenes para el usaurio actualmente conectado*/
		$this->paginate=array('limit' => 4,
				'page' => 1,
				'conditions'=>array('Favcar.user_id'=>$this->Session->read('user_id')),
				'joins'=>array(array('table'=>'taxownerscars',
						'alias'=>'Taxownerscar',
						'type'=>'INNER',
						'conditions'=>array('Taxownerscar.id = Favcar.taxownerscar_id'))),
				'fields'=>array('Favcar.id','Favcar.created','Taxownerscar.carcode','Taxownerscar.registerpermision','Taxownerscar.picture','Taxownerscar.descriptioncar')
			);
		$this->set('favcars',$this->Paginator->paginate());
	}



	public function favgetpost(){
		$error='';
		if(!empty($this->request->data['key'])){
			if($this->Rsesion->SessionIsOk($this->request->data['key'])){
				$rsesions = $this->Rsesion->rsesiondata($this->request->data['key']);
				if(!empty($rsesions)){
					$favcars = $this->Favcar->find('all',array('conditions'=>array('Favcar.user_id'=>$rsesions['Rsesion']['user_id'])));
				}
			}
		}else{
			$error = __('Parametros no validos');
		}
		$this->set('error',$error);
		$this->set(compact('favcars'));
	}

	public function listfavcars(){
		$favcars = $this->Favcar->find('all',array('conditions'=>array('Favcar.user_id'=>$this->Session->read('user_id'))));
		$this->set($favcars);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$error='';
		if(empty($this->error_public_token) &&
				empty($this->error_private_token) &&
				!empty($this->request->data['taxownerscar_id']) &&
				!empty($this->rsesions)){
				$cantidad = $this->Taxownerscar->find('count',array('conditions'=>array('Taxownerscar.id'=>$this->request->data['taxownerscar_id'])));
				if($cantidad > 0){
					if(!empty($this->rsesions)){
						$this->Favcar->create();
						$data['Favcar']['taxownerscar_id'] = $this->request->data['taxownerscar_id'];
						$data['Favcar']['user_id']				 = $this->rsesions['Rsesion']['user_id'];
						if (!$this->Favcar->save($data)) {
							$error = __('Error al intentar agregar a favoritos') ;
						}
					}
				}else{
					$error = __('No se encontro el auto indicado');
				}
			}else{
				$error = $this->errortoken();
			}
		$this->set('error',$error);
	}


/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete() {
		$error='';
		if(!empty($this->request->data['key'] && !empty($this->request->data['favcar_id']))){
			if($this->Rsesion->SessionIsOk($this->request->data['key'])){
				$rsesions = $this->Rsesion->rsesiondata($this->request->data['key']);
				if(!empty($rsesions)){
					if (!$this->Favcar->deleteAll(array('Favcar.user_id'=>$rsesions['Rsesion']['user_id'],
																							'Favcar.id'=>$this->request->data['favcar_id']),false)) {
						$error = __('No se pudo eliminar los datos');
					}
				}else{
					$error=__('Sesion invalida para operar');
				}
			}else{
				$error = __('Sesion invalida para operar');
			}
		}else{
			$error = __('Parametros invalidaos para operar');
		}
		$this->set('error',$error);
	}

	function beforeFilter(){
		parent::beforeFilter();
		$acepted_func=array('add','favgetpost','delete');
		if(in_array($this->params['action'],$acepted_func)){
			$this->Auth->allow();
		}else{
			 try{
				 $result =	$this->Acl->check(array(
				 'model' => 'Group',       # The name of the Model to check agains
				 'foreign_key' => $this->Session->read('tipousr') # The foreign key the Model is bind to
				 ), ucfirst($this->params['controller']).'/'.$this->params['action']);
				 //SI NO TIENE PERMISOS DA ERROR!!!!!!
				 if(!$result)
				 	return $this->redirect(array('controller' => 'mains','action'=>'securityerror',$this->params['controller'].'-'.$this->params['action']));
				}catch(Exeption $e){

				}
		}

	}
}
