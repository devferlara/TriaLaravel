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

            <div class="container-fluid container-fixed-lg">
            <div class="panel panel-transparent">
                <div class="panel-heading">
                    <div class="panel-title col-md-6">Listado Recibos de Pago Administraciones</div>
                    <div class="col-md-2 pull-right">
                        {!!link_to_route('administrador.recibosdepago.create', $title = '+ Cargar Recibos', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
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
            <div class="panel-body">
            <div class="table-responsive">
            <table class="table table-hover table-bordered" id="datos">
                <thead class="info">
                    <th style="width: auto;">Id Factura</th>
                    <th style="width: auto;">Valor Admon</th>
                    <th style="width: auto;">Fecha</th>
                    <th style="width: auto;">Valor Parqueadero</th>
                    <th style="width: auto;">Valor Cuota Extra</th>
                    <th style="width: auto;">Apartamento</th>
                    <th>Acciones</th>
                </thead>
                @foreach ($recibos as $recibo)
                <tbody>
                    <td class="v-align-middle">{{$recibo->num_factura}}</td>
                    <td class="v-align-middle">{{$recibo->valoradmon}}</td>
                    <td class="v-align-middle">{{$recibo->fecha}}</td>
                    <td class="v-align-middle">{{$recibo->valorparqueadero}}</td>
                    <td class="v-align-middle">{{$recibo->valorcuotaextra}}</td>
                    <td class="v-align-middle">{{$recibo->apartamento_id}}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-success dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Acciones
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                <li>
                                    {!!link_to_route('administrador.recibosdepago.edit', $title = 'Editar Recibo', $parameters = $recibo->id , $attributes = ['role'=>'menu-item'])!!}
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

@section ('footer')
    @include('layout.footer')
@stop

@section('js_library')

@stop

@section('specific_js')
    {!!Html::script('build/assets/js/script/busqueda.js')!!}
@stop