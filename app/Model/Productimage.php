<?php
App::uses('AppModel', 'Model');
/**
 * Productimage Model
 *
 * @property User $User
 * @property Provincia $Provincia
 * @property Departamento $Departamento
 * @property Localidade $Localidade
 */

class Productimage extends AppModel {
/**
 * Validation rules
 *
 * @var array
 */

	var $validate = array(
		'descripcion' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar una Descripcion'
			),
		),
		'estado' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar el Estado'
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'El estado es un valor numerico'
			),
		),
		'product_id' => array(
			'numeric' => array(
				'rule' => array('numeric')
			),
		),
		'imagen' => array(
				'extension' => array(
					'rule' => array('extension',array('jpg','png')),
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


	function uploadFile($data){
			//App::Component('');
			App::uses('CimageComponent','Controller/Component');
			$cimage = new CimageComponent(new ComponentCollection());
			if(!empty($this->data['Productimage']['id'])){
				$productimage = $this->find('first',array('conditions'=>array('Productimage.id'=>$this->data['Productimage']['id']),
																							'fields'=>array('Productimage.imagen','Productimage.thumbs')));
				if(!empty($productimage['Productimage']['imagen'])){
					if(file_exists($productimage['Productimage']['imagen'])){
						$file_normal = $productimage['Productimage']['imagen'];
						$file_thumbs = $productimage['Productimage']['thumbs'];
					}else{
						$file_normal = $this->data['Productimage']['product_id'].'nimage';
						$file_thumbs = $this->data['Productimage']['product_id'].'timage';						
					}
				}else{
					$file_normal = $this->data['Productimage']['product_id'].'nimage';
					$file_thumbs = $this->data['Productimage']['product_id'].'timage';
				}
			}else{
				$file_normal = $this->data['Productimage']['product_id'].'nimage';
				$file_thumbs = $this->data['Productimage']['product_id'].'timage';
			}
			/*imagen tamanio normal*/
			list($fileData,$file_npath) = $cimage->ImagenToBlob($this->data['Productimage']['imagen']['tmp_name'],0,0,$file_normal,'products/');
			/*imagen thumbs*/
			list($thumbs,$file_tpath) = $cimage->ImagenToBlob($this->data['Productimage']['imagen']['tmp_name'],200,200,$file_thumbs,'products/');
			$this->data['Productimage']['type'] = $this->data['Productimage']['imagen']['type'];
			$this->data['Productimage']['imagen']=$file_npath;
			$this->data['Productimage']['thumbs']=$file_tpath;
			return true;
	}
}
?>
