<?php
App::uses('AppModel', 'Model');
/**
 * Alquilere Model
 *
 * @property Cliente $Cliente
 * @property Alquileredetalle $Alquileredetalle
 */
class Alquilere extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'detalle' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar un detalle de alquiler'
			),
		),
		'total' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'No se encontro un totalizador'
			),
		),
		'cliente_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Debe Ingresar el Cliente'
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
		'Cliente' => array(
			'className' => 'Cliente',
			'foreignKey' => 'cliente_id',
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
		'Alquileredetalle' => array(
			'className' => 'Alquileredetalle',
			'foreignKey' => 'alquilere_id',
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

	function beforeValidate($options = array()){
		$this->data['Alquilere']['fecha'] =  date('Y-m-d H:i:s');
	}

	public function guardaralquileres($data = null){
		if(!empty($data)){
			$dataSource = $this->getDataSource();
			ClassRegistry::init('Bicicletasparaalquilere');
			$Bicicletasparaalquilere = new Bicicletasparaalquilere();
			$this->create();
			$dataSource->begin($this);
			$data['Alquilere']['cliente_id']=$data['Sale']['cliente_id'];
			$result = $this->saveAssociated($data,array('atomic'=>true));
			if($result == 1){
				foreach ($data['Alquileredetalle'] as $alquileredetalle) {
					if(!empty($alquileredetalle['bicicletasparaalquilere_id'])){
						$bicicletaparaalquiere['Bicicletasparaalquilere']['id']=$alquileredetalle['bicicletasparaalquilere_id'];
						$bicicletaparaalquiere['Bicicletasparaalquilere']['estado']=2;//alquilada
						$Bicicletasparaalquilere->create();
						if(!$Bicicletasparaalquilere->save($bicicletaparaalquiere)){
							$dataSource->rollback($this);
							return false;
						}
					}
				}
				//commit transaction
				$dataSource->commit($this);
				return true;
			}
			$dataSource->rollback($this);
			return false;
		}
	}

}
