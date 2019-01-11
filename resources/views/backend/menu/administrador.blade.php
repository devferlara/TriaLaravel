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
            <li class="m-t-30 ">
                <a href="/administrador" class="detailed">
                    <span class="title">Inicio</span>
                </a>
                <span class="icon-thumbnail bg-success"><i class="pg-home"></i></span>
            </li>
            <li class="">
                <a href="javascript:;"><span class="title">Gestionar</span>
                    <span class="arrow"></span></a>
                <span class="icon-thumbnail"><i class="fa fa-folder-open"></i></span>
                <ul class="sub-menu">
                    <li>
                        <a href="javascript:;"><span class="title">Propiedad</span>
                        <span class="arrow"></span></a>
                         <span class="icon-thumbnail"><i class="fa fa-building"></i></span>
                            <ul class="sub-menu">
                                <li>
                                {!!link_to_route('administrador.conjuntos.index', $title = 'Conjunto Residencial')!!}
                                <span class="icon-thumbnail"><i class="fa fa-building"></i></span>
                                </li>
                                <li>
                                    {!!link_to_route('administrador.zonas.index', $title = 'Unidades - Interiores')!!}
                                    <span class="icon-thumbnail"><i class="fa fa-building"></i></span>
                                </li>
                                <li>
                                    {!!link_to_route('administrador.apartamentos.index', $title = 'Apartamentos')!!}
                                    <span class="icon-thumbnail"><i class="fa fa-building"></i></span>
                                </li>
                            </ul>
                    </li>
                    <li>
                        {!!link_to_route('administrador.usuarios.index', $title = 'Usuarios')!!}
                        <span class="icon-thumbnail"><i class="fa fa-group"></i></span>  
                    </li>
                     <li>
                        {!!link_to_route('administrador.pagosmembresias.index', $title = 'Pagos de membresia')!!}
                        <span class="icon-thumbnail"><i class="fa fa-money"></i></span>  
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="javascript:;"><span class="title">Actividad</span>
                    <span class="arrow"></span></a>
                <span class="icon-thumbnail"><i class="fa fa-globe"></i></span>
                <ul class="sub-menu">
                    <li>
                        <a href="javascript:;"><span class="title">Bonos-Descuento</span>
                        <span class="arrow"></span></a>
                         <span class="icon-thumbnail"><i class="fa fa-bullhorn"></i></span>
                            <ul class="sub-menu">
                                <li>
                                {!!link_to_route('administrador.publicidad.bonos.index', $title = 'Bonos de Descuento')!!}
                                <span class="icon-thumbnail"><i class="fa fa-paw"></i></span>
                                </li>
                                <li>
                                {!!link_to_route('administrador.publicidad.clubmascotas.index', $title = 'Club Mascotas')!!}
                                <span class="icon-thumbnail"><i class="fa fa-paw"></i></span>
                                </li>
                                <li>
                                    {!!link_to_route('administrador.publicidad.clubmotor.index', $title = 'Club Motor')!!}
                                    <span class="icon-thumbnail"><i class="fa fa-car"></i></span>
                                </li>
                            </ul>
                    </li>
                    <li>
                        <a href="javascript:;"><span class="title">Censo Conjunto</span>
                        <span class="arrow"></span></a>
                         <span class="icon-thumbnail"><i class="fa fa-pie-chart"></i></span>
                            <ul class="sub-menu">
                                <li>
                                {!!link_to_action('ClubmascotasController@mascotasConjunto', $title = 'Mascotas Conjunto')!!}
                                <span class="icon-thumbnail"><i class="fa fa-paw"></i></span>
                                </li>
                                <li>
                                    {!!link_to_action('ClubvehiculosController@vehiculosConjunto', $title = 'Vehiculos Conjunto')!!}
                                    <span class="icon-thumbnail"><i class="fa fa-car"></i></span>
                                </li>
                            </ul>
                    </li>

                    <li>
                        {!!link_to_route('administrador.anuncios.index', $title = 'Anuncios')!!}
                        <span class="icon-thumbnail"><i class="fa fa-newspaper-o"></i></span>
                    </li>
                    <li>
                        {!!link_to_route('administrador.mensajes.index', $title = 'Mensajes')!!}
                        <span class="icon-thumbnail"><i class="fa fa-comments-o"></i></span>
                    </li>
                     <li>
                        {!!link_to_route('administrador.facturas.index', $title = 'Facturas')!!}
                        <span class="icon-thumbnail"><i class="fa fa-newspaper-o"></i></span>
                    </li>
                     <li>
                        {!!link_to_route('administrador.bancos.index', $title = 'Bancos')!!}
                        <span class="icon-thumbnail"><i class="fa fa-university"></i></span>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <!-- END SIDEBAR MENU -->
</nav>
<!-- END SIDEBAR -->
