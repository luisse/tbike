<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$result[0]['records']['licence']=$licence;
echo json_encode($result);
?>
