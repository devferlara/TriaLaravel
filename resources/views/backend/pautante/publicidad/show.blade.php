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
<div class="page-content-wrapper">
    <div class="content">
        @include ('errors.errors')
        @include ('errors.request')
        @include ('errors.success')
        <div class="container-fluid container-fixed-lg">
            <div class="panel panel-transparent">
                <div class="panel-heading">
                    <div class="col-md-2 pull-right">
                        {!!link_to_route('pautante.publicidad.bonos.index', $title = 'Volver a Bonos', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!-- Pegar el panel body -->
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="col-md-1"></div>
                        <div class="col-md-11">
                            <img class="img-responsive" style="margin:0 auto;width: 140px;border-radius: 100%;height: 140px;float: left;" alt="Logo publicidad" src="{{ asset('uploads/publicidad/'.$publicidad->logo) }}"/>
                        </div>
                        <div class="col-md-1"></div>
                         <div class="col-md-10 well well-sm" style="background:orange;">
                            <div class="col-md-4" >
                                <h5><i class="fa fa-calendar" style="font-size:20px;"></i> {{$publicidad->fecha}}
                                    </br>Categoria: {{$publicidad->categoria}}
                                    </br>Tienda: {{$publicidad->tienda}}
                                </h5>
                            </div>
                            <div class="col-md-6" >
                                <h3 style="font-weight:bold; text-align:center; margin-top:20px;">{{$publicidad->titulo}}</h3>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    <div class="col-md-12">
                        <div class="col-md-1"></div>
                        <div id="" class="col-md-10"><img class="img-responsive" style="margin:0 auto;" alt="Banner Bono" src="{{ asset('uploads/publicidad/'.$publicidad->img_publicidad) }}"/></div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-1"></div>
                        <div id="" class="col-md-10">
                        </br>
                        <textarea id="descripcion" name="hide" style="display:none;" class="input">{{$publicidad->descripcion}}</textarea>
                        <div id="arreglo" class="row"></div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-1"></div>
                        <div class="col-md-10 well well-lg" style="background:grey;">
                            <h5 class="datos" ><i class="fa fa-unlock" style="font-size:20px; color:white;"></i> Valido Desde: {{$publicidad->fecha_desde}}</h5>
                            <h5 class="datos" ><i class="fa fa-lock" style="font-size:20px; color:white;"></i> Valido Hasta: {{$publicidad->fecha_hasta}}</h5>
                            <h4 class="datos">Valor Bono: {{$publicidad->valor}}</h4>
                            <h6 class="datos"><a class="btn btn-success" target="_blank" href="{{$publicidad->link}}">Mayor Información Pulsa Aquí</a></h6>
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