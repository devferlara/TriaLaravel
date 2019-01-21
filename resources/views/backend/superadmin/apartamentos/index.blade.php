@extends('layout.admin')

@section('sidebar')

@include('backend.menu.superadmin')
@stop
@section('head')

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
      <h1 class="breadcrumb">Super Administrador de Apartamentos</h1>
    </div>

    <div class="col-lg-6 col-md-6">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="panel-body text-center">
            <a href="/superadmin/apartamentos">
              <i class="iconsmind-Hotel" style="font-size: 90px;margin-right: 15px;"></i>
            </a>
            <a href="/superadmin/zonas">
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
          <p style="color:#000; font-weight:bold; font-size:1em;">En esta sección podra agregar y administrar los apartamentos  pertenecientes a cada zona o unidad, crearlos y actualizarlos en un instante.</p>
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
                {!!Form::open(['action'=>'ApartamentoController@buscar','method'=>'POST' , 'class'=>'navbar-form', 'role'=>'search'])!!}
                <div class="form-group estilos_buscador_zonas">
                  {!!Form::select ('conjunto', $conjuntos, null, ['class'=>'form-control input_buscador_zonas', 'placeholder'=>'Selecciona un Conjunto', 'id'=>'conjunto'])!!}
                  <button type="submit" class="btn btn-primary"><i class="iconsmind-Magnifi-Glass2"></i></button>
                  {!!Form::close()!!}
                </div>
                
              </div>
            </div>

            <div class="col-md-6 text-right">
              <br>
              {!!link_to_route('superadmin.apartamentos.create', $title = '+ Nuevo Apartamento', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
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
                  <th style="width: auto;">Tipo Unidad</th>
                  <th style="width: auto;">Unidad o Zona</th>
                  <th style="width: auto;">Apartamento</th>
                  <th style="width: auto;">Nombre Residente</th>
                  <th style="width: auto;">Tipo Residente</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($apartamentos as $apartamento)
                <tr>
                  <td class="v-align-middle">{{$apartamento->nombre}}</td>
                  <td class="v-align-middle">{{$apartamento->tipo}}</td>
                  <td class="v-align-middle">{{$apartamento->zona}}</td>
                  <td class="v-align-middle">{{$apartamento->apartamento}}</td>
                  <td class="v-align-middle">{{$apartamento->nombres}} {{$apartamento->apellidos}}</td>
                  @if ($apartamento->propietario ==1)
                  <td class="v-align-middle">Propietario</td>
                  @else
                  <td class="v-align-middle">Arrendatario</td>
                  @endif
                  <td>
                    {!!link_to_route('superadmin.apartamentos.edit', $title = 'Editar Apartamento', $parameters = $apartamento->id , $attributes = ['role'=>'menu-item', 'class'=>'btn btn-secondary btn-xs mb-1'])!!}

                    {!!link_to_action('ApartamentoController@deletesuper', $title = 'Eliminar', $parameters = $apartamento->id, $attributes = ['role'=>'menu-item', 'class' => 'btn btn-danger btn-xs mb-1'])!!}
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>

          </div>
          <h6 style="font-weight:bold"> Total de Apartamentos Sin Registrar Datos: {{$data=$count->contarNoregistradosxConjunto($conjunto)}} </h6>
          <h6 style="font-weight:bold"> Total de Apartamentos Creados en Sistema {{$data2=$count->contarApartamentosConjunto($conjunto)}} </h6>
          <h6 style="font-weight:bold"> Total de Apartamentos Activos en  {{$totalactivos=$data2-$data}} </h6>
        </div>
      </div>
    </div>

  </div>
</div>



@stop
