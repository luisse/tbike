<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  $result['error']=$error;
  echo json_encode($result);
?>
