<!-- START HEADER -->
<div class="header ">
    <!-- START MOBILE CONTROLS -->
    <!-- LEFT SIDE -->
    <div class="pull-left full-height visible-sm visible-xs">
        <!-- START ACTION BAR -->
        <div class="sm-action-bar">
            <a href="#" class="btn-link toggle-sidebar" data-toggle="sidebar">
                <span class="icon-set menu-hambuger"></span>
            </a>
        </div>
        <!-- END ACTION BAR -->
    </div>
    <!-- RIGHT SIDE -->
    <div class="pull-right full-height visible-sm visible-xs">
        <!-- START ACTION BAR -->
        <div class="sm-action-bar">
            <a href="#" class="btn-link" data-toggle="quickview" data-toggle-element="#quickview">
                <span class="icon-set menu-hambuger-plus"></span>
            </a>
        </div>
        <!-- END ACTION BAR -->
    </div>
    <!-- END MOBILE CONTROLS -->
    <div class=" pull-left sm-table">
        <div class="header-inner">
            <div class="brand inline">
            </div>
        </div>
    </div>

    <div class=" pull-right">
        <!-- START User Info-->
        <div class="visible-lg visible-md m-t-10">
            <div class="pull-left p-r-10 p-t-10 fs-16 font-heading">
                <span class="semi-bold">{{ Auth::user()->nombres }}</span> <span class="text-master">{{ Auth::user()->apellidos }}</span>
            </div>
            <div class="dropdown pull-right">
                <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="thumbnail-wrapper d32 circular inline m-t-5">
                <img src="{{ asset('build/assets/img/profiles/user.png') }}" alt="" data-src="{{ asset('build/assets/img/profiles/user.png') }}" data-src-retina="{{ asset('build/assets/img/profiles/user.png') }}" width="32" height="32">
            </span>
                </button>
                <ul class="dropdown-menu profile-dropdown" role="menu">

                    <li class="bg-master-lighter">
                        <a href="/perfil" class="clearfix">
                            <span class="pull-left">Editar Perfil</span>
                            <span class="pull-right"><i class="fa fa-edit"></i></span>
                        </a>
                        <a href="/logout" class="clearfix">
                            <span class="pull-left">Salir</span>
                            <span class="pull-right"><i class="pg-power"></i></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- END User Info-->
    </div>
</div>
<!-- END HEADER -->