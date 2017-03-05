<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  /**$result='';
  $result='{"Error":"'.$error.'"}';
  $result ='{"records":['.$result.']}';**/
  $result=array();
  $result[0]['records']['error']=$error;
  echo json_encode($result);
?>
