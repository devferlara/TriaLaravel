@extends ('layout.principal')







@section ('meta')



    <meta charset="UTF-8">



    <meta name="description" content="">



    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">



    <meta http-equiv-"X-UA-Compatible" content="IE=edge"/>



@stop







@section ('nav-bar')



<nav class="navbar arvin-main-menu" role="navigation">



@stop







@section ('content')



<section class="slider-pro arvin-slider" id="index">



    <div class="sp-slides">



        <!-- Slides -->



        <div class="sp-slide arvin-main-slides" style="background-image: url({{asset('home/images/home1.jpg')}})">



            <div class="col-md-1"></div>



            <div class="col-md-10" style="padding-top:600px;">



                <!--video class="sp-video" width="100%" height="100%" controls="controls" preload="preload" autoplay >



                    <source src="{{asset('home/images/comunicando.mp4')}}" type="video/mp4">



                    Tu navegador no soporta la reproducción del video.



                </video-->



                <h1 class="sp-layer"



                data-position="center" data-show-transition="down" data-hide-transition="up" data-show-delay="1500" data-hide-delay="2000000">



                <span class="arvin-highlight-text">



                    <img  src="{{ asset('home/images/banners/LogoTria1.png') }}" style="width: 100% ;margin: 0 auto;display: -webkit-box;"/>



                </span>



                <br><br><br>



                </h1>



                <p class="sp-layer text-center" style="margin: -120px -60px -60px -60px; font-weight:500;text-align:center" data-position="center" data-vertical="15%" data-show-delay="3000" data-hide-delay="20000000" data-show-transition="up" data-hide-transition="down">

<br>

                <span>TRIA GROUP</span>



                </br>

                Es una aplicaci&oacute;n m&oacute;vil Multi-plataforma, app y web a nivel mundial dirigida a la Propiedad Horizontal<br>

		Conjuntos Residenciales , Condominios , Edificios Corporativos y centros comerciales.



                </p>



            </div>



            <div class="col-md-1"></div>



        </div>



        <div class="sp-slide arvin-main-slides">



            <div class="arvin-img-overlay"></div>



            <img class="sp-image" src="{{ asset('home/images/home2.jpg') }}" alt="Slider 1"/>



            <h1 class="sp-layer"



                data-position="center" data-show-transition="down" data-hide-transition="up" data-show-delay="1500" data-hide-delay="2000000">



                <span class="arvin-highlight-text">



                    <img  src="{{ asset('home/images/banners/LogoTria.png') }}" style="width: 100% ;margin: 0 auto;display: -webkit-box;"/>



                </span><br><br><br><br>



            </h1>



            <p class="sp-layer" style="margin: -60px; font-weight:bold;"



               data-position="center" data-vertical="15%" data-show-delay="2000" data-hide-delay="2000000" data-show-transition="up" data-hide-transition="down">



                <span style="text-align:center;">Ingresa a la era de la informaci&oacute;n con la propiedad que administras.</span>





            </p>



        </div>



    </div>



</section>



<!-- Arvin Main Slider End -->



<!--  About Section



*************************************** -->



<section id="quienesomos" class="arvin-section-wrapper">



    <div class="container">



        <div class="row">



            <!-- Section Header -->



            <div class="col-md-12 col-sm-12 col-xs-12 arvin-section-header wow fadeInDown">



                <h1> <span class="arvin-highlight-text">TRIA APP</span></h1>



                <div class="arvin-section-divider"></div>



                <p class="col-md-10 col-sm-10 col-xs-12 col-md-offset-1 col-sm-offset-1" style="text-align:justify;">



                    Tria APP, es una plataforma que permite que los residentes de las propiedades en general tengan una aplicación móvil, en donde el administrador de la propiedad puede comunicar su gestión a los móviles de los residentes en tiempo real. Optimizando la comunicación y haciéndola mas efectiva. Con presencia en seis (6) países ( Argentina, Alemania, Bolivia, Colombia, Mexico e Italia). TRIA se proyecta hacer la herramienta mas efectiva en el mundo para la gestión dentro de la propiedad horizontal. <br>

