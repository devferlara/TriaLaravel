@extends('layout.admin')

@section ('meta')
    <meta name="viewport" content="width=device-width, initial-scale=1">
@stop
<!-- Create General Section Sidebar -->
@section('sidebar')
    <!-- Include the menu -->
    @include('backend.menu.superadmin')
    @stop

            <!-- Create General Section Header -->
@section('head')
    <!-- Include the profile header--> 
    @include ('layout.head')
@stop

@section('css')
    <style>
        .table thead tr th, .table tbody tr td {
            text-align: center;
        }
    </style>
@stop

@section('content')

<div class="page-content-wrapper">
    <div class="content">
        @include ('errors.success')
        @include ('errors.request')
        @include ('errors.errors')
        <div class="jumbotron" data-pages="parallax">
            <div class="container-fluid container-fixed-lg">
                <div class="inner">
                    <h6 class="breadcrumb">Super Administrador de Conceptos Publicitarios</h6>
                </div>
            </div>
        </div>
        <div class="container-fluid container-fixed-lg">
            <div class="panel panel-transparent">
                <div class="panel-heading">
                    <div class="panel-title col-md-6">Listado de Conceptos Publicitarios Tria Group</div>
                    <div class="col-md-2 pull-right">
						{!!link_to_route('superadmin.conceptos.create', $title = '+ Nuevo Concepto', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
                    </div>
                    
                    <div class="clearfix"></div>
                </div>
            <div class="panel-body">
            <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class= "info">
                    <th style="width: auto;">Concepto</th>
                    <th>Acciones</th>
                </thead> 
                @foreach ($conceptos as $concepto)
                <tbody>
                    <td style="text-align:left;">{{$concepto->concepto}}</td>
                    <td>
						{!!link_to_action('ConceptoController@deleteconcepto', $title = 'Eliminar', $parameters = $concepto->id, $attributes = ['class'=>'btn btn-danger'])!!}
                    </td>
                @endforeach
                </tbody>
            </table>
            {!!$conceptos->render()!!}
            </div>
            </div>
            </div>
        </div>
    </div>
</div>

@stop

@section ('footer')
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