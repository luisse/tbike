<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  $result='';
  if(!empty($error))
  	$result='{"records":{"error":"'.$error.'"}}';
  else
    if(!empty($taxorder))
    	$result='{"records":'.json_encode($taxorder).'}';
  echo $result;
?>
