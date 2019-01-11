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
        <div class="container-fluid container-fixed-lg">
            <div class="panel panel-transparent">
                <div class="panel-heading">
                    <div class="panel-title col-md-6">Listado de Entidades Bancarias</div>
                    @if(count($bancos) == 0)
                    <div class="col-md-2 pull-right">
                        {!!link_to_route('administrador.bancos.create', $title = '+ Nuevo Banco', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
                    </div>
                    @endif
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
                                        {!!link_to_route('administrador.bancos.edit', $title = 'Editar Banco', $parameters = $banco->id , $attributes = ['role'=>'menu-item'])!!}
                                    </li>
                                    <li>
                                        <a href="javascript:;" onclick="delete_f({{ $banco->id }})" role="menu-item">Eliminar</a>
                                        <form action="{{ route('administrador.bancos.destroy',$banco->id) }}" id="delete_{{$banco->id}}"method="POST">
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

<div class="modal fade" id="eliminar_modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Eliminar banco</h4>
          </div>
          <div class="modal-body">
            <p>¿Está seguro que desea eliminar este banco?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" id="btn_delete" onclick="" class="btn btn-primary">Eliminar Banco</button>
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