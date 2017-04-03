
<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$json_bicicleta = array();
$i=0;
foreach($bicicletas as $bicicleta){
	$json_bicicleta[$i]['id'] = $bicicleta['Bicicleta']['id'];
	$json_bicicleta[$i]['Name'] = utf8_encode($bicicleta['Bicicleta']['nrocuadro']);
	$i=$i+1;
}
echo '{"records":'.json_encode($json_bicicleta).'}';
/***
$outp	="";
$outp .= '{"Name":"IBM",';
$outp .= '"City":"LODON",';
$outp .= '"Country":"UK"},';
//

$outp .= '{"Name":"VIVEO GROUP",';
$outp .= '"City":"Yerba Buena",';
$outp .= '"Country":"ARGENTINA"},';
//
$outp .= '{"Name":"FAKA",';
$outp .= '"City":"Sidney",';
$outp .= '"Country":"AUSTRALIA"}';

$outp ='{"records":['.$outp.']}';
echo($outp);
**/
?>