El uso de las aplicaciones móviles en el mundo esta revolucionando la comunicación a nivel global permitiendo una interacción directa con el teléfono móvil del usuario. Es el momento de hacer parte del cambio y que su propiedad ingrese a la era de la información.



                </p>



                </br>



            </div>



            <!-- Section Header End -->






            <!-- What We Do End -->



        </div>



    </div>



</section>



<!-- About Section End -->



<!-- Features Section



*************************************** -->



<section id="objetivos" class="arvin-section-wrapper arvin-features-section" data-stellar-background-ratio="0.5">



    <div class="arvin-parallax-overlay"></div>



    <div class="container">



        <div class="row">



            <!-- Section Header -->



            <div class="col-md-12 col-sm-12 col-xs-12 arvin-section-header arvin-section-header-parallax wow fadeInDown">



                <h1>FUNCIONALIDADES</h1>



                <div class="arvin-section-divider"></div>



                <p class="col-md-8 col-sm-10 col-xs-12 col-md-offset-2 col-sm-offset-1">



                    ¿ Que propiedades pueden hacer parte de TRIA APP ? <br>

                        Conjuntos residenciales o condominios, edificios corporativos , centros comerciales , centros industriales e inmobiliarias.<br>

                        con TRIA APP el administrador de la propiedad puede tener comunicación en tiempo real y en simultaneo con el propietario y arrendatario de la propiedad o inmobiliaria. <br>

                        TRIA APP es multi -plataforma el usuario puede operar desde la web, tablet o móvil. la distribución de la información va hacer mas efectiva y rapída, evitando el uso del papel.<br>


    




                </p>

        


            </div>



            <!-- Section Header End -->



            <!-- Features -->



            <div class="arvin-features">



                <div class="col-md-4 col-sm-4 col-xs-12 wow bounceInLeft">



                    <div class="arvin-blurb-icon-left-square">



                        <div class="arvin-icon">



                            <i class="fa fa-database"></i>



                        </div>



                        <div class="arvin-blurb-text">



                            <h3>Actualización de la base de datos de la propiedad en tiempo real</h3>



                            <p></p>



                        </div>



                    </div>



                    <div class="arvin-blurb-icon-left-square">



                        <div class="arvin-icon">



                            <i class="icon-screen-smartphone"></i>



                        </div>



                        <div class="arvin-blurb-text">



                            <h3>Comunicación en doble vía administrador al móvil del residente y residente a la web del administrador y envío de archivos</h3>



                            <p></p>



                        </div>



                    </div>



                </div>



                <div class="col-md-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-duration="1s">



                    <div class="arvin-blurb-icon-left-square">



                        <div class="arvin-icon">



                            <i class="fa fa-users"></i>



                        </div>



                        <div class="arvin-blurb-text">



                            <h3>Enlace con el banco para los pagos de la propiedad</h3>



                            <p></p>



                        </div>



                    </div>



                    <div class="arvin-blurb-icon-left-square">



                        <div class="arvin-icon">



                            <i class="fa fa-handshake-o"></i>



                        </div>



                        <div class="arvin-blurb-text">



                            <h3>Distribución de los recibos y pagos de administración</h3>



                            <p></p>



                        </div>



                    </div>



                </div>



                <div class="col-md-4 col-sm-4 col-xs-12 wow bounceInRight">



                    <div class="arvin-blurb-icon-left-square">



                        <div class="arvin-icon">



                            <i class="fa fa-building"></i>



                        </div>



                        <div class="arvin-blurb-text">



                            <h3>Censo de mascotas y vehículos</h3>



                            <p></p>



                        </div>



                    </div>



                    <div class="arvin-blurb-icon-left-square">



                        <div class="arvin-icon">



                            <i class="fa fa-exchange"></i>



                        </div>



                        <div class="arvin-blurb-text">



                            <h3>Contacto con la policía del sector</h3>



                            <p></p>



                        </div>



                    </div>



                </div>



            </div>



            <!-- Features End -->



        </div>



    </div>



</section>



<!-- Featuers Section End -->



<!-- Skill Section



*************************************** -->



