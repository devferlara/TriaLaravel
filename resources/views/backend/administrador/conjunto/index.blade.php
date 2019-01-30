@extends('layout.admin')

@section('sidebar')
@include('backend.menu.administrador')
@stop


@section('head')
@include('layout.head')
@stop

@section('css')


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

    @include ('errors.success')
    @include ('errors.request')
    @include ('errors.errors')

    <div class="col-lg-12 col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <img width="100%" alt="Cover photo" src="{{ asset('uploads/banners/conjunto/'.$conjunto->first()->banner_conjunto) }}" />
        </div>
      </div>
    </div>

    <div class="col-lg-12 col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <div style="float: left; margin-right: 20px">
            <img width="100" height="100" class="profile-photo" src="{{ asset('uploads/banners/conjunto/'.$conjunto->first()->img_perfil) }}" />
          </div>

          <div style="float: left">
            <h5 style="margin:0">Conjunto Residencial</h5>
            <h1 style="margin:0"><span class="semi-bold">{{ $conjunto->first()->nombre}}</span></h1>
            <br>
            {!!link_to_route('administrador.conjuntos.edit', $title = 'Editar Perfl Conjunto', $parameters = $conjunto->first()->id, $attributes = ['class'=>'btn btn-primary'])!!}
            <input type="hidden" id="map_latitud" value="{{ $conjunto->first()->map_latitud }}">
            <input type="hidden" id="map_longitud" value="{{ $conjunto->first()->map_longitud }}">
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-12 col-md-12">
      <div class="card mb-4">
        <div class="card-body">
          <h1 class="hint-text m-t-5">Datos Conjunto:</h1>
          <p class="no-margin fs-16" style="margin:0">{{$conjunto->first()->ciudad}} / {{$conjunto->first()->localidad}}</p>
          <p class="no-margin fs-16">{{$conjunto->first()->barrio}} / {{$conjunto->first()->direccion}}</p>
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
{!!Html::script('build/assets/js/script/admin.js')!!}
{!!Html::script('build/assets/js/script/busqueda.js')!!}
{!!Html::script('https://maps.googleapis.com/maps/api/js?key=AIzaSyD6tig7C2Lj9bG3BKOko3v06CC6X-QUnaA')!!}
@stop



