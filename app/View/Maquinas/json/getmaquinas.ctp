<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  if(!empty($maquinas)){
  //  $result = $maquinas;
    $i=0;
    foreach($maquinas as $maquina){
      $result[$i]['id'] = $maquina['Maquina']['id'];
      $result[$i]['descripcion'] = utf8_encode($maquina['Maquina']['descripcion']);
      $i=$i+1;
    }
  }else{
    $result[]=$error;
  }
  echo json_encode($result);
?>
