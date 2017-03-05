<?php
App::uses('AppModel', 'Model');
/**
 * Taxubication Model
 *
 */
class Taxubication extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';

/**
 * Validation rules
 *
 * @var array
 */

	function beforeSave($options=array())
		{
			if(!empty($this->data['Taxubication']['lat']) && !empty($this->data['Taxubication']['lng'])){
				$db=$this->getDataSource();
				$this->data['Taxubication']['gpspoint']=(object) $db->expression("ST_GeomFromText('POINT(" .$this->data['Taxubication']['lat'] . " " . $this->data['Taxubication']['lng'] . ")',4326)");
				return true;
			}
		}

		/*
		* Function: return ubication of a car with token
		*/
		function get_ubication($sessionkey = null){
			//$db = $this->getDataSource();
			$data = $this->query('SELECT * FROM sp_get_ubication(:sessionkey)',array('sessionkey'=>$sessionkey));
			return  !empty($data) ? $data[0] : array();
		}
}
