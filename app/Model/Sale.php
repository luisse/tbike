<?php
class Sale extends AppModel {
	var $name = 'Sale';
	var $validate = array(
		'saledate' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				'message' => 'La Fecha de Compra debe Tener Fecha y Hora'
			)
		),
		'totalsale' => array(
			'decimal' => array(
				'rule' => array('decimal'),
				'message' => 'No se Encontro el total de la venta'
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'El total no puede ser vacio'
			)
		),
		'totaliva' => array(
			'decimal' => array(
				'rule' => array('decimal'),
				'message' => 'El Total del Iva es invalido'
			),
		),
		'tipofactura' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe Seleccionar el Tipo de Factura'
			)
		),
		'nrofactura' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'El Nro de Factura solo permite números'
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe Ingresar el Numero de Factura'
			),
		),
		'tallercito_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'El negocio debe ser indicado'
			),
		),
		'fecha' => array(
			'date' => array(
				'rule' => array('date'),
				'message' => 'La Fecha de Compra es Invalida'
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe Ingresar Fecha de Pago'
			),
		)/***,
		'cliente_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Debe Ingresar el cliente'
			)
		),***/
	);
	
	var $hasMany = array(
		'Salesdetail' => array(
			'className' => 'Salesdetail',
			'foreignKey' => 'sale_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		));
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Tallercito' => array(
			'className' => 'Tallercito',
			'foreignKey' => 'tallercito_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Cliente' => array(
			'className' => 'Cliente',
			'foreignKey' => 'cliente_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	
	function beforeValidate($options = array()){
		$this->data['Sale']['fecha'] =  $this->formatDate($this->data['Sale']['fecha']);
	}
	
	/*
	 * Funcion: permite insertar una nueva venta
	 * */
	function savesale($data = null){
		if(!empty($data)){
			$dataSource = $this->getDataSource();
			ClassRegistry::init('Numeradore');
			ClassRegistry::init('Product');
			ClassRegistry::init('Sysconfig');
			$Numeradore = new Numeradore();
			$Product   = new Product();
			$Sysconfig = new Sysconfig();
			$this->create();
			$dataSource->begin($this);
			$result = $this->saveAssociated($data,array('atomic'=>true));
			if($result == 1){
				/*Determina si debemos validar stock u no*/
				$sysconfig = $Sysconfig->find('first',array('conditions'=>array('Sysconfig.tallercito_id'=>$data['Sale']['tallercito_id']),
										'fields'=>'Sysconfig.stockrestrict'));
				if(!empty($sysconfig['Sysconfig']['stockrestrict']))
					$stockrestrict=$sysconfig['Sysconfig']['stockrestrict'];
				else
					$stockrestrict=0;
					
				if($stockrestrict == 1){				
					foreach($data['Salesdetail'] as $salesdetail){
						$product['Product']['id']  = $salesdetail['product_id'];
						$product['Product']['cantidad'] = $salesdetail['cantidad'];
						if(!$Product->ProductStock($product,true)){
							$dataSource->rollback($this);
							return false;
						}
					}
				}
				$result = $Numeradore->incrementarNumeradore($data['Sale']['tallercito_id'],'FACTURA');
				if($result == 0){
					$dataSource->commit($this);
					return true;
				}
			}
			$dataSource->rollback($this);
			return false;
		}
	}
	
	function totalsales($data = nul){
		ClassRegistry::init('Cliente');
		$cliente = new Cliente();
		$ls_filtro='1 = 1 ';
		$fieldName = 'Sale.fecha';
		if(!empty($data)){
			if($data['fecdesde'] != null && $data['fecdesde'] != '' && 
				$data['fechasta'] != null &&  $data['fechasta'] != ''){
				$ls_filtro = $ls_filtro.' AND ( '.$fieldName.' >= "'.
						$this->formatDate($data['fecdesde']).'" AND '.
						$fieldName.' <= "'.$this->formatDate($data['fechasta']).'" )'; 
			}
			//filtro por tipo de factura
			if($data['tipofactura'] != null && 
				$data['tipofactura']!=''){
				$ls_filtro = $ls_filtro.' AND tipofactura = "'.$data['tipofactura'].'"';	
			}
			//filtro por nombre de cliente
			if($data['Sale']['cliente_id']!= '' && $data['Sale']['cliente_id']!= null){
				$ls_filtro = $ls_filtro.' AND cliente_id = '.$data['Sale']['cliente_id'];
			}
		}
		return $this->find('all',array('fields'=>array('sum(totalsale) AS totalsales'),'conditions'=>$ls_filtro));		
	}
	
}
?>