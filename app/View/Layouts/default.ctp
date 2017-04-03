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

	<?php echo $this->Html->css('bootstrap.css'); ?>
	<?php echo $this->Html->css('../font-awesome/css/font-awesome.css'); ?>
	<?php echo $this->Html->css('plugins/morris/morris-0.4.3.min'); ?>
	<?php echo $this->Html->css('sb-admin.css'); ?>
	<?php echo $this->Html->css('ionicons.css'); ?>
	<?php echo $this->fetch('css'); ?>
	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<?php
	echo $this->fetch('meta');
	echo $this->fetch('css');
	?>
	<?php
		$tallercito = $this->Session->read('tallercito');
	?>
</head>
<body>
    <div id="wrapper">

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only"><?php echo __('Navegación')?></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div>
            <!-- /.navbar-header -->
			<div class="row">
				<div class='col-lg-2'>
					<?php
							echo $this->Html->image(array ( 'controller' =>
								'tallercitos' , 'action' => 'mostrarimagen' ,
								$tallercito['Tallercito']['id']),
								array ( 'title' =>'Taller '.$tallercito['Tallercito']['razonsocial'],'width'=>'100px','heigth'=>'110') );
					?>
				</div>
				<div class='col-lg-7'>
					<h4><?php echo __('SGT 1.0 - '.$tallercito['Tallercito']['razonsocial'])?></h4>
				</div>
				<div class='col-lg-3'>
		            <ul class="nav navbar-top-links navbar-right">
						<li>
							<a class="dropdown-toggle" data-toggle="dropdown" href="#" id='glayuda'>
		                        <i class="fa fa-question-circle  fa-fw"></i><?php echo __('Ayuda')?>
		                    </a>
						</li>
		                <li class="dropdown">
		                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
		                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
		                    </a>
								<ul class="dropdown-menu dropdown-messages">
		                        <li>
									<a href="#">
										<center>
											<?php
												$image=$this->Session->read('userfoto');
												if(!empty($image))
													echo $this->Html->image($image,
														array ( 'title' =>__('Imagen de '.$this->Session->read('nomap')),'class'=>'img-rounded','width'=>'150px','height'=>'90px'));
												else{
													echo $this->Html->image('user_not.jpeg',
														array ( 'title' =>__('Imagen de '.$this->Session->read('nomap')),'class'=>'img-rounded','width'=>'40px','height'=>'40px'));
												}
										?>
										</center>
									</a>
		                            <a href="#">
											<div>
												<i class="fa fa-user fa-fw"></i>&nbsp;<strong><?php echo __('')?></strong>
												<span class="pull-right text-muted">
													<em><?php echo $this->Session->read('username')?></em>
												</span>
											</div>
											<div>
											<i class="fa fa-child fa-fw"></i>&nbsp;<strong><?php echo __('Nom. y Ape.')?></strong>
											<span class="pull-right text-muted">
												<em><?php echo $this->Session->read('nomap')?></em></div>
											</span>
											<div>
											<i class="fa fa-envelope fa-fw"></i>&nbsp;<strong><?php echo __('Email')?></strong>
											<span class="pull-right text-muted">
												<em><?php echo $this->Session->read('email')?></em>
											</span>
											</div>
		                            </a>
		                        </li>
		                        <li class="divider"></li>
		                        <li><?php echo $this->Html->link('<i class="fa fa-sign-out fa-fw"></i>&nbsp;'.__('Salir'),array('controller'=>'users',
												'action'=>'logout',''),array('escape'=>false),'')?>
		                        </li>
		                    </ul>
		                    <!-- /.dropdown-user -->
		                </li>
		                <!-- /.dropdown -->
		            </ul>
		        </div>
	         </div>
            <!-- /.navbar-top-links -->
        </nav>
        <!-- /.navbar-static-top -->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <?php echo $this->Html->link('<i class="fa fa-home fa-fw"></i>&nbsp;'.__('Inicio'),array('controller'=>'accesorapidos',
						'action'=>'index',''),array('escape' => false)) ?>
                    </li>
					<?php echo $this->element('mostrar_menu',array('MODEL'=>$this->Session->read('LLAMADO_DESDE')))?>
                </ul>
                <!-- /#side-menu -->
            </div>
            <!-- /.sidebar-collapse -->
        </nav>
        <!-- /.navbar-static-side -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                </div>
                <!-- /.col-lg-12 -->
            </div>
				<!-- /.row -->
				<div class="row">
					<div class="col-lg-12">
						<?php echo $this->fetch('content'); ?>
					</div>
					<!-- /.col-lg-8 (nested) -->
				</div>
								<!-- /.row -->
         </div>
		<!-- /.panel-body -->
   </div>
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
	<?php echo $this->Html->script(array('jquery','bootstrap.min.js','plugins/metisMenu/jquery.metisMenu.js','plugins/morris/raphael-2.1.0.min.js','plugins/morris/morris.js','sb-admin.js','moment.js','moment-spanish'));?>
	<?php echo $this->fetch('scriptjs'); ?>
	<?php if(!empty($action) && !empty($controller)):?>
		<?php echo $this->Html->script(array('/js/helps/global.js'))?>
		<?php echo $this->element('modalbox')?>
		<script>
			var gl_controller='<?php echo $controller?>';
			var gl_action='<?php echo $action?>';
		</script>
	<?php endif;?>
	<!-- <script src="//google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script> -->
</body>
</html>
