<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if(!empty($error)){
  $result['error'] = $error;
  echo json_encode($result);
}else
  echo json_encode($taxorders);
?>
