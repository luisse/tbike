<?php
class Numeradore extends AppModel {
	var $name = 'Numeradore';
	var $validate = array(
		'detalle' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar el detalle'
			),
			'maxlength' => array(
				'rule' => array('maxlength','45'),
				'message' => 'El Detalle Supera los 45 Catacteres'
			),
		),
		'rangodesde' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar el Rango Desde'
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Solo se Aceptan numeros para el rango'
			),
		),
		'rangohasta' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar el Rango Hasta'
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Solo se Aceptan numeros para el rango'
			),
		)
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Tallercito' => array(
			'className' => 'Tallercito',
			'foreignKey' => 'tallercito_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	//Retorna rango en que se encuentre el numerador
	function retornaValor($tallercito_id = null,$detalle = null){
		$rangos = $this->find('first',array('conditions'=>array('Numeradore.tallercito_id'=>$tallercito_id,
							'Numeradore.detalle'=>$detalle),
							'fields'=>array('Numeradore.rangodesde','Numeradore.rangohasta','Numeradore.id')));
		return $rangos;
	}
	
	function incrementarNumeradore($negocio_id = null,$detalle = null){
		$rangos = $this->retornaValor($negocio_id,$detalle);
		if(!empty($rangos)){
			$rangodesde = $rangos['Numeradore']['rangodesde'];
			$rangodesde++;
			if($rangodesde > $rangos['Numeradore']['rangohasta']){
				return -1; //numerador exceded error
			}else{
				$data['Numeradore']['id'] = $rangos['Numeradore']['id'];
				$data['Numeradore']['rangodesde'] = $rangodesde;
				$this->create();
				if($this->save($data)){
					return 0; //actualizado		 
				}else{
					return 1; //con error en actualizacion
				} 
			}
		}
	}
	
}
?>