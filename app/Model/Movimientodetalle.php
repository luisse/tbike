<?php
App::uses('AppModel', 'Model');
/**
 * Movimientodetalle Model
 *
 * @property Formulaimporte $Formulaimporte
 * @property Movimiento $Movimiento
 */
class Movimientodetalle extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	/***public $validate = array(
		'valor' => array(
			'decimal' => array(
				'rule' => array('decimal'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'signo' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'movimiento_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);***/

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Formulaimporte' => array(
			'className' => 'Formulaimporte',
			'foreignKey' => 'formulaimporte_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)/*,
		'Movimiento' => array(
			'className' => 'Movimiento',
			'foreignKey' => 'movimiento_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)*/
	);
	
	function GuardarMovimientoDetalle($data = null){
		if(!empty($data)){
			/*==TRANSACTION INIT==*/
			$this->create();
			$dataSource = $this->getDataSource();
			$dataSource->begin($this);
			/*== END TRANSACCION ==*/
			ClassRegistry::init('Formulaimporte');
			$Formulaimporte = new Formulaimporte();
			$formulas = $Formulaimporte->GetFormulas($data['Movimiento']['tipomovimiento_id']);
			//SIGNO
			ClassRegistry::init('Tipomovimiento');
			$Tipomovimiento = new Tipomovimiento();
			$tipomovmiento = $Tipomovimiento->find('first',array('conditions'=>array('Tipomovimiento.id'=>$data['Movimiento']['tipomovimiento_id'])));
			$movimientodetalles['Movimientodetalle']['movimiento_id']=$data['Movimiento']['id'];
			if($tipomovmiento['Tipomovimiento']['signo'] == 0) $tipomovmiento['Tipomovimiento']['signo'] = -1;
			$movimientodetalles['Movimientodetalle']['signo']=$tipomovmiento['Tipomovimiento']['signo'];
			
			foreach($formulas as $formula){
				if($formula['Formulaimporte']['esporcentaje'] == 1){
					$valor = ($data['Movimiento']['importe']*$formula['Formulaimporte']['valor'])/100;
				}else{
					$valor = $formula['Formulaimporte']['valor'];
				}				
				$movimientodetalles['Movimientodetalle']['formulaimporte_id']=$formula['Formulaimporte']['id'];
				$movimientodetalles['Movimientodetalle']['valor']=$valor;
				$this->create();
				if(!$this->Save($movimientodetalles)){
					$dataSource->rollback($this);
					return false;
				}				
			}
			/*==MOVIMIENTO CON TOTAL GENERAL==*/
			$movimientodetalles['Movimientodetalle']['formulaimporte_id']=null;
			$movimientodetalles['Movimientodetalle']['valor']=$data['Movimiento']['importe'];
			$this->create();
				
			if($this->Save($movimientodetalles)){
									
					$dataSource->commit($this);
					return true;
			}else{
				print_r($movimientodetalles);
					$dataSource->rollback($this);
					return false;			
			}				
		}

	}
}
