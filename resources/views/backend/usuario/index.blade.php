@extends('layout.admin')

@section('sidebar')
    @include('backend.menu.usuario')
@stop


@section('head')
    @include('layout.head')
@stop

@section('css')

<style>
    .table thead tr th, .table tbody tr td {
        text-align: center;
    }
    #map-canvas  {
        float:left;
        width: 50%;
        height: 400px;
    }
    #pano  {
        float:left;
        width: 50%;
        height: 400px;
    }
</style>
@stop

@section('content')

<div class="page-content-wrapper">

    <div class="content">

        <!-- START SOCIAL WRAPPER -->
        <div class="social-wrapper">

            <div class="social " data-pages="social">
                <div class="jumbotron" data-pages="parallax" data-social="cover">
                    <div class="cover-photo">
                        <img alt="Cover photo" src="{{ asset('uploads/banners/conjunto/'.$conjunto->banner_conjunto) }}" />
                    </div>


                    <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
                        <div class="inner">
                            <div class="pull-bottom bottom-left m-b-40">
<img class="profile-photo" src="{{ asset('uploads/banners/conjunto/'.$conjunto->img_perfil) }}" />
                                <h5 class="text-white no-margin">Conjunto Residencial</h5>
                                <h1 class="text-white no-margin"><span class="semi-bold">{{ $conjunto->nombre}}</span></h1>
				<input type="hidden" id="map_latitud" value="{{ $conjunto->map_latitud }}">
                                <input type="hidden" id="map_longitud" value="{{ $conjunto->map_longitud }}">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
                    <div class="feed">
                <!-- START DAY -->
                        <div class="day" data-social="day">
                    <!-- START PROFILE OVERVIEW -->
                            <div class="card no-border bg-transparent full-width" data-social="item">
        
                                <div class="container-fluid p-t-30 p-b-30 ">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="container-xs-height">
                                                <div class="row-xs-height">
                                            <!-- START USER PROFILE PICTURE -->
                                                    <div class="social-user-profile col-xs-height text-center col-top">
                                                        <div class="thumbnail-wrapper d48 circular bordered b-white">
                                                            <img alt="Avatar" width="55" height="55" data-src-retina="{{ asset('build/assets/img/profiles/user.png') }}" data-src="{{ asset('build/assets/img/profiles/user.png') }}" src="{{ asset('build/assets/img/profiles/user.png') }}">
                                                        </div>
                                                        <br>
                                                        <i class="fa fa-check-circle text-success fs-16 m-t-10"></i>
                                                    </div>
                                            <!-- END USER PROFILE PICTURE -->
                                            <!-- START USER NAME -->
                                                        <div class="col-xs-height p-l-20">
                                                            <p class="hint-text m-t-5">Datos de Usuario</p>
                                                            <h3 class="no-margin">{{$usuario->nombres}} {{$usuario->apellidos}}</h3>
                                                            <p class="no-margin fs-16">Residente {{$zona->zonas()->first()->tipo}} {{$zona->zonas()->first()->zona}} {{$usuario->apartamentos()->first()->apartamento}}</p>
                                                            <p class="hint-text m-t-5 small">{{$usuario->email}} | Teléfono: {{$usuario->telefono}} {{$usuario->celular}}</p>
                                                            {!!link_to_action('UsuarioController@edit', $title = 'Editar Perfil', $parameters = $usuario->id , $attributes = ['class'=>'btn btn-success'])!!}
                                                        </div>
                                            <!-- END USER NAME -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- START USER BIO -->

                                            <div class="col-md-4">
                                            </div>
                                <!-- END USER BIO -->
                                     <!-- <div class="col-md-4">
                                        <ul class="list-unstyled ">
                                        <li class="m-r-10">
                                            <div class="thumbnail-wrapper d32 circular b-white m-r-5 b-a b-white">
                                                <img width="35" height="35" data-src-retina="{{ asset('build/assets/img/profiles/user.png') }}" data-src="{{ asset('build/assets/img/profiles/user.png') }}" alt="Profile Image" src="{{ asset('build/assets/img/profiles/user.png') }}">
                                            </div>
                                        </li>
                                        <li>
                                            <div class="thumbnail-wrapper d32 circular b-white m-r-5 b-a b-white">
                                                <img width="35" height="35" data-src-retina="{{ asset('build/assets/img/profiles/user.png') }}" data-src="{{ asset('build/assets/img/profiles/user.png') }}" alt="Profile Image" src="{{ asset('build/assets/img/profiles/user.png') }}">
                                            </div>
                                        </li>
                                        <li>
                                            <div class="thumbnail-wrapper d32 circular b-white m-r-5 b-a b-white">
                                                <img width="35" height="35" data-src-retina="{{ asset('build/assets/img/profiles/user.png') }}" data-src="{{ asset('build/assets/img/profiles/user.png') }}" alt="Profile Image" src="{{ asset('build/assets/img/profiles/user.png') }}">
                                            </div>
                                        </li>
                                        <li>
                                            <div class="thumbnail-wrapper d32 circular b-white m-r-5 b-a b-white">
                                                <img width="35" height="35" data-src-retina="{{ asset('build/assets/img/profiles/user.png') }}" data-src="{{ asset('build/assets/img/profiles/user.png') }}" alt="Profile Image" src="{{ asset('build/assets/img/profiles/user.png') }}">
                                            </div>
                                        </li>
                                        <li>
                                            <div class="thumbnail-wrapper d32 circular b-white">
                                                </div>
                                            </div>
                                        </li>
                                        </ul>-->
                                            <br>
                                    </div>
                                    </div>
                                    <div class="container-fluid p-t-30 p-b-30 ">
                                    <div class="row">
                                        <div id="map-canvas"></div>
                                        <div id="pano"></div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('footer')
    @include ('layout.footer')
@stop


@section('js_library')

    {!!Html::script('https://maps.googleapis.com/maps/api/js?key=AIzaSyD6tig7C2Lj9bG3BKOko3v06CC6X-QUnaA')!!}
    {!!Html::script('build/assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js')!!}
    {!!Html::script('build/assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js')!!}
    {!!Html::script('build/assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js')!!}
    {!!Html::script('build/assets/plugins/datatables-responsive/js/datatables.responsive.js')!!}
    {!!Html::script('build/assets/plugins/datatables-responsive/js/lodash.min.js')!!}
@stop

@section('specific_js')
    
    {!!Html::script('build/assets/js/script/admin.js')!!}
    {!!Html::script('build/assets/js/datatables.js')!!}
    {!!Html::script('build/assets/js/script/busqueda.js')!!}

@stop