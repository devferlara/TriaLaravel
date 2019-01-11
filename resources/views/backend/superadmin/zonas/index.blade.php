@extends('layout.admin')

<!-- Create General Section Sidebar -->
@section('sidebar')
    <!-- Include the menu -->
    @include('backend.menu.superadmin')
    @stop

            <!-- Create General Section Header -->
@section('head')
    <!-- Include the profile header--> 
    @include ('layout.head')
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
                    <h6 class="breadcrumb">Super Administrador de Zonas</h6>
                    <div class="container-md-height m-b-20">
                        <div class="row row-md-height">
                            <div class="col-lg-6 col-md-6 col-md-height col-middle bg-white">
                                <div class="full-height">
                                    <div class="panel-body text-center">
                                        <a href="/superadmin/zonas">
                                            <i class="fa fa-building-o" style="font-size: 90px; margin-right: 15px;"></i>
                                        </a>
                                        <a href="/superadmin/apartamentos">
                                            <i class="fa fa-building" style="font-size: 90px;margin-right: 15px;"></i>
                                        </a>
                                        <a href="/superadmin/usuarios">
                                            <i class="fa fa-user" style="font-size: 90px;margin-right: 15px;"></i>
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
                                        <h3>Super Administrador</h3>
                                        <pre class="bg-success" style="color:white; font-weight:bold; font-size:1em;">En esta sección podra agregar y administrar las zonas pertenecientes a los conjuntos, crearlos y actualizarlos en un instante.</pre>
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
                    <div class="panel-title col-md-6">Listado de Detalles Conjunto </div>
                    <div class="col-md-2 pull-right">
                        {!!link_to_route('superadmin.zonas.create', $title = '+ Nueva Zona', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
                    </div>
                <div class="pull-left" style="80%">
                    <div class="form-group">
                    {!!Form::open(['action'=>'ZonaController@buscarzona','method'=>'POST' , 'class'=>'navbar-form', 'role'=>'search'])!!}
                    <div class="form-group">
                    {!!Form::select ('conjunto', $conjuntos, null, ['class'=>'form-control', 'placeholder'=>'Selecciona un Conjunto','id'=>'conjunto'])!!}
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                    {!!Form::close()!!}
                    </div>
                    </div>
                </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="datos">
                    <thead class="info">
                        <th style="width: auto;">Nombre Conjunto</th>
                        <th style="width: auto;">Cant. Usuarios Zona</th>
                        <th style="width: auto;">Tipo de Zona</th>
                        <th style="width: auto;">Número de Unidad</th>
                        <th style="width: auto;">Descripcion</th>
                        <th>Acciones</th>
                    </thead>
                    @foreach ($zonas as $zona)
                    <tbody>
                        <td class="v-align-middle">{{$zona->nombre}}</td>
                        <td class="v-align-middle">{{$data = $count->contarUsuariosZona($zona->id)}}</td>
                        <td class="v-align-middle">{{$zona->tipo}}</td>
                        <td class="v-align-middle">{{$zona->zona}}</td>
                        <td class="v-align-middle">{{$zona->descripcion}}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-success dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Acciones
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                    <li>
                                        {!!link_to_route('superadmin.zonas.edit', $title = 'Editar', $parameters = $zona->id , $attributes = ['role'=>'menu-item'])!!}
                                    </li>
                                    <li>
                                        {!!link_to_action('ZonaController@deletesuper', $title = 'Eliminar', $parameters = $zona->id, $attributes = ['role'=>'menu-item'])!!}
                                    </li>
                                </ul>
                            </div>
                        </td>>
                    </tbody>
                    @endforeach
                </table>
            </div>
             <h6 style="font-weight:bold"> Total de Zonas - Conjunto: {{$data = $count->zonasConjunto($conjunto)}} </h6>
            </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('js_library')

    {!!Html::script('build/assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js')!!}
    {!!Html::script('build/assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js')!!}
    {!!Html::script('build/assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js')!!}
    {!!Html::script('build/assets/plugins/datatables-responsive/js/datatables.responsive.js')!!}
    {!!Html::script('build/assets/plugins/datatables-responsive/js/lodash.min.js')!!}
@stop

@section('specific_js')

    {!!Html::script('build/assets/js/init.js')!!}
    {!!Html::script('build/assets/js/datatables.js')!!}
    {!!Html::script('build/assets/js/script/busqueda.js')!!}
@stop