<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$taxturn_id = !empty($user_details[0]['taxturn']['id']) ? $user_details[0]['taxturn']['id'] : '';
$taxownerscar_id  = !empty($user_details[0]['taxturn']['id']) ? $user_details[0]['taxownerscar']['id'] : '';
$taxownerscar_id  = !empty($user_details[0]['taxturn']['id']) ? $user_details[0]['taxownerscar']['id'] : '';
$user_id =  !empty($user_details[0]['user']['id']) ? $user_details[0]['user']['id'] : '';
$rsesion_key =  !empty($user_details[0]['rsesion']['sessionkey']) ? $user_details[0]['rsesion']['sessionkey'] : '';
$json = '{"taxturn_id":'.$taxturn_id.',"taxownerscar_id":'.$taxownerscar_id.',"user_id":'.$user_id.',"rsesion_key":"'.$rsesion_key.'"}';
echo $json;
?>
