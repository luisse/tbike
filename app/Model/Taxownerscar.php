<?php
App::uses('AppModel', 'Model');
/**
 * Taxownerscar Model
 *
 * @property Taxowner $Taxowner
 * @property Taxjourney $Taxjourney
 * @property Taxturn $Taxturn
 * @property Taxubication $Taxubication
 */
class Taxownerscar extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'taxowner_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Debe Ingresar el Identificador'
			),
		),
		'carcode' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar la patente'
			),
			'carcodeunique'=>array('rule'=>'carcodeunique',
										'message'=>'(*) Vehículo ya Registrado',
										'on' => 'create')
		),
		'descriptioncar'=> array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar una descripción del auto'
			)
		),
		'registerpermision' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar el Registro de Permiso'
			)/*,
			'registerpermisionunique'=>array('rule'=>'registerpermisionunique',
										'message'=>'(*) Permiso Asignado a otro auto',
										'on' => 'create')*/
		),
		'decreenro' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar el Número de decreto'
			),
		),
		'dateactive' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar la Fecha de Inicio de Actividad'
			),
			'date' => array(
				'rule' => array('date'),
				'message' => 'Debe Ingresar una fecha valida formado dd/mm/yyyy'
			),
		),
		'state' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe ingresar un estado válido',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
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
		'Taxowner' => array(
			'className' => 'Taxowner',
			'foreignKey' => 'taxowner_id',
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
	/***
	public $hasMany = array(
		'Taxjourney' => array(
			'className' => 'Taxjourney',
			'foreignKey' => 'taxownerscar_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Taxturn' => array(
			'className' => 'Taxturn',
			'foreignKey' => 'taxownerscar_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Taxubication' => array(
			'className' => 'Taxubication',
			'foreignKey' => 'taxownerscar_id',
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
	****/

	/*
	 * Funcion: permite cargar la imagen del usuario
	 */

	function uploadFile($data){
		App::uses('CimageComponent','Controller/Component');
		$cimage = new CimageComponent(new ComponentCollection());
		$filepath='SXD.jsp';
		/*imagen tamanio normal*/
		//si existe el registro en la DB recuepramos el nombre del archivo
		if(!empty($this->data['Taxownerscar']['id'])){
			$taxownercars = $this->find('first',array('conditions'=>array('Taxownerscar.id'=>$this->data['Taxownerscar']['id']),
																								'fields'=>array('Taxownerscar.picture')));
			if(!empty($taxownercars['Taxownerscar']['picture']))
				$filepath = $taxownercars['Taxownerscar']['picture'];
		}
		//si no existe el objeto entonces asignamos un nuevo nombre
		if(!file_exists(WWW_ROOT.$filepath)){
			$filepath = str_replace(' ','_',$this->data['Taxownerscar']['carcode']).'carsimg';
		}

		list($fileData,$filename) = $cimage->ImagenToBlob($this->data['Taxownerscar']['picture']['tmp_name'],120,120,$filepath);

		if(!empty($this->data['Taxownerscar']['id'])){
			$taxowner = $this->find('first',array('conditions'=>array('Taxownerscar.id'=>$this->data['Taxownerscar']['id'])));
			$this->drop_image_from_ws($taxowner['Taxownerscar']['picture']);
		}

		//$this->data['Taxownerscar']['picture']=$filename;
		$this->data['Taxownerscar']['picture'] = $this->upload_image_to_ws($filename);
		print_r($this->data);
		return true;
	}


	public function carcodeunique($data){
		return $this->isUnique(array('carcode'=>$this->data['Taxownerscar']['carcode']));
	}

	public function registerpermisionunique($data){
		return $this->isUnique(array('registerpermision'=>$this->data['Taxownerscar']['registerpermision']));
	}

	/*
	* Funcion: antes de guardar es importante convertir la fecha al formato Unix/Mysql
	*/
	function beforeSave($options=array())
	{
		if(!empty($this->data['Taxownerscar']['dateactive']))
			$this->data['Taxownerscar']['dateactive'] = $this->formatDate($this->data['Taxownerscar']['dateactive']);
		if(!empty($this->data['Taxownerscar']['dateexpire']))
				$this->data['Taxownerscar']['dateexpire'] = $this->formatDate($this->data['Taxownerscar']['dateexpire']);

			return true;
	}

	function beforeValidate($options=array())
	{
		if(!empty($this->data['Taxownerscar']['dateactive']))
			$this->data['Taxownerscar']['dateactive'] = $this->formatDate($this->data['Taxownerscar']['dateactive']);
		if(!empty($this->data['Taxownerscar']['dateexpire']))
				$this->data['Taxownerscar']['dateexpire'] = $this->formatDate($this->data['Taxownerscar']['dateexpire']);
			return true;
	}

	/*permite actualizar el estado del auto
	 * Param: data['id']:id of car
	 * 			data['state']: estado del auto activo:1 ocupado:2
	 * */
	public function updatestate($data){
		if(!empty($data)){
			$datasource = $this->getDataSource();
			$this->create();
			$datasource->begin($this);
			if($this->save($data)){
				$datasource->commit($this);
				return true;
			}
		}
		$datasource->rollback($this);
		return false;
	}

	/*
	* Funtion: permite actualizar el estado del taxista
	*/
	public function changeworkstate($data = null){
		if(empty($data))	return false;

			ClassRegistry::init('Logstate');
			$Logstate = new Logstate();
			$datasource = $this->getDataSource();
			$this->create();
			$datasource->begin($this);

			if($this->save($data)){
				if(empty($data['Logstate']))
					$data['Logstate']['comment']=' ';
				if($Logstate->save($data)){
					$datasource->commit($this);
					return true;
				}
			}
			$datasource->rollback($this);
			return false;
		}
}
