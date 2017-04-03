<?php
App::uses('AppModel', 'Model');
/**
 * Taxsecurity Model
 *
 * @property Taxjourney $Taxjourney
 */
class Taxsecurity extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'taxsecuritys';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Taxjourney' => array(
			'className' => 'Taxjourney',
			'foreignKey' => 'taxjourney_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	function uploadFile($data){
		App::uses('CimageComponent','Controller/Component');
		if(!empty($this->data['User']['picture']['tmp_name'])){
			$cimage = new CimageComponent(new ComponentCollection());
			/*imagen tamanio normal*/
			if(!empty($this->data['User']['email'])){
				$filename = $this->data['User']['email'].'userimg';
			}else{
				$filename = $this->data['User']['id'].'userimg';
			}
			list($fileData,$filename) = $cimage->ImagenToBlob($this->data['User']['picture']['tmp_name'],80,80,$filename);
			//$this->data['User']['picture']=base64_encode($fileData);
			$this->data['User']['picture']=$filename;
		}
		return true;
	}

	function beforeSave($options=array())
	{
		if(!empty($this->data['Taxsecurity']['lat']) && !empty($this->data['Taxsecurity']['lng'])){
			$db=$this->getDataSource();
			$this->data['Taxsecurity']['gpspoint']=(object) $db->expression("ST_GeomFromText('POINT(" .$this->data['Taxsecurity']['lat'] . " " . $this->data['Taxsecurity']['lng'] . ")',4326)");
			return true;
		}
	}
}
