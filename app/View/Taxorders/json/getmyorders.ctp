<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if(!empty($taxorders)){
  echo json_encode($taxorders);
}else{
	$result='{"error":"no se recuperaron datos"}';
	echo $result;
}
?>