<?php

App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
App::uses('Xml', 'Utility');
/*
* FUNCTION: THE KILLER - dead of all order dead and clean firebase DB for zombies.
*/
class KillorderShell extends AppShell{
  public $uses=array('Taxorder');

  public function main(){
    $taxorders = $this->Taxorder->find('all',array('conditions'=>array('Taxorder.state in(0)',
    																	"date_part('month',current_timestamp) = date_part('month',Taxorder.date)",
    																	"date_part('year',current_timestamp) = date_part('year',Taxorder.date)",
    																	"date_part('day',current_timestamp) = date_part('day',Taxorder.date)",
                                      "date_part('minutes',current_timestamp - Taxorder.date) > 7",
                                      "date_part('hours',current_timestamp - Taxorder.date) >= 0"),
    															'order'=>array('Taxorder.id DESC'),
                                  'limit'=>100,
    															'fields'=>array('Taxorder.id')));
    foreach($taxorders as $taxorder){
      $taxorder['Taxorder']['state'] = 2;
      $this->Taxorder->create();
      if(!$this->Taxorder->save($taxorder)) print_r('ERROR: No se pudo actualizar el producto');
      $this->_execfirebase('firebase/orders/'.$taxorder['Taxorder']['id'],[''],'del');
    }

    $taxorders = array();
    $taxorders = $this->Taxorder->find('all',array('conditions'=>array('Taxorder.state in(1,2)',
    																	"date_part('month',current_timestamp) = date_part('month',Taxorder.date)",
    																	"date_part('year',current_timestamp) = date_part('year',Taxorder.date)",
    																	"date_part('day',current_timestamp) = date_part('day',Taxorder.date)",
                                      "date_part('minutes',current_timestamp - Taxorder.date) > 70",
                                      "date_part('hours',current_timestamp - Taxorder.date) >= 0"),
    															'order'=>array('Taxorder.id DESC'),
                                  'limit'=>100,
    															'fields'=>array('Taxorder.id')));

      foreach($taxorders as $taxorder){
        $this->_execfirebase('firebase/orders/'.$taxorder['Taxorder']['id'],[''],'del');
      }


  }

  public function _execfirebase($path_name = null,$json = null,$func = null){
		if(!empty($path_name) && !empty($json)){
			$this->log('Delete path on firebase: '.$path_name, LOG_DEBUG);
			if (!include (APP .'Vendor'. DS .'vendor'. DS.'ktamas77'.DS.'firebase-php'. DS .'autoload.php')) {
				trigger_error("Unable to load composer autoloader.", E_USER_ERROR);
				exit(1);
			}

     $firebase = new \Firebase\FirebaseLib("https://tst-taxiseguro.firebaseio.com","O2FJN7IYbtpONWoieskw2mOF6HOYJ5HFjlE1Tlxc");
			if(empty($func))
				$result = $firebase->set($path_name, $json);
			else
				$result = $firebase->delete($path_name);
		}
	}

}
?>
