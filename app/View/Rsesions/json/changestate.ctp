<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  //ch
  echo json_encode(array('error'=>$error,'state'=>$state));
?>