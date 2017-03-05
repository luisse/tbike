<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  $result='';
  $result='{"Error":"'.$error.'"}';
  echo($result);
?>
