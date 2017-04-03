<?php
App::uses('AppModel', 'Model');
/**
 * Taxorder Model
 *
 * @property User $User
 */
class Taxorder extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	function beforeSave($options=array())
	{
		if(!empty($this->data['Taxorder']['lat']) && !empty($this->data['Taxorder']['lng'])){
			$db=$this->getDataSource();
			$this->data['Taxorder']['gpspoint']=(object) $db->expression("ST_GeomFromText('POINT(" .$this->data['Taxorder']['lat'] . " " . $this->data['Taxorder']['lng'] . ")',4326)");
			return true;
		}
	}

	public function get_car_for_position($lat = null,$lng = null,$ratio_km = null, $radiotaxi_id = null, $preferences = null){
		if(empty($preferences))
			return $this->query('SELECT * FROM sp_get_car_for_position(:lat, :lng, :ratio, :id)',['lat' 	=> $lat,
																																													'lng' 	=> $lng,
																																													'ratio' => $ratio_km,
																																													'id' 		=> empty($radiotaxi_id) ? 0 : $radiotaxi_id]);
		else
			return $this->query('SELECT * FROM sp_get_car_for_position(:lat, :lng, :ratio, :id, :preferences)',['lat' 	=> $lat,
																																													'lng' 	=> $lng,
																																													'ratio' => $ratio_km,
																																													'id' 		=> empty($radiotaxi_id) ? 0 : $radiotaxi_id,
																																												  'preferences' => empty($preferences) ? '' : $preferences]);
	}

	public function get_order_per_day($user_id = null, $date_from = null, $date_to = null, $state = null){
		$date_from = $this->formatDate($date_from)." 00:00:00";
		$date_to = $this->formatDate($date_to)." 23:59:59";
		return $this->query("SELECT * FROM sp_orders_days( :id, :datefrom, :dateto, :state)",[  'id'       => $user_id,
																																														'datefrom' => $date_from,
																																														'dateto'   => $date_to,
																																														'state'    => $state]);
	}

	public function get_order_per_driver($user_id = null, $date_from = null, $date_to = null){
		$date_from = $this->formatDate($date_from)." 00:00:00";
		$date_to = $this->formatDate($date_to)." 23:59:59";
		return $this->query("SELECT * FROM sp_orders_driver( :id, :datefrom, :dateto)",['id' 			=> $user_id,
																																									'datefrom'  => $date_from,
																																									'dateto' 		=> $date_to]);
	}

	public function cancel_order($sessionkey = null,$order_id = null,$state = null){
		$data = $this->query('SELECT * FROM sp_cancel_order(:p_sessionkey, :p_order_id,:p_state)',['p_sessionkey' => $sessionkey,
																																																'p_order_id'  => $order_id,
																																																'p_state'     => $state]);
		return  !empty($data) ? $data[0] : array();
	}


}
