@extends('layout.admin')

@section ('meta')
<meta name="viewport" content="width=device-width, initial-scale=1">
@stop

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
      <h1 class="breadcrumb">Administrador de Usuarios</h1>
    </div>

    <div class="col-lg-6 col-md-6">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="panel-body text-center">
            <a href="/administrador/usuarios">
              <i class="iconsmind-Hotel" style="font-size: 90px; margin-right: 15px;"></i>
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
          <p style="color:#000; font-weight:bold; font-size:1em;">En esta sección podra agregar usuarios, editar y actualizar cualquier información.</p>
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="row">
            <div class="col-md-4 ">
              <h3>Listado de Usuarios Plataforma</h3>
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
              {!!link_to_route('administrador.usuarios.create', $title = '+ Nuevo Usuario', $parameters = null, $attributes = ['class'=>'btn btn-primary','data-target'=>'#crearusuario'])!!}
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
                  <th style="width: auto;">Identificación</th>
                  <th style="width: auto;">Nombres</th>
                  <th style="width: auto;">Apellidos</th>
                  <th style="width: auto;">Email</th>
                  <th style="width: auto;">Telefono</th>
                  <th style="width: auto;">Celular</th>
                  <th style="width: auto;">Unidad</th>
                  <th style="width: auto;">Apartamento</th>
                  <th style="width: auto;">Tipo de Residente</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($usuarios as $usuario)
                <tr>
                  <td class="v-align-middle">{{$usuario->identificacion}}</td>
                  <td class="v-align-middle">{{$usuario->nombres}}</td>
                  <td class="v-align-middle">{{$usuario->apellidos}}</td>
                  <td class="v-align-middle">{{$usuario->email}}</td>
                  <td class="v-align-middle">{{$usuario->telefono}}</td>
                  <td class="v-align-middle">{{$usuario->celular}}</td>
                  <td class="v-align-middle">{{$usuario->tipo}} {{$usuario->zona}}</td>
                  <td class="v-align-middle">{{$usuario->apartamento}}</td>
                  @if ($usuario->propietario== 1)
                  <td class="v-align-middle">Propietario</td>
                  @else
                  <td class="v-align-middle">Arrendatario</td>
                  @endif
                  <td>
                    {!!link_to_route('administrador.usuarios.edit', $title = 'Editar', $parameters = $usuario->id, $attributes = ['class'=>'btn btn-info'])!!} 
                    {!!link_to_action('UsuarioController@delete', $title = 'Eliminar', $parameters = $usuario->id, $attributes = ['class'=>'btn btn-danger'])!!}
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          {!! $usuarios->render() !!}
          <h6 style="font-weight:bold"> Total de Usuarios Registrados: {!! $usuarios->total() !!} </h6>
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
