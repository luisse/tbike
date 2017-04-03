<?php
	$calendar = array();
	
	$i=0;
			foreach($bicicletareparamos as $bicicletareparamo){
				if($bicicletareparamo['Bicicletareparamo']['estado']==0) $color = 'red';
				if($bicicletareparamo['Bicicletareparamo']['estado']==1) $color = 'green';
				if($bicicletareparamo['Bicicletareparamo']['estado']==2) $color = 'orange';
				
				$calendar[$i]=array('id'=>$bicicletareparamo['Bicicletareparamo']['id'],
										'title'=>$bicicletareparamo['Bicicleta']['marca'].'-'.$bicicletareparamo['Bicicleta']['modelo'].'-'.$bicicletareparamo['Bicicletareparamo']['detallereparacion'],
										'start'=>$this->Time->format('Y-m-d',$bicicletareparamo['Bicicletareparamo']['fechaingreso']).'T08:00:00',
										'end'=>$this->Time->format('Y-m-d',$bicicletareparamo['Bicicletareparamo']['fechaegreso']).'T09:00:00',
										'color'=>$color);
				$i++;
			}
echo json_encode($calendar);
?>