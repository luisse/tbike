<?php
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
App::uses('Xml', 'Utility');
App::uses('ConnectionManager', 'Model');

class SincronizedbShell extends AppShell{
  function main(){
    $path = APP.'sql'.DS.'run'. DS ;
    $this->_directory_scan($path);
  }

  public function _directory_scan($path = null){
    $this->log('Directory Read: '.$path, LOG_DEBUG);
    $dir     = new Folder($path);
    $all_sql = $dir->findRecursive('().*.sql');
    $db = ConnectionManager::getDataSource('default');
    foreach($all_sql as $sql_file){
      $res  = 'ok';
      $file = new File($sql_file);
      $script_sql = $file->read();
      try{
        $db->rawQuery($script_sql,[false]);
      }catch(Exception $e){
        //si hay error dejamos el archivo con el detalle del error
        $file_error_log = str_replace('.sql','.error',$sql_file);
        $file_error     = new File($file_error_log, true, 0644);
        $file_error->write($e,'w',true);
        $file_error->close();
        $res = 'error';
      }

      $file->copy($sql_file.'.'.$res);
      $file->delete();
      $file->close();
    }
  }

}

?>
