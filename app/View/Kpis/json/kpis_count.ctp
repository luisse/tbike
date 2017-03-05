<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  echo json_encode(
  	array('kpi_libre'=>$kpi_libre,
  	'kpi_ocupado'=>$kpi_ocupado,
  	'kpi_en_camino'=>$kpi_en_camino,
  	'kpi_fuera_servicio'=>$kpi_fuera_servicio,
  	'kpi_libre_list'=>$kpi_libre_json,
  	'kpi_ocupado_list'=>$kpi_ocupado_json,
  	'kpi_en_camino_list'=>$kpi_en_camino_json,
  	'kpi_fuera_servicio_list'=>$kpi_fuera_servicio_json));
?>
