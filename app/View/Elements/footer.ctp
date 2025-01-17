<!-- Section Footer start  -->
<!-- Modal CHOFERES TAXI -->
<div class="modal fade bannerformmodal" id="bannerformmodal" role="dialog" tabindex="-1" aria-labelledby="Login" aria-hidden="true">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content" >
      <div class="modal-header" style="padding: 25px 40px;">
        <button id="closeModalC" type="button" class="close" data-dismiss="modal">&times;</button>
        <h4><span class="glyphicon glyphicon-lock"></span><?php echo __('Ingresar') ?></h4>
      </div>
      <div class="modal-body" style="padding: 30px 50px;">
          <?php echo $this->element('login'); ?>
      </div>
      <!-- Otras Opciones de Formulario -->
      <div class="modal-footer">
        <button class="btn btn-info pull-left" type="submit" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar </button>
        <div id="footerOptions">
          <p><?php echo __('Eres nuevo?')?><a style="color:#000" id="signerUp" href="/registeruser" >&nbsp;<?php echo __('Registrarse')?></a></p>
          <p><?php echo __('Olvidaste tu ')?><a style="color:#999" id="forgotterPass" href="#" id='resetpass' onclick='return changepassword()'>&nbsp;<?php echo __('Contraseña')?>? </a></p>     <!--ReestablecerContraseña()-->
        </div>
      </div>
    </div>

  </div>
</div>
<?php echo $this->element('flash_message')?>
<!-- END LOGIN -->
<!-- Section Contact start -->
<!-- Section Contact start -->
<section id="contact" >
<div class="pattern"></div>
<div class="container">

  <div class="row">
        <div class="col-md-6 col-md-offset-0">
            <div class="footer-links">

        <a href="#header" class="page-scroll logo-title">
          <img src="https://taxiar-files.s3.amazonaws.com/img/landpage/blackbg.png" alt="">
        </a>

                <p><a href="/pasajero">Pasajeros</a> - <a href="/taxista">Taxistas</a> <!--- <a href="/radiotaxi">Radio Taxi</a>  - <a href="blog/">Novedades</a> --> - <a href="/ayuda">Ayuda</a> - <a href="/sistemap">Mapa del Sitio</a></p>
                  <div class="btn-footer-container" align="center">
                  <div class="col-lg-1"></div>
                  <div class="col-lg-5">
                        <a href="https://play.google.com/store/apps/details?id=com.taxiar.app&hl=es"><i><img src="https://taxiar-files.s3.amazonaws.com/img/landpage/sec-img/btn-wht-google-play.png"></i></a>
                    </div>
                    <div class="col-lg-5">
                        <a href="https://itunes.apple.com/gb/app/taxiar-pasajeros/id1200849847?mt=8"><i><img src="https://taxiar-files.s3.amazonaws.com/img/landpage/sec-img/btn-wht-apple-store.png"></i></a><br>iOS solo para usuarios
                    </div>
                    <div class="col-lg-1"></div>
                    </div>
                    <!-- <p class="privacy"><a href="/privacidad">Políticas de Privacidad</a> - <a href="/privacidad#terms">Términos y Condiciones</a></p> -->
            </div>
        </div>

    <div class="col-md-5">

                    <h2 class="sec-title">Contacto</h2>
                    <div class="line-btm c-white"></div>
                    <p>
                    <ul class="footer-social list-inline">
                        <li><a href="https://www.facebook.com/taxiar/?fref=ts" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#" target="_blank"><i class="fa fa-google"></i></a></li>
                        <li><a href="#" target="_blank"><i class="fa fa-youtube"></i></a></li>

                    </ul>
                    </p>
                 <!-- heading row end -->

      <form id="contact" class="contact-inner">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">

              <input type="text" name="name" id="name" class="form-control" placeholder="Nombre:" required>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">

              <input type="email" name="email" id="email" class="form-control" placeholder="Email:" required>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">

              <input type="tel" name="phonenumber" id="phonenumber" class="form-control" placeholder="Teléfono:">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">

              <textarea name="message" id="message" cols="30" rows="2" class="form-control" placeholder="Mensaje:" required></textarea>
            </div>
          </div>
        </div> <!-- row end -->
        <div id="form-messages"></div>
      </form>
      <div class="row">
        <div class="col-md-12 text-center">
          <button class="btn btn-default" onclick='sendmail()'>Enviar mensaje</button>
        </div>
      </div>

    </div>
  </div><!-- row end -->
</div><!-- container end -->
</section>
<!-- Section Contact end -->

<!-- Section Footer start  -->
<footer id="footer">
<div class="container">
  <div class="row">
    <div class="col-md-12">

      <div class="row">
        <div class="col-md-6">
          <div class="copyright">
            <p>2017 &copy; Copyright reserved to <span><a href="#header" class="page-scroll">Taxiar</a></span></p>
          </div>
        </div>
        <!-- <div class="col-md-6">
          <div class="copyright">
            <p class="pull-right">Development by <a href="http://www.viveogroup.com" target="_blank"><img src="images/logo-viveo.png"></a></p>
          </div>
        </div> -->
      </div>
    </div>
  </div> <!-- row end  -->
</div> <!-- container end  -->
</footer>
<!-- Section Footer end  -->


<!-- Back To Top Button -->
<div id="back-top">
    <a href="#header" class="page-scroll btn btn-primary" ><i class="fa fa-angle-double-up"></i></a>
</div>
<!-- End Back To Top Button -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- initialize jQuery Library -->
<script type="text/javascript" src="js/landpage/jquery.js"></script>

<!-- PrettyPhoto -->
<script type="text/javascript" src="js/landpage/jquery.prettyPhoto.js"></script>

<!-- Wow Animation -->
<script type="text/javascript" src="js/landpage/wow.min.js"></script>
<!-- SmoothScroll -->
<script type="text/javascript" src="js/landpage/smooth-scroll.js"></script>
<!-- Eeasing -->
<script type="text/javascript" src="js/landpage/jquery.easing.1.3.js"></script>

<!-- Waypoints
<script type="text/javascript" src="js/landpage/jquery.waypoints.min.js"></script>

<script type="text/javascript" src="js/landpage/scrolling-nav.js"></script>
<script type="text/javascript" src="js/custom.js"></script> -->

<script type="text/javascript" src="js/landpage/init.js"></script>
<?php echo $this->fetch('scriptjs'); ?>
<script src="js/jquery-2.1.0.min.js"></script>
<script src="js/app.js"></script>
<script>
//new WOW().init();
</script>

</body>
</html>
