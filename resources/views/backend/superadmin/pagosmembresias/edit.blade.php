@extends('layout.mensajes')

<!-- Create General Section Sidebar -->
@section('sidebar')
<!-- Include the menu -->
@include('backend.menu.superadmin')
@stop

<!-- Create General Section Header -->
@section('head')
<!-- Include the profile header -->
@include('layout.head')

@stop

@section('css')
{!!Html::style('build/assets/plugins/multiple-select/multiple-select.css')!!}

@stop

@section('content')

<div class="container-fluid">
  <div class="row">
    @include ('errors.success')
    @include ('errors.request')
    @include ('errors.errors') 
    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <h3 class="p-b-5 text-primary" style="text-align:center;">
            <span class="semi-bold">Nuevo</span>
            Pago
          </h3>
          <h4 class="text-info text-center">Podrás crear nuevos pagos de membresias de tipo manual o Payu.</h4>
          <br>

          {!!Form::model(null,['route'=> ['superadmin.pagosmembresias.update',$pago->id],'method'=>'PUT'])!!}
          <div class="row">

            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                <label for="administrador_id">Tipo de pago</label>
                <select class="full-width form-control" data-init-plugin="select2" id="tipo_pago" name="tipo_pago">
                  <optgroup label="Seleccione un tipo de pago">
                    <option value="1">PAYU</option>
                    <option value="2" <?= $pago->tipo_pago == 2?'selected':''?>>Manual</option>
                  </optgroup>
                </select>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                <label for="administrador_id">Administrador</label>
                <select class="full-width form-control" data-init-plugin="select2" id="administrador_id" name="administrador_id">
                  <optgroup label="Seleccione un administrador">
                    @foreach($administradores as $admin)
                    <option value="{{$admin->id}}" <?= $pago->administrador_id == $admin->id?'selected':''?>>{{$admin->nombres}} {{$admin->apellidos}}</option>
                    @endforeach
                  </optgroup>
                </select>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('reference', 'Referencia')!!}
                {!!Form::text ('reference', $pago->reference, ['class'=>'form-control', 'placeholder'=>'Número de referencia del pago 0000000', 'style'=>'width:100%'])!!}
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('total', 'Total')!!}
                {!!Form::text ('total', $pago->total, ['class'=>'form-control', 'placeholder'=>'Total del pago (USD)', 'style'=>'width:100%'])!!}
              </div>
            </div>
            <div class="col-md-4 form-group">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('payment_status', 'Estado del pago', ['class'=>'form-label'])!!}
                <select class="full-width form-control" data-init-plugin="select2" id="payment_status" name="payment_status">
                  <optgroup label="Seleccione un estado">
                    <option value="1">Aprobado</option>
                    <option value="0" <?= $pago->payment_status == 'Pending'?'selected':''?>>Pendiente</option>
                    <option value="2" <?= $pago->payment_status == 'Vencido'?'selected':''?>>Vencido</option>
                  </optgroup>
                </select>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('transaction_id', 'ID de la transacción', ['class'=>'form-label'])!!}
                {!!Form::text ('transaction_id', $pago->transaction_id, ['class'=>'form-control', 'placeholder'=>'ID de la transacción en caso de ser Payu', 'style'=>'width:100%'])!!}
              </div>
            </div>


            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('fecha_inicio', 'Valido-Desde', ['class'=>'form-label'])!!}
                {!!Form::date('fecha_inicio',null,['class'=>'form-control'], date("Y-m-d", strtotime($pago->fecha_inicio)))!!}
              </div>
            </div>

            <div class="col-md-4" >
              <div class="form-group has-float-label mb-4">
                {!!Form::label('fecha_fin', 'Valido-Hasta', ['class'=>'form-label'])!!}
                {!!Form::date('fecha_fin',null,['class'=>'form-control'], date("Y-m-d", strtotime($pago->fecha_fin)))!!}
              </div>
            </div>

            <div class="col-md-4" >
              <div class="form-group has-float-label mb-4">
                {!!Form::label('payment_method', 'Metodo de pago', ['class'=>'form-label'])!!}
                {!!Form::text ('payment_method', $pago->payment_method, ['class'=>'form-control', 'placeholder'=>'MASTERCARD, Efectivo', 'style'=>'width:100%'])!!}
              </div>
            </div>
          </div>
          <div class="col-md-6 form-group" style="margin-top:20px;">
            <div style="float:none;">
              {!!Form::submit('Guardar y Enviar', ['class'=>'btn btn-primary'])!!}
              {!!link_to_route('superadmin.pagosmembresias.index',  $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-danger'])!!}
            </div>
          </div>
          <div class="col-md-6 form-group"></div>
          {!!Form::close()!!}

        </div>
      </div>
    </div>
  </div>
</div>

@stop

@section ('footer')
@include('layout.footer')
@stop
