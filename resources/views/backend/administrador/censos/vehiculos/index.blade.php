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
      <h1>Censo Vehiculos del Conjunto</h1>
    </div>


    <div class="col-lg-6 col-md-6">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="panel-body text-center">
            <a href="/administrador/censos/vehiculos">
              <i class="iconsmind-Car-2" style="font-size: 90px; margin-right: 15px;"></i>
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
          <p style="color:#000; font-weight:bold; font-size:1em;">En esta sección podra conocer la cantidad de vehiculos registrados en el conjunto residencial y su discriminado por zona y apartamento.</p>
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="row">
            <div class="col-md-6 ">
              <h3>Listado de Vehiculos del conjunto</h3>
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
        <div class="card-body ">
          <div class="table-responsive">
            <table class="data-table responsive nowrap tabla_bonos_estilos" id="datos">
              <thead>
                <tr>
                  <th style="width: auto;">Unidad</th>
                  <th style="width: auto;">Apartamento</th>
                  <th style="width: auto;">Propietario</th>
                  <th style="width: auto;">Marca</th>
                  <th style="width: auto;">Modelo</th>
                  <th style="width: auto;">Placa</th>
                  <th style="width: auto;">Color</th>
                  <th style="width: auto;">Parqueadero</th>
                  <th style="width: auto;">Tipo Parq</th>
                  <th style="width: auto;">No. Parq.</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($vehiculosconjunto as $vehiconjunto)
                <tr>
                  <td class="v-align-middle">{{$vehiconjunto->zona}}</td>
                  <td class="v-align-middle">{{$vehiconjunto->apartamento}}</td>
                  <td class="v-align-middle">{{$vehiconjunto->nombres}} {{$vehiconjunto->apellidos}}</td>
                  <td class="v-align-middle">{{$vehiconjunto->marca}}</td>
                  <td class="v-align-middle">{{$vehiconjunto->modelo}}</td>
                  <td class="v-align-middle">{{$vehiconjunto->placa}}</td>
                  <td class="v-align-middle">{{$vehiconjunto->color}}</td>
                  @if ($vehiconjunto->parqueadero ==1)
                  <td class="v-align-middle">SI</td>
                  @else
                  <td class="v-align-middle">NO</td>
                  @endif
                  <td class="v-align-middle">{{$vehiconjunto->tipo_parqueadero}}</td>
                  <td class="v-align-middle">{{$vehiconjunto->numero_parqueadero}}</td>
                </tr> 
                @endforeach
              </tbody>
            </table>

            {!!$vehiculosconjunto->render()!!}

          </div>
          <h6 style="font-weight:bold"> Total Mascotas registradas: {!!$vehiculosconjunto->total()!!} </h6>

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