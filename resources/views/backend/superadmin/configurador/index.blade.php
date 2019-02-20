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



<div class="container-fluid">
  <div class="row">
    @include ('errors.success')
    @include ('errors.request')
    @include ('errors.errors') 

    <div class="col-md-12">
      <h1 class="breadcrumb">Super Administrador de Conceptos Publicitarios</h1>
    </div>

    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="row">
            <div class="col-md-6 ">
              <h3>Listado de Conceptos Publicitarios HGV</h3>
            </div>

            <div class="col-md-6 text-right">
              {!!link_to_route('superadmin.conceptos.create', $title = '+ Nuevo Concepto', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>


    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-body">
          <div class="table-responsive">
            <table class="data-table responsive nowrap tabla_bonos_estilos">
              <thead >
                <tr>
                  <th style="width: auto;">Concepto</th>
                  <th>Acciones</th>
                </tr>
              </thead> 
              <tbody>
                @foreach ($conceptos as $concepto)
                <tr>
                  <td style="text-align:left;">{{$concepto->concepto}}</td>
                  <td>
                    {!!link_to_action('ConceptoController@deleteconcepto', $title = 'Eliminar', $parameters = $concepto->id, $attributes = ['class'=>'btn btn-danger btn-xs mb-1'])!!}
                  </td>
                </tr>
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
{!!Html::script('build/assets/js/init.js')!!}
{!!Html::script('build/assets/js/datatables.js')!!}
@stop
