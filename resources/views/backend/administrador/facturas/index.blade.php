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
                    <div class="panel-title col-md-6">Listado Recibos de Pago</div>
                    <div class="col-md-2 pull-right">
                        {!!link_to_route('administrador.facturas.create', $title = '+ Cargar Recibos', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
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
                    <th style="width: auto;">Id Recibo</th>
                    <th style="width: auto;">Nombre</th>
                    <th style="width: auto;">Fecha</th>
                    <th>Acciones</th>
                </thead>
                @foreach ($recibos as $recibo)
                <tbody>
                    <td class="v-align-middle">{{$recibo->id}}</td>
                    <td class="v-align-middle">{{$recibo->name}}</td>
                    <td class="v-align-middle">{{$recibo->created_at}}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-success dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Acciones
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                <li>
                                    {!!link_to_route('administrador.facturas.edit', $title = 'Editar', $parameters = $recibo->id , $attributes = ['role'=>'menu-item'])!!}
                                    {!!link_to_route('administrador.facturas.detalles', $title = 'Ver detalles', $parameters = $recibo->id , $attributes = ['role'=>'menu-item'])!!}
                                    <a href="javascript:;" onclick="delete_f({{ $recibo->id }})" role="menu-item">Eliminar</a>
                                    <form action="{{ route('administrador.facturas.destroy',$recibo->id) }}" id="delete_{{$recibo->id}}"method="POST">
                                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                        {{ method_field('DELETE')}}
                                    </form>
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

<div class="modal fade" id="eliminar_modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Eliminar recibo</h4>
          </div>
          <div class="modal-body">
            <p>¿Está seguro que desea eliminar este recibo?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" id="btn_delete" onclick="" class="btn btn-primary">Eliminar Recibo</button>
          </div>
        </div>
      </div>
   </div>

<script>
    function delete_f(id)
    {
        $('#btn_delete').attr('onclick','$("#delete_'+id+'").submit()');
        $('#eliminar_modal').modal('show');
    }
</script>