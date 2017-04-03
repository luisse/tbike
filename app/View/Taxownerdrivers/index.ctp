<?php echo $this->Html->script(array('/js/taxownerdrivers/index.js','jquery.toastmessage'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>
<?php echo $this->element('flash_message')?>
<script>
	var rlink="<?php echo $this->Html->url(array('controller'=>'taxownerdrivers','action'=>'listtaxownerdrivers')) ?>"
</script>
<br>
<div class="row">
		<div class="col-lg-12">
				<div class="panel panel-default">
						<div class="panel-heading">
								<i class="fa fa-table fa-fw"></i><?= empty($username) ? __('Mis Choferes') : __('Choferes Asociados a '.$username) ?>
						</div>
						<div class="panel-body">
								<div class="row">
										<div class="col-lg-12">
													<div id='listtaxownerdriver'>
														<div id='cargandodatos' style='display:none;top: 50%;left: 50%;text-align:center'>
															<?php echo $this->Html->image('https://taxiar-files.s3.amazonaws.com/img/carga.gif')?>
														</div>
													</div>
													</div>
												</div>
											</div>
											<?php if(!empty($username)): ?>
												<div class="row">
													<div class="col-xs-12 col-sm-12">
														<center>


															<?php
								                  echo $this->Html->link('<i class="fa fa-users fa-fw"></i>&nbsp;'.__('Volver a listado de usuarios'),array('controller'=>'users',
								                      'action'=>'index',null),
								                      array('onclick'=>'','escape'=>false),'');

								              ?>

														</center>
													</div>
												</div>
											<?php endif; ?>
				</div>
		</div>
</div>

<?php echo $this->element('modalbox')?>
