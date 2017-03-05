<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  if(!empty($bicicletasparaalquilere)){
    echo json_encode($bicicletasparaalquilere);
  }else{
    echo '{"error":"'.$error.'"}';
  }
?>
