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
                <div class="card-body ">
                    <div class="panel-heading">
                        <div class="col-md-2 pull-right">
                            {!!link_to_route('superadmin.publicidad.clubmascotas.index', $title = 'Volver a Bonos Club Mascotas', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
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
                            <h5><i class="iconsmind-Calendar-4" style="font-size:20px;"></i> {{$publimascotas->fecha}}</br>Categoriasss: {{$publimascotas->categoria}}</br>Emisor Bono: {{$publimascotas->emisor}}
                            </h5>
                        </div>

                        <div class="col-md-6" >
                            <h3 style="font-weight:bold; text-align:center; margin-top:20px; color:#000;">
                                {{$publimascotas->titulo}}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card mb-4">
                <div class="card-body ">
                    <h5 class="datos" ><i class="fa fa-unlock" style="font-size:20px; color:white;"></i> Valido Desde: {{$publimascotas->fecha_desde}}</h5>
                    <h5 class="datos" ><i class="fa fa-lock" style="font-size:20px; color:white;"></i> Valido Hasta: {{$publimascotas->fecha_hasta}}</h5>
                    <h4 class="datos">Valor Bono: {{$publimascotas->valor}}</h4>
                    <h6 class="datos"><a target="_blank" class="btn btn-success" href="{{$publimascotas->link}}">Mayor Información Pulsa Aquí</a></h6>
                </div>
            </div>
        </div>


        <div class="col-lg-12 col-md-12">
            <div class="card mb-4">
                <div class="card-body ">
                    <img class="img-responsive" style="margin:0 auto;" alt="Banner Bono" src="{{ asset('uploads/publicidad/mascotas/'.$publimascotas->img_banner) }}"/>
                    <textarea id="descripcion" name="hide" style="display:none;" class="input">{{$publimascotas->descripcion}}</textarea>
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