@extends('layout.mensajes')

@section ('meta')
<meta name="viewport" content="width=device-width, initial-scale=1">
@stop

@section('sidebar')
@include('backend.menu.superadmin')
@stop

@section('head')
@include('layout.head')
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
    @include ('errors.errors')
    @include ('errors.request')
    @include ('errors.success')

    <div class="col-md-12">
      <h1 class="breadcrumb">Listado Recibos de Pago Administraciones por conjunto</h1>
    </div>

    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="row">
            <div class="col-md-4 estilos_buscador_zonas">
              {!!Form::open(['action'=>'FacturaController@buscar','method'=>'POST' , 'class'=>'navbar-form ', 'style'=>'margin:0 !important', 'role'=>'search'])!!}
              <div class="form-group" style="margin:0">
                {!!Form::select ('conjunto', $conjuntos, null, ['class'=>'form-control input_buscador_zonas', 'placeholder'=>'Selecciona un Conjunto', 'id'=>'conjunto'])!!}
                <button type="submit" class="btn btn-primary"><i class="iconsmind-Magnifi-Glass2"></i></button>
              </div>
              {!!Form::close()!!}
            </div>

            <div class="col-md-4" style="80%">
              <form>
                <div class="form-group has-float-label mb-4">
                  <label class= "text-primary" style="font-weight:bold">Busqueda:</label> 
                  <input id="buscar" type="text" onkeyup="busqueda()" class="form-control" style="width:100%;" placeholder="Escriba aquí el valor a buscar" />
                </div>
              </form>
            </div>
            <div class="col-md-4 text-right">
              {!!link_to_route('superadmin.recibosdepago.create', $title = '+ Cargar Recibos', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>


    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="table-responsive">
            <table class="data-table responsive nowrap tabla_bonos_estilos" id="datos">
              <thead>
                <tr>
                  <th style="width: auto;">Id Factura</th>
                  <th style="width: auto;">Valor Admon</th>
                  <th style="width: auto;">Fecha</th>
                  <th style="width: auto;">Valor Parqueadero</th>
                  <th style="width: auto;">Valor Cuota Extra</th>
                  <th style="width: auto;">Apartamento</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($recibos as $recibo)
                <tr>
                  <td class="v-align-middle">{{$recibo->num_factura}}</td>
                  <td class="v-align-middle">{{$recibo->valoradmon}}</td>
                  <td class="v-align-middle">{{$recibo->fecha}}</td>
                  <td class="v-align-middle">{{$recibo->valorparqueadero}}</td>
                  <td class="v-align-middle">{{$recibo->valorcuotaextra}}</td>
                  <td class="v-align-middle">{{$recibo->apartamento_id}}</td>
                  <td>
                    {!!link_to_route('superadmin.recibosdepago.edit', $title = 'Editar Recibo', $parameters = $recibo->id , $attributes = ['role'=>'menu-item', 'class' => 'btn btn-secondary btn-xs mb-1'])!!}
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>



  </div>
</div>

@stop

@section ('footer')
@include('layout.footer')
{!!Html::script('build/assets/js/script/busqueda.js')!!}
@stop
