@extends('layout.admin')

<!-- Create General Section Sidebar -->
@section('sidebar')
    <!-- Include the menu -->
    @include('backend.menu.administrador')
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
                    <h6 class="breadcrumb">Administrador de Apartamentos</h6>
                    <div class="container-md-height m-b-20">
                        <div class="row row-md-height">
                            <div class="col-lg-6 col-md-6 col-md-height col-middle bg-white">
                                <div class="full-height">
                                    <div class="panel-body text-center">
                                        <a href="/administrador/apartamentos">
                                            <i class="fa fa-building" style="font-size: 90px;margin-right: 15px;"></i>
                                        </a>
                                        <a href="/administrador/zonas">
                                            <i class="fa fa-building-o" style="font-size: 90px; margin-right: 15px;"></i>
                                        </a>
                                        <a href="/administrador/usuarios">
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
                                        <h3>Administrador</h3>
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
                    <div class="panel-title col-md-6">Lista Apartamentos Conjunto: {{$conjunto->first()->nombre}}</div>
                    <div class="col-md-2 pull-right">
                        {!!link_to_route('administrador.apartamentos.create', $title = '+ Nuevo Apartamento', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
                    </div>
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
                <!-- Pegar el panel body -->
                <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="datos">
                    <thead class="info">
                        <th style="width: auto;">Id Apto</th>
                        <th style="width: auto;">Tipo Propiedad</th>
                        <th style="width: auto;">Tipo Unidad</th>
                        <th style="width: auto;">Unidad o Zona</th>
                        <th style="width: auto;">Apartamento</th>
                        <th style="width: auto;">Nombre Residente</th>
                        <th style="width: auto;">Tipo Residente</th>
                        <th>Acciones</th>
                    </thead>
                    @foreach ($zonas as $zona)
                        @foreach ($zona->apartamentos as $apartamento)
                            @foreach ($apartamento->usuarios as $usuario)
                    <tbody>
                        <td class="v-align-middle">{{$apartamento->id}}</td>
                        <td class="v-align-middle">{{$conjunto->first()->tipo}}</td>
                        <td class="v-align-middle">{{$zona->tipo}}</td>
                        <td class="v-align-middle">{{$zona->zona}}</td>
                        <td class="v-align-middle">{{$apartamento->apartamento}}</td>
                        <td class="v-align-middle">{{$usuario->nombres}} {{$usuario->apellidos}}</td>
                        @if ($usuario->propietario ==1)
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
                                        {!!link_to_route('administrador.apartamentos.edit', $title = 'Editar Apartamento', $parameters = $apartamento->id , $attributes = ['role'=>'menu-item'])!!}
                                    </li>
                                    <li>
                                        {!!link_to_action('ApartamentoController@delete', $title = 'Eliminar', $parameters = $apartamento->id, $attributes = ['role'=>'menu-item'])!!}
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tbody>
                            @endforeach
                        @endforeach
                    @endforeach
                </table>
               
            </div>
             <h6 style="font-weight:bold"> Total de Apartamentos Registrados: {{$data = $count->contarApartamentosConjunto($conjunto->first()->id)}} </h6>
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