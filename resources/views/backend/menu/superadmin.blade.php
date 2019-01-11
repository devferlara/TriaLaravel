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
                <a href="/superadmin" class="detailed">
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
                                {!!link_to_route('superadmin.conjuntos.index', $title = 'Conjuntos')!!}
                                <span class="icon-thumbnail"><i class="fa fa-building-o"></i></span>
                                </li>
                                <li>
                                    {!!link_to_route('superadmin.zonas.index', $title = 'Zonas')!!}
                                    <span class="icon-thumbnail"><i class="fa fa-building"></i></span>
                                </li>
                                <li>
                                    {!!link_to_route('superadmin.apartamentos.index', $title = 'Apartamentos')!!}
                                    <span class="icon-thumbnail"><i class="fa fa-building-o"></i></span>
                                </li>
                            </ul>
                    </li>

                     <li>
                        <a href="javascript:;"><span class="title">Pagos</span>
                        <span class="arrow"></span></a>
                         <span class="icon-thumbnail"><i class="fa fa-building"></i></span>
                            <ul class="sub-menu">
                                <li>
                                {!!link_to_route('superadmin.pagosmembresias.index', $title = 'Membresias')!!}
                                <span class="icon-thumbnail"><i class="fa fa-money"></i></span>
                                </li>
                                <li>
                                    {!!link_to_route('superadmin.pagosanuncios.index', $title = 'Anuncios')!!}
                                    <span class="icon-thumbnail"><i class="fa fa-money"></i></span>
                                </li>
                            </ul>
                    </li>

                    <li>
                        {!!link_to_route('superadmin.usuarios.index', $title = 'Usuarios')!!}
                        <span class="icon-thumbnail"><i class="fa fa-group"></i></span>  
                    </li>
                </ul>


            </li>
            <li class="">
                <a href="javascript:;"><span class="title">Actividad</span>
                    <span class="arrow"></span></a>
                <span class="icon-thumbnail"><i class="fa fa-globe"></i></span>
                <ul class="sub-menu">
                    <li>
                        <a href="javascript:;"><span class="title">Descuentos</span>
                        <span class="arrow"></span></a>
                         <span class="icon-thumbnail"><i class="fa fa-bullhorn"></i></span>
                            <ul class="sub-menu">
                                <li>
                                {!!link_to_route('superadmin.publicidad.bonos.index', $title = 'Bonos de Descuento')!!}
                                <span class="icon-thumbnail"><i class="fa fa-gift"></i></span>
                                </li>
                                <li>
                                    {!!link_to_route('superadmin.publicidad.clubmascotas.index', $title = 'Club Mascotas')!!}
                                    <span class="icon-thumbnail"><i class="fa fa-paw"></i></span>
                                </li>
                                <li>
                                    {!!link_to_route('superadmin.publicidad.clubmotor.index', $title = 'Club Motor')!!}
                                    <span class="icon-thumbnail"><i class="fa fa-car"></i></span>
                                </li>
                            </ul>
                    </li>
                    <li>
                        {!!link_to_route('superadmin.anuncios.index', $title = 'Anuncios')!!}
                        <span class="icon-thumbnail"><i class="fa fa-newspaper-o"></i></span>
                    </li>
                    <li>
                        {!!link_to_route('superadmin.mensajes.index', $title = 'Mensajes')!!}
                        <span class="icon-thumbnail"><i class="fa fa-comments-o"></i></span>
                    </li>
                    <li>
                        {!!link_to_route('superadmin.bancos.index', $title = 'Bancos')!!}
                        <span class="icon-thumbnail"><i class="fa fa-university"></i></span>
                    </li>
                   <!--  <li>
                        {!!link_to_route('superadmin.recibosdepago.index', $title = 'Recibos de Pago')!!}
                        <span class="icon-thumbnail"><i class=""></i></span>
                    </li> -->
                </ul>
            </li>
			<li class="">
                <a href="javascript:;"><span class="title">Configurador</span>
                    <span class="arrow"></span></a>
                <span class="icon-thumbnail"><i class="fa fa-folder-open"></i></span>
                <ul class="sub-menu">
					<li>
						{!!link_to_route('superadmin.conceptos.index', $title = 'Concepto Publicitario')!!}
                        <span class="icon-thumbnail"><i class="fa fa-newspaper-o"></i></span>
					</li>
					<li>
						{!!link_to_route('superadmin.valores.index', $title = 'Valores')!!}
                        <span class="icon-thumbnail"><i class="fa fa-building-o"></i></span>
					</li>
				</ul>
			</li>
			
        </ul>
        <div class="clearfix"></div>
    </div>
    <!-- END SIDEBAR MENU -->
</nav>
<!-- END SIDEBAR -->
