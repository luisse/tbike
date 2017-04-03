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
	<?php echo $this->fetch('css'); ?>
	<?php
	echo $this->fetch('meta');
	echo $this->fetch('css');
	?>
</head>
<body>
				<div class="row">
					<div class="col-lg-12">
						<?php echo $this->fetch('content'); ?>
					</div>
				</div>
	<!-- Placed at the end of the document so the pages load faster -->
	<?php echo $this->fetch('scriptjs'); ?>
</body>
</html>