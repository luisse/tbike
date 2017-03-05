<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  $result['error']=$error;
  $result['id']=$id;
  echo json_encode($result);
?>
