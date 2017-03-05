    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i>Por Favor Inicia Sesión</i></h3>
                    </div>
                    <div class="panel-body">
							<?php
							echo $this->Form->create("User",array('action'=>'login'));
							?>
                            <fieldset>
                                <div class="form-group">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-user fa-fw"></i>
										</span>
										<?php
										echo $this->Form->input('User.username',array('label'=>false,
													'class'=>'form-control',
													'placeholder'=>__('Usuario'),
													'autofocus','size'=>15,'div'=>false));
										?>
									</div>
                                </div>
                                <div class="form-group">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-key fa-fw"></i>
										</span>
										<?php
										echo $this->Form->input('User.password',array('label'=>false,
															'class'=>'form-control',
															'type'=>'password',
															'size'=>'15',
															'div'=>false,
															'placeholder'=>__('Contraseña')));
										?>
									</div>
                                </div>
								<div class='row'>
									<div class="col-lg-5">
									</div>
									<div class="col-lg-3">
										<!-- Change this to a button or input when using this as a form -->
										<button type="button" class="btn btn-primary btn-lg" id='ingresar'>
										  <?php echo __('Iniciar Sesión');?> <span class="glyphicon glyphicon-log-in"></span>
										</button>
									</div>
								</div>
                            </fieldset>
                        </form>
                        <?php
						echo $this->Form->end();
						?>
                    </div>
                </div>
            </div>
        </div>
    </div>
