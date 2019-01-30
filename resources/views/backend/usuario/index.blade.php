@extends('layout.admin')

@section('sidebar')
@include('backend.menu.usuario')
@stop


@section('head')
@include('layout.head')
@stop






@section('content')

<style>
.table thead tr th, .table tbody tr td {
  text-align: center;
}
#map-canvas  {
  float:left;
  width: 50%;
  height: 400px;
}
#pano  {
  float:left;
  width: 50%;
  height: 400px;
}
</style>

<div class="container-fluid">
  <div class="row">

    <div class="col-12 text-center">
      <div class="card mb-4">
        <div class="card-body ">
          <img width="100%"  src="{{ asset('uploads/banners/conjunto/'.$conjunto->banner_conjunto) }}" >
        </div>
      </div>
    </div>

    <div class="col-6 ">
      <div class="card mb-4">
        <div class="card-body ">
          <img class="profile-photo" src="{{ asset('uploads/banners/conjunto/'.$conjunto->img_perfil) }}" />
          <h5 class="no-margin">Conjunto Residencial</h5>
          <h1 class="no-margin"><span class="semi-bold">{{ $conjunto->nombre}}</span></h1>
          <input type="hidden" id="map_latitud" value="{{ $conjunto->map_latitud }}">
          <input type="hidden" id="map_longitud" value="{{ $conjunto->map_longitud }}">
        </div>
      </div>
    </div>


    <div class="col-6">
      <div class="card mb-4">
        <div class="card-body ">

          <img alt="Avatar" width="55" style="float: left; margin-right: 20px" height="55" data-src-retina="{{ asset('build/assets/img/profiles/user.png') }}" data-src="{{ asset('build/assets/img/profiles/user.png') }}" src="{{ asset('build/assets/img/profiles/user.png') }}">
          <div style="display: inline-block">
            <p class="hint-text m-t-5">Datos de Usuario</p>
            <h3 class="no-margin">{{$usuario->nombres}} {{$usuario->apellidos}}</h3>
            <p class="no-margin fs-16">Residente {{$zona->zonas()->first()->tipo}} {{$zona->zonas()->first()->zona}} {{$usuario->apartamentos()->first()->apartamento}}</p>
            <p class="hint-text m-t-5 small">{{$usuario->email}} | Teléfono: {{$usuario->telefono}} {{$usuario->celular}}</p>
            {!!link_to_action('UsuarioController@edit', $title = 'Editar Perfil', $parameters = $usuario->id , $attributes = ['class'=>'btn btn-success'])!!}
          </div>
        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="card mb-4">
        <div class="card-body ">

          <div id="map-canvas"></div>
          <div id="pano"></div>
        </div>
      </div>
    </div>

  </div>
</div>



@stop

@section('footer')
@include ('layout.footer')
{!!Html::script('https://maps.googleapis.com/maps/api/js?key=AIzaSyD6tig7C2Lj9bG3BKOko3v06CC6X-QUnaA')!!}
{!!Html::script('build/assets/js/script/admin.js')!!}
{!!Html::script('build/assets/js/script/busqueda.js')!!}
@stop

