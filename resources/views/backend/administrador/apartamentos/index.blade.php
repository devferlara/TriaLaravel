@extends('layout.admin')

@section('sidebar')
@include('backend.menu.administrador')
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
      <h1 class="breadcrumb">Administrador de Apartamentos</h1>
    </div>

    <div class="col-lg-6 col-md-6">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="panel-body text-center">
            <a href="/administrador/apartamentos">
              <i class="iconsmind-Hotel" style="font-size: 90px; margin-right: 15px;"></i>
            </a>
            <a href="/administrador/zonas">
              <i class="iconsmind-Home-5" style="font-size: 90px;margin-right: 15px;"></i>
            </a>
            <a href="/administrador/usuarios">
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
              <h3>Lista Apartamentos Conjunto: {{$conjunto->first()->nombre}}</h3>
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
              {!!link_to_route('administrador.apartamentos.create', $title = '+ Nuevo Apartamento', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
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
                  <th style="width: auto;">Id Apto</th>
                  <th style="width: auto;">Matricula Apto</th>
                  <th style="width: auto;">Tipo Propiedad</th>
                  <th style="width: auto;">Tipo Unidad</th>
                  <th style="width: auto;">Unidad o Zona</th>
                  <th style="width: auto;">Apartamento</th>
                  <th style="width: auto;">Nombre Residente</th>
                  <th style="width: auto;">Tipo Residente</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <?php
              $i = 0;

              ?>
              <tbody>
                @foreach ($zonas as $zona)

                @foreach ($zona->apartamentos as $apartamento)

                @foreach ($apartamento->usuarios as $usuario)

                <tr>

                  <td class="v-align-middle">{{$apartamento->id}}</td>
                  <td class="v-align-middle">{{$apartamento->matricula_inmobiliaria}}</td>
                  <td class="v-align-middle">{{$conjunto->first()->tipo}}</td>
                  <td class="v-align-middle">{{$zona->tipo}}</td>
                  <td class="v-align-middle">{{$zona->zona}}</td>
                  <td class="v-align-middle">{{$apartamento->apartamento}}</td>
                  <td class="v-align-middle">{{$usuario->nombres}} {{$usuario->apellidos}}</td>
                  @if ($usuario->propietario ==1)
                  <td class="v-align-middle">Propietario</td>
                  @else
                  <td class="v-align-middle">Arrendatario</td>
                  @endif
                  <td>

                    {!!link_to_route('administrador.apartamentos.edit', $title = 'Editar Apartamento', $parameters = $apartamento->id , $attributes = ['role'=>'menu-item','class'=>'btn btn-secondary btn-xs mb-1'])!!}


                    {!!link_to_action('ApartamentoController@delete', $title = 'Eliminar', $parameters = $apartamento->id, $attributes = ['role'=>'menu-item','class'=>'btn btn-danger btn-xs mb-1'])!!}

                    <div class="dropdown">
                      <button class="btn btn-success dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Acciones
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                        <li>
                          {!!link_to_route('administrador.apartamentos.edit', $title = 'Editar Apartamento', $parameters = $apartamento->id , $attributes = ['role'=>'menu-item'])!!}
                        </li>
                        <li>
                          {!!link_to_action('ApartamentoController@delete', $title = 'Eliminar', $parameters = $apartamento->id, $attributes = ['role'=>'menu-item'])!!}
                        </li>
                      </ul>
                    </div>
                  </td>
                </tr>
                @endforeach
                @endforeach
                @endforeach
              </tbody>
            </table>

          </div>
          <h6 style="font-weight:bold"> Total de Apartamentos Registrados: {{$data = $count->contarApartamentosConjunto($conjunto->first()->id)}} </h6>
        </div>
      </div>
    </div>

  </div>
</div>

@stop
