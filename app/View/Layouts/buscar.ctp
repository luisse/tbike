<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-es" lang="es-es" dir="ltr" > 
<head>
    <title><?php echo $title_for_layout; ?></title>
        <?php
        	echo $this->Html->charset('utf-8');
        	/*Archivos JS para generar el AJAX necesario para cada uno de los casos*/
			if(!empty($js_funciones)){
				foreach($js_funciones as $js_funcione){
					echo $this->Html->script($js_funcione);
				}
				echo $this->Html->css('jquery-ui');        	
			}
          	?>
</head>
<body id="minwidth-body">
	<div id="border-top" class="h_green">
		<div>
			<div>
				<span class="version">Versión 1.0</span>
				<span class="title"></span>
			</div>
		</div>
	</div>
	<div id="header-box">
		<div class="clr"></div>
	</div>
<div id="content-box">
		<div class="border">
			<div class="padding">
			<div id="element-box">
				<?php echo $this->fetch('content'); ?>
			</div>
			<noscript>
				¡Advertencia! JavaScript debe estar habilitado para un correcto funcionamiento de la Administración
			</noscript>
			<div class="clr"></div>
			</div>
		</div>
	</div>
	<div id="border-bottom">
	<div>
		<div>
		</div>
	</div>
	</div>
	<div id="footer">
		<p class="copyright">
			<a href="" target="_blank">Tallercito Bike</a>
			es software libre liberado bajo la <a href="http://www.gnu.org/licenses/gpl-2.0.html">Licencia GNU/GPL</a>.	</p>
	
	</div>
</body>
</html>
