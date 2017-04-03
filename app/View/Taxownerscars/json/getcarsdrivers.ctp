<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  /**$result='';
  foreach($taxownerscars as $taxownerscar){
    if($result!='') $result .=',';
    $result.=trim($this->element('retornarjson',array('datos'=>$taxownerscar)));
  }
  $result='{"records":'.$result.'}';
  echo $result;***/
  $result['records']=$taxownerscars;
  echo json_encode($result);
  
?>