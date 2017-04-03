<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$result='';
foreach($taxupositions as $taxuposition){
  unset($taxuposition[0]['id']);
  unset($taxuposition[0]['distance']);
  $object = (object) $taxuposition[0];
  $result = $result.json_encode($object).',';
}
$result = substr($result,0,strlen($result) - 1);
echo '['.$result.']';
?>
