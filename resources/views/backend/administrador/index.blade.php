@extends('layout.admin')

@section ('meta')
 <meta name="viewport" content="width=device-width, initial-scale=1">
@stop
<!-- Create General Section Sidebar -->
@section('sidebar')
    <!-- Include the menu -->
    @include('backend.menu.administrador')
@stop

<!-- Create General Section Header -->
@section('head')
    <!-- Include the profile header--> 
    @include('layout.head')
@stop

@section('content')
@include ('errors.success')
@include ('errors.request')
@include ('errors.errors')

    <div class="page-content-wrapper">
        <!-- START PAGE CONTENT -->
        <div class="content">
            <!-- START JUMBOTRON -->
            <div class="jumbotron" data-pages="parallax">
                <div class="container-fluid container-fixed-lg">
                    <div class="inner">
                        <!-- START BREADCRUMB -->
                        <ul class="breadcrumb">
                            <li>
                                <p>Inicio</p>
                            </li>
                        </ul>
                        <!-- END BREADCRUMB -->
                        <div class="container-md-height m-b-20">
                            <div class="row row-md-height">
                                <div class="col-lg-7 col-md-6 col-md-height col-middle bg-white">
                                    <!-- START PANEL -->
                                    <div class="full-height">
                                        <div class="panel-body text-center">
                                            <img  src="{{ asset('home/images/LogoTria.png') }}" alt="" width="280">
                                        </div>
                                    </div>
                                    <!-- END PANEL -->
                                </div>
                                <div class="col-lg-5 col-md-height col-md-6 col-top">
                                    <!-- START PANEL -->
                                    <div class="panel panel-transparent">
                                        <div class="panel-heading">
                                            <div class="panel-title">Bienvenido(a) {{ Auth::user()->nombres }}
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <h3>Plataforma Tria Group</h3>
                                            <p>Bienvenido! A la Plataforma de Administración Tria Group. Desde esta sección podras administrar tu conjunto residencial, crear usuarios, unidades y apartamentos, con el fin de comunicar información importante y publicar noticias y servicios que la comunidad residencial debe estar enterada; como tambien editar su información y hacer un control detallado de los datos del conjunto para que tengas un control total!</p>
                                            <br>
                                        </div>
                                    </div>
                                    <!-- END PANEL -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END JUMBOTRON -->
        </div>

@stop

@section('footer')
@include ('layout.footer')
@stop


@section('js_library')

    {!!Html::script('build/assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js')!!}
    {!!Html::script('build/assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js')!!}
    {!!Html::script('build/assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js')!!}
    {!!Html::script('build/assets/plugins/datatables-responsive/js/datatables.responsive.js')!!}
    {!!Html::script('build/assets/plugins/datatables-responsive/js/lodash.min.js')!!}
@stop

@section('specific_js')

    {!!Html::script('build/assets/js/init.js')!!}
    {!!Html::script('build/assets/js/datatables.js')!!}
@stop