<?php

App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
App::uses('Xml', 'Utility');

/*
* FUNCTION: THE KILLER - dead of all order dead and clean firebase DB for zombies.
*/
class GenusertestShell extends AppShell{
  public $uses = array('User','Rsesion');

  public function main(){
    $username = 'test__';
    $email    = 'test@gmail';
    $password = '123456';
    $user  = [];
    $file = new File(APP.'Console/url_test_siege.txt', true, 0644);

    for($i = 0; $i <= 10000; $i++){
      $count = 0;
      $user['User']['group_id'] 			 = 2;
      $user['User']['username'] 			 = $username.$i;
      $user['User']['password'] 			 = "bacb7225cfbce6520fc6953dcd7c1ac754732358";
      $user['User']['password_repit'] =  "bacb7225cfbce6520fc6953dcd7c1ac754732358";
      $user['User']['state']	   			 = 1; //active
      $user['User']['email']          = $email.$i.'.com';

      $count = $this->User->find('count',array('conditions'=>array('username'=>$user['User']['username'])));
      if($count == 0){
        $this->User->create();
        if($this->User->save($user)){
          $keyremote					= Security::generateAuthKey();
          $data['ipconnect']	= '127.0.0.1';
          $data['sessionkey']	= $keyremote;
          $data['user_id']		= $this->User->id;
          $data['phone_id']   = '';
          if(!$this->Rsesion->AddSession($data)){
            $keyremote = '';
          }

          $file->write('https://www.taxiar.com.ar/users/setphonetoken_test.json POST key='.$keyremote."&phone_id=TEST\n");
          $file->write('https://www.taxiar.com.ar/taxorders/taxordercancel.json POST key='.$keyremote."&message=TEST&reason=TRASH\n");
          $file->write('https://www.taxiar.com.ar/taxubications/savepoint.json POST key='.$keyremote."&lat=-26.818133&lng=-65.265304\n");
          $file->write('https://www.taxiar.com.ar/taxorders/takeorder.json POST key='.$keyremote."&lat=-26.818133&lng=-65.265304&orderid=1055\n");
          $file->write('https://www.taxiar.com.ar/taxorders/getmyorderstate.json POST key='.$keyremote);
          $file->write('https://www.taxiar.com.ar/taxorders/neworder.json POST key='.$keyremote."&lat=-26.818133&lng=-65.265304&orderid=1055&directiodetails=AA&travelto=BB&preference=LIMOUSINE\n");
          $file->write('https://www.taxiar.com.ar/taxorders/neworder.json POST key='.$keyremote."&lat=-26.818133&lng=-65.265304&orderid=1055&directiodetails=AA&travelto=BB&preference=LIMOUSINE\n");
          $file->write('https://www.taxiar.com.ar/taxorders/taxordercancel.json POST key='.$keyremote);
        }
      }else{
        $this->log('Usuario existe en DB:'.$username.$i, LOG_DEBUG);
      }
    }
    $this->log('Creando archivo con urls para test', LOG_DEBUG);
    $file->close();
  }

}
