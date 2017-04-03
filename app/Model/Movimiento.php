<?php
App::uses('AppModel', 'Model');
/**
 * Movimiento Model
 *
 * @property Tallercito $Tallercito
 * @property Cuenta $Cuenta
 * @property Tipomovimiento $Tipomovimiento
 * @property Movimientodetalle $Movimientodetalle
 */
class Movimiento extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		/***'nrocomprobante' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'El Nro de Comprobante debe Contener Solo Números'
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe Ingresar el Numero de Comprobante'
			),
			'comprobanteunico'=>array(
				'rule'=>'movimientocomprobunico',
			'message'=>'El Nro de Comprabante ya Existe')
		),**/
	
		'fechamov' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				'message' => 'Debe Ingresar una Fecha correcta para el Movimiento'
			),
<<<<<<< HEAD
			'notBlank' => array(
				'rule' => array('notBlank'),
=======
			'notEmpty' => array(
				'rule' => array('notEmpty'),
>>>>>>> d1dd9254b21e573d5d9674487d0b9be918df744a
				'message' => 'Debe Ingresar una fecha de movimiento'
			),
		),
		'tipomovimiento_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Debe Ingresar el Tipo de Movimiento'
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Tallercito' => array(
			'className' => 'Tallercito',
			'foreignKey' => 'tallercito_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Cuenta' => array(
			'className' => 'Cuenta',
			'foreignKey' => 'cuenta_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Tipomovimiento' => array(
			'className' => 'Tipomovimiento',
			'foreignKey' => 'tipomovimiento_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Movimientodetalle' => array(
			'className' => 'Movimientodetalle',
			'foreignKey' => 'movimiento_id',
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

	
	/*
	 * data struct
	 * tipomov: tipo de movimiento (deuda,pagos,salida caja,entrada caja etc)
	 * nrocomprobante: puede ser un numero de factura,ticket de debito,credito
	 * fechahoramov: fecha hora en que se ejecuto el movimiento
	 * ctacte: cuenta corriente del cliente
	 * importemov: importe del movimiento
	 * typemovent_id: tipo de movimiento
	 * negocio_id: negocioid
	 * cliente_id: para recuperar la ctacte del mismo
	 * */
	function AgregarMovimiento($data = null){
		if(!empty($data)){
			//si es un movimiento a un cliente recuperamos la cuenta corriente del cliente
			if(!empty($data['Movimiento']['cliente_id'])){
				ClassRegistry::init('Cuenta');
				$Cuenta = new Cuenta();
				$nrocuenta = $Cuenta->getctactecliente($data['Movimiento']['cliente_id'],$data['Movimiento']['tallercito_id']);
				$data['Movimiento']['cuenta_id'] = $nrocuenta;
				if(empty($nrocuenta)) return 'No se pudo recuperar la Cuenta Corriente del Cliente';			
				$datasource = $this->getDataSource();
			}else{
				$data['Movimiento']['cuenta_id'] = $data['Movimiento']['cuenta_id'];
			}
			
			
			$data['Movimiento']['fechamov'] = date('Y-m-d H:i:s');
			$this->create();
			$dataSource = $this->getDataSource();
			$dataSource->begin($this);
			if($this->save($data['Movimiento'])){
				//guardamos los datos en la tabla con el commit
				ClassRegistry::init('Movimientodetalle');
				$data['Movimiento']['id']=$this->id;
				$Movimientodetalle = new Movimientodetalle();
				if($Movimientodetalle->GuardarMovimientoDetalle($data)){
					$dataSource->commit($this);
					return '';
				}else{
					$dataSource->rollback($this);
					return 'Error al Guardar el Detalle';
				}
			}else{
				$dataSource->rollback($this);
				return 'No se pudo gravar el movimiento';
			}
		}
		
		return '';
	}
	 
	function movimientocomprobunico($nrocomprobante = null,$tipodemoviento_id = null){
		if(empty($nrocomprobante)) $nrocomprobante=$this->data['Movimiento']['nrocomprobante'];
		if(empty($tipodemoviento_id)) $tipodemoviento_id= $this->data['Movimiento']['tipomovimiento_id'];
		return $this->isUnique(array('nrocomprobante'=>$nrocomprobante,'tipodemoviento_id'=>$tipodemoviento_id));
	}
	
	function GetTotalCuenta($cuenta_id = null){
		$saldo = 0;			
		if(!empty($cuenta_id)){
				$movimientos = $this->find('all',array('conditions'=>array('Movimiento.cuenta_id'=>$cuenta_id,'Movimiento.tipomovimiento_id in(1,2)'),
																			'fields'=>array('(SELECT valor*signo FROM movimientodetalles 
																								WHERE movimientodetalles.movimiento_id = Movimiento.id and (movimientodetalles.formulaimporte_id = 0 OR movimientodetalles.formulaimporte_id is null)) as importe')));
				foreach($movimientos as $movimiento){
					$saldo = $saldo + $movimiento[0]['importe'];
				}
		}
		return $saldo;
	}
	
}
