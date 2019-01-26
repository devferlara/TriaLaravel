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
      <h1 class="breadcrumb">Bienvenido a la Administración de Mascotas del Club Mascotas HGV</h1>
    </div>

    <div class="col-lg-6 col-md-6">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="panel-body text-center">
            <a href="/usuario/clubmascotas">
              <i class="iconsmind-Dog" style="font-size: 90px;margin-right: 15px;"></i>
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
          <p style="color:#000; font-weight:bold; font-size:1em;">En esta sección podras registrar y editar tus mascotas. !Es Muy fácil solo debes crearlos y actualizarlos en un instante!</p>
        </div>
      </div>
    </div>


    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="row">
            <div class="col-md-6 ">
              <h3>Mis Mascotas</h3>
            </div>
            <div class="col-md-6 text-right">
              {!!link_to_route('usuario.clubmascotas.create', $title = '+ Registrar Otra Mascota', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
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
                  <th style="width: auto;">Nombre de tu Mascota</th>
                  <th style="width: auto;">Tipo de Mascota</th>
                  <th style="width: auto;">Raza</th>
                  <th style="width: auto;">Genero</th>
                  <th style="width: auto;">Foto de tu Mascota</th>
                  <th style="width: auto;">Vacunado</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($mascotas as $mascota)
                <tr>
                  <td class="v-align-middle">{{$mascota->nombre}}</td>
                  <td class="v-align-middle">{{$mascota->tipo}}</td>
                  <td class="v-align-middle">{{$mascota->raza}}</td>
                  <td class="v-align-middle">{{$mascota->genero}}</td>
                  <td class="v-align-middle"><img class="profile-photo" alt="Imagen Mascota" src="{{ asset('uploads/mascotas/'.$mascota->img_mascota) }}"/></td>
                  @if ($mascota->vacunas ==1)
                  <td class="v-align-middle">SI</td>
                  @else
                  <td class="v-align-middle">NO</td>
                  @endif
                  <td>
                    {!!link_to_route('usuario.clubmascotas.edit', $title = 'Editar', $parameters = $mascota->id , $attributes = ['role'=>'menu-item','class'=>'btn btn-secondary btn-xs mb-1'])!!}
                    {!!link_to_action('ClubmascotasController@delete', $title = 'Eliminar', $parameters = $mascota->id, $attributes = ['role'=>'menu-item', 'class'=>'btn btn-danger btn-xs mb-1'])!!}
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