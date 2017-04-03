<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  if(!empty($cart)){
    $result = $cart;
  }else{
    $result[]=$error;
  }
  echo json_encode($result);
?>
