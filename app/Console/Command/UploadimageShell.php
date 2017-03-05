<?php

App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
App::uses('Xml', 'Utility');
/*
* FUNCTION: Upload image to local server to S3 amazon
*/
class UploadimageShell extends AppShell{
  public $uses = array('User','Taxownerscar','Taxownerdriver');

  public function main(){
    //users upload image to amazonS3
    $users = $this->User->find('all');
    foreach($users as $user){
      $file_name = !empty($user['User']['picture']) ? $user['User']['picture'] : '';
      $file_path = WWW_ROOT.$file_name;
      if(file_exists($file_path) && !empty($file_name)){
        $user_save['User']['picture'] = $this->User->upload_image_to_ws($file_name);


        $user_save['User']['id'] = $user['User']['id'];
        $this->User->validator()->remove('picture');
        if($this->User->save($user_save)){
          //print_r($user_save);
          $this->log('Remote Link:'.$user_save['User']['picture'], LOG_DEBUG);
          //$this->log('File User to Sync to Amazon: '.$file_path, LOG_DEBUG);
        }else{
          $errors = $this->User->invalidFields();
          $error ='';
          foreach($errors as $errorget){
            foreach($errorget as $errormsg){
              $res = strpos($error,$errormsg);
              if(empty($res))
                  $error = $error."<br>".$errormsg;
            }
          }

          $this->log('Remote Link Error:'.$error, LOG_DEBUG);
        }
      }
    }

    //Taxownerscar upload image to amazonS3
    $taxownerscars = $this->Taxownerscar->find('all');
    foreach($taxownerscars as $taxownerscar){
      $file_name = !empty($taxownerscar['Taxownerscar']['picture']) ? $taxownerscar['Taxownerscar']['picture'] : '';
      $file_path = WWW_ROOT.$file_name;
      if(file_exists($file_path) && !empty($file_name)){
        $taxownerscar['Taxownerscar']['picture'] = $this->Taxownerscar->upload_image_to_ws($file_name);
        $this->Taxownerscar->validator()->remove('picture');
        if($this->Taxownerscar->save($taxownerscar)){
          $this->log('File Taxownerscar to Sync to Amazon: '.$file_path, LOG_DEBUG);
        }
      }
    }

    //Taxownerdriver upload image to amazonS3
    $taxownerdrivers = $this->Taxownerdriver->find('all');
    foreach($taxownerdrivers as $taxownerdriver){
      $file_name = !empty($taxownerdriver['Taxownerdriver']['picture']) ? $taxownerdriver['Taxownerdriver']['picture'] : '';
      $file_path = WWW_ROOT.$file_name;
      if(file_exists($file_path) && !empty($file_name)){
        $taxownerdriver['Taxownerdriver']['picture'] = $this->Taxownerdriver->upload_image_to_ws($file_name);
        $this->Taxownerdriver->validator()->remove('picture');
        if($this->Taxownerdriver->save($taxownerdriver)){
          $this->log('File Taxownerdriver to Sync to Amazon: '.$file_path, LOG_DEBUG);
        }
      }
    }


  }
}
