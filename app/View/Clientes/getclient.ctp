<?php
	if(!empty($clientes))
		echo $this->element('retornaxml',array('modelo'=>'clientes','datos'=>$clientes));
?>