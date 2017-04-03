<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  if($error){
  	$result['error']=$error;
  }else{
  	$result=$userfavplaces;
  }
  echo json_encode($result);
?>