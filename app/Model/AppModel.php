<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {



	/*
	*Funcion: permite convertir la fecha en un formato determinado para guardar la misma
	*/
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
}
