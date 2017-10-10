<?php
App::uses('AppModel', 'Model');
/**
 * Bicicleta Model
 *
 * @property Bicicletareparamo $Bicicletareparamo
 * @property Clientebicicleta $Clientebicicleta
 */
class Bicicleta extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'marca' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar la Marca'
			),
			'maxLength' => array(
				'rule' => array('maxLength',45),
				'message' => 'Solo puede Ingresar 45 Caracteres'
			),
		),
		'modelo' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar el modelo'
			)
		),
		'imagen' => array(
				'extension' => array(
					'rule' => array('extension',array('jpg','png','jpeg')),
					'message' => 'Solo se pueden subir archivos JPG'
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
 * hasMany associations
 *
 * @var array
 */
 public $belongsTo = array(
		'Cliente' => array(
			'className' => 'Cliente',
			'foreignKey' => 'cliente_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		));

	public $hasMany = array(
		'Bicicletareparamo' => array(
			'className' => 'Bicicletareparamo',
			'foreignKey' => 'bicicleta_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		));

		function uploadFile($data){
				App::uses('CimageComponent','Controller/Component');
				$cimage = new CimageComponent(new ComponentCollection());
				//si no existe la imagen
				if(!empty($this->data['Bicicleta']['id'])){
					$bicicleta = $this->find('first',array('conditions'=>array('Bicicleta.id'=>$this->data['Bicicleta']['id']),
																								'fields'=>array('Bicicleta.imagen')));
					if(!empty($bicicleta['Bicicleta']['imagen'])){
						if(file_exists($bicicleta['Bicicleta']['imagen'])){
							$file_normal = $bicicleta['Bicicleta']['imagen'];
						}
					}else {
						$file_normal = '-'.$this->data['Bicicleta']['id'].'-'.$this->data['Bicicleta']['tallercito_id'].'nbike';
					}
				}else{
						$file_normal = $data['Bicicleta']['tallercito_id'].'nbike';
				}

				/*imagen tamanio normal*/
				list($fileData,$file_npath) = $cimage->ImagenToBlob($this->data['Bicicleta']['imagen']['tmp_name'],0,0,$file_normal,'bicicletas/');
				$this->data['Bicicleta']['imagen'] = $file_npath;
				return true;
		}
}
