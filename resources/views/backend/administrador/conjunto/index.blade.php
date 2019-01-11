@extends('layout.admin')

@section('sidebar')
    @include('backend.menu.administrador')
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
    @include ('errors.success')
    @include ('errors.request')
    @include ('errors.errors')

        <!-- START SOCIAL WRAPPER -->
        <div class="social-wrapper">

            <div class="social " data-pages="social">
                <div class="jumbotron" data-pages="parallax" data-social="cover">
                    <div class="cover-photo">
                        <img alt="Cover photo" src="{{ asset('uploads/banners/conjunto/'.$conjunto->first()->banner_conjunto) }}" />
                    </div>

                    <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
                        <div class="inner">
                            <div class="pull-bottom bottom-left m-b-40">
                                <img class="profile-photo" src="{{ asset('uploads/banners/conjunto/'.$conjunto->first()->img_perfil) }}" />
                                <h5 class="text-white no-margin">Conjunto Residencial</h5>
                                <h1 class="text-white no-margin"><span class="semi-bold">{{ $conjunto->first()->nombre}}</span></h1>
                                {!!link_to_route('administrador.conjuntos.edit', $title = 'Editar Perfl Conjunto', $parameters = $conjunto->first()->id, $attributes = ['class'=>'btn btn-primary'])!!}
                                <input type="hidden" id="map_latitud" value="{{ $conjunto->first()->map_latitud }}">
                                <input type="hidden" id="map_longitud" value="{{ $conjunto->first()->map_longitud }}">
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
                                        
                                        <!-- START USER BIO -->

                                            <div class="col-md-6">
                                                <p class="hint-text m-t-5">Datos Conjunto:</p></br>
                                                <p class="no-margin fs-16">{{$conjunto->first()->ciudad}} | {{$conjunto->first()->localidad}}</p>
                                                <p class="no-margin fs-16">{{$conjunto->first()->barrio}} | {{$conjunto->first()->direccion}}</p>
                                            </div>
                                <!-- END USER BIO -->
                                    <div class="col-md-6">
                                        <!--  <p class="m-b-5 small">{{$data = $count->contarUsuariosConjunto($conjunto->first()->id)}} Usuarios Activos</p>
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
                                                <div class="bg-master text-center text-white"><span>{{$data = ($count->contarUsuariosConjunto($conjunto->first()->id))-4}}</span>
                                                </div>
                                            </div>
                                        </li>
                                        </ul>
                                            <br>
                                            <p class="m-t-5 small">Residentes Conjunto</p>-->
                                    </div>
                                    </div>
                                    <div class="container-fluid p-t-30 p-b-30 ">
                                   
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
