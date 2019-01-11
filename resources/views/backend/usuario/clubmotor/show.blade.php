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
</style>
@stop

@section('content')
<div class="page-content-wrapper">
    <div class="content">
        @include ('errors.errors')
        @include ('errors.request')
        @include ('errors.success')
        <div class="jumbotron" data-pages="parallax">
            <div class="container-fluid container-fixed-lg">
                <div class="inner">
                    <h6 class="breadcrumb">Bienvenido a la Administración de Vehiculos del Club Motor</h6>
                    <div class="container-md-height m-b-20">
                        <div class="row row-md-height">
                            <div class="col-lg-6 col-md-6 col-md-height col-middle bg-white">
                                <div class="full-height">
                                    <div class="panel-body text-center">
                                        <a href="/usuario/clubmotor">
                                            <i class="fa fa-car" style="font-size: 120px;text-align: center;"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-height col-md-6 col-top">
                                <div class="panel panel-transparent">
                                    <div class="panel-heading">
                                        <div class="panel-title">Bienvenido(a) {{ Auth::user()->nombres }}</div>
                                    </div>
                                    <div class="panel-body">
                                        <h3>Club Motors</h3>
                                        <pre class="bg-success" style="color:white; font-weight:bold; font-size:1em;">En esta sección podras registrar y editar tus vehiculos. !Es Muy fácil solo debes crearlos y actualizarlos en un instante!</pre>
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
                    <div class="panel-title col-md-6">Mis Mascotas </div>
                    <div class="col-md-2 pull-right">
                        {!!link_to_route('usuario.clubmotor.create', $title = '+ Registrar Otra Vehiculo', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!-- Pegar el panel body -->
                <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                    <thead class="info">
                        <th style="width: auto;">Tipo de Vehiculo</th>
                        <th style="width: auto;">Marca del Vehiculo</th>
                        <th style="width: auto;">Placa</th>
                        <th style="width: auto;">Color</th>
                        <th style="width: auto;">Modelo</th>
                        <th style="width: auto;">Parqueadero</th>
                        <th>Acciones</th>
                    </thead>
                    @foreach ($vehiculos as $vehiculo)
                    <tbody>
                        <td class="v-align-middle">{{$vehiculo->tipo}}</td>
                        <td class="v-align-middle">{{$vehiculo->marca}}</td>
                        <td class="v-align-middle">{{$vehiculo->placa}}</td>
                        <td class="v-align-middle">{{$vehiculo->color}}</td>
                        <td class="v-align-middle">{{$vehiculo->modelo}}</td>
                        @if ($vehiculo->parqueadero ==1)
                            <td class="v-align-middle">SI</td>
                        @else
                            <td class="v-align-middle">NO</td>
                        @endif
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-success dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Acciones
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                    <li>
                                        {!!link_to_route('usuario.clubmotor.edit', $title = 'Editar Vehiculo', $parameters = $vehiculo->id, $attributes = ['role'=>'menu-item'])!!}
                                    </li>
                                    <li>
                                        {!!link_to_action('ClubvehiculosController@delete', $title = 'Eliminar', $parameters = $vehiculo->id, $attributes = ['role'=>'menu-item'])!!}
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tbody>
                    @endforeach
                </table>
                
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