<section class="arvin-our-skills arvin-section-wrapper" id="servicios">



    <div class="container">



        <div class="row">



            <!-- Section Header -->



            <div class="col-md-12 col-sm-12 col-xs-12 arvin-section-header wow fadeInDown">



                <h1>FRANQUICIAS</h1>



                <div class="arvin-section-divider"></div>



            </div>



            <!-- Section Header End -->



            <!-- Skills -->



            <div class="col-md-12 col-sm-12 col-xs-12 arvin-skills-wrapper wow fadeInUp">



                Adquiere la franquicia de TRIA y ejecuta un negocio del 200 % de ganancia a 12 meses, podr&aacute;s abrir mercado con las propiedades y mantenerlas por periodos renovables de 1 a&ntilde;o.
para mayor informaci&oacute;n escribe a triainternacional@gmail.com. o al whatsapp 57- 3173719404.

 



            </div>



            <!-- Skills End -->



        </div>



    </div>



</section>



<!-- Skill seciton End -->



<!-- Contact Section



*************************************** -->



<section id="contactenos" class="arvin-section-wrapper arvin-contact-section" data-stellar-background-ratio="0.5">



    <div class="arvin-parallax-overlay"></div>



    <div class="container">



        <div class="row">



            <!-- Section Header -->



            <div class="col-md-12 col-sm-12 col-xs-12 arvin-section-header wow fadeInDown arvin-section-header-parallax">



                <h1>CONTACTENOS</h1>



                <div class="arvin-section-divider"></div>



            </div>



            <!-- Section Header End -->



            <div class="arvin-contact-details">



                <!-- Address Area -->



                <div class="col-md-5 col-sm-4 col-xs-12 arvin-contact-address wow bounceInLeft">



                    <p style="font-weight: 700; color:gray;">



                        Dejénos su mensaje y pronto estableceremos contacto dispuestos a llevarle a conocer la mejor experiencia en administración



                        de propiedad horizontal.



                    </p>



                    <ul style="font-weight:700; color:gray;">





                        <li class="arvin-phone" style="color:black"><i class="fa fa-phone" style="color:black"></i>CEL +57 317 371 94 04</li>



                        <li class="arvin-phone" style="color:black"><i class="fa fa-info" style="color:black"></i>Jorge Andr&eacute;s Gonz&aacute;lez</li>



                        <li class="arvin-email" style="color:black"><i class="fa fa-envelope-o" style="color:black"></i>triainternacional@gmail.com</li>



                        <li class="arvin-web" style="color:black"><i class="fa  fa-globe" style="color:black"></i>www.triagroup.co</li>



                    </ul>



                </div>



                <!-- Address Area End -->



                <!-- Contact Form -->



                <div class="col-md-7 col-sm-8 col-xs-12 arvin-contact-form wow bounceInRight">



                    <div id="contact-result"></div>



                    <div id="contact-form">


                        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">



                        <div class="arvin-input-name arvin-input-fields">



                            <label for="name" style="color:black">Nombre*</label>



                            <input type="text" name="name" id="name" required>



                        </div>



                        <div class="arvin-input-email arvin-input-fields">



                            <label for="email" style="color:black">Email*</label>



                            <input type="email" name="email" id="email" required>



                        </div>



                        <div class="arvin-input-message arvin-input-fields">



                            <label for="message" style="color:black">Mensaje</label>



                            <textarea name="message" id="message" cols="30" rows="10"></textarea>



                        </div>



                        <input type="submit" value="Enviar Mensaje" id="submit-btn">



                    </div>



                </div>



                <!-- Contact Form End -->



            </div>



        </div>



    </div>



</section>



<!-- Contact Section End -->



<!--  Custom Section



*************************************** -->



<!-- <section class="arvin-cta-2">



    <div class="container">



        <div class="row">



            <div class="arvin-cta-2-wrapper">



                <h1 class="wow fadeInDown" style="color: ##2E3191;">Si deseas recibir más información acerca de nuestros servicios y actualizaciones, Suscribete!</h1>



                <a href="#" class="arvin-btn-round wow bounceIn">Suscribirse</a>



            </div>



        </div>



    </div>



</section> -->



<!-- Call To Action 2 End -->



@stop