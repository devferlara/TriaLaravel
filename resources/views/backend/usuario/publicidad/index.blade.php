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
      <h1 class="breadcrumb">Bienvenido: <strong>Sistema de Bonos</strong></h1>
    </div>

    <div class="col-lg-12 col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <img alt="" width="100%" src="{{ asset('uploads/banners/bannerbonos.png') }}"/>
        </div>
      </div>
    </div>


    <div class="col-lg-12 col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="row">
            @foreach($publicidades as $publicidad)
            <div class="col-md-3">
              <div class="estilos_foreach_resultados_usuario_anuncios">
                <h5>{{ $publicidad->titulo}}</h5>
                <h6>{{ $publicidad->fecha }}</h6>
                <h6>{{ $publicidad->tienda}}</h6>
                @if (empty($publicidad->img_publicidad))

                @else
                <img src="{{ asset('uploads/publicidad/'.$publicidad->img_publicidad) }}" />
                @endif
                {!!link_to_route('usuario.descuentos.bonos.show', $title = 'Ver Bono', $parameters = $publicidad->id, $attributes = ['class'=>'btn btn-primary mb-1'])!!}
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
