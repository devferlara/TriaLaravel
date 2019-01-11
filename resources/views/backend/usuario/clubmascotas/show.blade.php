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
                    <h6 class="breadcrumb">Bienvenido a la Administración de Mascotas del Club Mascotas HGV</h6>
                    <div class="container-md-height m-b-20">
                        <div class="row row-md-height">
                            <div class="col-lg-6 col-md-6 col-md-height col-middle bg-white">
                                <div class="full-height">
                                    <div class="panel-body text-center">
                                        <a href="/usuario/clubmascotas">
                                            <i class="fa fa-paw" style="font-size: 120px;text-align: center;"></i>
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
                                        <h3>Club Mascotas HGV</h3>
                                        <pre class="bg-success" style="color:white; font-weight:bold; font-size:1em;">En esta sección podras registrar y editar tus mascotas. !Es Muy fácil solo debes crearlos y actualizarlos en un instante!</pre>
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
                        {!!link_to_route('usuario.clubmascotas.create', $title = '+ Registrar Otra Mascota', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!-- Pegar el panel body -->
                <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                    <thead class="info">
                        <th style="width: auto;">Nombre de tu Mascota</th>
                        <th style="width: auto;">Tipo de Mascota</th>
                        <th style="width: auto;">Raza</th>
                        <th style="width: auto;">Genero</th>
                        <th style="width: auto;">Foto de tu Mascota</th>
                        <th style="width: auto;">Vacunado</th>
                        <th>Acciones</th>
                    </thead>
                    @foreach ($mascotas as $mascota)
                    <tbody>
                        <td class="v-align-middle">{{$mascota->nombre}}</td>
                        <td class="v-align-middle">{{$mascota->tipo}}</td>
                        <td class="v-align-middle">{{$mascota->raza}}</td>
                        <td class="v-align-middle">{{$mascota->genero}}</td>
                        <td class="v-align-middle"><img class="profile-photo" alt="Imagen Mascota" src="{{ asset('uploads/mascotas/'.$mascota->img_mascota) }}"/></td>
                        @if ($mascota->vacunas ==1)
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
                                        {!!link_to_route('usuario.clubmascotas.edit', $title = 'Editar Mascota', $parameters = $mascota->id , $attributes = ['role'=>'menu-item'])!!}
                                    </li>
                                    <li>
                                        {!!link_to_action('ClubmascotasController@delete', $title = 'Eliminar', $parameters = $mascota->id, $attributes = ['role'=>'menu-item'])!!}
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