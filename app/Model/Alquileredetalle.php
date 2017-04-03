<?php
App::uses('AppModel', 'Model');
/**
 * Alquileredetalle Model
 *
 * @property Alquilere $Alquilere
 * @property Bicicletasparaalquilere $Bicicletasparaalquilere
 */
class Alquileredetalle extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'horasalquila' => array(
			'time' => array(
				'rule' => array('time'),
				'message' => 'Debe Ingresar una Hora valida HH:MM'
			),
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar la Hora'
			),
		),
		'cantidad' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Debe Ingresar la Cantidad'
			),
		),
		'subtotal' => array(
			'numeric' => array(
				'rule' => array('decimal'),
				'message' => 'Debe Ingresar la Cantidad'
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
		'Alquilere' => array(
			'className' => 'Alquilere',
			'foreignKey' => 'alquilere_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Bicicletasparaalquilere' => array(
			'className' => 'Bicicletasparaalquilere',
			'foreignKey' => 'bicicletasparaalquilere_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public function marcarentregado($data = null){
		if(!empty($data)){
			$dataSource = $this->getDataSource();
			$dataSource->begin($this);
			$this->create();
			if($this->save($data)){
				$dataSource->commit($this);
				return true;
			}else{
				$dataSource->rollback($this);
				return false;
			}
		}
		return false;
	}
}
