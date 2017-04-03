<?php
//Seteamos valor por defecto en caso de no existir 
if(count($enero) == 1) $enero[]=0;
if(count($febrero) == 1) $febrero[]=0;
if(count($marzo) == 1) $marzo[]=0;
if(count($abril) == 1) $abril[]=0;
if(count($mayo) == 1) $mayo[]=0;
if(count($junio) == 1) $junio[]=0;
if(count($julio) == 1) $julio[]=0;
if(count($agosto) == 1) $agosto[]=0;
if(count($septiembre) == 1) $septiembre[]=0;
if(count($octubre) == 1) $octubre[]=0;
if(count($noviembre) == 1) $noviembre[]=0;
if(count($diciembre) == 1) $diciembre[]=0; 
?>
<?php echo json_encode( array($categoria,$enero,$febrero,$marzo,$abril,$mayo,$junio,$julio,$agosto,$septiembre,$octubre,$noviembre,$diciembre) ); ?>
