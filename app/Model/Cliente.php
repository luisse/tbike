<?php
class Cliente extends AppModel {
	var $name = 'Cliente';
	//var $useTable = 'tallercitobikes.shclientes.clientes';
	//var $tablePrefix='shclientes.';
	var $validate = array(
		'nombre' => array(
<<<<<<< HEAD
			'notBlank' => array(
				'rule' => array('notBlank'),
=======
			'notempty' => array(
				'rule' => array('notempty'),
>>>>>>> d1dd9254b21e573d5d9674487d0b9be918df744a
				'message' => 'Debe Ingresar el Nombre'
			)
		),
		'apellido' => array(
<<<<<<< HEAD
			'notBlank' => array(
				'rule' => array('notBlank'),
=======
			'notempty' => array(
				'rule' => array('notempty'),
>>>>>>> d1dd9254b21e573d5d9674487d0b9be918df744a
				'message' => 'Debe Ingresar el Apellido'
			)
		),
		/***'documento' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'El Nro de Documento no es valido'
			),
			'unico'=>array(
				'rule'=>'isUnique',
				'message'=>'El Documento ya existe',
				'on'=> 'create'
			)
		),***/
		'telefono' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'El Nro de Telefono no es valido'
			)
		),
		'domicilio' => array(
<<<<<<< HEAD
			'notBlank' => array(
				'rule' => array('notBlank'),
=======
			'notempty' => array(
				'rule' => array('notempty'),
>>>>>>> d1dd9254b21e573d5d9674487d0b9be918df744a
				'message' => 'Debe Ingresar el Domicilio'
			)
		),
		'foto' => array(
						'extension' => array(
						'rule' => array('extension',array('jpg','png')),
						'message' => 'Solo se pueden subir archivos JPG/PNG'
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
	public $virtualFields = array('nomape'=>"concat(Cliente.apellido,', ',Cliente.nombre)");

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Provincia' => array(
			'className' => 'Provincia',
			'foreignKey' => 'provincia_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Departamento' => array(
			'className' => 'Departamento',
			'foreignKey' => 'departamento_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Localidade' => array(
			'className' => 'Localidade',
			'foreignKey' => 'localidade_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	/*
	 * Funcion: permite cargar la imagen del usuario
	 */

	function uploadFile($data){
			App::uses('CimageComponent','Controller/Component');
			$cimage = new CimageComponent(new ComponentCollection());
			$file_normal='noimage.jpg';
			/*cliente image*/
			if(!empty($this->data['Cliente']['id'])){
				$cliente = $this->find('first',array('conditions'=>array('Cliente.id'=>$this->data['Cliente']['id']),
																							'fields'=>array('Cliente.foto')));
				if(!empty($cliente['Cliente']['foto'])){
					if(file_exists($cliente['Cliente']['foto'])){
						$file_normal = $cliente['Cliente']['foto'];
					}
				}else {
					$file_normal = '-'.$this->data['Cliente']['id'].'-'.$this->data['Cliente']['tallercito_id'].'ncliente';
				}
			}else{
					$file_normal = '-'.$data['Cliente']['tallercito_id'].'ncliente';
			}
			/*imagen tamanio normal*/
			list($fileData,$file_npath) = $cimage->ImagenToBlob($this->data['Cliente']['foto']['tmp_name'],0,0,$file_normal,'clientes/');
			$this->data['Cliente']['foto'] = $file_npath;
			return true;
	}

	/*
	 * Funcion: antes de guardar es importante convertir la fecha al formato Unix/Mysql
	 */
	function beforeSave($options=array())
	{
		if(!empty($this->data['Cliente']['fechanac']))
			$this->data['Cliente']['fechanac'] = $this->formatDate($this->data['Cliente']['fechanac']);
		return true;
	}

	function beforeValidate($options=array())
	{
		if(!empty($this->data['Cliente']['fechanac']))
			$this->data['Cliente']['fechanac'] = $this->formatDate($this->data['Cliente']['fechanac']);
		return true;
	}

	function GuardarCliente($data = null){
		if(!empty($data)){
			$dataSource = $this->getDataSource();
			ClassRegistry::init('Cuenta');
			$Cuenta = new Cuenta();
			$this->create();
			$dataSource->begin($this);
			if($this->Save($data)){
				$cuenta['Cuenta']['cliente_id']=$this->id;
				$cuenta['Cuenta']['tallercito_id']=$data['tallercito_id'];
				$cuenta['Cuenta']['maxdeuda']=0;
				$cuenta['Cuenta']['estado']=1;
				$result = $Cuenta->AltaCuenta($cuenta);
				if(empty($result)){
					$dataSource->commit($this);
					return true;
				}else{
					$dataSource->rollback($this);
					return $result;
				}
			}else{
				$dataSource->rollback($this);
				return false;
			}
		}
	}
}
