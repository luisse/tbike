<?php
$result="";
?>
 	<?php foreach($datos as $clave => $dato):?>
 		<?php foreach($dato as $clavev => $values):?>
      <?php
      if(!empty($values)){
    	if($result != "") $result .=',';
	   	$result .= '"'.$clavev.'":"'.rtrim($values).'"';
      }
      ?>
	<?php endforeach;?>
<?php endforeach;
  echo $result='{'.$result.'}';

?>
