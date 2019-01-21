@extends('layout.mensajes')

@section ('meta')
<meta name="viewport" content="width=device-width, initial-scale=1">
@stop

@section('sidebar')
@include('backend.menu.superadmin')
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
      <h1 class="breadcrumb">Super Administrador de Bonos de Descuento</h1>
    </div>
    <div class="col-lg-6 col-md-6">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="panel-body text-center">
            <a href="/superadmin/publicidad/bonos">
              <i class="simple-icon-present" style="font-size:120px;"></i>
            </a>
          </div>
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
          <p style="color:#000; font-weight:bold; font-size:1em;">En esta sección podra mantener informada a su comunidad, mediante publicaciones y noticias que permitan COMUNICAR a los residentes de su conjunto.</p>
        </div>
      </div>
    </div>
    
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
              {!!link_to_route('superadmin.publicidad.bonos.create', $title = '+ Crear Bono Descuento', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
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
              <thead >
                <tr>
                  <th >Item</th>
                  <th>Fecha</th>
                  <th >Titulo</th>
                  <th >Categoria</th>
                  <th>Tienda</th>
                  <th >Logo</th>
                  <th >Local</th>
                  <th>Acciones</th>
                </tr>
              </thead>

              {!!Form::open(['action'=>'PublicidadController@borramasivos'])!!}
              <p class="select_todos_table_bonos"><label><input type="checkbox" id="checkAll"/> Seleccionar Todos</label></p>
              <tbody>
                @foreach ($publicidades as $publicidad)
                <tr>
                  <td>
                    <input type="checkbox" name="checkbox[]" value="{{$publicidad->id}}" />
                  </td>
                  <td>{{$publicidad->fecha}}</td>
                  <td>{{$publicidad->titulo}}</td>
                  <td>{{$publicidad->categoria}}</td>
                  <td>{{$publicidad->tienda}}</td>
                  <td><img class="profile-photo" src="{{ asset('uploads/publicidad/'.$publicidad->logo) }}"/></td>
                  <td >{{$publicidad->local}}</td>
                  <td> 
                    {!!link_to_route('superadmin.publicidad.bonos.show', $title = 'Ver', $parameters = $publicidad->id, $attributes = ['class'=>'btn btn-success btn-xs mb-1'])!!}
                    {!!link_to_route('superadmin.publicidad.bonos.edit', $title = 'Editar', $parameters = $publicidad->id, $attributes = ['class'=>'btn btn-secondary btn-xs mb-1'])!!} 
                    {!!link_to_action('PublicidadController@delete', $title = 'Borrar', $parameters =$publicidad->id, $attributes = ['class'=>'btn btn-danger btn-xs mb-1'])!!}
                  </td>
                </tr>
                @endforeach
              </tbody>
              {!!Form::submit('Eliminar Seleccionados', ['class'=>'btn btn-danger'])!!}
              {!!Form::close()!!}
            </table>
            {!!$publicidades->render()!!}
          </div>
          <h6 style="font-weight:bold"> Total Bonos Creados: {!!$publicidades->total()!!}</h6>
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
<script type="text/javascript">
  $("#checkAll").change(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));
  });
</script>
@stop