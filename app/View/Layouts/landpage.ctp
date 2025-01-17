<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= __('Sistema para Taller') ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap and Font Awesome css-->
    <!-- we use cdn but you can also include local files located in css directory-->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <?= $this->Html->css('/css/ldpage/themify-icons.css'); ?>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <!-- Google fonts - Roboto Condensed for headings, Open Sans for copy-->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto+Condensed:300,700%7COpen+Sans:300,400,700">
    <!-- theme stylesheet-->
    <?= $this->Html->css('/css/ldpage/style.default.css'); ?>
    <?= $this->Html->css('/css/ldpage/custom.css'); ?>
    <?= $this->Html->css(array('message'))?>

    <!-- Custom stylesheet - for your changes-->
    <!-- Favicon-->
    <link rel="shortcut icon" href="favicon.png">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body data-spy="scroll" data-target="#navigation" data-offset="120">
    <!-- intro-->
    <section id="intro" class="intro image-background">
      <div class="overlay"></div>
      <div class="content">
        <div class="container clearfix">
          <div class="row">
            <div class="col-md-8 col-md-offset-2 col-sm-12">
              <p class="roboto"><?= __('Bienvenidos a tallercitobike') ?></p>
              <h1><?= __('Aplicacion')?> <br /><span class="bold"><?= __('Software') ?></span></h1>
              <p class="roboto">tallercitobike el software para hacer de su negocio una gran oportunidad <a href="http://bootstrapious.com" class="external">tallercitobike.esy.es</a></p>
            </div>
          </div>
        </div>
      </div><a href="#about" class="icon faa-float animated scroll-to"><i class="fa fa-angle-double-down"></i></a>
    </section>
    <!-- navbar-->
    <header class="header">
      <div class="sticky-wrapper">
        <div role="navigation" class="navbar navbar-default">
          <div class="container">
            <div class="navbar-header">
              <button type="button" data-toggle="collapse" data-target=".navbar-collapse" class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a href="#intro" class="navbar-brand scroll-to"><img src="img/logo.png" alt=""></a>
            </div>
            <div id="navigation" class="collapse navbar-collapse">
              <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="#intro">Principal</a></li>
                <li><a href="#about">Acerca </a></li>
                <li><a href="#services">Servicios</a></li>
                <li><a href="#portfolio">Portfolio</a></li>
                <li><a href="#text">Ayuda</a></li>
                <li><a href="#team">Equipo</a></li>
                <li><a href="#contact">Contacto</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- /.navbar-->
    <!-- about us-->
    <section id="about">
      <div class="container clearfix">
        <div class="row margin-bottom">
          <div class="col-md-6 margin-bottom">
            <h2 class="heading"><?= __('Acerca de Tallercitobike')?></h2>
            <p class="lead">Aplicacion de gestion para su bicicleteria u taller, el futuro ahora simple y moderno</p>
            <p>Primera aplicación creada por apasionados ciclistas, para mejorar lo servicios de su bicicletería. Un producto creado para ser simple y eficiente. La primer herramienta que le permitirá gestionar sus pedidos a proveedores, ventas, y las reparaciones que se realicen en su taller, acercando todo su negocio a los clientes los cuales poseen un panel especial para mantenerse al tanto de sus bicicletas en reparación u por que no de nuevos y mas variados productos que podamos ofertar. </p>
            <div class="row">
              <div class="col-sm-6">
                <ul>
                  <li><?= __('Una aplicación todas los dispositivos')?></li>
                  <li><?= __('No mas papeles') ?></li>
                  <li><?= __('Su negocio eficiente y amigable')?></li>
                </ul>
              </div>
              <div class="col-sm-6">
                <ul>
                  <li><?= __('Clientes conectados')?></li>
                  <li><?= __('Gestion eficiente')?> </li>
                  <li><?= __('Seguridad y ventas')?></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6 margin-bottom">
            <p><img src="img/template-homepage.png" alt="" class="img-responsive"></p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <h5><i class="fa fa-users"></i>Usuarios</h5>
            <p>
              <ul>
                <li>Permite crear,borrar u modificar los usuarios, cambio de imágenes y contraseña.<br>
                <li>Permite asociar las bicicletas al Usuario u Cliente.<br>
                <li>Permite dar de alta un nuevo Usuario vinculado a un Cliente
              </ul>
            </p>

          </div>
          <div class="col-sm-6">
            <h5> <i class="fa fa-cogs"></i>Taller</h5>
            <p>
              <ul>
                <li>Permite administrar los datos de su Taller, logo, dirección etc</li>
                <li>Calendario para visualizar el tiempo de reparación y los tiempos estimados.</li>
                <li>Ingresos Mensuales Gráfica.</li>
                <li>Tiempos estimados para reparaciones anteriores.</li>
                <li>Permite visualizar los mensajes de mantenimiento que serán enviados automáticamente.</li>
              </ul>
            </p>

          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <h5><i class="fa fa-bicycle"></i>Bicicletas</h5>
            <p>
              <ul>
                <li>Nuevo Ingreso a taller con detalles de gastos.</li>
                <li>Ver listado de ingresos en taller por rango de fechas.</li>
                <li>Permite imprimir un ticket con código QR para luego al escanearlo podemos ver que reparaciones debemos hacer a la bicicleta.</li>
                <li>Bicicletas en taller permite administrar las etapas para que el cliente y taller vean el estado de las bicicletas.</li>
                <li>Modo entrega bicicleta permite visualizar solo aquellas bicicletas cuyo estado se encuentre en finalizado, se incluye la opción para el pago de lo adeudado.</li>
                <li>Modo entrega con vista GPS se visualiza por medio de Google Maps los lugares para dejar las bicicletas con una ruta marcada, es posible modificar los puntos GPS de entrega.</li>
              </ul>
            </p>

          </div>
          <div class="col-sm-6">
            <h5> <i class="fa fa-cart-arrow-down"></i>Alquileres de Bicicletas.</h5>
            <p>
              <ul>
                <li>Nuevo Alquiler se puede agregar las bicicletas u componentes externos a alquilar, el sistema administra los tiempos automáticamente.</li>
                <li>Se puede realizar el pago del alquiler.</li>
                <li>Se pueden asociar bicicleta para alquiler solo bicicletas asociadas al usuario administrador de la bicicleta</li>
              </ul>
            </p>
          </div>
        </div>
      </div>
    </section>
    <!-- services-->
    <section id="services" class="section-gray">
      <div class="container clearfix">
        <div class="row services">
          <div class="col-md-12">
            <h2 class="heading">Servicios</h2>
            <div class="row">
              <div class="col-sm-4">
                <div class="box box-services">
                  <div class="icon"><i class="ti-desktop"></i></div>
                  <h4 class="heading">Webdesign</h4>
                  <p>Adaptamos la web a lo requerido por el cliente.</p>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="box box-services">
                  <div class="icon"><i class="ti-search"></i></div>
                  <h4 class="heading">Desarrollo y Mejoras</h4>
                  <p>Creamos, modificamos y actualizamos el software a sus requerimientos</p>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="box box-services">
                  <div class="icon"><i class="ti-email"></i></div>
                  <h4 class="heading">Email </h4>
                  <p>Mantengase en contacto con sus clientes.</p>
                </div>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- portfolio-->
    <section id="portfolio" class="no-padding-bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 class="heading">Portfolio</h2>
            <p class="text-center">Sistemas simples e inteligentes.</p>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row no-space">
          <div class="col-sm-4 col-md-3">
            <div class="box"><a href="#" title=""><img src="img/portfolio-prog-linux.png" alt="" class="img-responsive"></a></div>
          </div>
          <div class="col-sm-4 col-md-3">
            <div class="box"><a href="#" title=""><img src="img/portfolio-debugapp.png" alt="" class="img-responsive"></a></div>
          </div>
          <div class="col-sm-4 col-md-3">
            <div class="box"><a href="#" title=""><img src="img/portfolio-appentregas.png" alt="" class="img-responsive"></a></div>
          </div>
          <div class="col-sm-4 col-md-3">
            <div class="box"><a href="#" title=""><img src="img/portfolio-ventas.png" alt="" class="img-responsive"></a></div>
          </div>
        </div>
      </div>
    </section>
    <!-- text-->
    <section id="text" class="section-gray">
      <div class="container clearfix">
        <div class="row">
          <div class="col-md-12">
            <h2 class="heading">Sobre Tallercito bike</h2>
            <div class="row">
              <div class="col-sm-6">
                <p>Primera aplicación desarrollada por apasionados ciclista, buscando en la misma satisfacer las necesidades de una tienda de bicicletas de forma simple y divertida. Pensada para mantener el orden y el contacto del cliente con la tienda, acercando información sobre sus productos u de su amada bicicleta si se encuentra en el taller y el estado de la misma. </p>
                <p>La aplicación se diseño con una interfaz adaptativa, lo cual permite que funciona en cualquier dispositivo, permitiendo acceder a la aplicación desde cualquier lugar del mundo u por que no mientras pedalea u entrena, pudiendo realizar las operaciones diarias desde un PC, tablet u shmart phone. </p>
              </div>
              <div class="col-sm-6">
                <p>El primer sistema pensada para llevar su bicicletería u taller al futuro, ya no deberá recordar cuando y a quien enviar sus pedidos de compra, basta de papeles para anotaciones de que mantenimiento debemos realizar a la bicicleta, no deberá perder tiempo organizando sus pedidos de compra y envío, podrá de manera simple y efectiva estar conectado con sus clientes, brindándole mayores oportunidades de negocio con un software pensado para ser simple y estable.</p>
                <p>El futuro es de las bicicletas en las ciudades dónde la movilidad se a vuelto caótica, hoy la bicicleta comienza a tomar el control, creamos el software pensando en hacer de su negocio un lugar dónde el caos no reine y dónde pueda disfrutar de su negocio como de pedalear. El futuro es incierto nosotros lo llevamos al futuro pudiendo evolucionar el software a medida que los requerimientos y su negocio avanzan</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- team-->
    <section id="team">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 class="heading">El Equipo</h2>
            <div class="row"></div>
            <!-- team-member-->
            <div class="col-md-3 col-sm-6">
              <div class="team-member">
                <div class="image"><a href="#"><img src="img/person-1.jpg" alt="" class="img-responsive"></a></div>
                <h3><a href="#">Luis Sebastian Oppe</a></h3>
                <p class="role">Fundador</p>
                <div class="social">
                  <a href="#" class="external facebook" data-animate-hover="pulse"><i class="fa fa-facebook"></i></a>
                  <a href="#" class="external gplus" data-animate-hover="pulse"><i class="fa fa-google-plus"></i></a>
                  <a href="#" class="external twitter" data-animate-hover="pulse"><i class="fa fa-twitter"></i></a>
                  <a href="#" class="email" data-animate-hover="pulse"><i class="fa fa-envelope"></i></a>
                </div>
                <div class="text">
                  <p>Analista programador, y apasionado de las dos ruedas.</p>
                </div>
              </div>
            </div>
            <!-- team-member col end-->
            <!-- team-member-->

          </div>
        </div>
      </div>
    </section>
    <!-- map-->
    <section id="map"></section>
    <section id="contact">
      <div class="container clearfix">
        <div class="row">
          <div class="col-md-12">
            <h2 class="heading">Contacto</h2>
            <div class="row">
              <div class="col-md-6">
                <form id="contact-form" method="post" class="contact-form form">
                  <div class="controls">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="name">Apellido *</label>
                          <input type="text" name="name" id="name" placeholder="Ingresa tu Apellido" required="required" class="form-control">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="surname">Nombre *</label>
                          <input type="text" name="surname" id="surname" placeholder="Ingresa tu Nombre" required="required" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="email">Tu email *</label>
                      <input type="email" name="email" id="email" placeholder="Ingresa tu correo" required="required" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="message">Tu Mensaje *</label>
                      <textarea rows="4" name="message" id="message" placeholder="Ingresa tu mensaje" required="required" class="form-control"></textarea>
                    </div>
                    <div class="text-center">
                      <input value="Enviar Mensaje" class="btn btn-primary btn-block" id = 'enviar'>
                    </div>
                  </div>
                </form>
              </div>
              <div class="col-md-6">
                <p>Gracias por contactarnos a la brevedad u bien volvamos de pedalear nos contactaremos con usted. </p>
                <p class="social"><a href="#" title="" class="facebook"><i class="fa fa-facebook"></i></a><a href="#" title="" class="twitter"><i class="fa fa-twitter"></i></a><a href="#" title="" class="gplus"><i class="fa fa-google-plus"></i></a><a href="#" title="" class="instagram"><i class="fa fa-instagram"></i></a><a href="#" title="" class="email"><i class="fa fa-envelope"></i></a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <footer>
      <div class="container">
        <div class="row copyright">
          <div class="col-md-6">
            <p class="roboto">&copy;2016 TallercitoBike, simple software</p>
          </div>
          <div class="col-md-6">
            <p class="credit roboto"><a href="http://bootstrapious.com/portfolio-themes">Bootstrap Portfolio Themes</a></p>
            <!-- Please do not remove the backlink to us. It is part of the licence conditions. Thanks for understanding :)-->
          </div>
        </div>
      </div>
    </footer>
    <!-- Javascript files-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery.js"><\/script>')</script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <?= $this->Html->script(array('/js/jquery.sticky.js','jquery.scrollTo.min.js'))?>
    <script src="js/"></script>
    <script src="js/landscape/main.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;amp;sensor=false"></script>
    <?= $this->Html->script(array('jquery.toastmessage','/js/jquery.sticky.js','/js/gmaps.js','/js/jquery.cookie.js','front.js'))?>
    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID.-->
    <script>
      (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
      function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
      e=o.createElement(i);r=o.getElementsByTagName(i)[0];
      e.src='//www.google-analytics.com/analytics.js';
      r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
      ga('create','UA-XXXXX-X');ga('send','pageview');
    </script>
  </body>
</html>
