
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>HGV - Home</title>
  <link rel="shortcut icon" type="image/png" href="{{asset('build/assets/img/logo_login.png')}}"/>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  {!!Html::style('build/assets/font/iconsmind/style.css')!!}
  {!!Html::style('build/assets/font/simple-line-icons/css/simple-line-icons.css')!!}
  {!!Html::style('build/assets/css_new/vendor/bootstrap-float-label.min.css')!!}
  {!!Html::style('build/assets/css_new/vendor/bootstrap-stars.css')!!}
  {!!Html::style('build/assets/css_new/estilos.css')!!}
  {!!Html::style('build/assets/css_new/vendor/bootstrap.min.css')!!}
  {!!Html::style('build/assets/css_new/vendor/owl.carousel.min.css')!!}
  {!!Html::style('build/assets/css_new/vendor/bootstrap-stars.css')!!}
  {!!Html::style('build/assets/css_new/vendor/video-js.css')!!}
  {!!Html::style('build/assets/css_new/main.css')!!}

</head>


<body class="show-spinner">
  <div class="landing-page">
    <div class="mobile-menu">
      <a href="#home" class="logo-mobile scrollTo">
        <span></span>
      </a>
      <ul class="navbar-nav">
        <li class="nav-item"><a href="#home" class="scrollTo">INICIO</a></li>
        <li class="nav-item"><a href="#tria_app" class="scrollTo">HGV APP</a></li>
        <li class="nav-item"><a href="#funcionalidades" class="scrollTo">FUNCIONALIDADES</a></li>
        <li class="nav-item"><a href="#franquicias" class="scrollTo">FRANQUICIAS</a></li>
        @if(Auth::check())
        <li class="nav-item"><a href="/login" class="scrollTo">Ir al dashboard</a></li>
        @else
        <li class="nav-item"><a href="/login" >LOGIN</a></li>
        <li class="nav-item"><a href="/registroAdmin" >REGISTRO</a></li>
        <li class="nav-item"><a href="/registroPautante" >PAUTA</a></li>
        @endif
      </ul>
    </div>

    <div class="main-container ">
      <nav class="landing-page-nav estilos_menu_home">
        <div class="container d-flex align-items-center justify-content-between">
          <a class="navbar-logo pull-left scrollTo logo_index" href="#home">
            <img src="{{asset('build/assets/img/logo_login.png')}}">
          </a>
          <ul class="navbar-nav d-none d-lg-flex flex-row">
            <li class="nav-item"><a href="#home" class="scrollTo">INICIO</a></li>
            <li class="nav-item"><a href="#tria_app" class="scrollTo">HGV APP</a></li>
            <li class="nav-item"><a href="#funcionalidades" class="scrollTo">FUNCIONALIDADES</a></li>
            <li class="nav-item"><a href="#contactenos" class="scrollTo">CONTACTENOS</a></li>
            <li class="nav-item"><a href="#franquicias" class="scrollTo">FRANQUICIAS</a></li>
            @if(Auth::check())
            <li class="nav-item"><a href="/login">IR AL DASHBOARD</a></li>
            @else
            <li class="nav-item"><a href="/login" >LOGIN</a></li>
            <li class="nav-item"><a href="/registroAdmin" >REGISTRO</a></li>
            <li class="nav-item"><a href="/registroPautante" >PAUTA</a></li>
            @endif

          </ul>
          <a href="#" class="mobile-menu-button">
            <i class="simple-icon-menu"></i>
          </a>
        </div>
      </nav>

      <div class="content-container" id="home">
        <div class="section home">
          <div class="container">
            <div class="row home-row">
              <div class="col-12 d-block d-md-none">
                <a href="#">
                  <img alt="mobile hero" class="mobile-hero" src="{{asset('build/assets/imagenes/landing-page/home-hero-mobile.png')}}" />
                </a>
              </div>

              <div class="col-12 col-xl-4 col-lg-5 col-md-6">
                <div class="home-text">
                  <div class="display-1">HGV</div>
                  <p class="white mb-5">Es una aplicaci&oacute;n m&oacute;vil Multi-plataforma, app y web a nivel mundial dirigida a la Propiedad Horizontal <br />
                    <br />
                    Conjuntos Residenciales , Condominios , Edificios Corporativos y centros comerciales.<br />
                    <br />
                  </p>
                  <a class="btn btn-outline-semi-light btn-xl" href="/registroAdmin">REGISTRO</a>
                </div>
              </div>
              <div class="col-12 col-xl-7 offset-xl-1 col-lg-7 col-md-6  d-none d-md-block">
                <a href="#">
                  <img alt="hero" src="{{asset('build/assets/imagenes/home_principal.png')}}" />
                </a>
              </div>
            </div>

            <div class="row" id="funcionalidades">
              <div class="col-12 offset-0 col-lg-8 offset-lg-2 text-center">
                <h1 style="color: #fff">FUNCIONALIDADES</h1>
                <p style="color: #fff">¿ Que propiedades pueden hacer parte de HGV APP ? <br>
                  Conjuntos residenciales o condominios, edificios corporativos , centros comerciales , centros industriales e inmobiliarias.<br>
                  con HGV APP el administrador de la propiedad puede tener comunicación en tiempo real y en simultaneo con el propietario y arrendatario de la propiedad o inmobiliaria. <br>
                  HGV APP es multi -plataforma el usuario puede operar desde la web, tablet o móvil. la distribución de la información va hacer mas efectiva y rapída, evitando el uso del papel.<br><br><br>
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-12 p-0">
                <div class="owl-container">
                  <div class="owl-carousel home-carousel carousel_home_estilos">
                    <div class="card">
                      <div class="card-body text-center">
                        <div>
                          <i class="iconsmind-Big-Data large-icon"></i>
                        </div>
                        <div>
                          <p class="detail-text">
                            Actualización de la base de datos de la propiedad en tiempo real
                          </p>
                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-body text-center">
                        <div>
                          <i class="iconsmind-Dollar large-icon"></i>
                        </div>
                        <div>
                          <p class="detail-text">
                            Enlace con el banco para los pagos de la propiedad
                          </p>
                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-body text-center">
                        <div>
                          <i class="iconsmind-Sea-Dog large-icon"></i>
                        </div>
                        <div>
                          <p class="detail-text">
                            Censo de mascotas y vehículos
                          </p>
                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-body text-center">
                        <div>
                          <i class="iconsmind-Arrow-Inside large-icon"></i>
                        </div>
                        <div>
                          <p class="detail-text">
                            Comunicación en doble vía administrador al móvil del residente y residente a la web del administrador y envío de archivos
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-body text-center">
                        <div>
                          <i class="iconsmind-Folder-WithDocument large-icon"></i>
                        </div>
                        <div>
                          <p class="detail-text">
                            Distribución de los recibos y pagos de administración
                          </p>
                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-body text-center">
                        <div>
                          <i class="iconsmind-Police-Man large-icon"></i>
                        </div>
                        <div>
                          <p class="detail-text">
                            Contacto con la policía del sector
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <a class="btn btn-circle btn-outline-semi-light hero-circle-button scrollTo" href="#features" id="homeCircleButton">
            <i class="simple-icon-arrow-down"></i>
          </a>
        </div>



        <div class="section">
          <div class="container" id="franquicias">

            <div class="row ">
              <div class="col-12 col-md-12 col-lg-12 d-flex align-items-center">
                <div class="d-flex">
                  <div class="feature-icon-container">
                    <div class="icon-background">
                      <i class="fas fa-fw fa-ban"></i>
                    </div>
                  </div>
                  <div class="feature-text-container text-center">
                    <h1>FRANQUICIAS</h1>
                    <p>Adquiere la franquicia de HGVy ejecuta un negocio del 200 % de ganancia a 12 meses, podrás abrir mercado con las propiedades y mantenerlas por periodos renovables de 1 año. para mayor información escribe a hgvinternacional@gmail.com. o al whatsapp 57- 3173719404.
                    </p>
                  </div>
                </div>
              </div>
            </div>

            
          </div>
        </div>

        <div class="section background">
          <div class="container estilos_contacto_home" id="contactenos">
            <div class="row">

              <div class="col-md-12 text-center">
                <h1>CONTACTENOS</h1>
              </div>

              <div class="col-12 col-md-5">  
                <p>
                  Dejénos su mensaje y pronto estableceremos contacto dispuestos a llevarle a conocer la mejor experiencia en administración de propiedad horizontal.
                </p>
                <ul>
                  <li>
                    <i class="iconsmind-Telephone"> CEL +57 317 371 94 04</i>
                  </li>
                  <li>
                    <i class="iconsmind-Checked-User"> Jorge Andrés González</i>
                  </li>
                  <li>
                    <i class="iconsmind-Envelope"> hgvinternacional@gmail.com</i>
                  </li>
                  <li>
                    <i class="iconsmind-Globe"> www.hgv.co</i>
                  </li>
                </ul>
              </div>

              <div class="col-md-6">
                <div id="contact-result"></div>
                <div id="contact-form">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                  
                  <div class="form-group has-float-label mb-4">
                    <label for="name">Nombre*</label>
                    <input class="form-control" type="text" name="name" id="name" required>
                  </div>
                  
                  <div class="form-group has-float-label mb-4">
                    <label for="email" >Email*</label>
                    <input class="form-control" type="email" name="email" id="email" required>
                  </div>

                  <div class="form-group has-float-label mb-4">
                    <label for="message" >Mensaje</label>
                    <textarea style="resize: none" class="form-control" name="message" id="message" cols="30" rows="10"></textarea>
                  </div>
                  <input class="btn btn-primary mb-1" type="submit" value="Enviar Mensaje" id="submit-btn">
                </div>

              </div>
            </div>
          </div>
        </div>

        <div class="section padding_triap_group">
          <div class="container" id="tria_app">

            <div class="row feature-row">
              <div class="col-12 col-md-12 col-lg-12 d-flex align-items-center">
                <div class="d-flex">
                  <div class="feature-icon-container">
                    <div class="icon-background">
                      <i class="fas fa-fw fa-ban"></i>
                    </div>
                  </div>
                  <div class="feature-text-container ">
                    <h1 style="text-align: center;display: block">HGV APP</h1>
                    <p>HGV APP, es una plataforma que permite que los residentes de las propiedades en general tengan una aplicación móvil, en donde el administrador de la propiedad puede comunicar su gestión a los móviles de los residentes en tiempo real. Optimizando la comunicación y haciéndola mas efectiva. Con presencia en seis (6) países ( Argentina, Alemania, Bolivia, Colombia, Mexico e Italia). HGVse proyecta hacer la herramienta mas efectiva en el mundo para la gestión dentro de la propiedad horizontal.<br> El uso de las aplicaciones móviles en el mundo esta revolucionando la comunicación a nivel global permitiendo una interacción directa con el teléfono móvil del usuario. Es el momento de hacer parte del cambio y que su propiedad ingrese a la era de la información.
                    </p>
                  </div>
                </div>
              </div>
            </div>

            
          </div>
        </div>


        <div class="container-fluid estilos_footer">
          <div class="container">
            <div class="row">
              <div class="col-4">
                <p class="mb-0">2018 TODOS LOS DERECHOS RESERVADOS © -HGV</p>
              </div>
              <div class="col-md-4 text-center">
                <p class="arvin-copyright-info"><a href="/politicas">Términos y Condiciones</a></p>
              </div>
              <div class="col-4 text-right social-icons">
                <ul class="list-unstyled list-inline">
                  <li class="list-inline-item">
                    <a href="#"><i class="simple-icon-social-facebook"></i></a>
                  </li>
                  <li class="list-inline-item">
                    <a href="#"><i class="simple-icon-social-twitter"></i></a>
                  </li>
                  <li class="list-inline-item">
                    <a href="#"><i class="simple-icon-social-instagram"></i></a>
                  </li>
                  <li class="list-inline-item">
                    <a href="#"><i class="simple-icon-social-google"></i></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>


      </div>
    </div>
  </div>
</body>
</html>
{!!Html::script('home/js/custom.js')!!}
{!!Html::script('build/assets/js_new/vendor/jquery-3.3.1.min.js')!!}
{!!Html::script('build/assets/js_new/vendor/jquery-3.3.1.min.js')!!}
{!!Html::script('build/assets/js_new/vendor/bootstrap.bundle.min.js')!!}
{!!Html::script('build/assets/js_new/vendor/owl.carousel.min.js')!!}
{!!Html::script('build/assets/js_new/vendor/jquery.barrating.min.js')!!}
{!!Html::script('build/assets/js_new/vendor/jquery.barrating.min.js')!!}
{!!Html::script('build/assets/js_new/vendor/landing-page/headroom.min.js')!!}
{!!Html::script('build/assets/js_new/vendor/landing-page/jQuery.headroom.js')!!}
{!!Html::script('build/assets/js_new/vendor/landing-page/jquery.scrollTo.min.js')!!}
{!!Html::script('build/assets/js_new/vendor/landing-page/jquery.autoellipsis.js')!!}
{!!Html::script('build/assets/js_new/dore.scripts.landingpage.js')!!}
{!!Html::script('build/assets/js_new/scripts.js')!!}


