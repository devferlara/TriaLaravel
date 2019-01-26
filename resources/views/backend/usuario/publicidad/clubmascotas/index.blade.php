@extends('layout.mensajes')

<!-- Create General Section Sidebar -->
@section('sidebar')
<!-- Include the menu -->
@include('backend.menu.usuario')
@stop

<!-- Create General Section Header -->
@section('head')
<!-- Include the profile header -->
@include('layout.head')

@stop




@section('content')

<div class="container-fluid">
  <div class="row">

    <div class="col-md-12">
      <h1 class="breadcrumb">Bienvenido: <strong>Bonos-Club Mascotas</strong></h1>
    </div>

    <div class="col-lg-12 col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <img alt="" width="100%" src="{{ asset('uploads/banners/bannermascotas.png') }}"/>
        </div>
      </div>
    </div>

    <div class="col-lg-12 col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="row">
            @foreach($publicidades as $publimascota)
            <div class="col-md-3">
              <div class="estilos_foreach_resultados_usuario_anuncios">
                <h5>{{ $publimascota->titulo}}</h5>
                <h6>{{ $publimascota->fecha }}</h6>
                <h6>{{ $publimascota->emisor}}</h6>
                @if (empty($publimascota->img_banner))

                @else
                <img src="{{ asset('uploads/publicidad/mascotas/'.$publimascota->img_banner) }}" />
                @endif

                {!!link_to_route('usuario.descuentos.clubmascotas.show', $title = 'Ver Bono', $parameters = $publimascota->id, $attributes = ['class'=>'btn btn-primary mb-1'])!!}
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


