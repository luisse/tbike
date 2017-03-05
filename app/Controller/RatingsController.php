<?php
App::uses('AppController', 'Controller');
/**
 * Ratings Controller
 *
 * @property Rating $Rating
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class RatingsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session','RequestHandler');
	public $uses=array('Rating','Rsesion','User');

	public function index(){
		$this->set('title_for_layout',__('Ranking de Mis Choferes'));
		$this->Rating->recursive = 0;
		$this->paginate=array('limit' => 4,
										'page' => 1,
										'joins'=>array(
												array('table'=>'taxownerdrivers',
														'alias'=>'Taxownerdriver',
														'type'=>'INNER',
														'conditions'=>array('Taxownerdriver.user_id = Rating.user_id','Taxownerdriver.taxowner_id'=>$this->Session->read('taxowner_id'))),
														array('table'=>'userpeoples',
																'alias'=>'Userpeople',
																'type'=>'INNER',
																'conditions'=>array('Userpeople.user_id = Rating.user_id')),
																array('table'=>'peoples',
																		'alias'=>'People',
																		'type'=>'INNER',
																		'conditions'=>array('People.id = Userpeople.people_id'))
																	),
										'fields'=>array('round(avg(Rating.value)*100) rating__valprom','People.firstname','People.secondname'),
										'group'=>array('Rating.user_id','People.firstname','People.secondname')
									);
		$this->set('ratings', $this->Paginator->paginate());
	}

/**
 * add method
 *
 * @return void
 */
	public function addratings() {
		$error='';
		$token='';
		$error='';
		$this->Rating->create();

		if(empty($this->error_public_token) &&
				empty($this->error_private_token) &&
				!empty($this->request->data['key']) &&
				!empty($this->rsesions)){
								//validamos is existe el Usuario
								 $rsesions = $this->Rsesion->rsesiondata($this->request->data['key']);

								 $userexist = $this->User->find('count',array('conditions'=>array('User.id'=>!empty($rsesions['Rsesion']['user_id']) ? $rsesions['Rsesion']['user_id'] : 0 )));
								 if($userexist > 0){
									 	$this->Rating->create();
										//si existo actualizo
										$data['Rating']['user_id']     = $rsesions['Rsesion']['user_id'];
										$data['Rating']['value']       = $this->request->data['value'];//0 - 5
										$data['Rating']['typeranking'] = 1; //0 user 1 driver
										if (!$this->Rating->save($data)){
											$error = __('No se pudieron guardar los datos');
										}
									}else{
										throw new NotFoundException('Usuario inexistente');
									}
			}else{
					  throw new BadRequestException('Datos invalidos para procesamiento');
						$error = $this->errortoken();
			}
			$this->set('error',$error);
	}

	public function getranking(){
		$error='';
		$token='';
		$error='';
		if(empty($this->error_public_token) &&
				empty($this->error_private_token) &&
				!empty($this->rsesions)){
							//validamos is existe el Usuario
							 $userexist = $this->User->find('count',array('conditions'=>array('User.id'=>$this->rsesions['Rsesion']['user_id'])));
							 if($userexist > 0){
								 $rating = $this->Rating->find('first',array('conditions'=>array('Rating.user_id'=>$this->rsesions['Rsesion']['user_id']),
																												'fields'=>array('avg(Rating.value) as Rating__valrating')));
								}else{
									throw new NotFoundException('Usuario inexistente');
								}
		}else{
				  throw new BadRequestException('Datos invalidos para procesamiento');
					$error = $this->errortoken();
		}
		$this->set('error',$error);
		$this->set(compact('rating'));
	}
}
