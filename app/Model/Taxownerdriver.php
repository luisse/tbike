<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
/**
 * Taxownerdriver Model
 *
 * @property People $People
 * @property Taxowner $Taxowner
 * @property Taxjourney $Taxjourney
 * @property Taxpanic $Taxpanic
 * @property Taxturn $Taxturn
 */
class Taxownerdriver extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'taxowner_id' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Vincular el dueño del taxi'
			),
		),
		'licencenumber' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar el Numero de Licencia de Conductor'
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Debe Ingresar solo números'
			),
			'licenceunique'=>array('rule'=>'licenceunique',
									'message'=>'(*) Licencia de Conductor Existente',
									'on' => 'create'),
			'rango' => array('rule'=>array('range', 1,9999999999),
				'message' => 'El número de licencia del chofer no puede ser mayor a 10 dígitos')
		),
		'state' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar el estado'
			),
		),
		'picture' => array(
					'extension' => array(
							'rule' => array('extension',array('jpg','png')),
							'message' => 'Debe Seleccionar un archivos JPG u PNG'
					),
					'upload-file' => array(
							'rule' => array('uploadFile'),
							'message' => 'Error al Cargar el Archivo'
					),
					'fileSize' => array(
							'rule' => array('fileSize', '<=', '1MB'),
							'message' => 'La Imagen debe ser menor igual a un 1MB'
					)
			)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'People' => array(
			'className' => 'People',
			'foreignKey' => 'people_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Taxowner' => array(
			'className' => 'Taxowner',
			'foreignKey' => 'taxowner_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

  /*Permite cargar el driver image*/
	function uploadFile($data){
		App::uses('CimageComponent','Controller/Component');
		$cimage = new CimageComponent(new ComponentCollection());
		$filepath='SXD.jsp';
		if(!empty($this->data['Taxownerdriver']['id'])){
			$taxownerdrivers = $this->find('first',array('conditions'=>array('Taxownerdriver.id'=>$this->data['Taxownerdriver']['id']),
																								'fields'=>array('Taxownerdriver.picture')));
			if(!empty($taxownerdrivers['Taxownerdriver']['picture']))
				$filepath = $taxownerdrivers['Taxownerdriver']['picture'];
			else
				$filepath = $this->data['Taxownerdriver']['taxowner_id']. $this->data['Taxownerdriver']['licencenumber'].'driversimg';
		}else{
			$filepath   = $this->data['Taxownerdriver']['taxowner_id']. $this->data['Taxownerdriver']['licencenumber'].'driversimg';
		}

		list($fileData,$filename) = $cimage->ImagenToBlob($this->data['Taxownerdriver']['picture']['tmp_name'],120,120,$filepath);

		if(!empty($this->data['Taxownerdriver']['id'])){
			$taxowner = $this->find('first',array('conditions'=>array('Taxownerdriver.id'=>$this->data['Taxownerdriver']['id'])));
			$this->drop_image_from_ws($taxowner['Taxownerdriver']['picture']);
		}

 	  $this->data['Taxownerdriver']['picture'] = $this->upload_image_to_ws($filename);
		//$this->data['Taxownerdriver']['picture']=$filename;
		//$this->log('IMAGEN CREADA'. print_r($this->data['Taxownerdriver'], true ));
		//$this->log('IMAGEN CREADA'. print_r($fileData, true ));
		return true;
	}
	/*
	 * Funcion: Permite validar si el usuario que se quiere dar de alta ya existe
	 */
	function licenceunique($data){
		return $this->isUnique(array('licencenumber'=>$this->data['Taxownerdriver']['licencenumber']));
	}

	public function beforeSave($options=array()){
		if(!empty($this->data['Taxownerdriver']['fecvenclicence']))
			$this->data['Taxownerdriver']['fecvenclicence'] = $this->formatDate($this->data['Taxownerdriver']['fecvenclicence']);
		return true;
	}



	public function savedriver($data = null){
		if(!empty($data)){
			$datasource = $this->getDataSource();
			ClassRegistry::init('People');
			ClassRegistry::init('Userpeople');
			//si se debe crear usuario lo cremos
			if($data['Taxownerdriver']['newuser'] == 0){
				ClassRegistry::init('User');
				$User = new User();
			}
			$People = new People();
			$Userpeople = new Userpeople();
			$this->create();
			$datasource->begin($this);
			//solo crea usuario si el vinculo es nuevo
			if(empty($data['People']['id'])){
				if($People->save($data)){
						$data['Taxownerdriver']['people_id']=$People->id;
				}else{
					echo 'Error People Save';
					$datasource->rollback($this);
					return false;
				}
			}else{
				$data['Taxownerdriver']['people_id']=$data['People']['id'];
			}

			if($data['Taxownerdriver']['newuser'] == 0){
				$data['User']['group_id'] = 2;
				$data['User']['state'] = 2; //need by authorized for the user
				$data['User']['password']=AuthComponent::password($data['User']['password']);
				$data['User']['password_repit']=AuthComponent::password($data['User']['password_repit']);
				if(!$User->save($data)){
					echo 'Error User Save';
					$datasource->rollback($this);
					return false;
				}
				$data['Taxownerdriver']['user_id']=$User->id;
			}
			//solo guarda el vinculo si el usuario es nuevo
			if(empty($data['People']['id'])){
				if(!$Userpeople->adduserpeople($data['Taxownerdriver']['user_id'],$data['Taxownerdriver']['people_id'])){
					$datasource->rollback($this);
					return false;
				}
			}

			if($this->save($data)){
				$datasource->commit($this);
				return true;
			}


			$datasource->rollback($this);
			return false;
		}
	}
}
