@extends('layout.mensajes')

<!-- Create General Section Sidebar -->
@section('sidebar')
<!-- Include the menu -->
@include('backend.menu.administrador')
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
        <div class="card-body">
          <h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold">Nueva</span> Factura para un propietario</h3>

          <h4 class="text-info text-center">Podrá crear una factura para el propietario de forma manual. </h4>
          <br>
          {!!Form::open(['route'=>'administrador.facturas.storefactura','method'=>'POST'])!!}
          <div class="row">

            <div class="col-md-6">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('fecha_corte', 'Fecha de corte', ['class'=>'form-label'])!!}
                {!!Form::date('fecha_corte', \Carbon\Carbon::now() ,['class' => 'form-control'])!!}
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('nombre_propietaria', 'Nombre del propietario')!!}
                {!!Form::text ('nombre_propietaria', null, ['class'=>'form-control', 'placeholder'=>'Nombre del propietario(a)', 'style'=>'width:100%'])!!}
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('valor_adeudado', 'Valor Adeudado', ['class'=>'form-label'])!!}
                {!!Form::text ('valor_adeudado', null, ['class'=>'form-control', 'placeholder'=>'$ valor adeudado', 'style'=>'width:100%'])!!}
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('matricula_inmobiliaria', 'Apartamento', ['class'=>'form-label'])!!}
                <select name="matricula_inmobiliaria" id="matricula_inmobiliaria" class="form-control" style="width:100%">
                  @if(count($apartamentos) > 0)
                  @foreach($apartamentos as $apto)
                  <option value="{{$apto->matricula_inmobiliaria}}">{{$apto->descripcion}}</option>
                  @endforeach
                  @endif
                </select>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('coeficiente_inmueble', 'Coeficiente inmueble', ['class'=>'form-label'])!!}
                {!!Form::text ('coeficiente_inmueble', null, ['class'=>'form-control', 'placeholder'=>'Coeficiente del inmueble', 'style'=>'width:100%'])!!}
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('concepto_pago', 'Concepto de pago', ['class'=>'form-label'])!!}
                {!!Form::text ('concepto_pago', null, ['class'=>'form-control', 'placeholder'=>'Concepto de pago de la factura', 'style'=>'width:100%'])!!}
              </div>
            </div>


            <div class="col-md-6">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('saldo_mes_anterior', 'Saldo del mes anterior', ['class'=>'form-label'])!!}
                {!!Form::text ('saldo_mes_anterior', null, ['class'=>'form-control', 'placeholder'=>'Saldo del mes anterior', 'style'=>'width:100%'])!!}
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('saldo_anterior', 'Saldo anterior', ['class'=>'form-label'])!!}
                {!!Form::text ('saldo_anterior', null, ['class'=>'form-control', 'placeholder'=>'Saldo anterior', 'style'=>'width:100%'])!!}
              </div>
            </div>


            <div class="col-md-6">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('nuevo_saldo', 'Nuevo saldo', ['class'=>'form-label'])!!}
                {!!Form::text ('nuevo_saldo', null, ['class'=>'form-control', 'placeholder'=>'Nuevo saldo', 'style'=>'width:100%'])!!}
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('total_mes', 'Total mes', ['class'=>'form-label'])!!}
                {!!Form::text ('total_mes', null, ['class'=>'form-control', 'placeholder'=>'Total del mes', 'style'=>'width:100%'])!!}
              </div>
            </div>


            <div class="col-md-6">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('correo_conjunto', 'Correo electrónico del conjunto', ['class'=>'form-label'])!!}
                {!!Form::email ('correo_conjunto', null, ['class'=>'form-control', 'placeholder'=>'ejemplo@conjunto.om', 'style'=>'width:100%'])!!}
              </div>
            </div>

            <div class="col-md-6 form-group">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('estado', 'Estado', ['class'=>'form-label'])!!}
                <select name="estado" id="estado" class="form-control" style="width:100%">
                  <option value="1">Por pagar</option>
                  <option value="2">Pagado</option>
                  <option value="3">Anulado</option>
                </select>
              </div>
            </div>
          </div>

          <input type="hidden" name="id_csv" value="{{$id}}">

          <div class="col-md-6 form-group" style="margin-top:20px;">

            <div style="float:none;">
              {!!Form::submit('Guardar y Enviar', ['class'=>'btn btn-primary'])!!}
              {!!link_to_route('administrador.facturas.index',  $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-danger'])!!}
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


@section('js_library')
{!!Html::script('vendor/ckeditor/ckeditor.js')!!}
@stop

@section('specific_js')
<script>

  CKEDITOR.replace('descripcion');

  CKEDITOR.replace( 'descripcion', {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
  });
</script>

@stop