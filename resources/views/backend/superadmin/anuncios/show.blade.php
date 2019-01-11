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
<div class="page-content-wrapper">
    <div class="content">
        @include ('errors.errors')
        @include ('errors.request')
        @include ('errors.success')
        <div class="container-fluid container-fixed-lg">
            <div class="panel panel-transparent">
                <div class="panel-heading">
                    <div class="col-md-2 pull-right">
                        {!!link_to_route('superadmin.anuncios.index', $title = 'Volver a Anuncios', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!-- Pegar el panel body -->
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="col-md-1"></div>
                        <div class="col-md-10 well well-sm" style="background:#21F380;">
                            <h5 ><i class="fa fa-calendar" style="font-size:20px;"></i> {{$anuncio->fecha}}</h5>
                            <h3 style="font-weight:bold; text-align:center;">{{$anuncio->nombre}}</h3>
                            <h5>Categoria: {{$anuncio->categoria}}</h6>
                        </div>
                        <div class="col-md-1"></div>
                    <div class="col-md-12">
                        <div class="col-md-1"></div>
                        <div id="" class="col-md-10"><img class="img-responsive" style="margin:0 auto;" alt="Banner Anuncio" src="{{ asset('uploads/anuncios/'.$anuncio->img_banner) }}"/></div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-1"></div>
                        <div id="" class="col-md-10">
                        </br>
                        <textarea id="descripcion" name="hide" style="display:none;" class="input">{{$anuncio->descripcion}}</textarea>
                        <div id="arreglo" class="row"></div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('footer')
    @include ('layout.footer')
@stop

@section('specific_js')
    {!!Html::script('build/assets/js/script/anuncios.js')!!}
@stop