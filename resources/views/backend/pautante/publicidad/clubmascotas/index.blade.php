@extends('layout.mensajes')

@section ('meta')
<meta name="viewport" content="width=device-width, initial-scale=1">
@stop

@section('sidebar')
@include('backend.menu.pautante')
@stop

@section('head')
@include('layout.head')
@stop


@section('content')
<div class="container-fluid">
  <div class="row">
    @include ('errors.errors')
    @include ('errors.success')
    @include ('errors.request')
    <div class="col-md-12">
      <h1 class="breadcrumb">Pautante de Bonos Club Mascotas</h1>
    </div>

    <div class="col-lg-6 col-md-6">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="panel-body text-center">
            <a href="/superadmin/publicidad/clubmascotas">
              <i class="iconsmind-Sea-Dog" style="font-size:120px;"></i>
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
          <h3>Pautante</h3>
          <p style="color:#000; font-weight:bold; font-size:1em;">En esta sección podra administrar el listado de publicidades para los conjuntos.</p>
        </div>
      </div>
    </div>
 

    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="row">
            <div class="col-md-4 ">
              <h3>Listado de Bonos Club Mascotas</h3>
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
              {!!link_to_route('pautante.publicidad.clubmascotas.create', $title = '+ Crear Bono Club Mascotas', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-12"> 
      <div class="card mb-4">
        <div class="card-body">
          <div class="table-responsive">
            <table class="data-table responsive nowrap tabla_bonos_estilos" id="datos">
              <thead>
                <tr>
                  <th style="width: auto;">Fecha</th>
                  <th style="width: auto;">Titulo</th>
                  <th style="width: auto;">Categoria</th>
                  <th style="width: auto;">Emisor Bono</th>
                  <th style="width: auto;">Valor</th>
                  <!-- <th style="width: auto;">Dirigido A:</th> -->
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($publicaciones as $bonomascota)
                <tr> 
                  <td class="v-align-middle">{{$bonomascota->fecha}}</td>
                  <td class="v-align-middle">{{$bonomascota->titulo}}</td>
                  <td class="v-align-middle">{{$bonomascota->categoria}}</td>
                  <td class="v-align-middle">{{$bonomascota->emisor}}</td>
                  <td class="v-align-middle">{{$bonomascota->valor}}</td>
                  <td>
                    {!!link_to_route('pautante.publicidad.clubmascotas.show', $title = 'Ver', $parameters = $bonomascota->id, $attributes = ['class'=>'btn btn-success btn-xs mb-1'])!!}
                    {!!link_to_route('pautante.publicidad.clubmascotas.edit', $title = 'Editar', $parameters = $bonomascota->id, $attributes = ['class'=>'btn btn-warning btn-xs mb-1'])!!} 
                    <!-- {!!link_to_action('PublimascotasController@delete', $title = 'Borrar', $parameters =$bonomascota->id, $attributes = ['class'=>'btn btn-danger small'])!!} -->
                    @if($bonomascota->enabled == 1)
                    <button class="btn btn-primary btn-xs mb-1" type="button" onclick="detener({{$bonomascota->id}})">Detener</button>
                    @else
                    <button class="btn btn-secondary btn-xs mb-1" type="button" onclick="reanudar({{$bonomascota->id}})">Reanundar</button>
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <h6 style="font-weight:bold"> Total Bonos Creados: {!!$publicaciones->total()!!}</h6>
        </div>
      </div>
    </div>

  </div>
</div>


<div class="modal" tabindex="-1" role="dialog" id="detener_modal">
  <div class="modal-dialog" role="document">
    <form action="{{ action('PublimascotasController@changeStatus') }}" method="POST">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Detener anuncio</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>¿Está seguro que desea detener este anuncio?</p>
        </div>
        <input type="hidden" id="id_detener" name="id">
        <input type="hidden" name="status" value="0">
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit"  class="btn btn-primary">Detener anuncio</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="reanudar_modal">
  <div class="modal-dialog" role="document">
    <form action="{{ action('PublimascotasController@changeStatus') }}" method="POST">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Reanudar anuncio</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>¿Está seguro que desea reanundar este anuncio?</p>
        </div>
        <input type="hidden" id="id_reanudar" name="id">
        <input type="hidden" name="status" value="1">
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit"  class="btn btn-primary">Reanudar anuncio</button>
        </div>
      </div>
    </form>
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
  function detener(id)
  {
    $('#id_detener').val(id);
    $('#detener_modal').modal('show');
  }

  function reanudar(id)
  {
    $('#id_reanudar').val(id);
    $('#reanudar_modal').modal('show');
  }
</script>