<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-es" lang="es-es" dir="ltr" >
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $title_for_layout; ?></title>
  
  
  			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
     <?php 	echo $this->Html->charset('utf-8');
     		//echo $this->Html->script('jquery');
			echo $this->Html->css('bootstrap.min.css');
			echo $this->Html->css('bootstrap-theme.min.css');
			echo $this->fetch('scriptjs');	
     ?>   	
</head>
<body id="minwidth-body">
	<nav class="navbar navbar-default" role="navigation">
	  <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			<span class="sr-only">Barra de Navegacion</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="#">Opciones</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		  <ul class="nav navbar-nav">
			<li class="active"><a href="#">Clientes</a></li>
			<li><a href="#">Empresas</a></li>
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gestiones Varias<b class="caret"></b></a>
			  <ul class="dropdown-menu">
				<li><a href="#">Movilizar Expedientes</a></li>
				<li><a href="#">Buscar Expedientes</a></li>
				<li><a href="#">Generar Expedientes Online</a></li>
				<li class="divider"></li>
				<li><a href="#">Documentar Expedientes del Dia</a></li>
				<li class="divider"></li>
				<li><a href="#">Gestionar Expedientes Perdidos</a></li>
			  </ul>
			</li>
		  </ul>
		  <form class="navbar-form navbar-left" role="search">
			<div class="form-group">
			  <input type="text" class="form-control" placeholder="Search">
			</div>
			<button type="submit" class="btn btn-default">Buscar Informes</button>
		  </form>
		  <ul class="nav navbar-nav navbar-right">
			<li><a href="#">Link</a></li>
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
			  <ul class="dropdown-menu">
				<li><a href="#">Action</a></li>
				<li><a href="#">Another action</a></li>
				<li><a href="#">Something else here</a></li>
				<li class="divider"></li>
				<li><a href="#">Separated link</a></li>
			  </ul>
			</li>
		  </ul>
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>

	<?php echo $this->fetch('content'); ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<?php echo $this->Html->script(array('bootstrap.min.js','bootstrap-transition.js'),array('block'=>'scriptjs'));?>
	<?php echo $this->element('sql_dump');?>
</body>
</html>

