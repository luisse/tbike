<?php
App::uses('AppModel', 'Model');
/**
 * Group Model
 *
 */
class Group extends AppModel {

/**
 * Display field
 *
 * @var string
 */
  public $actsAs = array('Acl' => array('type' => 'requester'));

  public function parentNode() {
  	return null;
  }

}
