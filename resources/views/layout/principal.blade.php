<!DOCTYPE html>

<html lang="es">

<head>

    <title>TRIA</title>

    
    @yield ('meta')

    <!-- FAVICON AND APPLE TOUCHSCREEN ICONS -->

    <link rel="shortcut icon" href="{{ asset('home/css/normalize.css') }}images/favicon.ico">

    <link rel="apple-touch-icon" href="{{ asset('home/css/normalize.css') }}images/apple-touch-icon.png">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- **********************************

            	STYLESHEETS

    *********************************** -->

    <!-- Hojas de estilo de bootstrap y normalize -->

    {!!Html::style('home/css/normalize.css')!!}

    {!!Html::style('home/css/bootstrap.min.css')!!}

    <!-- Fuentes de Google  -->

    {!!Html::style('http://fonts.googleapis.com/css?family=Montserrat:400,700')!!}

    {!!Html::style('http://fonts.googleapis.com/css?family=Raleway:600,700,400,300')!!}

    <!-- CSS para fuentes e iconos -->

    {!!Html::style('home/css/font-awesome.min.css')!!}

    {!!Html::style('home/css/justicons.css')!!}

    {!!Html::style('home/css/simple-line-icons.css')!!}

    <!-- CSS de Plugins y Complementos-->

    {!!Html::style('home/css/magnific-popup.css')!!}

    {!!Html::style('home/css/slider-pro.css')!!}

    {!!Html::style('home/css/owl.carousel.css')!!}

    {!!Html::style('home/css/owl.theme.css')!!}

    {!!Html::style('home/css/owl.transitions.css')!!}

    {!!Html::style('home/css/mediaelementplayer.css')!!}

    {!!Html::style('home/css/animate.css')!!}

    <!-- Hojas de Estilo del Menú -->

    {!!Html::style('home/css/main.css?v=1')!!}

    {!!Html::style('home/css/responsive.css')!!}

    {!!Html::style('home/css/orange.css')!!}

    <!--[if lt IE 9]>

    <script src="{{ asset('home/js/html5shiv.min.js') }}"></script>

    <script src="{{ asset('home/js/respond.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('home/js/selectivizr-min.js') }}"></script>

    <script src="http://s3.amazonaws.com/nwapi/nwmatcher/nwmatcher-1.2.5-min.js"></script>

    <script src="http://css3-mediaqueries-js.googlecode.com/files/css3-mediaqueries.js"></script>

    <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>

    <![endif]-->


<style>
.navbar {
    background:#4692c6 !important;
}
</style>
</head>



<body>

<!-- **************************************

                Header

*************************************** -->

<header>

    <!-- Navigation Menu start-->

   @yield ('nav-bar')

        <div class="container">

            <!-- Navbar Toggle -->

            <div class="navbar-header">

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                </button>

            </div>

            <!-- navbar-collapse start-->

            <div id="nav-menu" class="navbar-collapse collapse" role="navigation">

                <ul class="nav navbar-nav arvin-menu-wrapper">

                    <li>

                        <a href="/#index">Inicio</a>

                    </li>

                    <li>

                        <a href="/#quienesomos">Tria App</a>

                    </li>

                    <li>

                        <a href="/#objetivos">Funcionalidades</a>

                    </li>

                    <li>

                        <a href="/#servicios">Franquicias</a>

                    </li>

                    <li>

                        <a href="/#contactenos">Contactenos</a>

                    </li>

                    @if(Auth::check())

                    <li>

                        <a href="/login">Ir al dashboard</a>

                    </li>

                    @else

                    <li>

                        <a href="/login">Login Aplicativo</a>

                    </li>

                    <li>

                        <a href="/registroAdmin">Registro</a>

                    </li>

                    <li>

                        <a href="/registroPautante">Pauta</a>

                    </li>

                    @endif

		          		            
                    

                </ul>

            </div>

            <!-- navbar-collapse end-->

        </div>

    <!-- Navigation Menu end-->

</header>

<!-- Header End -->



@yield ('content')

<!-- **************************************

             Footer Section

 *************************************** -->

<footer>

    <div class="container">

        <div class="row">

            <div class="arvin-footer-content">

                <div class="arvin-footer-logo wow bounceIn" data-wow-offset="0">

                </div>

                <p class="arvin-copyright-info"> 2018 Todos los Derechos Reservados © -TRIA</p>

                <p class="arvin-copyright-info">Colombia - Bogotá D.C</p>

                <ul class="arvin-footer-social-info">

                    <li>

                        <a href="#"><i class="fa fa-facebook"></i></a>

                    </li>

                    <li>

                        <a href="#"><i class="fa fa-twitter"></i></a>

                    </li>

                    <li>

                        <a href="#"><i class="fa fa-google-plus"></i></a>

                    </li>

                    <li>

                        <a href="#"><i class="fa fa-linkedin"></i></a>

                    </li>

                </ul>

                <p class="arvin-copyright-info"><a href="/politicas">Términos y Condiciones</a></p>

                </br>

                <hr>

                <p class="arvin-copyright-info">Sitio Desarrollado por TriaGroup</p>

            </div>

        </div>

    </div>

</footer>

<!-- Footer End -->

<!-- *******************************

            SCRIPTS

************************************ -->

<!-- MODERNIZR -->

{!!Html::script('home/js/modernizr-2.7.2.min.js')!!}

<!-- JQUERY -->

{!!Html::script('home/js/jquery-1.11.2.min.js')!!}

{!!Html::script('home/js/bootstrap.min.js')!!}

{!!Html::script('home/js/jquery.easing.1.3.js')!!}

{!!Html::script('home/js/jquery.scrollUp.min.js')!!}

{!!Html::script('home/js/smooth-scroll.min.js')!!}

{!!Html::script('home/js/jquery.magnific-popup.min.js')!!}

{!!Html::script('home/js/jquery.sliderPro.min.js')!!}

{!!Html::script('home/js/owl.carousel.min.js')!!}

{!!Html::script('home/js/jquery.easypiechart.js')!!}

{!!Html::script('home/js/jquery.countTo.js')!!}

{!!Html::script('home/js/isotope.pkgd.min.js')!!}

{!!Html::script('home/js/jflickrfeed.min.js')!!}

{!!Html::script('home/js/jquery.fitvids.js')!!}

{!!Html::script('home/js/jquery.stellar.min.js')!!}

{!!Html::script('home/js/jquery.waypoints.min.js')!!}

{!!Html::script('home/js/wow.min.js')!!}

{!!Html::script('home/js/jquery.nav.js')!!}

{!!Html::script('home/js/imagesloaded.pkgd.min.js')!!}

{!!Html::script('home/js/mediaelement-and-player.min.js')!!}

<!-- Scripts para Google Maps -->

{!!Html::script('https://maps.googleapis.com/maps/api/js')!!}

{!!Html::script('home/js/google-map-init.js')!!}

{!!Html::script('home/js/custom.js')!!}

</body>

</html>