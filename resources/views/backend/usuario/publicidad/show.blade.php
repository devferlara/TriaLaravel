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

    <div class="col-lg-12 col-md-12">
      <div class="card mb-4">
        <div class="card-body">
          {!!link_to_route('usuario.descuentos.bonos.index', $title = 'Volver a Bonos de Descuento', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
        </div>
      </div>
    </div>

    <div class="col-lg-12 col-md-12">
      <div class="card mb-4">
        <div class="card-body">
          <h5><i class="simple-icon-calendar" style="font-size:20px;"></i> {{$publicidad->fecha}}
            <br>Categoria: {{$publicidad->categoria}}
            <br>Tienda: {{$publicidad->tienda}}
          </h5>
        </div>
      </div>
    </div>


    <div class="col-lg-12 col-md-12">
      <div class="card mb-4">
        <div class="card-body">
          <h5 class="datos" ><i class="fa fa-unlock" style="font-size:20px; color:white;"></i> Valido Desde: {{$publicidad->fecha_desde}}</h5>
          <h5 class="datos" ><i class="fa fa-lock" style="font-size:20px; color:white;"></i> Valido Hasta: {{$publicidad->fecha_hasta}}</h5>
          <h4 class="datos">Valor Bono: {{$publicidad->valor}}</h4>
          <h6 class="datos"><a class="btn btn-success" target="_blank" href="{{$publicidad->link}}">Mayor Información Pulsa Aquí</a></h6>
        </div>
      </div>
    </div>

    <div class="col-lg-12 col-md-12">
      <div class="card mb-4">
        <div class="card-body">
          <img class="img-responsive" style="margin:0 auto;" alt="Banner Bono" src="{{ asset('uploads/publicidad/'.$publicidad->img_publicidad) }}"/>
          <textarea id="descripcion" name="hide" style="display:none;" class="input">{{$publicidad->descripcion}}</textarea>
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
