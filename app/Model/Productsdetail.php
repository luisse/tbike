<?php
App::uses('AppModel', 'Model');
/**
 * Productdetail Model
 *
 * @property User $User
 * @property Provincia $Provincia
 * @property Departamento $Departamento
 * @property Localidade $Localidade
 */

class Productsdetail extends AppModel {
/**
 * Validation rules
 *
 * @var array
 */
	
	var $validate = array(
		'id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Debe Ingresar solo Números'
			)
		),
		'estado' => array(
			'numeric' => array(
				'rule' => array('numeric')
			),
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar el Estado',
			)
		),
		'product_id' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar el Producto'
			)
		),
		'precio' => array(
			'decimal' => array(
				'rule' => array('decimal'),
				'message' => 'El Precio no es valido'
			),
		)
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	

	
	function beforeSave($options=array())
	{
		$this->data['Productsdetail']['precio'] = str_replace('$','',$this->data['Productsdetail']['precio']);
		$this->data['Productsdetail']['precio'] = str_replace(' ','',$this->data['Productsdetail']['precio']);
		return true;
	}	
	
	function beforeValidate($options=array())
	{
		$this->data['Productsdetail']['precio'] = str_replace('$','',$this->data['Productsdetail']['precio']);
		$this->data['Productsdetail']['precio'] = str_replace(' ','',$this->data['Productsdetail']['precio']);
		return true;
	}	
	
	/*
	 * Funcion: permite recuperar todos los productos
	 * */
	function GetAllProducts($id = null){
		$product = $this->find('first',array('conditions'=>array('Productsdetail.id'=>$id,'Productsdetail.estado'=>'1'),
									'fields'=>array('Product.descripction')));
		return $product;
	}
	
	function saveallprecio($data){
		$dataSource = $this->getDataSource();
		$error=false;
		//inicializar transaccion
		$dataSource->begin($this);
		$i=0;
		foreach($data['Productsdetail'] as $productsdetail){
			if($productsdetail['actualizar']==1){
				$this->create();
				$errordesc='';
				if(!$this->save($productsdetail)){
					$error = true;
					$errordesc=__('No se pudo actualizar el precio del producto');				
				}
				$data['Productsdetail'][$i]['error'] =$errordesc;
			}else{
				$data['Productsdetail'][$i]['error'] =__('Sin Cambios');
			}
			$i++;
		}
		if($error)
			$dataSource->rollback($this);
		else
			$dataSource->commit($this);
		return $data;
	}
	/*
	 * Funcion: permite recuperar los productos y sus imagenes en caso de existir
	 * */
	function ProductDetailGet($data = null){
		//para poder realizar el join con la tabla de imagenes si existen datos
		/*$options = array('joins'=>array(
			array('table' => 'productimages',
			'alias' => 'Productimage',
			'type' => 'STRAIGHT_JOIN',
			'conditions' => array(
				'Productimage.productsdetail_id = Productsdetail.id',
				)
			),
			array('table' => 'subtypeproducts',
			'alias' => 'Subtypeproduct',
			'type' => 'STRAIGHT_JOIN',
			'conditions' => array(
				'Subtypeproduct.id = Product.subtypeproduct_id',
				)),
			array('table'=>'typeproducts',
					'alias'=>'Typeproduct',
					'type'=>'STRAIGHT_JOIN',
					'conditions'=>array(
							'Typeproduct.id = Product.typeproduct_id')),
			array('table'=>'rubros',
					'alias'=>'Rubro',
					'type'=>'STRAIGHT_JOIN',
					'conditions'=>array(
							'Rubro.id = Product.rubro_id'))),
			'fields'=>array('Product.descripction',
							'Product.codgen',
							'Productsdetail.details', 
							'Productsdetail.precio',
							'Productimage.description',
							'Typeproduct.descripction',
							'Subtypeproduct.descripction',
							'Rubro.descripcion'
			),
			'conditions'=>array('Productimage.estado'=>1,'Productsdetail.estado'=>1));
			*/
			$sql = "SELECT `Product`.`descripction`, 
					`Product`.`codgen`, 
					`Productsdetail`.`details`, 
					`Productsdetail`.`precio`, 
					`Productimage`.`description`,
					`Typeproduct`.`descripction`, 
					`Subtypeproduct`.`descripction`, 
					`Rubro`.`descripcion`
					FROM `productsdetails` AS `Productsdetail` 
					LEFT JOIN productimages AS `Productimage` ON ( `Productsdetail`.`id` = `Productimage`.`productsdetail_id`) 
					JOIN `products` AS `Product` ON (`Productsdetail`.`product_id` = `Product`.`id`)  					
					JOIN subtypeproducts AS `Subtypeproduct` ON (`Subtypeproduct`.`id` = `Product`.`subtypeproduct_id`) 
					JOIN typeproducts AS `Typeproduct` ON (`Typeproduct`.`id` = `Product`.`typeproduct_id`) 
					JOIN rubros AS `Rubro` ON (`Rubro`.`id` = `Product`.`rubro_id`) 
			WHERE (`Productimage`.`estado` = 1 or `Productimage`.`estado` is null) AND `Productsdetail`.`estado` = 1";
			return $this->query($sql);
			//return $this->find('all',$options);
	}
	
}
?>
