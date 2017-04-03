<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if(!empty($error))
  $records['error'] = $error;
if(!empty($userpreferencejson))
  $records = $userpreferencejson;

echo json_encode($records);

 ?>
