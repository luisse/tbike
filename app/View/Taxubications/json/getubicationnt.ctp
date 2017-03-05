<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  $result='';
  /***foreach($taxowners as $taxowner){
    if($result!='') $result .=',';
    $result.=trim($this->element('retornarjson',array('datos'=>$taxowner)));
  }***/
  if(!empty($taxubication))
    $result = '{"lat":"'.$taxubication[0]['lat'].'","lng":"'.$taxubication[0]['lng'].'"}';
  else
    $result = '{"lat":"0","lng":"0"}';
  $result='{"records":'.$result.'}';
  echo $result;
?>
