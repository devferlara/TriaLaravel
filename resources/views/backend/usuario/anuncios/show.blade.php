@extends('layout.mensajes')

@section ('meta')
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset= UTF-8">
@stop

@section('sidebar')
@include('backend.menu.usuario')
@stop


@section('head')
@include('layout.head')
@stop

@section('css')

@stop

@section('content')

<div class="container-fluid">
  <div class="row">

    <div class="col-lg-12 col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          {!!link_to_route('usuario.noticias.index', $title = 'Volver a Anuncios', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
        </div>
      </div>
    </div>

    <div class="col-lg-12 col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <h5><i class="fa fa-calendar" style="font-size:20px;"></i> {{$anuncio->fecha}}</h5>
          <h3 style="font-weight:semi-bold">{{$anuncio->nombre}}</h3>
          <h6 class="right">{{$anuncio->autor}} {{$anuncio->categoria}}</h6>
          <img class="img-responsive" alt="Banner Anuncio" src="{{ asset('uploads/anuncios/'.$anuncio->img_banner) }}"/>
          <textarea id="descripcion" name="hide" style="display:none;" class="input">{{$anuncio->descripcion}}</textarea>
          <div id="arreglo" class="row"></div>
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



