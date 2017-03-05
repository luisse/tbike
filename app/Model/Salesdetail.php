<?php
class Salesdetail extends AppModel {
	var $name = 'Salesdetail';
	var $validate = array(
		'cantidad' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'La Cantidad debe ser solo números'
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe Ingresar la Cantidad'
			)
		),
		'subtotal' => array(
			'decimal' => array(
				'rule' => array('decimal'),
				'message' => 'El Subtotal es incorrecto'
			),
			'notempty' => array(
				'rule' => array('notempty'),
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