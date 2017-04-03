<?php
App::uses('AppModel', 'Model');
/**
 * Mensajeservice Model
 *
 * @property Bicicleta $Bicicleta
 */
class Mensajeservice extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'detalleservice' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar el detalle'
			),
			'maxLength' => array(
				'rule' => array('maxLength',50),
				'message' => 'La Cantidad Máxima es de 200 caracteres'
			),
		),
		'enviarcorreo' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Indicar el Envío de Correo'
			),
		),
		'cantmensajes' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingesar la Cantidad de Mensajes a Enviar'
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'La Cantidad de mensajes debe ser numerico'
			),
		),
		'fechaaprox' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar la Fecha de Próximo Servicio'
			),
			'date' => array(
				'rule' => array('date'),
				'message' => 'Debe Ingresar una Fecha Valida'
			),
		),
		'confirmadocliente' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Debe Ingresar un estado valido para la Confirmación del Cliente'
			)
		)
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
	
	function beforeSave($options=array())
	{
		if(!empty($this->data['Mensajeservice']['fechaaprox'])) $this->data['Mensajeservice']['fechaaprox'] = $this->formatDate($this->data['Mensajeservice']['fechaaprox']);
		return true;
	}	
	
	function beforeValidate($options=array())
	{
		if(!empty($this->data['Mensajeservice']['fechaaprox'])) $this->data['Mensajeservice']['fechaaprox'] = $this->formatDate($this->data['Mensajeservice']['fechaaprox']);
		return true;
	}		
}
