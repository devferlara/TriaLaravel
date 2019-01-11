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
			<li class="m-t-5" style="text-align:center;">
				@if(Auth::user()->img_perfil)
					<img src="{{asset('img_perfil')}}/{{Auth::user()->img_perfil}}" alt="logo" class="brand border-radius" data-src="{{asset('img_perfil')}}/{{Auth::user()->img_perfil}}" data-src-retina="{{asset('img_perfil')}}/{{Auth::user()->img_perfil}}" width="45" height="40">
				@else
					<img src="http://triagroup.co/build/assets/img/profiles/user.png" alt="logo" class="brand border-radius" data-src="http://triagroup.co/build/assets/img/profiles/user.png" data-src-retina="http://triagroup.co/build/assets/img/profiles/user.png" width="45" height="40">
				@endif
			</li>
            <li class="m-t-5 ">
                <a href="/perfil"><span class="title">Perfil</span></a>
                <span class="icon-thumbnail"><i class="pg-home"></i></span>
            </li>

			<li>
				<a href="/logout"><span class="title">Salir</span></a>
				<span class="icon-thumbnail"><i class="pg-power"></i></span>
			</li>

        </ul>
        <div class="clearfix"></div>
    </div>
    <!-- END SIDEBAR MENU -->
</nav>