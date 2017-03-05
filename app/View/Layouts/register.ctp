<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="VIVEO GROUP">
  <meta name="description" content="Aplicacion Web para pedir Taxi moviles...">
  <meta name="keywords" content="taxi, movilidad, transporte, viajes" />
  <link rel="icon" href="https://taxiar-files.s3.amazonaws.com/img/favicon.ico">
    <title>
			 	<?php //echo $cakeDescription ?>
		 		<?php echo $this->fetch('title'); ?>
		</title>
		<?php
			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');
		?>
		<?php echo $this->Html->css('bootstrap'); ?>
		<?php echo $this->Html->css('bootstrap-social.css');?>
		<?php echo $this->Html->css('/font-awesome/css/font-awesome.css'); ?>
		<?php echo $this->Html->css('metisMenu.min.css'); ?>
		<?php echo $this->Html->css('custom-admin.css'); ?>
		<?php echo $this->Html->css('hover.css'); ?>

	<!-- CDN GOOGLE FONTS -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Maven+Pro" />
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lato" />
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lobster" />
    <link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Roboto' />
	<!-- CDN ESTILOS 960, BOOTSTRAP, JQUERY UI, FONT-AWESOME, ANIMATE.CSS  -->
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />-->
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css" /> -->
	<!-- <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" /> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css" />
</head>
<body>
    <!--MAIN CONTAINER-->
		<?php echo $this->fetch('content'); ?>
		<?php echo $this->Session->flash(); ?>
		<?php //echo $this->element('sql_dump'); ?>
		<?php echo $this->Html->script(array('jquery','bootstrap.min'));?>
		<?php //echo $this->Html->script(array('jquery','bootstrap.min.js','bootstrap-filestyle.min.js','metisMenu.min.js','bootstrap-filestyle.min.js'));?>
		<?php echo $this->fetch('scriptjs'); ?>
	<!-- CDN JS
	<script src="https://apis.google.com/js/client.js?onload=init"></script>
	<!--GOOGLE API ENDPOINTS (REST)-->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.1/modernizr.min.js"></script>-->
	<!-- SOLUCION A ERRORES DE INTERNET EXPLORER -->
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
 </body>
</html>
