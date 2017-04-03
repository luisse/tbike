<?php
App::uses('AppModel', 'Model');
/**
 * Bicicletasparaalquilere Model
 *
 * @property Bicicleta $Bicicleta
 */
class Bicicletasparaalquilere extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'estado' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar el Estado de la Bicicleta'
			),
		),
		'detalle' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar el detalle de la bicicleta'
			),
		),
		'bicicleta_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Debe asignar el identificador de bicicleta'
			),
			'existebike'=>array('rule'=>'existebike','message'=>'(*) Bicicleta Asignada para alquiler')
		),

	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Bicicleta' => array(
			'className' => 'Bicicleta',
			'foreignKey' => 'bicicleta_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	function existebike($data){
		$cantidad = $this->find('count',array('conditions'=>array('Bicicletasparaalquilere.bicicleta_id = '.$this->data['Bicicletasparaalquilere']['bicicleta_id'],'Bicicletasparaalquilere.tallercito_id'=>$this->data['Bicicletasparaalquilere']['tallercito_id'])));
		if($cantidad > 0)
			return true;
		else
			return false;
	}

}
