<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $title_for_layout; ?></title>
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Le styles -->
    <!-- Core CSS - Include with every page -->
	<?php echo $this->Html->css('bootstrap.min.css'); ?>
	<?php echo $this->Html->css('../font-awesome/css/font-awesome.css'); ?>
    <!-- Page-Level Plugin CSS - Dashboard -->
	<?php echo $this->Html->css('sb-admin.css'); ?>
	<style>
		body {
			background:url(../img/back.JPG) no-repeat center center fixed;
		 -webkit-background-size: cover;
		 -moz-background-size: cover;
		 -o-background-size: cover;
		 background-size: cover;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<?php echo $this->fetch('content'); ?>
		</div>
	</div>
	<?php echo $this->element('mensajealerta',array('title'=>__('Seguridad y Acceso'),'buttondesc'=>' Cerrar'))?>
	<!-- Le javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<?php echo $this->Html->script(array('jquery','bootstrap.min.js','jquery-ui.min','fmensajes','plugins/metisMenu/jquery.metisMenu.js','sb-admin.js'));?>
	<?php echo $this->Html->script('login_init');?>
	<?php echo $this->fetch('scriptjs'); ?>
	<script src="//google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
	<?php echo $this->fetch('script'); ?>

</body>
</html>
