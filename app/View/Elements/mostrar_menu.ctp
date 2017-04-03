            <li>
                        <a href="#"><i class="fa fa-user fa-fw"></i><?php echo __('Usuarios')?><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                            	<?php if( $this->Session->read('tipousr') != 2):?>
	                                <?php echo $this->Html->link('<i class="fa fa-th-list fa-fw"></i>&nbsp;'.__('Ver'),array('controller'=>'users',
									'action'=>'index',''),array('escape' => false))?>
								<?php elseif($this->Session->read('tipousr') == 2): ?>
	                                <?php echo $this->Html->link('<i class="fa fa-th-list fa-fw"></i>&nbsp;'.__('Ver Datos Usuario'),array('controller'=>'users',
									'action'=>'edit',$this->Session->read('user_id')),array('escape' => false))?>
	                                <?php echo $this->Html->link('<i class="fa fa-bars fa-fw"></i>&nbsp;'.__('Ver Bicicletas'),array('controller'=>'bicicletas',
									'action'=>'index',''),array('escape' => false))?>
	                                <?php //echo $this->Html->link('<i class="fa fa-wrench fa-fw"></i>&nbsp;'.__('Ver Services'),array('controller'=>'bicicletareparamos',
											//'action'=>'servicesclientes',''),array('escape' => false))?>
	                                <?php echo $this->Html->link('<i class="fa fa-wrench fa-fw"></i>&nbsp;'.__('Historia de Services'),array('controller'=>'bicicletareparamos',
									'action'=>'listbicreparpersona',$this->Session->read('cliente_id')),array('escape' => false))?>

								<?php endif;?>
                            </li>
							<?php if( $this->Session->read('tipousr') != 2):?>
                            <li>
                                <?php echo $this->Html->link('<i class="fa fa-plus fa-fw"></i>&nbsp;'.__('Agregar'),array('controller'=>'users',
								'action'=>'addcliente',''),array('escape' => false))?>
                            </li>

							<?php endif; ?>
                	</ul>
            	<!-- /.nav-second-level -->
			</li>
			<?php if( $this->Session->read('tipousr') != 2):?>
			<li>
				<a href="#"><i class="fa fa-laptop fa-fw"></i><?php echo __('Mi Taller') ?><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
                	<li>
                                <?php echo $this->Html->link('<i class="fa fa-th-list fa-fw"></i>&nbsp;'.__('Ver Datos'),array('controller'=>'tallercitos',
								'action'=>'edit',$this->Session->read('tallercito_id')),array('escape' => false))?>
					</li>
					<li>
						<?php echo $this->Html->link('<i class="fa fa-calendar-o fa-fw"></i>&nbsp;'.__('Ver Calendario'),array('controller'=>'bicicletareparamos',
						'action'=>'bicicletareparamocalendario',''),array('escape' => false))?>
					</li>
					<li>
						<?php echo $this->Html->link('<i class="fa fa-bar-chart-o  fa-fw"></i>&nbsp;'.__('Ingresos Mensuales'),array('controller'=>'bicicletareparamos',
						'action'=>'vertotalservicemes',''),array('escape' => false))?>
					</li>
					<li>
						<?php echo $this->Html->link('<i class="fa fa-clock-o fa-fw"></i>&nbsp;'.__('Tiempos Estimados'),array('controller'=>'bicicletareparamos',
						'action'=>'tiemposreparestimado',''),array('escape' => false))?>
					</li>
					<li>
						<?php echo $this->Html->link('<i class="fa fa-envelope fa-fw"></i>&nbsp;'.__('Mensajes Mantenimiento'),array('controller'=>'mensajes',
						'action'=>'indexmant',''),array('escape' => false))?>
					</li>
				</ul>
			</li>
			<li>
                <a href="#"><i class="fa fa-ambulance fa-fw"></i><?php echo __('Bicicletas') ?><span class="fa arrow"></span></a>
            	<ul class="nav nav-second-level">
					<li>
						<?php echo $this->Html->link('<i class="fa fa-plus fa-fw"></i>&nbsp;'.__('Nuevo Ingreso'),array('controller'=>'bicicletareparamos',
						'action'=>'add',''),array('escape' => false))?>
					</li>
					<li>
						<?php echo $this->Html->link('<i class="fa fa-th-list fa-fw"></i>&nbsp;'.__('Ver Ingresos'),array('controller'=>'bicicletareparamos',
						'action'=>'index',''),array('escape' => false))?>
					</li>
					<li>
						<?php echo $this->Html->link('<i class="fa fa-user-md fa-fw"></i>&nbsp;'.__('Ver Bicicletas en Taller'),array('controller'=>'bicicletareparamos',
						'action'=>'tallerlistarbicicletas',''),array('escape' => false))?>
					</li>
					<li>
						<?php echo $this->Html->link('<i class="fa fa-thumbs-o-up fa-fw"></i>&nbsp;'.__('Entregar Bicicleta'),array('controller'=>'bicicletareparamos',
						'action'=>'bicicletasentrega',''),array('escape' => false))?>
					</li>
					<li>
						<?php echo $this->Html->link('<i class="fa fa-thumbs-o-up fa-fw"></i>&nbsp;'.__('Entregas Vista GPS'),array('controller'=>'bicicletareparamos',
						'action'=>'mapbicicletaentregaall',''),array('escape' => false))?>
					</li>
				</ul>
			</li>
      <li>
          <a href="#"><i class="fa fa-shopping-cart fa-fw"></i><?php echo __('Alquileres') ?><span class="fa arrow"></span></a>
        	<ul class="nav nav-second-level">
            <li>
  						<?php echo $this->Html->link('<i class="fa fa-th-list fa-fw"></i>&nbsp;'.__('Ver Alquileres'),array('controller'=>'alquileres',
  						'action'=>'index',''),array('escape' => false))?>
  					</li>
  					<li>
  						<?php echo $this->Html->link('<i class="fa fa-plus fa-fw"></i>&nbsp;'.__('Nuevo Alquiler'),array('controller'=>'alquileres',
  						'action'=>'add',''),array('escape' => false))?>
  					</li>
            <li>
  						<?php echo $this->Html->link('<i class="fa fa-shopping-cart fa-fw"></i>&nbsp;'.__('Bicicleta para Aqluiler'),array('controller'=>'bicicletasparaalquileres',
  						'action'=>'index',''),array('escape' => false))?>
  					</li>            
          </ul>
      </li>

			<li>
                <a href="#"><i class="fa fa-money fa-fw"></i><?php echo __('Movimientos') ?><span class="fa arrow"></span></a>
            	<ul class="nav nav-second-level">
					<li>
						<?php echo $this->Html->link('<i class="fa fa-plus fa-fw"></i>&nbsp;'.__('Deudas Clientes'),array('controller'=>'clientes',
						'action'=>'clientedeuda',''),array('escape' => false))?>
					</li>
					<li>
						<?php echo $this->Html->link('<i class="fa fa-bar-chart-o  fa-fw"></i>&nbsp;'.__('Movimientos por Fecha'),array('controller'=>'movimientos',
						'action'=>'veringresosfecha',''),array('escape' => false))?>
					</li>
					<li>
						<?php echo $this->Html->link('<i class="fa fa-exclamation-triangle  fa-fw"></i>&nbsp;'.__('Movimientos Manuales'),array('controller'=>'movimientos',
						'action'=>'movimientosmanuales',''),array('escape' => false))?>
					</li>
				</ul>
			</li>
			<li>
                <a href="#"><i class="fa fa-cogs fa-fw"></i><?php echo __('Productos') ?><span class="fa arrow"></span></a>
            	<ul class="nav nav-second-level">
					<li>
						<?php echo $this->Html->link('<i class="fa fa-plus fa-fw"></i>&nbsp;'.__('Categorias'),array('controller'=>'categorias',
						'action'=>'index',''),array('escape' => false))?>
					</li>
					<li>
						<?php echo $this->Html->link('<i class="fa fa-plus fa-fw"></i>&nbsp;'.__('Proveedores'),array('controller'=>'proveedores',
						'action'=>'index',''),array('escape' => false))?>
					</li>
					<li>
						<?php echo $this->Html->link('<i class="fa fa-th-list fa-fw"></i>&nbsp;'.__('Productos'),array('controller'=>'products',
						'action'=>'index',''),array('escape' => false))?>
					</li>
					<li>
						<?php echo $this->Html->link('<i class="fa fa-plus fa-fw"></i>&nbsp;'.__('Agregar Producto'),array('controller'=>'products',
						'action'=>'add',''),array('escape' => false))?>
					</li>
					<li>
						<?php echo $this->Html->link('<i class="fa fa-money fa-fw"></i>&nbsp;'.__('Actualizar Precios'),array('controller'=>'products',
						'action'=>'actualizapreciomasivo',''),array('escape' => false))?>
					</li>

				</ul>
			</li>
			<li>
                <a href="#"><i class="fa fa-desktop fa-fw"></i><?php echo __('Sistema') ?><span class="fa arrow"></span></a>
            	<ul class="nav nav-second-level">
					<li>
						<?php echo $this->Html->link('<i class="fa fa-envelope-o fa-fw"></i>&nbsp;'.__('Mensajes'),array('controller'=>'mensajes',
						'action'=>'index',''),array('escape' => false))?>
					</li>
					<li>
						<?php echo $this->Html->link('<i class="fa fa-share fa-fw"></i>&nbsp;'.__('Mensajes Enviados'),array('controller'=>'senderlogs',
						'action'=>'index',''),array('escape' => false))?>
					</li>
					<li>
						<?php echo $this->Html->link('<i class="fa fa-plus fa-fw"></i>&nbsp;'.__('Movimientos'),array('controller'=>'tipomovimientos',
						'action'=>'indexusr',''),array('escape' => false))?>
					</li>
					<li>
						<?php echo $this->Html->link('<i class="fa fa-wrench fa-fw"></i>&nbsp;'.__('Conf. Globales'),array('controller'=>'sysconfigs',
						'action'=>'add',''),array('escape' => false))?>
					</li>
					<li>
						<?php echo $this->Html->link('<i class="fa fa-tasks fa-fw"></i>&nbsp;'.__('Activar Accesos'),array('controller'=>'buttonusers',
						'action'=>'index',''),array('escape' => false))?>
					</li>
				</ul>
			</li>
			<li>
                <a href="#"><i class="fa fa-credit-card fa-fw"></i><?php echo __('Ventas') ?><span class="fa arrow"></span></a>
            	<ul class="nav nav-second-level">
					<li>
						<?php echo $this->Html->link('<i class="fa fa-th-list fa-fw"></i>&nbsp;'.__('Ventas'),array('controller'=>'sales',
						'action'=>'index',''),array('escape' => false))?>
					</li>
					<li>
						<?php echo $this->Html->link('<i class="fa  fa-plus fa-fw"></i>&nbsp;'.__('Nueva Venta'),array('controller'=>'sales',
						'action'=>'newsale',''),array('escape' => false))?>
					</li>
					<li>
						<?php echo $this->Html->link('<i class="fa  fa-bar-chart-o fa-fw"></i>&nbsp;'.__('Ranking Productos'),array('controller'=>'sales',
						'action'=>'rankingproduct',''),array('escape' => false))?>
					</li>
					<li>
						<?php echo $this->Html->link('<i class="fa  fa-bar-chart-o fa-fw"></i>&nbsp;'.__('Ventas Totales'),array('controller'=>'sales',
						'action'=>'diagramasventas',''),array('escape' => false))?>
					</li>
				</ul>
			</li>
	<?php endif;?>
