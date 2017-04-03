<?php
class Test extends AppModel{
	var $name = 'Test';
	
	var $validate = array(
		'fecha' => array(
			'date' => array(
				'rule' => array('date'),
				'message' => 'Debe Ingresar una Fecha Valida'
			),
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar la Fecha del test'
			),
			'fechavalidar'=>array(
				'rule'=>'fechavalidar',
				'message'=>'Ya existe la FC de reposo para la Fecha Ingresada')
		),
		'hora' => array(
			'numeric' => array(
				'rule' => array('time'),
				'message' => 'Debe Ingresar una hora valida'
			),
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar la hora'
			)
		),
		'temperatura' => array(
			'numeric' => array(
				'rule' => array('decimal',1),
				'message' => 'Debe Ingresar la temperatura'
			),
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar la hora'
			)
		),
		
		
		'ppm' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Debe Ingresar solo números'
			),
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Debe Ingresar las pulsaciones'
			),
			'range' => array(
				'rule' => array('range',20,120),
				'message' => 'El Rango de pulsaciones debe estar entre 20 y 120'
			)
		),
		
	);

	function formatDate($dateToFormat){
	    $pattern1 = '/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/i';
	    $pattern2 = '/^([0-9]{4})\/([0-9]{2})\/([0-9]{2})$/i';
	    $pattern3 = '/^([0-9]{2})-([0-9]{2})-([0-9]{4})$/i';
	    $pattern4 = '/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/i';
	
	    $coincidences = array();
	    
	    if(preg_match($pattern1, $dateToFormat)){
	        $newDate = $dateToFormat; 
	    }elseif(preg_match($pattern2, $dateToFormat, $coincidences)){
	        $newDate = $coincidences[1] . '-' . $coincidences[2] . '-' . $coincidences[3];
	    }elseif(preg_match($pattern3, $dateToFormat, $coincidences)){
	        $newDate = $coincidences[3] . '-' . $coincidences[2] . '-' . $coincidences[1];
	    }elseif(preg_match($pattern4, $dateToFormat, $coincidences)){
	        $newDate = $coincidences[3] . '-' . $coincidences[2] . '-' . $coincidences[1];
	    }else{
	        $newDate = null;
	    }
	    return $newDate;
	}	

	function fechavalidar(){
		if(!empty($this->data))
			$this->data['Test']['fecha']=$this->formatDate($this->data['Test']['fecha']);
		return $this->isUnique(array('fecha'=>$this->data['Test']['fecha']));
	}
	
}
?>