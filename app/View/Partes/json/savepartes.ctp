<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  if(!empty($partes)){
  //  $result = $maquinas;
    $i=0;
    foreach($partes as $parte){
      $result[$i]['id'] = $parte['Parte']['id'];
      $result[$i]['descripcion'] = utf8_encode($parte['Parte']['descripcion']);
      $i=$i+1;
    }
  }else{
    $result[]=$error;
  }
  echo json_encode($result);
?>
