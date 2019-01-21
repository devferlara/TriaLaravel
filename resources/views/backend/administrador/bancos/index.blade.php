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

<div class="container-fluid">
  <div class="row">
    @include ('errors.errors')
    @include ('errors.request')
    @include ('errors.success')

    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="row">
            <div class="col-md-4 ">
              <h3>Listado de Entidades Bancarias</h3>
            </div>

            <div class="col-md-4" style="80%">
              <form>
                <div class="form-group has-float-label mb-4" style="margin:0 !important">
                  <label class= "text-primary" style="font-weight:bold">Busqueda:</label> 
                  <input id="buscar" type="text" onkeyup="busqueda()" class="form-control" style="width:100%;" placeholder="Escriba aquí el valor a buscar" />
                </div>
              </form>
            </div>

            

            <div class="col-md-4 text-right">
              @if (count($bancos) == 0)
                {!!link_to_route('administrador.bancos.create', $title = '+ Nuevo Banco', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
              @endif
               
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>


    <div class="col-md-12"> 
      <div class="card mb-4">
        <div class="card-body ">
          <div class="table-responsive">
            <table class="data-table responsive nowrap tabla_bonos_estilos" id="datos">
              <thead>
                <tr>
                  <th style="width: auto;">ID Banco</th>
                  <th style="width: auto;">Nombre</th>
                  <th style="width: auto;">Pais</th>
                  <th style="width: auto;">Link de Pago</th>
                  <th style="width: auto;">Estado</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($bancos as $banco)
                <tr>
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
                    {!!link_to_route('administrador.bancos.edit', $title = 'Editar Banco', $parameters = $banco->id , $attributes = ['role'=>'menu-item', 'class'=>'btn btn-success btn-xs mb-1'])!!}
                    <a class="btn btn-danger btn-xs mb-1" href="javascript:;" onclick="delete_f({{ $banco->id }})" role="menu-item">Eliminar</a>
                    <form action="{{ route('administrador.bancos.destroy',$banco->id) }}" id="delete_{{$banco->id}}"method="POST">
                      <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                      {{ method_field('DELETE')}}
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>




<div class="modal" tabindex="-1" role="dialog" id="eliminar_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Eliminar banco</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
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



<script>
  function delete_f(id)
  {
    $('#btn_delete').attr('onclick','$("#delete_'+id+'").submit()');
    $('#eliminar_modal').modal('show');
  }
</script>