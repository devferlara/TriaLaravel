@extends('layout.admin')

@section ('meta')
<meta name="viewport" content="width=device-width, initial-scale=1">
@stop

@section('sidebar')
@include('backend.menu.administrador')
@endsection

@section('head')
@include ('layout.head')
@endsection

@section ('content')
<div class="container-fluid">
  <div class="row">
    @include ('errors.success')
    @include ('errors.request')
    @include ('errors.errors') 
    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-body">
          <h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold">Cargar</span> Facturación</h3>
          <h4 class="text-info" style="text-align: center">Por medio de este módulo podrás cargar la facturación por conjunto residencial.</h4>
          <br>

          {!!Form::open(['route'=>'administrador.facturas.store','method'=>'POST', 'files'=>'true'])!!}
          <div class="row">
            <div class="col-md-6">
              <div class="form-group has-float-label mb-4" >
                <label for="archivo" class="form-label">Nombre de la factura </label>
                {!!Form::text ('name', null, ['class'=>'form-control', 'placeholder'=>'Ingrese un nombre para identificar la factura'])!!}
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group" id="cargarecibos">
                <label for="archivo" class="form-label">Archivo de Facturación. <span style="font-size:12px; font-weight: bold"> (Solo se permiten archivos .csv)</span> </label>
                {!!Form::file('archivo')!!}
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                {!!Form::submit('Cargar Facturación', ['class'=>'btn btn-primary'])!!}
                {!!link_to_route('administrador.facturas.index', $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-danger'])!!}                        
              </div>
            </div>
            {!!Form::close()!!}

            <div class="col-md-12" style="margin-top: 30px">
              <h4 style="font-weight: bold">Instrucciones para la carga de facturas</h4>
              <p style="font-weight: bold"><a href="{{ asset('uploads/facturas/ejemplo/modelo_csv_factura_conjunto.csv') }}" title="descargar ejemplo de factura" target="_blank"><i class="fa fa-download"></i> Descargar ejemplo de factura</a></p>
              <p>-Cada campo debe estar separado por punto y coma ( ; )</p>
              <p>-Cada factura se separa por un salto de linea.</p>
              <h5 style="font-weight: bold;color: #888488;font-size: 15px;">Campos a colocar en el archivo (por orden)</h5>
              <ul>
                <li>NOMBRE DEL CONJUNTO. (Este debe coincidir exactamente con el nombre de su conjunto).</li>
                <li><span style="color:red;font-size: 13px;">*</span>NIT DEL CONJUNTO. (Este debe coincidir exactamente con el NIT de su conjunto).</li>
                <li>DIRECCION DEL CONJUNTO.</li>
                <li>TLF DEL CONJUNTO.</li>
                <li><span style="color:red;font-size: 13px;">*</span>FECHA MES Y DIA DE CORTE. (En el siguiente formato yyyy-mm-dd, ejm: 2018-03-15)</li>
                <li>NOMBRE DE LA PROPIETARIA DEL INMUEBLE.</li>
                <li>NUEVAMENTE DIRECCION DEL CONJUNTO CON TORRE, APTO, CASA ETC.</li>
                <li><span style="color:red;font-size: 13px;">*</span>VALOR ADEUDADO. (En USD, formato maximo dos decimales, ejm: 500, 600, 500.50)</li>
                <li><span style="color:red;font-size: 13px;">*</span>CODIGO DEL INMUEBLE. (Este campo es el mas IMPORTANTE de la exportación, debe coincidir con la matrícula del apartamento).</li>
                <li><span style="color:red;font-size: 13px;">*</span>COEFICIENTE DEL INMUEBLE.</li>
                <li><span style="color:red;font-size: 13px;">*</span>CONCEPTO DEL PAGO.</li>
                <li><span style="color:red;font-size: 13px;">*</span>SALDO MES ANTERIOR.</li>
                <li><span style="color:red;font-size: 13px;">*</span>SALDO ANTERIOR.</li>
                <li><span style="color:red;font-size: 13px;">*</span>NUEVO SALDO.</li>
                <li><span style="color:red;font-size: 13px;">*</span>TOTAL DEL MES.</li>
                <li>CORREO ELECTRONICO DEL CONJUNTO.</li>
              </ul>
              <p>Los campos que NO esten señalados con <span style="color:red;font-size: 13px;">*</span> pueden ser sustituidos con la palabra NULL.</p>

              <p style="font-weight: bold"><a href="{{ asset('uploads/facturas/ejemplo/modelo_csv_factura_conjunto.csv') }}" title="descargar ejemplo de factura" target="_blank"><i class="fa fa-download"></i> Descargar ejemplo de factura</a></p>
            </div>
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
