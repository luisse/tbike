<?php
App::uses('AppModel', 'Model');

class Cuenta extends AppModel {
/**
 * Validation rules
 *
 * @var array
 */
	var $validate = array(
		'nrocuenta' => array(
			'alphanumeric' => array(
				'rule' => array('alphanumeric'),
				'message' => 'El numero de cuenta corriente debe contener solo numeros'
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'El Numero de Cuenta Corriente ya Existe'
			)
		),
		'estado' => array(
			'alphanumeric' => array(
				'rule' => array('alphanumeric'),
				'message' => 'El estado debe ser un valor numerico'
			)
		),
		'maxdeuda' => array(
			'decimal' => array(
				'rule' => array('decimal'),
				'message' => 'El máximo de la deuda debe ser un valor numerico decimal'
			)
		),
		'cliente_id' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar un Cliente Valido para Asociar a la Cuenta Corriente'
			)
		),
		'tallercito_id' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar un Negocio Valido para Asociar a la Cuenta Corriente'
			)
		)
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Clientes' => array(
			'className' => 'Clientes',
			'foreignKey' => 'cliente_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Tallercitos' => array(
			'className' => 'Tallercitos',
			'foreignKey' => 'tallercito_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	/*
	 * Funcion: permite ralizar el alta de una nueva cuenta corriente
	 * */
	function AltaCuenta($data = null){
		if(!empty($data)){
			$datasource = $this->getDataSource();
			$this->create();
			$nrocuentacorriente = str_pad($data['Cuenta']['cliente_id'],4,'0',STR_PAD_RIGHT).str_pad($data['Cuenta']['tallercito_id'],4,'0',STR_PAD_RIGHT);
			//incrementamos el valor del numerador
			$data['Cuenta']['nrocuenta'] = $nrocuentacorriente;
			$datasource->begin($this);
			if($this->save($data)){
					$datasource->commit($this);
					return '';
				$datasource->rollback($this);
				return 'No se pudo Grabar la Cuenta';
			}else{
				$datasource->rollback($this);
				return 'No se pudo Generar la Cuenta Corriente'.$nrocuentacorriente;
			}
		}
	}
	
	/*
	 * Funcion: retorna el id de la cuenta corriente para un cliente determinado
	 * */
	function getctactecliente($cliente_id = null,$tallercito_id = null){
		$ctacte = $this->find('first',array('conditions'=>
								array('Cuenta.cliente_id'=>$cliente_id,
										'Cuenta.tallercito_id'=>$tallercito_id),
								'fields'=>array('Cuenta.id')));
		if(!empty($ctacte))
			return $ctacte['Cuenta']['id'];
		else
			return 0;
	}
}
?>