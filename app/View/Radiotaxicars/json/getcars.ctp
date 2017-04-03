<?php
$json_return='';
foreach($cars as $car){
  $object = (object) $car[0];
  $json_return = json_encode($object).','.$json_return;
}
$json_return = substr($json_return,0,strlen($json_return) - 1);
?>
<?= '['.$json_return.']' ?>
