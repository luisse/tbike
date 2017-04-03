<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  $result=array("error"=>$error,"taxorder"=>$taxorder_ref);
  echo json_encode($result);
?>
