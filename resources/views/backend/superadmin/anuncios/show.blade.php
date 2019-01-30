@extends('layout.mensajes')

@section ('meta')
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset= UTF-8">
@stop

@section('sidebar')
@include('backend.menu.superadmin')
@stop


@section('head')
@include('layout.head')
@stop

@section('css')

@stop

@section('content')
<div class="container-fluid">
  <div class="row">
    @include ('errors.errors')
    @include ('errors.request')
    @include ('errors.success')

    <div class="col-lg-12 col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          {!!link_to_route('superadmin.anuncios.index', $title = 'Volver a Anuncios', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
        </div>
      </div>
    </div>


    <div class="col-lg-12 col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <h3 style="font-weight:bold; text-align:center;">{{$anuncio->nombre}}</h3>
          <h5 ><i class="fa fa-calendar" style="font-size:20px;"></i> {{$anuncio->fecha}}</h5>
          <h5>Categoria: {{$anuncio->categoria}}</h5>
          <br>
          <img class="img-responsive"style="margin:0 auto;display: block" alt="Banner Anuncio" src="{{ asset('uploads/anuncios/'.$anuncio->img_banner) }}"/>
          <textarea id="descripcion" name="hide" style="display:none;" class="input">{{$anuncio->descripcion}}</textarea>
        </div>
      </div>
    </div>


  </div>
</div>



@stop

@section('footer')
@include ('layout.footer')
{!!Html::script('build/assets/js/script/anuncios.js')!!}
@stop
