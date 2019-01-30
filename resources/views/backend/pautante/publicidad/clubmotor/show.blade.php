@extends('layout.mensajes')

@section ('meta')
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset= UTF-8">
@stop

@section('sidebar')
@include('backend.menu.pautante')
@stop


@section('head')
@include('layout.head')
@stop

@section('css')
<style>
.datos {
  text-align: center;
  color: white;
  font-weight: semi-bold;
  font-family: verdana;
}
</style>
@stop

@section('content')


<div class="container-fluid">
  <div class="row">
    @include ('errors.errors')
    @include ('errors.request')
    @include ('errors.success')
    <div class="col-lg-12 col-md-12">
      <div class="card mb-4">
        <div class="card-body">
          {!!link_to_route('pautante.publicidad.clubmotor.index', $title = 'Volver a Bonos Club Motor', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
        </div>
      </div>
    </div>


    <div class="col-lg-4 col-md-4">
      <div class="card mb-4">
        <div class="card-body">
          <img class="img-responsive" style="margin:0 auto;width: 140px;height: auto;display:block" alt="Logo publicidad" src="{{ asset('uploads/publicidad/vehiculos/'.$publivehiculos->img_banner) }}"/>
        </div>
      </div>
    </div>

    <div class="col-lg-8 col-md-8">
      <div class="card mb-4">
        <div class="card-body">
          <h3 style="font-weight:bold">{{$publivehiculos->titulo}}</h3>
          <h5><i class="simple-icon-calendar" style="font-size:20px;"></i> {{$publivehiculos->fecha}}
            <br>Categoria: {{$publivehiculos->categoria}}
            <br>Tienda: {{$publivehiculos->emisor}}
          </h5>
        </div>
      </div>
    </div>

    <div class="col-lg-12 col-md-12">
      <div class="card mb-4">
        <div class="card-body">
          <h5 class="datos" ><i class="fa fa-unlock" style="font-size:20px; color:white;"></i> Valido Desde: {{$publivehiculos->fecha_desde}}</h5>
          <h5 class="datos" ><i class="fa fa-lock" style="font-size:20px; color:white;"></i> Valido Hasta: {{$publivehiculos->fecha_hasta}}</h5>
          <h4 class="datos">Valor Bono: {{$publivehiculos->valor}}</h4>
          <h6 class="datos"><a class="btn btn-primary mb-1" target="_blank" href="{{$publivehiculos->link}}">Mayor Información Pulsa Aquí</a></h6>
          <textarea id="descripcion" name="hide" style="display:none;" class="input">{{$publivehiculos->descripcion}}</textarea>
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
