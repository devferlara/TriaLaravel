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
                    <h6 class="breadcrumb">Super Administrador de Conjuntos</h6>
                    <div class="container-md-height m-b-20">
                        <div class="row row-md-height">
                            <div class="col-lg-6 col-md-6 col-md-height col-middle bg-white">
                                <div class="full-height">
                                    <div class="panel-body text-center">
                                        <a href="/superadmin/conjuntos">
                                            <i class="fa fa-building" style="font-size:120px;"></i>
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
                                        <p style="font-weight:bold; font-size:1em;">
                                            En esta sección podra agregar y administrar los conjuntos, crearlos y actualizarlos en un instante.
                                        </p>
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
                    <div class="panel-title col-md-6">Listado de Conjuntos</div>
                    <div class="col-md-2 pull-right">
                        {!!link_to_route('superadmin.conjuntos.create', $title = '+ Nuevo Conjunto', $parameters = null, $attributes = ['class'=>'btn btn-primary','data-target'=>'#crearconjunto'])!!}
                    </div>
                    <div class="pull-left" style="80%">
                    {!!Form::open(['action'=>'ConjuntoController@buscarconjunto','method'=>'GET' , 'class'=>'navbar-form', 'role'=>'search'])!!}
                    <div class="form-group">
                    {!!Form::text ('nomconjunto', null, ['class'=>'form-control', 'placeholder'=>'Buscar Conjuntos'])!!}
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                    {!!Form::close()!!}
                    </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="datos">
                    <thead class="info">
                        <th style="width: auto;">NIT</th>
                        <th style="width: auto;">Cant. Usuarios</th>
                        <th style="width: auto;">Cant. NO Actualizados</th>
                        <th style="width: auto;">Tipo</th>
                        <th style="width: auto;">Nombre</th>
                        <th style="width: auto;">Administrador</th>
                        <th style="width: auto;">Ciudad</th>
                        <th style="width: auto;">Localidad</th>
                        <th style="width: auto;">Barrio</th>
                        <th style="width: auto;">Dirección</th>
                        <th style="width: auto;">Estrato</th>
                        <th style="width: auto;">Teléfono</th>
                        <th>Acciones</th>
                    </thead>
                    @foreach ($conjuntos as $conjunto)
                    <tbody>
                        <td class="v-align-middle">{{$conjunto->nit}}</td> 
                        <td class="v-align-middle">{{$data = $count->contarUsuariosConjunto($conjunto->id)}}</td>
                        <td class="v-align-middle">{{$data = $count->contarNoRegistradosConjunto($conjunto->id)}}</td>
                        <td class="v-align-middle">{{$conjunto->tipo}}</td>
                        <td class="v-align-middle">{{$conjunto->nombre}}</td>
                        <td class="v-align-middle">{{$conjunto->administrador->first()->usuarios()->first()->nombres}}
                            {{$conjunto->administrador->first()->usuarios()->first()->apellidos}}</td>
                        <td class="v-align-middle">{{$conjunto->ciudad}}</td>
                        <td class="v-align-middle">{{$conjunto->localidad}}</td>
                        <td class="v-align-middle">{{$conjunto->barrio}}</td>
                        <td class="v-align-middle">{{$conjunto->direccion}}</td>
                        <td class="v-align-middle">{{$conjunto->estrato}}</td>
                        <td class="v-align-middle">{{$conjunto->telefono}}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-success dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Acciones
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                    <li>
                                        {!!link_to_route('superadmin.conjuntos.edit', $title = 'Editar', $parameters = $conjunto->id, $attributes = ['role'=>'menu-item'])!!}
                                    </li>
                                    <li>
                                        {!!link_to_action('ConjuntoController@delete', $title = 'Eliminar', $parameters = $conjunto->id, $attributes = ['role'=>'menu-item'])!!}
                                    </li>
                                    <li>
                                        {!!link_to_action('ConjuntoController@detalles', $title = 'Detalles', $parameters = $conjunto->id, $attributes = ['role'=>'menu-item'])!!}                                   </li>
                                </ul>
                            </div>
                        </td>
                    </tbody>
                    @endforeach
                </table>
                {!!$conjuntos->render()!!}
            </div>
             <h6 style="font-weight:bold"> Total de Conjuntos Registrados: {!!$conjuntos->total()!!}</h6>       
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

    {!!Html::script('build/assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js')!!}
    {!!Html::script('build/assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js')!!}
    {!!Html::script('build/assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js')!!}
    {!!Html::script('build/assets/plugins/datatables-responsive/js/datatables.responsive.js')!!}
    {!!Html::script('build/assets/plugins/datatables-responsive/js/lodash.min.js')!!}
@stop

@section('specific_js')

    {!!Html::script('build/assets/js/init.js')!!}
    {!!Html::script('build/assets/js/datatables.js')!!}

@stop