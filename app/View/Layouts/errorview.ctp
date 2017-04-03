<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Le styles -->
    <!-- Core CSS - Include with every page -->
	<?php echo $this->Html->css('bootstrap.min.css'); ?>
	<?php echo $this->Html->css('../font-awesome/css/font-awesome.css'); ?>
    <!-- Page-Level Plugin CSS - Dashboard -->
	<?php echo $this->Html->css('plugins/morris/morris-0.4.3.min'); ?>
    <!-- SB Admin CSS - Include with every page -->
	<?php echo $this->fetch('css'); ?>
	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<?php
	echo $this->fetch('meta');
	echo $this->fetch('css');
	?>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
			<div class='row'>
				<div class="col-lg-10">
					<a class="navbar-brand" href="#">Sistema Gestion de Taller 1.0</a>
				</div>
			</div>
            <!-- /.navbar-header -->
		</nav>    		
		<div class="well">
				<!-- /.row -->
				<div class="row">
					<div class="col-lg-12">
					<div class="panel panel-warning">
					  <div class="panel-heading"><h3>Error el Ejecutar Petición</h3></div>
					  <div class="panel-body">					
						<div class="alert alert-danger">
						<?php echo $this->fetch('content'); ?>
						</div>
						</div>
					</div>
					</div>
					<!-- /.col-lg-8 (nested) -->
				</div>
		</div>
   </div>
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
	<!-- Le javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<?php echo $this->Html->script(array('jquery','bootstrap.min.js','plugins/morris/raphael-2.1.0.min.js','plugins/morris/morris.js','moment.js','moment-spanish'));?>
	<?php echo $this->fetch('scriptjs'); ?>
	<script src="//google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>

</body>
</html>