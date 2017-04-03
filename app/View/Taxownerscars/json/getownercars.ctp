<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  $result='';
  foreach($taxowners as $taxowner){
    if($result!='') $result .=',';
    $result.=trim($this->element('retornarjson',array('datos'=>$taxowner)));
  }
  $result='{"records":'.$result.'}';
  echo $result;
?>
