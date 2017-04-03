<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  $result='';
  foreach($gpspoints as $gpspoint){
    if ($result != "") {$result .= ",";}
    $result .='{"Lat":"'.$gpspoint[0]['st_x'].'","Lng":"'.$gpspoint[0]['st_x'].'"}';
  }
  $result='{"records":'.$result.'}';
  echo $result;
?>
