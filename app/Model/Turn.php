<?php
App::uses('AppModel', 'Model');
/**
 * Favcar Model
 *
 */
class Turn extends AppModel {

  function getturn($user_id = null){
    $turn = $this->query("SELECT * FROM sp_addturns(".$user_id.")");
    return $turn;
  }
  
}

?>
