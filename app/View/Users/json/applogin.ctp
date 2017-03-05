<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  $result = array('keyacces'=>$keyremote,'error'=>$error,'user_id'=>$user_id);
  echo json_encode($result);
?>
