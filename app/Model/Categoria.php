<?php
App::uses('AppModel', 'Model');
/**
 * Categoria Model
 *
 * @property Productosacategoria $Productosacategoria
 */
class Categoria extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'descripcion' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar la descripción'
			),
			'maxLength' => array(
				'rule' => array('maxLength',45),
				'message' => 'La Maxima cantidad de Catacteres es de 45'
			)
		),
		'padre_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'imagen' => array(
				'extension' => array(
					'rule' => array('extension',array('jpg','png')),
					'message' => 'Solo se pueden subir archivos JPG,PNG'
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
	public $hasMany = array(
		'Productosacategoria' => array(
			'className' => 'Productosacategoria',
			'foreignKey' => 'categoria_id',
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

	function uploadFile($data){
			App::uses('CimageComponent','Controller/Component');
			$cimage = new CimageComponent(new ComponentCollection());
			$filename = 'img.jsp';
			//si existe el id verificamos que exista el mismoo en la DB
			if(!empty($this->data['Categoria']['id'])){
				$categoria = $this->find('first',array('conditions'=>array('Categoria.id'=>$this->data['Categoria']['id']),
																							'fields'=>array('Categoria.imagen')));
				if(!empty($categoria['Categoria']['imagen'])){
						if(file_exists($categoria['Categoria']['imagen'])){
							$filename = $categoria['Categoria']['imagen'];
						}else{
							$filename = date('Ymd').'mgicat';	
						}
					}else {
						$filename = date('Ymd').'mgicat';
					}
			}else{
				$filename = date('Ymd').'mgicat';
			}
			/*imagen tamanio normal*/
			list($fileData,$filepath) = $cimage->ImagenToBlob($this->data['Categoria']['imagen']['tmp_name'],100,200,$filename,'categorias/');
			$this->data['Categoria']['imagen']=$filepath;
			return true;
	}
}
