@extends('layout.admin')

<!-- Create General Section Sidebar -->
@section('sidebar')
<!-- Include the menu -->
@include('backend.menu.superadmin')
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
      <h1 class="breadcrumb">Super Administrador de Bonos de Descuento</h1>
    </div>

    <div class="col-lg-6 col-md-6">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="panel-body text-center">
            <a href="/superadmin/zonas">
              <i class="iconsmind-Hotel" style="font-size: 90px;margin-right: 15px;"></i>
            </a>
            <a href="/superadmin/apartamentos">
              <i class="iconsmind-Home-5" style="font-size: 90px; margin-right: 15px;"></i>
            </a>
            <a href="/superadmin/usuarios">
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
          <p style="color:#000; font-weight:bold; font-size:1em;">En esta sección podra agregar y administrar las zonas pertenecientes a los conjuntos, crearlos y actualizarlos en un instante.</p>
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="row">
            <div class="col-md-6 ">
              <h2>Listado de Detalles Conjunto</h2>
              <div class="form-group">
                {!!Form::open(['action'=>'ZonaController@buscarzona','method'=>'POST' , 'class'=>'navbar-form', 'role'=>'search'])!!}
                <div class="form-group estilos_buscador_zonas">
                  {!!Form::select ('conjunto', $conjuntos, null, ['class'=>'form-control input_buscador_zonas', 'placeholder'=>'Selecciona un Conjunto','id'=>'conjunto'])!!}
                  <button type="submit" class="btn btn-primary"><i class="iconsmind-Magnifi-Glass2"></i></button>
                  {!!Form::close()!!}
                </div>
              </div>
            </div>

            <div class="col-md-6 text-right">
              <br>
              {!!link_to_route('superadmin.zonas.create', $title = '+ Nueva Zona', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
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
                <th style="width: auto;">Nombre Conjunto</th>
                <th style="width: auto;">Cant. Usuarios Zona</th>
                <th style="width: auto;">Tipo de Zona</th>
                <th style="width: auto;">Número de Unidad</th>
                <th style="width: auto;">Descripcion</th>
                <th>Acciones</th>
              </thead>
              <tbody>
                @foreach ($zonas as $zona)
                <tr>
                  <td class="v-align-middle">{{$zona->nombre}}</td>
                  <td class="v-align-middle">{{$data = $count->contarUsuariosZona($zona->id)}}</td>
                  <td class="v-align-middle">{{$zona->tipo}}</td>
                  <td class="v-align-middle">{{$zona->zona}}</td>
                  <td class="v-align-middle">{{$zona->descripcion}}</td>
                  <td>
                    <div class="dropdown">
                      <button class="btn btn-success dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Acciones
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                        <li>
                          {!!link_to_route('superadmin.zonas.edit', $title = 'Editar', $parameters = $zona->id , $attributes = ['role'=>'menu-item'])!!}
                        </li>
                        <li>
                          {!!link_to_action('ZonaController@deletesuper', $title = 'Eliminar', $parameters = $zona->id, $attributes = ['role'=>'menu-item'])!!}
                        </li>
                      </ul>
                    </div>
                  </td>
                </tr>

                @endforeach
              </tbody>
            </table>
          </div>
          <h6 style="font-weight:bold"> Total de Zonas - Conjunto: {{$data = $count->zonasConjunto($conjunto)}} </h6>
        </div>
      </div>
    </div>
  </div>
</div>


@stop

