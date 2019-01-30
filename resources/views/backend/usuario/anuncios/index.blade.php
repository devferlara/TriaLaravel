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

@section('css')

<style>
.anuncio-btn{
  margin: 0 auto;
  display: -webkit-box;
  border-radius: 5px !important;
  width: 50%;
  margin-top: 23px;
  text-align: center;
}
#img-profile{
  width: 50%;
  margin: 0 auto;
  display: block;
  margin-bottom: 30px;
}
.card.share.col1 {
  margin-right: 16px;
}
.social-wrapper .social .jumbotron {
  height: 35vh;
}
.table thead tr th, .table tbody tr td {
  text-align: center;
}
</style>
@stop

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <h1 class="breadcrumb">Conjunto Residencial: <strong>NOTICIAS</strong></h1>
    </div>

    <div class="col-lg-12 col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <img width="100%" src="{{ asset('uploads/banners/banneranuncios.png') }}">
        </div>
      </div>
    </div>


    <div class="col-lg-12 col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="row">
            @foreach($anuncios as $anuncio)
            <div class="col-md-3">
              <div class="estilos_foreach_resultados_usuario_anuncios">
                <h5>{{ $anuncio->nombre }}</h5>
                <h6>{{ $anuncio->fecha }}</h6>
                @if (empty($anuncio->img_banner))

                @else
                <img src="{{ asset('uploads/anuncios/'.$anuncio->img_banner) }}" />
                @endif
                {!!link_to_route('usuario.noticias.show', $title = 'Ver Noticia', $parameters = $anuncio->id, $attributes = ['class'=>'btn btn-primary mb-1'])!!}
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

