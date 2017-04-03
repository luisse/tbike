<?php
class Salesdetail extends AppModel {
	var $name = 'Salesdetail';
	var $validate = array(
		'cantidad' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'La Cantidad debe ser solo números'
			),
<<<<<<< HEAD
			'notBlank' => array(
				'rule' => array('notBlank'),
=======
			'notempty' => array(
				'rule' => array('notempty'),
>>>>>>> d1dd9254b21e573d5d9674487d0b9be918df744a
				'message' => 'Debe Ingresar la Cantidad'
			)
		),
		'subtotal' => array(
			'decimal' => array(
				'rule' => array('decimal'),
				'message' => 'El Subtotal es incorrecto'
			),
<<<<<<< HEAD
			'notBlank' => array(
				'rule' => array('notBlank'),
=======
			'notempty' => array(
				'rule' => array('notempty'),
>>>>>>> d1dd9254b21e573d5d9674487d0b9be918df744a
				'message' => 'No se encuentra el subtotal'
			)
		),
		'sales_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'No se pudo procesar valor de cabecera'
			)
		),
		'products_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'El producto no es valido'
			)
		)
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Sales' => array(
			'className' => 'Sales',
			'foreignKey' => 'sale_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Products' => array(
			'className' => 'Products',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>