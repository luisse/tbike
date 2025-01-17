<?php
App::uses('AppModel', 'Model');
/**
 * Mensajesmantenimiento Model
 *
 * @property Bicicleta $Bicicleta
 */
class Mensajesmantenimiento extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'fechacontrol' => array(
			'date' => array(
				'rule' => array('date'),
				'message' => 'Debe Ingresar una Fecha Valida'
			),
		),
		'enviarcorreo' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Seleccionar una opción'
			),
		),
		'objetorevisar' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Especificar un Componente a Revisar'
			),
		),
		'observaciones' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar una Observación'
			),
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	/**public $belongsTo = array(
		'Bicicleta' => array(
			'className' => 'Bicicleta',
			'foreignKey' => 'bicicleta_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);**/
	
	function beforeSave($options=array())
	{
		if(!empty($this->data['Mensajesmantenimiento']['fechacontrol'])) $this->data['Mensajesmantenimiento']['fechacontrol'] = $this->formatDate($this->data['Mensajesmantenimiento']['fechacontrol']);
		return true;
	}	
	
	function beforeValidate($options=array())
	{
		if(!empty($this->data['Mensajesmantenimiento']['fechacontrol'])) $this->data['Mensajesmantenimiento']['fechacontrol'] = $this->formatDate($this->data['Mensajesmantenimiento']['fechacontrol']);
		return true;
	}			
}
