<!-- BEGIN SIDEBPANEL-->
<nav class="page-sidebar" data-pages="sidebar">
    <!-- BEGIN SIDEBAR MENU TOP TRAY CONTENT-->
    <!-- BEGIN SIDEBAR MENU HEADER-->
     <div class="sidebar-header">
        <img src="{{ asset('build/assets/img/logo_login.png') }}" alt="logo" class="brand border-radius" data-src="{{ asset('build/assets/img/logo_login.png') }}" data-src-retina="{{ asset('build/assets/img/logo_login.png') }}" width="80" height="60">
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
                <a href="/pautante" class="detailed">
                    <span class="title">Inicio</span>
                </a>
                <span class="icon-thumbnail bg-success"><i class="pg-home"></i></span>
            </li>
            <li class="">
                <a href="javascript:;"><span class="title">Actividad</span>
                    <span class="arrow"></span></a>
                <span class="icon-thumbnail"><i class="fa fa-globe"></i></span>
                <ul class="sub-menu">
                    <li>
                        {!!link_to_route('pautante.publicidad.bonos.index', $title = 'Bonos de Descuento')!!}
                        <span class="icon-thumbnail"><i class="fa fa-gift"></i></span>
                    </li>
                    <li>
                        {!!link_to_route('pautante.publicidad.clubmascotas.index', $title = 'Club Mascotas')!!}
                        <span class="icon-thumbnail"><i class="fa fa-paw"></i></span>
                    </li>
                    <li>
                        {!!link_to_route('pautante.publicidad.clubmotor.index', $title = 'Club Motor')!!}
                        <span class="icon-thumbnail"><i class="fa fa-car"></i></span>
                     </li>  
                </ul>
            </li>
            <li class="">
                <a href="javascript:;"><span class="title">Gestionar</span>
                    <span class="arrow"></span></a>
                <span class="icon-thumbnail"><i class="fa fa-folder-open"></i></span>
                <ul class="sub-menu">
                    
                    <li>
                        {!!link_to_route('pautante.pagosanuncios.index', $title = 'Pagos')!!}
                        <span class="icon-thumbnail"><i class="fa fa-money"></i></span>  
                    </li>
                </ul>
            </li>
			
        </ul>
        <div class="clearfix"></div>
    </div>
    <!-- END SIDEBAR MENU -->
</nav>
<!-- END SIDEBAR -->
