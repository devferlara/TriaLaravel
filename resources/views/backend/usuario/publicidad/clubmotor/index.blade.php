@extends('layout.mensajes')

@section('sidebar')
@include('backend.menu.usuario')
@stop

@section('head')
@include('layout.head')
@stop


@section('content')

<div class="container-fluid">
  <div class="row">

    <div class="col-md-12">
      <h1 class="breadcrumb">Bienvenido: <strong>Bonos-Club Motor</strong></h1>
    </div>

    <div class="col-lg-12 col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <img alt="" width="100%" src="{{ asset('uploads/banners/bannerclubmotor.png') }}"/>
        </div>
      </div>
    </div>

    <div class="col-lg-12 col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="row">
            @foreach($publicidades as $publimotor)
            <div class="col-md-3">
              <div class="estilos_foreach_resultados_usuario_anuncios">
                <h5>{{ $publimotor->titulo}}</h5>
                <h6>{{ $publimotor->fecha }}</h6>
                <h6>{{ $publimotor->emisor}}</h6>
                @if (empty($publimotor->img_banner))

                @else
                <img src="{{ asset('uploads/publicidad/mascotas/'.$publimotor->img_banner) }}" />
                @endif

                {!!link_to_route('usuario.descuentos.clubmotor.show', $title = 'Ver Bono', $parameters = $publimotor->id, $attributes = ['class'=>'btn btn-primary mb-1'])!!}
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>

  </div>
</div>


@stop

@section('footer')
@include ('layout.footer')
{!!Html::script('build/pages/js/pages.social.min.js')!!}
@stop
