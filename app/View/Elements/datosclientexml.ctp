<?php
header("Content-type: text/xml");
?>
 <clientes>
 	<?php foreach($cliente as $cliente):?>
   <datos id='<?php echo $cliente['Cliente']['id'] ?>' added="0">
   <dni><?php echo $cliente['Cliente']['dni'] ?></dni>
   <nombre><?php echo $cliente['Cliente']['nombre'] ?></nombre>
   <apellido><?php echo $cliente['Cliente']['apellido'] ?></apellido>
   <telefono><?php echo $cliente['Cliente']['telefono'] ?></telefono>
   <celular><?php echo $cliente['Cliente']['celular'] ?></celular>
   <email><?php echo $cliente['Cliente']['email'] ?></email>
   <estado><?php echo $cliente['Cliente']['estado'] ?></estado>
   <codarea><?php echo $cliente['Cliente']['codarea'] ?></codarea>
   </datos>
   <?php endforeach;?>
</clientes>