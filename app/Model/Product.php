<?php
App::uses('AppModel', 'Model');
/**
 * Product Model
 *
 * @property User $User
 * @property Provincia $Provincia
 * @property Departamento $Departamento
 * @property Localidade $Localidade
 */

class Product extends AppModel {

	var $validate = array(
		'descripcion' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe Ingresar la descripcion del Producto',
				'required' => true
			),
		'maxlength' => array(
        			'rule' => array('maxlength',255),
                    'message' => 'Debe Ingresar menos de 500 Caracteres',                        )

		),
		'sintetico' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe Ingresar el Sintetico',
				'required' => true
			),
		),
		'codgen' => array(
			'alphanumeric' => array(
							'rule' => array('alphanumeric'),
							'message'=>'Debe Ingresar un Valor'),
			'isunico'=>array('rule'=>'isUnique',
							'message'=>'Ya existe el código ingresado')
		),
		'codbarra' => array(
			'alphanumeric' => array(
				'rule' => array('alphanumeric'),
				'message'=>'El código de barras debe contener letras y números'),
				'codbarraunico'=>array('rule'=>'isUnique','message'=>'Ya existe el Código de Barras ingresado')
		),
		'proveedore_id'=>array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe Ingresar el Proveedor',
				'required' => true
			)		
		),
		'categoria_id'=>array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe Ingresar la Categoria',
				'required' => true
			)		
		)
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasOne = array(
		'Productsdetail' => array(
			'className' => 'Productsdetail',
			'foreignKey' => 'product_id',
			'dependent' => false,
			'conditions' => array('Productsdetail.estado'=>'1'),
			'fields' => array('Productsdetail.stock','Productsdetail.estado','Productsdetail.details',
							'Productsdetail.precio','Productsdetail.peso','Productsdetail.id'),
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)		
	);

	/*Valores Relacionados con BelongTo*/
	/******
	var $belongsTo=array('Subtypeproduc'=>array('className'=>'Subtypeproduct',
												'foreignKey'=>'subtypeproduct_id',
                                                'field'=>array('descripction')),
						'Typeproduct'=>array('className'=>'Typeproduct',
											'foreignKey'=>'typeproduct_id',
											'fields'=>array('descripction')),
						'Rubro'=>array('className'=>'Rubro',
											'foreignKey'=>'rubro_id',
											'fields'=>array('descripcion')));***/

	/*
	 * Funcion: permite validar que el código generico existe una sola vez
	 * */
	function codigogenesunico(){
		return $this->isUnique(array('codgen'=>$this->data['Product']['codgen']));
	}
	
	function codbarraunico(){
		return $this->isUnique(array('codbarra'=>$this->data['Product']['codbarra']));
		
	}
	/*
	 * Funcion: permite insertar un producto con el alta
	 */
	function saveproduct($data=null){
		if(!empty($data)){
			$dataSource = $this->getDataSource();
			ClassRegistry::init('Productsdetail');
			ClassRegistry::init('Productosacategoria');
			$ProductsDetail = new Productsdetail(); 
			$this->create();
			//inicializamos la transaccion
			$dataSource->begin($this);

			if ($this->save($data['Product'])){
				$data['Productsdetail']['product_id']=$this->id;
				$data['Productsdetail']['precio']=str_replace('$','', $data['Productsdetail']['precio']);
					if($ProductsDetail->save($data['Productsdetail'])){
						//gaurdamos los datos en la tabla con el commit
						$dataSource->commit($this);
						return true;
					}else{
						$dataSource->rollback($this);
						return false;
					}
			}else{
				$dataSource->rollback($this);
				return false;
			}
			
		}
	}
	
	/*
	 * Funcion: permite retornar los datos del producto y sus detalles
	 * */
	function ProductDetailGet($data = null){
		//para poder realizar el join con la tabla de imagenes si existen datos
		$options['joins'] = array(
			array('table' => 'productimages',
			'alias' => 'Productimage',
			'type' => 'LEFT',
			'conditions' => array(
				'Productimage.productsdetail_id = Productsdetail.id',
				)
			)
		);		
		$this->find('all',$options);
	}
	
	
	/*
	*Funcion: permite disminuir el stock que tenemos, en caso de no existir la cantidad retorna false/true si hay stock
	*/
	function ProductStock($data=null,$save=null){
		if(!empty($data)){
			$product=$this->find('first',array('conditions'=>array('Product.id'=>$data['Product']['id']),
												'values'=>array('Productsdetail.stock','Productsdetail.id','Productsdetail.precio')));
			if(!empty($product)){
				$enstock = $product['Productsdetail']['stock'] - $data['Product']['cantidad'];
				if($save){
					if($enstock >= 0){
						ClassRegistry::init('Productsdetail');
						$dataSource = $this->getDataSource();
						$ProductsDetail = new Productsdetail(); 
						$this->create();
						//inicializamos la transaccion
						$dataSource->begin($this);
						$productdetail['Productsdetail']['id'] = $product['Productsdetail']['id'];
						$productdetail['Productsdetail']['stock'] = $enstock; 
						$productdetail['Productsdetail']['precio'] = $product['Productsdetail']['precio']; 
						if ($ProductsDetail->save($productdetail['Productsdetail'])){
							$dataSource->commit($this);
							return true;
						}else{
							$dataSource->rollback($this);
							return false;
						}
					}else{
						return false;
					}
				}else{
					if($enstock >= 0)
						return true;
					else
						return false;				
				}
			}else{
				return false;
			}
		}
	}
}
?>
