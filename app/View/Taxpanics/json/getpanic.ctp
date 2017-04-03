<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  $list_json = '';

  foreach($panics as $panic){
    $convert_json = str_replace('[','',json_encode($panic));
    $convert_json = str_replace(']','',$convert_json);
    $list_json = $list_json.$convert_json.',';
  }
	$result = '{"total_panics":"'.$total_panics.'","panics":['.$list_json.']}';
  $result = str_replace(',]',']',$result);
	echo $result;
?>
