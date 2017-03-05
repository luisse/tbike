<?php
App::uses('AppModel', 'Model');
/**
 * Taxturn Model
 *
 * @property Taxownerscar $Taxownerscar
 * @property Taxownerdriver $Taxownerdriver
 * @property Taxorder $Taxorder
 */
class Taxturn extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'taxownerscar_id' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar el auto'
			),
		),
		'taxownerdriver_id' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar el conductor'
			),
		),
		'turninit' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar la fecha de inicio'
			),
			'datetime' => array(
				'rule' => array('datetime'),
				'message' => 'Debe Ingresar una fecha valida'
			),
		),
		'state' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */

	public $belongsTo = array(
		'Taxownerscar' => array(
			'className' => 'Taxownerscar',
			'foreignKey' => 'taxownerscar_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Taxownerdriver' => array(
			'className' => 'Taxownerdriver',
			'foreignKey' => 'taxownerdriver_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Taxorder' => array(
			'className' => 'Taxorder',
			'foreignKey' => 'taxturn_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	/*
	 * Function: permite manegar los turnos habilitar u inhabilitar los turnos
	 * */
	public function turnmanagen($user_id=null, $taxownerscar_id = null,$state = null){
			$error='';
			$id='';
			if(!empty($user_id)){
				ClassRegistry::init('Userpeople');
				ClassRegistry::init('Taxownerdriver');
				ClassRegistry::init('Taxownerscar');
				$taxownerscar=new Taxownerscar();
				$userpeople = new Userpeople();
				//recuperamos los datos de la persona
				$array_userpeople = $userpeople->find('first',array('conditions'=>array('Userpeople.user_id'=>$user_id),
																	'fields'=>array('Userpeople.people_id','Taxownerdriver.user_id','Taxownerdriver.id','Taxownerdriver.taxowner_id'),
																	'joins'=>array(
																			array('table'=>'taxownerdrivers',
																					'alias'=>'Taxownerdriver',
																					'type'=>'LEFT',
																					'conditions'=>array('Taxownerdriver.people_id = Userpeople.people_id')))
				));

				//si existe la persona indicada procedemos a verificar los autos asociados al dueño si existe el mismo

				if(!empty($array_userpeople)){
					ClassRegistry::init('Taxowner');
					$taxowner =new Taxowner();
					$array_cars = $taxowner->find('first',array('conditions'=>array('Taxowner.id'=>$array_userpeople['Taxownerdriver']['taxowner_id'],
																					'Taxownerscar.id'=>$taxownerscar_id),
																				'joins'=>array(array('table'=>'taxownerscars',
																					'alias'=>'Taxownerscar',
																					'type'=>'LEFT',
																					'conditions'=>array('Taxownerscar.taxowner_id = Taxowner.id'))),
																				'fields'=>array('Taxownerscar.id')
					));

					$datasource = $this->getDataSource();
					//si existe el automovil indicado procedemos a verificar que no exista un turno ya extivo
					if(!empty($array_cars)){
						$this->unbindModel(
								array('belongsTo' => array('Taxorder'),
										'hasMany' =>array('Taxorder')
								)
						);
						$this->unbindModel(
								array('belongsTo' => array('Taxorder'),
										'belongsTo'=>array('Taxownerscar','Taxownerdriver')
								)
						);
						$taxturn = $this->find('first',array('conditions'=>array(/*'Taxturn.taxownerscar_id'=>$array_cars['Taxownerscar']['id'],*/
																		'Taxturn.taxownerdriver_id'=>$array_userpeople['Taxownerdriver']['id'],
																		'Taxturn.state'=>1)));
						//print_r($taxturn);
						//print_r($taxturn);
						//solo habilita un nuevo turno si el estado es distinto de 2
						if(empty($taxturn) && ($state != 2)){
							$this->create();
							$datasource->begin($this);
							$data['Taxturn']['taxownerscar_id'] = $array_cars['Taxownerscar']['id'];
							$data['Taxturn']['taxownerdriver_id'] = $array_userpeople['Taxownerdriver']['id'];
							$data['Taxturn']['turninit'] = date('Y-m-d H:i:s');
							$data['Taxturn']['state']	= 1;
						}else{
							$id = !empty($taxturn['Taxturn']['id']) ? $taxturn['Taxturn']['id'] : '' ;
							if(!empty($taxturn) && ($state == 2)){
								if($taxturn['Taxturn']['state'] == 1){
									if($state != 2){
										$error=__('Existe un turno activo');
									}else{
										//end turn....
										$data['Taxturn']['id'] = $taxturn['Taxturn']['id'];
										$data['Taxturn']['turnend']=date('Y-m-d H:i:s');
										$data['Taxturn']['state']=0;
									}
								}else{
										$error=__('Turno finalizado no se puede operar con el mismo');
								}
							}
						}


						if(empty($error) && !empty($data)){
							if($this->save($data)){
								$id = $this->id;
								$datasource->commit($this);
							}else{
								$datasource->rollback($this);
								$error = __('Error al grabar los datos de usuario');
							}
						}

					}else{
						$error=__('El movil indicado no existe');
					}
				}else{

					$error=__('No se encontro la persona indicada');
				}
			}
			return array($error,$id);
	}

}
