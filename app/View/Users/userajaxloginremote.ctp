<?php
echo header("Content-type:  text/xml"); 
$array = array("mensaje" => $error);
echo json_encode($array); 
?>
