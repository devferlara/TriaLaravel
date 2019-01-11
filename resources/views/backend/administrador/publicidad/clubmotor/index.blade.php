@extends('layout.mensajes')

@section ('meta')
    <meta name="viewport" content="width=device-width, initial-scale=1">
@stop

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
</style>

@stop

@section('content')
    <!-- START PAGE CONTENT WRAPPER -->
    <div class="page-content-wrapper">

        <div class="content">
        @include ('errors.errors')
        @include ('errors.success')
        @include ('errors.request')
            <div class="jumbotron" data-pages="parallax">
                <div class="container-fluid container-fixed-lg">
                    <div class="inner">
                        <h6 class="breadcrumb">Vista Administrador - Bonos de Descuento Club Motor</h6>
                        <div class="container-md-height m-b-20">
                            <div class="row row-md-height">
                                <div class="col-lg-6 col-md-6 col-md-height col-middle bg-white">
                                    <div class="full-height">
                                        <div class="panel-body text-center">
                                            <a href="/administrador/publicidad/clubmotor">
                                            <i class="fa fa-car" style="font-size:120px;"></i>
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
                                            <h3>Administrador</h3>
                                            <pre class="bg-success" style="color:white; font-weight:bold; font-size:1em;">En esta sección podra estar informado sobre los descuentos o bonos para los propietarios de vehiculos y las necesidades de los residentes de su conjunto.</pre>
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
                    <div class="panel-title col-md-6">Listado de Bonos Club Motor</div>
                    <div class="pull-left" style="80%">
                    <div class="form-group">
                    <form>
                    <h6 class= "text-primary" style="font-weight:bold">Busqueda:</h6> 
                    <input id="buscar" type="text" onkeyup="busqueda()" class="form-control" style="width:100%;" placeholder="Escriba aquí el valor a buscar" />
                    </form>
                    </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            <div class="panel-body">
            <div class="table-responsive">
            <table class="table table-hover table-bordered" id="datos">
                <thead class= "info">
                    <th style="width: auto;">Fecha</th>
                    <th style="width: auto;">Titulo</th>
                    <th style="width: auto;">Categoria</th>
                    <th style="width: auto;">Emisor Bono</th>
                    <th style="width: auto;">Valor Bono</th>
                    <th>Acciones</th>
                </thead>
                @foreach ($publicaciones as $publivehiculo)
                <tbody>
                    <td class="v-align-middle">{{$publivehiculo->fecha}}</td>
                    <td class="v-align-middle">{{$publivehiculo->titulo}}</td>
                    <td class="v-align-middle">{{$publivehiculo->categoria}}</td>
                    <td class="v-align-middle">{{$publivehiculo->emisor}}</td>
                    <td class="v-align-middle">{{$publivehiculo->valor}}</td>
                    <td>
                    {!!link_to_route('administrador.publicidad.clubmotor.show', $title = 'Ver', $parameters = $publivehiculo->id, $attributes = ['class'=>'btn btn-success'])!!}
                @endforeach
                </tbody>
            </table>
            {!!$publicaciones->render()!!}
            </div>
            <h6 style="font-weight:bold"> Total Bonos Creados: {!!$publicaciones->total()!!}</h6>
            </div>
            </div>
        </div>
    </div>
</div>
@stop

@section ('footer')
    @include('layout.footer')
@stop

@section('js_library')

@stop

@section('specific_js')
    {!!Html::script('build/assets/js/script/busqueda.js')!!}
@stop