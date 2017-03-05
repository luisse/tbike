<?php
$json_return='';
foreach($data as $det){
  $object = (object) $det[0];
  $object->color = "rgba(75,192,192,0.4)";
  $json_return = json_encode($object).','.$json_return;
}
$json_return = substr($json_return,0,strlen($json_return) - 1);
echo '['.$json_return.']'
?>
