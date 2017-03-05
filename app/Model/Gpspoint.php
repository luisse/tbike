<?php
App::uses('AppModel', 'Model');
/**
 * Gpspoint Model
 *
 */
class Gpspoint extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'gpspoint';

	function beforeSave($options=array())
		{
			if(!empty($this->data['Gpspoint']['lat']) && !empty($this->data['Gpspoint']['lon'])){
				$db=$this->getDataSource();
			  $this->data['Gpspoint']['gpspoint']=(object) $db->expression("ST_GeomFromText('POINT(" .$this->data['Gpspoint']['lat'] . " " . $this->data['Gpspoint']['lon'] . ")',4326)");
				return true;
			}
		}

}
