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
                    <h6 class="breadcrumb">Super Administrador de Apartamentos</h6>
                    <div class="container-md-height m-b-20">
                        <div class="row row-md-height">
                            <div class="col-lg-6 col-md-6 col-md-height col-middle bg-white">
                                <div class="full-height">
                                    <div class="panel-body text-center">
                                        <a href="/superadmin/apartamentos">
                                            <i class="fa fa-building" style="font-size: 90px;margin-right: 15px;"></i>
                                        </a>
                                        <a href="/superadmin/zonas">
                                            <i class="fa fa-building-o" style="font-size: 90px; margin-right: 15px;"></i>
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
                                        <pre class="bg-success" style="color:white; font-weight:bold; font-size:1em;">En esta sección podra agregar y administrar los apartamentos  pertenecientes a cada zona o unidad, crearlos y actualizarlos en un instante.</pre>
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
                    <div class="panel-title col-md-6">Listado de Apartamentos  </div>
                    <div class="col-md-2 pull-right">
                        {!!link_to_route('superadmin.apartamentos.create', $title = '+ Nuevo Apartamento', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
                    </div>
                <div class="pull-left" style="80%">
                    <div class="form-group">
                    {!!Form::open(['action'=>'ApartamentoController@buscar','method'=>'POST' , 'class'=>'navbar-form', 'role'=>'search'])!!}
                    <div class="form-group">
                    {!!Form::select ('conjunto', $conjuntos, null, ['class'=>'form-control', 'placeholder'=>'Selecciona un Conjunto', 'id'=>'conjunto'])!!}
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                    {!!Form::close()!!}
                    </div>
                    </div>
                </div>
                    <div class="clearfix"></div>
                </div>
                <!-- Pegar el panel body -->
                <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="datos">
                    <thead class="info">
                        <th style="width: auto;">Nombre Conjunto</th>
                        <th style="width: auto;">Tipo Unidad</th>
                        <th style="width: auto;">Unidad o Zona</th>
                        <th style="width: auto;">Apartamento</th>
                        <th style="width: auto;">Nombre Residente</th>
                        <th style="width: auto;">Tipo Residente</th>
                        <th>Acciones</th>
                    </thead>
                    @foreach ($apartamentos as $apartamento)
                    <tbody>
                        <td class="v-align-middle">{{$apartamento->nombre}}</td>
                        <td class="v-align-middle">{{$apartamento->tipo}}</td>
                        <td class="v-align-middle">{{$apartamento->zona}}</td>
                        <td class="v-align-middle">{{$apartamento->apartamento}}</td>
                        <td class="v-align-middle">{{$apartamento->nombres}} {{$apartamento->apellidos}}</td>
                        @if ($apartamento->propietario ==1)
                            <td class="v-align-middle">Propietario</td>
                        @else
                            <td class="v-align-middle">Arrendatario</td>
                        @endif
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-success dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Acciones
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                    <li>
                                        {!!link_to_route('superadmin.apartamentos.edit', $title = 'Editar Apartamento', $parameters = $apartamento->id , $attributes = ['role'=>'menu-item'])!!}
                                    </li>
                                    <li>
                                        {!!link_to_action('ApartamentoController@deletesuper', $title = 'Eliminar', $parameters = $apartamento->id, $attributes = ['role'=>'menu-item'])!!}
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tbody>
                    @endforeach
                </table>
                
            </div>
             <h6 style="font-weight:bold"> Total de Apartamentos Sin Registrar Datos: {{$data=$count->contarNoregistradosxConjunto($conjunto)}} </h6>
             <h6 style="font-weight:bold"> Total de Apartamentos Creados en Sistema {{$data2=$count->contarApartamentosConjunto($conjunto)}} </h6>
             <h6 style="font-weight:bold"> Total de Apartamentos Activos en  {{$totalactivos=$data2-$data}} </h6>
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