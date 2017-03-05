<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  if(!empty($sectores)){
    //$result = $sectores;
    $i=0;
    foreach($sectores as $sectore){
      $result[$i]['id'] = $sectore['Sectore']['id'];
      $result[$i]['descripcion'] = utf8_encode($sectore['Sectore']['descripcion']);
      $i=$i+1;
    }
  }else{
    $result[]=$error;
  }
  echo json_encode($result);
?>
