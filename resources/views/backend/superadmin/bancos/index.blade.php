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
                                        <pre class="bg-success" style="color:white; font-weight:bold; font-size:1em;">En esta sección podra agregar y administrar las entidades bancarias que tienen manejo para pagos de las obligaciones de los conjuntos residenciales.</pre>
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
                    <div class="panel-title col-md-6">Listado de Entidades Bancarias  </div>
                    <div class="col-md-2 pull-right">
                        {!!link_to_route('superadmin.bancos.create', $title = '+ Nuevo Banco', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
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
                        <th style="width: auto;">ID Banco</th>
                        <th style="width: auto;">Nombre</th>
                        <th style="width: auto;">Pais</th>
                        <th style="width: auto;">Link de Pago</th>
                        <th style="width: auto;">Estado</th>
                        <th>Acciones</th>
                    </thead>
                    @foreach ($bancos as $banco)
                    <tbody>
                        <td class="v-align-middle">{{$banco->id}}</td>
                        <td class="v-align-middle">{{$banco->nombre}}</td>
                        <td class="v-align-middle">{{$banco->pais}}</td>
                        <td class="v-align-middle">{{$banco->link}}</td>
                        @if ($banco->enabled ==1)
                            <td class="v-align-middle">Habilitado</td>
                        @else
                            <td class="v-align-middle">Deshabilitado</td>
                        @endif
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-success dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Acciones
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                    <li>
                                        {!!link_to_route('superadmin.bancos.edit', $title = 'Editar Banco', $parameters = $banco->id , $attributes = ['role'=>'menu-item'])!!}
                                    </li>
                                    <li>
                                        {!!link_to_action('BancoController@deletesuper', $title = 'Eliminar', $parameters = $banco->id, $attributes = ['role'=>'menu-item'])!!}
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