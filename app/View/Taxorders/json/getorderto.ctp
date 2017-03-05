<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  $result='';

  if(!empty($error)){
  	$result='{"records":{"error":"'.$error.'"}}';
  	echo $result;
  }else{
  	echo json_encode($taxorders);
  }
  
  
?>