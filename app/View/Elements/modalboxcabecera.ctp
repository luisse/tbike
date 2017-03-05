<div class="panel <?php echo $paneltipo?>">
  <div class="panel-heading">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<?php if(strpos($title,'Panel')) 
				$icon='fa-print';
			else
				$icon='fa-desktop';?>
	<h4 class="modal-title" id="myModalLabel"><i class="fa <?php echo $icon?> fa-lg"></i>&nbsp;<?php echo $title ?></h4>
  </div>
  <div class="panel-body">