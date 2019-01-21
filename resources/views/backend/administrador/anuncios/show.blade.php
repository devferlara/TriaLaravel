@extends('layout.mensajes')

@section ('meta')
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset= UTF-8">
@stop

@section('sidebar')
@include('backend.menu.administrador')
@stop


@section('head')
@include('layout.head')
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
          <div class="panel-heading">
            <div class="col-md-2 pull-right">
              {!!link_to_route('administrador.anuncios.index', $title = 'Volver a Anuncios', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-12 col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="row">
            <div class="col-md-6">
              <h5><i class="fa fa-calendar" style="font-size:20px;"></i> {{$anuncio->fecha}}</h5>
              <h6 class="right">{{$anuncio->autor}}</h6>
              <h6>{{$anuncio->categoria}}</h6>
            </div>

            <div class="col-md-6" >
              <h3 style="font-weight:bold; text-align:center; margin-top:20px; color:#000;">
                {{$anuncio->nombre}}
              </h3>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="col-lg-12 col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <img class="img-responsive" style="margin:0 auto;" alt="Banner Bono" src="{{ asset('uploads/anuncios/'.$anuncio->img_banner) }}"/>
          <textarea id="descripcion" name="hide" style="display:none;" class="input">{{$anuncio->descripcion}}</textarea>
          <div id="arreglo" class="row"></div>
        </div>
      </div>
    </div>

  </div>
</div>


@stop
{!!Html::script('build/assets/js/script/anuncios.js')!!}
@section('footer')
@include ('layout.footer')
@stop

