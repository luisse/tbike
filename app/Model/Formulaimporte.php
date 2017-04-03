<?php
App::uses('AppModel', 'Model');
/**
 * Formulaimporte Model
 *
 * @property Tallercito $Tallercito
 * @property Movimientodetalle $Movimientodetalle
 */
class Formulaimporte extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'descripcion' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar una descripción para la formula'
			),
		),
		'valor' => array(
			'decimal' => array(
				'rule' => array('decimal'),
				'message' => 'Debe Ingresar un valor decimal'
			),
		)
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
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	/***
	public $hasMany = array(
		'Movimientodetalle' => array(
			'className' => 'Movimientodetalle',
			'foreignKey' => 'formulaimporte_id',
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
	);***/
	
	public function GetFormulas($tipomovimiento_id = null){
		$formulas = array();
		if(!empty($tipomovimiento_id)){
			$formulas = $this->find('all',array('conditions'=>array('Formulaimporte.tipomovimiento_id'=>$tipomovimiento_id),
																'fields'=>array('Formulaimporte.id','Formulaimporte.valor','Formulaimporte.esporcentaje')));
		}
		return $formulas;
	}
}
