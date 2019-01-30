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
      <h1>Administrador de Noticias y Anuncios</h1>
    </div>


    <div class="col-lg-6 col-md-6">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="panel-body text-center">
            <a href="/administrador/anuncios">
              <i class="iconsmind-Add" style="font-size: 90px; margin-right: 15px;"></i>
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
              {!!link_to_route('administrador.anuncios.create', $title = '+ Nueva Noticia', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
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
                  <th style="width: auto;">Fecha</th>
                  <th style="width: auto;">Titulo</th>
                  <th style="width: auto;">Dirigida a:</th>
                  <th style="width: auto;">Categoria</th>
                  <th style="width: auto;">Autor</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($anuncios as $anuncio)
                <tr>
                  <td class="v-align-middle">{{$anuncio->fecha}}</td>
                  <td class="v-align-middle">{{$anuncio->nombre}}</td>
                  <td class="v-align-middle">{{$anuncio->conjuntos->nombre}}</td>
                  <td class="v-align-middle">{{$anuncio->categoria}}</td>
                  <td class="v-align-middle">{{$anuncio->autor}}</td>
                  <td>
                    {!!link_to_route('administrador.anuncios.show', $title = 'Ver', $parameters = $anuncio->id, $attributes = ['class'=>'btn btn-success small'])!!}
                    {!!link_to_route('administrador.anuncios.edit', $title = 'Editar', $parameters = $anuncio->id, $attributes = ['class'=>'btn btn-info small'])!!} 
                    {!!link_to_action('AnunciosController@delete', $title = 'Borrar', $parameters =$anuncio->id, $attributes = ['class'=>'btn btn-danger small'])!!}
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>

          </div>
          <h6 style="font-weight:bold"> Noticias enviadas: {!!$anuncios->total()!!}</h6>
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

