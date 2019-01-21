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
          {!!Form::model(null,['route'=> ['superadmin.pagosanuncios.update',$pago->id],'method'=>'PUT'])!!}
          <div class="row">

            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                <label for="tipo_pago">Tipo de pago</label>
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
                <label for="usuario_id">Pautante</label>
                <select class="full-width form-control" data-init-plugin="select2" id="usuario_id" name="usuario_id">
                  <optgroup label="Seleccione un administrador">
                    @foreach($pautantes as $admin)
                    <option value="{{$admin->id}}" <?= $pago->usuario_id == $admin->id?'selected':''?>>{{$admin->nombres}} {{$admin->apellidos}}</option>
                    @endforeach
                  </optgroup>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                <label for="publicidad_tipo">Tipo de auncio</label>
                <select class="full-width form-control" data-init-plugin="select2" id="publicidad_tipo" name="publicidad_tipo">
                  <optgroup label="Elija el tipo de anuncio">
                    <option value="1">Bono de descuento</option>
                    <option value="2" <?= $pago->tipo_pago == 2?'selected':''?>>Club de mascotas</option>
                    <option value="3" <?= $pago->tipo_pago == 3?'selected':''?>>Club de motores</option>
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
            <div class="col-md-4">
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
                {!!Form::label('buyer_email', 'Correo electrónico', ['class'=>'form-label'])!!}
                {!!Form::email ('buyer_email', $pago->buyer_email, ['class'=>'form-control', 'placeholder'=>'comprador@comprador.com', 'style'=>'width:100%'])!!}
              </div>
            </div>


            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('payment_method', 'Metodo de pago', ['class'=>'form-label'])!!}
                {!!Form::text ('payment_method', $pago->payment_method, ['class'=>'form-control', 'placeholder'=>'MASTERCARD, Efectivo', 'style'=>'width:100%'])!!}
              </div>
            </div>
            <div class="col-md-6 form-group" style="margin-top:20px;">
              <div style="float:none;">
                {!!Form::submit('Guardar y Enviar', ['class'=>'btn btn-primary'])!!}
                {!!link_to_route('superadmin.pagosanuncios.index',  $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-danger'])!!}
              </div>
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
