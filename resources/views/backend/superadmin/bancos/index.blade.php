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
          <p style="color:#000; font-weight:bold; font-size:1em;">En esta sección podra mantener informada a su comunidad, mediante publicaciones y noticias que permitan COMUNICAR a los residentes de su conjunto.</p>
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="row">
            <div class="col-md-4 ">
              <h3>Listado de Entidades Bancarias</h3>
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
              {!!link_to_route('superadmin.bancos.create', $title = '+ Nuevo Banco', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
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
                <tr>
                  <th style="width: auto;">ID Banco</th>
                  <th style="width: auto;">Nombre</th>
                  <th style="width: auto;">Pais</th>
                  <th style="width: auto;">Link de Pago</th>
                  <th style="width: auto;">Estado</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($bancos as $banco)
                <tr>
                  <td class="v-align-middle">{{$banco->id}}</td>
                  <td class="v-align-middle">{{$banco->nombre}}</td>
                  <td class="v-align-middle">{{$banco->pais}}</td>
                  <td class="v-align-middle">{{$banco->link}}</td>
                  @if ($banco->enabled ==1)
                  <td class="v-align-middle">Habilitado</td>
                  @else
                  <td class="v-align-middle">Deshabilitado</td>
                  @endif

                  <td>
                    {!!link_to_route('superadmin.bancos.edit', $title = 'Editar Banco', $parameters = $banco->id , $attributes = ['role'=>'menu-item', 'class'=>'btn btn-secondary btn-xs mb-1'])!!}
                    {!!link_to_action('BancoController@deletesuper', $title = 'Eliminar', $parameters = $banco->id, $attributes = ['role'=>'menu-item', 'class'=>'btn btn-danger btn-xs mb-1'])!!}
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

@section ('footer')
@include ('layout.footer')
{!!Html::script('build/assets/js/init.js')!!}
{!!Html::script('build/assets/js/script/busqueda.js')!!}
@stop