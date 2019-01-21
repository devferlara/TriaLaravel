@extends('layout.admin')

<meta name="viewport" content="width=device-width, initial-scale=1">
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
      <h1 class="breadcrumb">Super Administrador de Conjuntos</h1>
    </div>
    <div class="col-lg-6 col-md-6">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="panel-body text-center">
            <a href="/superadmin/publicidad/bonos">
              <i class="iconsmind-Hotel" style="font-size:120px;"></i>
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
          <p style="color:#000; font-weight:bold; font-size:1em;">En esta sección podra agregar y administrar los conjuntos, crearlos y actualizarlos en un instante.</p>
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
              {!!Form::open(['action'=>'ConjuntoController@buscarconjunto','method'=>'GET' , 'class'=>'navbar-form', 'role'=>'search'])!!}
              <div class="form-group has-float-label mb-4" style="margin:0 !important">
                <label class= "text-primary" style="font-weight:bold">Busqueda:</label>
                {!!Form::text ('nomconjunto', null, ['class'=>'form-control', 'placeholder'=>'Buscar Conjuntos'])!!}
                {!!Form::close()!!}
              </div>
            </div>
            <div class="col-md-4 text-right">
              {!!link_to_route('superadmin.conjuntos.create', $title = '+ Nuevo Conjunto', $parameters = null, $attributes = ['class'=>'btn btn-primary','data-target'=>'#crearconjunto'])!!}
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
                  <th style="width: auto;">Cant. Usuarios</th>

                  <th style="width: auto;">Tipo</th>
                  <th style="width: auto;">Nombre</th>

                  <th style="width: auto;">Ciudad</th>
                  <th style="width: auto;">Localidad</th>

                  <th style="width: auto;">Dirección</th>

                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>

                @foreach ($conjuntos as $conjunto)
                <tr>
                  <td class="v-align-middle">{{$data = $count->contarUsuariosConjunto($conjunto->id)}}</td>
                  <td class="v-align-middle">{{$conjunto->tipo}}</td>
                  <td class="v-align-middle">{{$conjunto->nombre}}</td>
                  <td class="v-align-middle">{{$conjunto->ciudad}}</td>
                  <td class="v-align-middle">{{$conjunto->localidad}}</td>
                  <td class="v-align-middle">{{$conjunto->direccion}}</td>
                  <td>
                    {!!link_to_action('ConjuntoController@detalles', $title = 'Detalles', $parameters = $conjunto->id, $attributes = ['role'=>'menu-item','class'=>'btn btn-success btn-xs mb-1'])!!}
                    {!!link_to_route('superadmin.conjuntos.edit', $title = 'Editar', $parameters = $conjunto->id, $attributes = ['role'=>'menu-item','class'=>'btn btn-secondary btn-xs mb-1'])!!}
                    {!!link_to_action('ConjuntoController@delete', $title = 'Eliminar', $parameters = $conjunto->id, $attributes = ['role'=>'menu-item','class'=>'btn btn-danger btn-xs mb-1'])!!}
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {!!$conjuntos->render()!!}
          </div>
          <h6 style="font-weight:bold"> Total de Conjuntos Registrados: {!!$conjuntos->total()!!}</h6>
        </div>
      </div>
    </div>
  </div>
</div>

@stop

@section('footer')
@include ('layout.footer')
@stop

