<?php
App::uses('Folder', 'Utility');
App::uses('File',   'Utility');
App::uses('Model',  'Utility');

class DbsincronizedShell extends AppShell {
  public $connection = 'default';
  function main(){
    $path_files_sql = APP.'sql'.DS.'execute'. DS ;
    $error = $this->exec_file($path_files_sql);
    $this->log($error, LOG_DEBUG);
  }

  function exec_file($path_files_sql = null){
    if(empty($path_files_sql)) return 'Directorie not exists';
    if(!is_dir($path_files_sql)) return 'Directorie File for SQL not exists';
    $dir   = new Folder($path_files_sql);
    $files = $dir->findRecursive('().*');
    foreach($files as $file){
      $sql_file = new File($file);
      $sql_file->open();
      $sql = $sql_file->read();
      $this->log($sql, LOG_DEBUG);
      $db = $this->getDataSource();
      $db->query($sql);
      $sql_file->close();
    }
    print_r($files);
  }
}

 ?>
