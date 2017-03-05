<?php
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
App::uses('Xml', 'Utility');

class CompressjsShell extends AppShell{

  public function main(){
    $path = APP.'webroot'.DS.'js'. DS ;
    $path_to_save =  APP.'webroot'.DS.'js_prod'.DS;
    $directories = ['radiotaxicars','faultcars','taxownerscars','taxorders','mains','radiotaxis','taxownerdrivers','users'];
    foreach($directories as $directorie){
      $this->_directory_scan($path.$directorie. DS,$path_to_save);
    }
  }

  public function _directory_scan($path = null, $path_to_save = null){
    $this->log('Directory Read: '.$path, LOG_DEBUG);
    $dir   = new Folder($path);
    $files = $dir->read('files','*.js');
    $all   = $dir->findRecursive('().*');

    foreach($all as $file){
      $Compresor = new MatthiasMullie\Minify\JS($file);
      $sourcetosave = str_replace('/js','/js_prod',$file);
      $this->log('Directory File: '.$sourcetosave, LOG_DEBUG);
      try{
      $Compresor->minify($sourcetosave);

      }catch(Exception $e){
        $this->log($e,LOG_DEBUG);
      }
      $Compresor = null;
    }

  }

}

?>
