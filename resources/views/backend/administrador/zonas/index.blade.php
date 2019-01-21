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
      <h1 class="breadcrumb">Administrador de Zonas Conjunto</h1>
    </div>

    <div class="col-lg-6 col-md-6">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="panel-body text-center">
            <a href="/zonas">
              <i class="iconsmind-Hotel" style="font-size: 90px; margin-right: 15px;"></i>
            </a>
            <a href="/apartamentos">
              <i class="iconsmind-Home-5" style="font-size: 90px;margin-right: 15px;"></i>
            </a>
            <a href="/usuarios">
              <i class="iconsmind-User" style="font-size: 90px;margin-right: 15px;"></i>
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
              <h3>Listado Detallada de Zonas - Conjunto</h3>
            </div>

            <div class="col-md-4">
              <form>
                <div class="form-group has-float-label mb-4" style="margin:0 !important">
                  <label class= "text-primary" style="font-weight:bold">Busqueda:</label> 
                  <input id="buscar" type="text" onkeyup="busqueda()" class="form-control" style="width:100%;" placeholder="Escriba aquí el valor a buscar" />
                </div>
              </form>
            </div>
            <div class="col-md-4 text-right">
              {!!link_to_route('administrador.zonas.create', $title = '+ Nueva Zona', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
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
                  <th style="width: auto;">Nombre Conjunto</th>
                  <th style="width: auto;">Tipo de Propiedad</th>
                  <th style="width: auto;">Cant. Usuarios Zona</th>
                  <th style="width: auto;">Tipo de Zona</th>
                  <th style="width: auto;">Número de Unidad</th>
                  <th style="width: auto;">Descripcion</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($zonas as $zona)
                <tr>
                  <td class="v-align-middle">{{$zona->conjuntos->nombre}}</td>
                  <td class="v-align-middle">{{$zona->conjuntos->tipo}}</td>
                  <td class="v-align-middle">{{$data = $count->contarUsuariosZona($zona->id)}}</td>
                  <td class="v-align-middle">{{$zona->tipo}}</td>
                  <td class="v-align-middle">{{$zona->zona}}</td>
                  <td class="v-align-middle">{{$zona->descripcion}}</td>
                  <td>

                    {!!link_to_route('administrador.zonas.edit', $title = 'Editar', $parameters = $zona->id , $attributes = ['role'=>'menu-item','class'=>'btn btn-secondary btn-xs mb-1'])!!}

                    {!!link_to_action('ZonaController@delete', $title = 'Eliminar', $parameters = $zona->id, $attributes = ['role'=>'menu-item','class'=>'btn btn-danger btn-xs mb-1'])!!}
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {!!$zonas->render()!!}
          </div>
          <h6 style="font-weight:bold"> Total de Conjuntos Registrados: {!!$zonas->total()!!}</h6>
        </div>
      </div>
    </div>
  </div>
</div>


@stop
