<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  $result='{"records":{"error":"'.$error.'","order_id":"'.$order_id.'"}}';
  echo $result;
?>
