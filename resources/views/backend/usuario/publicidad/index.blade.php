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
<!-- START PAGE CONTENT WRAPPER -->
<div class="page-content-wrapper">
    <!-- START PAGE CONTENT -->

    <div class="content">

        <div class="social-wrapper">
            <div class="social " data-pages="social">
                <!-- START JUMBOTRON -->
                <div class="jumbotron" data-pages="parallax" data-social="cover">
                    <div class="cover-photo">
                        <img alt="Cover photo" src="{{ asset('uploads/banners/bannerbonos.png') }}" />
                    </div>
                    <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
                        <div class="inner">
                            <div class="pull-bottom bottom-left m-b-40">
                                <h3 class="text-white no-margin">Bienvenido</h3>
                                <h1 class="text-white no-margin"><span class="semi-bold">Sistema de Bonos</span></h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END JUMBOTRON -->
                <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
                    <div class="feed">
                        <!-- START DAY -->
                        <div class="day" data-social="day">
                            <!-- START ITEM -->
                            @foreach($publicidades as $publicidad)

                                <div class="card share  col1" data-social="item">
                                    <div class="circle" data-toggle="tooltip" title="Noticia" data-container="body">
                                    </div>
                                    <div class="card-header clearfix">
                                        <div class="user-pic">
                                            <i class="fa fa-paste" style="font-size: 20px;"></i>
                                        </div>
                                        <h5>{{ $publicidad->titulo}}</h5>
                                        <h6>{{ $publicidad->fecha }}</h6>
                                        <h6>{{ $publicidad->tienda}}</h6>
                                    </div>

                                    <div class="card-description">
                                    @if (empty($publicidad->img_publicidad))

                                    @else
                                        <img src="{{ asset('uploads/publicidad/'.$publicidad->img_publicidad) }}" style="width:250px; height:250px;"/>
                                    @endif
                                        {!!link_to_route('usuario.descuentos.bonos.show', $title = 'Ver Bono', $parameters = $publicidad->id, $attributes = ['class'=>'btn btn-tag btn-tag-light btn-tag-rounded anuncio-btn'])!!}
                                    </div>
                                </div>
                            @endforeach
                            <!-- END ITEM -->
                        </div>
                        <!-- END DAY -->
                    </div>
                    <!-- END FEED -->
                </div>
                <!-- END CONTAINER FLUID -->
            </div>
            <!-- /container -->
        </div>

    </div>
</div>

@stop

@section('footer')
    @include ('layout.footer')
@stop


@section('js_library')

{!!Html::script('build/assets/plugins/imagesloaded/imagesloaded.pkgd.min.js')!!}
{!!Html::script('build/assets/plugins/jquery-isotope/isotope.pkgd.min.js')!!}
{!!Html::script('build/assets/plugins/classie/classie.js')!!}
{!!Html::script('build/assets/plugins/codrops-stepsform/js/stepsForm.js')!!}
<!--[if lte IE 9]>
<script src="{{ asset('build/assets/plugins/jquery-isotope/isotope.pkgd.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('build/assets/plugins/jquery-isotope/masonry-horizontal.js') }}" type="text/javascript"></script>
<![endif]-->
@stop

@section('specific_js')

{!!Html::script('build/pages/js/pages.social.min.js')!!}

@stop