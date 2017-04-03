<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  //$result=array();
  //$result[0]['records']['error']=$error;
  echo json_encode(array('error'=>$error));
?>
