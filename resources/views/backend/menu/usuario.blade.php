<!-- BEGIN SIDEBPANEL-->
<nav class="page-sidebar" data-pages="sidebar">
    <!-- BEGIN SIDEBAR MENU TOP TRAY CONTENT-->

    <!-- BEGIN SIDEBAR MENU HEADER-->
    <div class="sidebar-header">
        <img src="{{ asset('build/assets/img/logo_login.png') }}" alt="logo" class="brand border-radius" data-src="{{ asset('build/assets/img/logo_login.png') }}" data-src-retina="{{ asset('build/assets/img/logo_login.png') }}" width="45" height="40">
        <div class="sidebar-header-controls">
            <button type="button" class="btn btn-xs sidebar-slide-toggle btn-link m-l-20" data-pages-toggle="#appMenu"><i class="fa fa-angle-down fs-16"></i>
            </button>
            <button type="button" class="btn btn-link visible-lg-inline" data-toggle-pin="sidebar"><i class="fa fs-12"></i>
            </button>
        </div>
    </div>
    <!-- END SIDEBAR MENU HEADER-->
    <!-- START SIDEBAR MENU -->
    <div class="sidebar-menu">
        <!-- BEGIN SIDEBAR MENU ITEMS-->
        <ul class="menu-items">
            <li class="m-t-5 ">
                <a href="/usuario"><span class="title">Inicio</span></a>
                <span class="icon-thumbnail"><i class="pg-home"></i></span>
            </li>

            <li class="m-t-5 ">
                <a href="/usuario/mensajes"><span class="title">Mensajes</span></a>
                <span class="icon-thumbnail"><i class="fa fa-comments"></i></span>
            </li>

            <li class="m-t-5 ">
                <a href="/usuario/noticias"><span class="title">Anuncios</span></a>
                <span class="icon-thumbnail"><i class="fa fa-newspaper-o"></i></span>
            </li>
            <li class="m-t-5 ">
                <a href="/usuario/clubmascotas"><span class="title">Club Mascotas</span></a>
                <span class="icon-thumbnail"><i class="fa fa-paw"></i></span>
            </li>
            <li class="m-t-5 ">
                <a href="/usuario/clubmotor"><span class="title">Club Motor</span></a>
                <span class="icon-thumbnail"><i class="fa fa-car"></i></span>
            </li>
            <li class="">
                <a href="javascript:;"><span class="title">Descuentos</span>
                    <span class="arrow"></span></a>
                <span class="icon-thumbnail"><i class="fa fa-bullhorn"></i></span>
                <ul class="sub-menu">
                    <li>
                    <a href="/usuario/descuentos/bonos"><span class="title">Bonos</span></a>
                    <span class="icon-thumbnail"><i class="fa fa-gift"></i></span>
                    </li>
                    <li>
                    <a href="/usuario/descuentos/clubmascotas"><span class="title">Club Mascotas</span></a>
                    <span class="icon-thumbnail"><i class="fa fa-paw"></i></span>
                    </li>
                    <li>
                     <a href="/usuario/descuentos/clubmotor"><span class="title">Club Motor</span></a>
                    <span class="icon-thumbnail"><i class="fa fa-car"></i></span>
                    </li>
                </ul>
            </li>
            <li class="m-t-5 ">
                <a href="/usuario/facturas"><span class="title">Mi Cuenta</span></a>
                <span class="icon-thumbnail"><i class="fa fa-money"></i></span>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <!-- END SIDEBAR MENU -->
</nav>
