<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if(!empty($taxownerdriver)){
  echo json_encode($taxownerdriver);
}else{

	echo '{"error":"'.$error.'"}';
}
?>
