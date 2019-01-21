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
<div class="container-fluid">
  <div class="row">
    @include ('errors.errors')
    @include ('errors.success')
    @include ('errors.request')

    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="row">
            <div class="col-md-4 ">
              <h3>Listado de Bonos de Descuento</h3>
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
              {!!link_to_route('administrador.facturas.create', $title = '+ Cargar Recibos', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
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
                  <th style="width: auto;">Id Recibo</th>
                  <th style="width: auto;">Nombre</th>
                  <th style="width: auto;">Fecha</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($recibos as $recibo)
                <tr>
                  <td class="v-align-middle">{{$recibo->id}}</td>
                  <td class="v-align-middle">{{$recibo->name}}</td>
                  <td class="v-align-middle">{{$recibo->created_at}}</td>
                  <td>
                    {!!link_to_route('administrador.facturas.edit', $title = 'Editar', $parameters = $recibo->id , $attributes = ['role'=>'menu-item', 'class'=>'btn btn-success btn-xs mb-1'])!!}
                    {!!link_to_route('administrador.facturas.detalles', $title = 'Ver detalles', $parameters = $recibo->id , $attributes = ['role'=>'menu-item', 'class'=>'btn btn-secondary btn-xs mb-1'])!!}
                    <a href="javascript:;" class="btn btn-danger btn-xs mb-1" onclick="delete_f({{ $recibo->id }})" role="menu-item">Eliminar</a>
                    <form action="{{ route('administrador.facturas.destroy',$recibo->id) }}" id="delete_{{$recibo->id}}"method="POST">
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
        <h5 class="modal-title">Eliminar recibo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
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


@stop

@section ('footer')
@include('layout.footer')
@stop

@section('js_library')

@stop

@section('specific_js')
{!!Html::script('build/assets/js/script/busqueda.js')!!}
@stop



<script>
  function delete_f(id){
    $('#btn_delete').attr('onclick','$("#delete_'+id+'").submit()');
    $('#eliminar_modal').modal('show');
  }
</script>


