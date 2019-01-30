@extends('layout.admin')

@section ('meta')
<meta name="viewport" content="width=device-width, initial-scale=1">
@stop

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
    @include ('errors.success')
    @include ('errors.request')
    @include ('errors.errors')
    <div class="col-md-12">
      <h1 class="breadcrumb">Super Administrador de Bonos de Descuento</h1>
    </div>


    <div class="col-lg-6 col-md-6">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="panel-body text-center">
            <a href="/superadmin/usuarios">
              <i class="simple-icon-people" style="font-size:120px;"></i>
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
              <h3>Listado de Usuarios Tria Group</h3>
            </div>

            <div class="col-md-4">
              <div class="form-group" >
                {!!Form::open(['action'=>'UsuarioController@buscar','method'=>'GET' , 'class'=>'navbar-form', 'role'=>'search'])!!}

                <div class="form-group estilos_buscador_zonas" style="margin:0">
                  {!!Form::text ('nombres', null, ['class'=>'form-control input_buscador_zonas', 'placeholder'=>'Buscar Usuarios'])!!}
                  <button type="submit" class="btn btn-primary"><i class="iconsmind-Magnifi-Glass2"></i></button>
                </div>
                {!!Form::close()!!}
              </div>
            </div>
            <div class="col-md-4 text-right">
              {!!link_to_route('superadmin.usuarios.create', $title = '+ Nuevo Usuario', $parameters = null, $attributes = ['class'=>'btn btn-primary','data-target'=>'#crearusuario'])!!}
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
                  <th style="width: auto;">Identificación</th>
                  <th style="width: auto;">Nombres</th>
                  <th style="width: auto;">Apellidos</th>
                  <th style="width: auto;">Username</th> 
                  <th style="width: auto;">Rol</th>
                  <th style="width: auto;">Email</th>
                  <th style="width: auto;">Telefono</th>
                  <th style="width: auto;">Celular</th>
                  <th style="width: auto;">Documentos</th>
                  <th>Acciones</th>
                </tr>
              </thead> 
              <tbody>
                @foreach ($usuarios as $usuario)
                <tr>
                  <td class="v-align-middle">{{$usuario->identificacion}}</td>
                  <td class="v-align-middle">{{$usuario->nombres}}</td>
                  <td class="v-align-middle">{{$usuario->apellidos}}</td>
                  <td class="v-align-middle">{{$usuario->username}}</td>
                  <td class="v-align-middle">{{$usuario->rol}}</td>
                  <td class="v-align-middle">{{$usuario->email}}</td>
                  <td class="v-align-middle">{{$usuario->telefono}}</td>
                  <td class="v-align-middle">{{$usuario->celular}}</td>
                  <td class="v-align-middle"><a href="#" target="_blank">{{$usuario->documento}}</a>
                    {{--*/ if($usuario->documento!=""){ echo "<br> <a href='?docId=".$usuario->documentoId."' >borrar documento</a>";}/*--}}   
                  </td>
                  <td>
                    @if($usuario->active == 0)
                    {!!link_to_action('UsuarioController@activatesuper', $title = 'activar', $parameters = $usuario->id, $attributes = ['class'=>'btn btn-success'])!!}
                    @else
                    {!!link_to_action('UsuarioController@desactivatesuper', $title = 'desactivar', $parameters = $usuario->id, $attributes = ['class'=>'btn btn-warning'])!!} 
                    @endif
                    {!!link_to_route('superadmin.usuarios.edit', $title = 'Editar', $parameters = $usuario->id, $attributes = ['class'=>'btn btn-info'])!!} 
                    {!!link_to_action('UsuarioController@deletesuper', $title = 'Eliminar', $parameters = $usuario->id, $attributes = ['class'=>'btn btn-danger'])!!}
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            
          </div>
          <h6 style="font-weight:bold"> Total de Usuarios Registrados en sistema: {{$usuarios->total()}}</h6>
          <h6 style="font-weight:bold"> Total de Usuarios sin datos actualizados: {{$data= $noregistrados}}</h6>
          <h6 style="font-weight:bold"> Total de Usuarios con datos actualizados: {{$usuarios->total()-$noregistrados}}</h6>
        </div>
      </div>
    </div>
  </div>
</div>


@stop

@section ('footer')
@include ('layout.footer')
{!!Html::script('build/assets/js/init.js')!!}
@stop
