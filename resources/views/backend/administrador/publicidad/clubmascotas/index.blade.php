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

    <div class="col-12">
      <h1>Vista Administrador - Bonos de Club Mascotas</h1>
    </div>

    <div class="col-lg-6 col-md-6">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="panel-body text-center">
            <a href="/administrador/publicidad/clubmascotas">
              <i class="iconsmind-Sea-Dog" style="font-size: 90px; margin-right: 15px;"></i>
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
          <h3>Administrador</h3>
          <p style="color:#000; font-weight:bold; font-size:1em;">En esta sección podra estar informado sobre los descuentos o bonos para las mascotas y las necesidades de los residentes de su conjunto.</p>
        </div>
      </div>
    </div>


    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="row">
            <div class="col-md-6 ">
              <h3>Listado de Bonos de Club Mascotas</h3>
            </div>

            <div class="col-md-6">
              <form>
                <div class="form-group has-float-label mb-4" style="margin:0 !important">
                  <label class= "text-primary" style="font-weight:bold">Busqueda:</label> 
                  <input id="buscar" type="text" onkeyup="busqueda()" class="form-control" style="width:100%;" placeholder="Escriba aquí el valor a buscar" />
                </div>
              </form>
            </div>
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
                  <th style="width: auto;">Valor Bono</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($publicaciones as $publimascota)
                <tr>
                  <td class="v-align-middle">{{$publimascota->fecha}}</td>
                  <td class="v-align-middle">{{$publimascota->titulo}}</td>
                  <td class="v-align-middle">{{$publimascota->categoria}}</td>
                  <td class="v-align-middle">{{$publimascota->emisor}}</td>
                  <td class="v-align-middle">{{$publimascota->valor}}</td>
                  <td>
                    {!!link_to_route('administrador.publicidad.clubmascotas.show', $title = 'Ver', $parameters = $publimascota->id, $attributes = ['class'=>'btn btn-success btn-xs mb-1'])!!}
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {!!$publicaciones->render()!!}
          </div>
          <h6 style="font-weight:bold"> Total Bonos Club Mascotas Vigentes: {!!$publicaciones->total()!!}</h6>
        </div>
      </div>
    </div>

  </div>
</div>


@stop

@section ('footer')
@include('layout.footer')
{!!Html::script('build/assets/js/script/busqueda.js')!!}
@stop
