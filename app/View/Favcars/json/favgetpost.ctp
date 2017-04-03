<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  if(!empty($error)){
    $result = $favcars;
  }else{
    $result[]=array('error'=>$error);
  }

  echo json_encode($result);
?>
