@extends('layout.admin')

@section('sidebar')
    @include('backend.menu.superadmin')
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
                                {!!link_to_route('superadmin.conjuntos.edit', $title = 'Editar Perfl Conjunto', $parameters = $conjunto->id, $attributes = ['class'=>'btn btn-primary'])!!}
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
                                                    @foreach ($administrador as $admin)
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
                                                            <p class="hint-text m-t-5">Datos Administrador</p>
                                                            <h3 class="no-margin">{{$admin->usuarios->nombres}} {{$admin->usuarios->apellidos}}</h3>
                                                            <p class="no-margin fs-16">{{$admin->usuarios->rol}}</p>
                                                            <p class="hint-text m-t-5 small">{{$admin->usuarios->email}} | Teléfono: {{$admin->usuarios->telefono}} {{$admin->usuarios->celular}}</p>
                                                            {!!link_to_route('superadmin.usuarios.edit', $title = 'Editar Perfil Admin', $parameters = $admin->usuarios->id , $attributes = ['class'=>'btn btn-success'])!!}
                                                        </div>
                                            <!-- END USER NAME -->
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <!-- START USER BIO -->

                                            <div class="col-md-4">
                                                <p class="hint-text m-t-5">Datos Conjunto:</p></br>
                                                <p class="no-margin fs-16">{{$conjunto->ciudad}} | {{$conjunto->localidad}}</p>
                                                <p class="no-margin fs-16">{{$conjunto->barrio}} | {{$conjunto->direccion}}</p>
                                            </div>
                                <!-- END USER BIO -->
                                    <div class="col-md-4">
                                        <p class="m-b-5 small">{{$data = $count->contarUsuariosConjunto($conjunto->id)}} Usuarios Activos</p>
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
                                                <div class="bg-master text-center text-white"><span>{{$data = ($count->contarUsuariosConjunto($conjunto->id))-4}}</span>
                                                </div>
                                            </div>
                                        </li>
                                        </ul>
                                            <br>
                                            <p class="m-t-5 small">Residentes Conjunto</p>
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

         <div class="container-fluid container-fixed-lg">
            <div class="panel panel-transparent">
                <div class="panel-heading">
                    <div class="panel-title col-md-6">Listado de Usuarios:
                    <h4>{!!$conjunto->nombre!!} </h4>     
                    </div>
                    <div class="form-group">
                    <form>
                    <h6 class= "text-primary" style="font-weight:bold">Busqueda:</h6> 
                    <input id="buscar" type="text" onkeyup="busqueda()" class="form-control" style="width:50%;" placeholder="Escriba aquí el valor a buscar" />
                    </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
            <div class="panel-body">
                <div class="table-responsive">
                 <table class="table table-hover table-bordered" id= "datos">
                    <thead class= "info">
                        <th style="width: auto;">Identificacion</th>
                        <th style="width: auto;">Nombres</th>
                        <th style="width: auto;">Apellidos</th>
                        <th style="width: auto;">Email</th>
                        <th style="width: auto;">Tipo Residente</th>
                        <th style="width: auto;">Unidad</th>
                        <th style="width: auto;">Apartamento</th>
                    </thead>
                <tbody>
                    @foreach ($zonas as $zona)
                        @foreach ($zona->apartamentos as $apartamento)
                            @foreach ($apartamento->usuarios as $usuario)
                    <td class="v-align-middle">{{ $usuario->identificacion }}</td>
                    <td class="v-align-middle">{{ $usuario->nombres }}</td>
                    <td class="v-align-middle">{{ $usuario->apellidos }}</td>
                    <td class="v-align-middle">{{ $usuario->email }}</td>
                        @if($usuario->propietario = 1)
                        <td class="v-align-middle">Propietario</td>
                        @else <td class="v-align-middle">Arrendatario</td> 
                        @endif
                    <td class="v-align-middle">{{ $zona->tipo }} {{ $zona->zona }}</td>
                    <td class="v-align-middle">{{ $apartamento->apartamento }}</td>
                </tbody>
                            @endforeach
                        @endforeach
                    @endforeach
            </table>
            {!!$zonas->render()!!}
            </div>
            <h6 style="font-weight:bold"> Total de usuarios Registrados: {{$data = $count->contarUsuariosConjunto($conjunto->id)}} </h6>
            <h6 style="font-weight:bold"> Total de usuarios sin actualizar datos: {{$data = $count->contarNoRegistradosConjunto($conjunto->id)}} </h6>
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

    {!!Html::script('https://maps.googleapis.com/maps/api/js')!!}
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
