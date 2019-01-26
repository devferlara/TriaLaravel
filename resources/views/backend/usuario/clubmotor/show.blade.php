@extends('layout.admin')

@section('sidebar')
@include('backend.menu.usuario')
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
    @include ('errors.request')
    @include ('errors.success')

    <div class="col-md-12">
      <h1 class="breadcrumb">Bienvenido a la Administración de Vehiculos del Club Motor</h1>
    </div>

    <div class="col-lg-6 col-md-6">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="panel-body text-center">
            <a href="/usuario/clubmotor">
              <i class="iconsmind-Car-2" style="font-size: 90px;margin-right: 15px;"></i>
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
          <p style="color:#000; font-weight:bold; font-size:1em;">En esta sección podras registrar y editar tus vehiculos. !Es Muy fácil solo debes crearlos y actualizarlos en un instante!</p>
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="row">
            <div class="col-md-6 ">
              <h3>Mis Vehiculos</h3>
            </div>
            <div class="col-md-6 text-right">
              {!!link_to_route('usuario.clubmotor.create', $title = '+ Registrar Otra Vehiculo', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
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
            <table class="data-table responsive nowrap tabla_bonos_estilos">
              <thead>
                <tr>
                  <th style="width: auto;">Tipo de Vehiculo</th>
                  <th style="width: auto;">Marca del Vehiculo</th>
                  <th style="width: auto;">Placa</th>
                  <th style="width: auto;">Color</th>
                  <th style="width: auto;">Modelo</th>
                  <th style="width: auto;">Parqueadero</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($vehiculos as $vehiculo)
                <tr>
                  <td class="v-align-middle">{{$vehiculo->tipo}}</td>
                  <td class="v-align-middle">{{$vehiculo->marca}}</td>
                  <td class="v-align-middle">{{$vehiculo->placa}}</td>
                  <td class="v-align-middle">{{$vehiculo->color}}</td>
                  <td class="v-align-middle">{{$vehiculo->modelo}}</td>
                  @if ($vehiculo->parqueadero ==1)
                  <td class="v-align-middle">SI</td>
                  @else
                  <td class="v-align-middle">NO</td>
                  @endif
                  <td>
                    {!!link_to_route('usuario.clubmotor.edit', $title = 'Editar', $parameters = $vehiculo->id, $attributes = ['role'=>'menu-item', 'class'=>'btn btn-secondary btn-xs mb-1'])!!}
                    {!!link_to_action('ClubvehiculosController@delete', $title = 'Eliminar', $parameters = $vehiculo->id, $attributes = ['role'=>'menu-item','class'=>'btn btn-danger btn-xs mb-1'])!!}
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


@stop

@section('footer')
@include ('layout.footer')
@stop