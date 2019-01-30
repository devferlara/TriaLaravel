@extends('layout.admin')

@section ('meta')
<meta name="viewport" content="width=device-width, initial-scale=1">
@stop

@section('sidebar')
@include('backend.menu.usuario')
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
        <div class="card-body ">
          <h3 class="p-b-5 text-primary" style="text-align:center;">
            <span class="semi-bold">Actualizar tu</span>
            Vehiculo
          </h3>
          <h4 class="text-info text-center">Ahora que ya tienes vehiculos registrados en el Club Motor, solo debes actualizarlos cuantas veces quieras. Recuerda que todos los campos son requeridos *.!</h4>
          <br>

          {!!Form::model($vehiculo,['route'=> ['usuario.clubmotor.update', $vehiculo->id],'method'=>'PUT'])!!}
          <div class="row">

            <div class="col-md-4 ">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('tipo', 'Tipo de Vehiculo' )!!}
                {!!Form::select('tipo',['Automovil'=>'Automóvil', 'Bicicleta'=>'Bicicleta','Bicimotor'=>'Bicicleta a Motor','Camioneta'=>'Camioneta','Motocicleta'=>'Motocicleta',],null, ['class'=>'form-control','style'=>'width:100%'])!!}
              </div>
            </div>

            <div class="col-md-4 form-group">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('placa', 'Placa del Vehiculo')!!}
                {!!Form::text ('placa', null, ['class'=>'form-control', 'style'=>'width:100%', 'placeholder'=>'Ingresa la placa'])!!}
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('cantidad', 'Selecciona la cantidad de vehiculos' , ['class'=>'form-label'])!!}
                {!!Form::select('cantidad',['1'=>'1', '2'=>'2','3'=>'3','4'=>'4'],null, ['class'=>'form-control','style'=>'width:100%'])!!}
              </div>
            </div>

            <div class="col-md-4" >
              <div class="form-group has-float-label mb-4">
                {!!Form::label('marca', 'Selecciona la marca de tu vehiculo' , ['class'=>'form-label'])!!}
                {!!Form::select('marca',['Vehiculos' =>['Audi'=>'Audi', 'BMW'=>'BMW','Brilliance'=>'Brilliance','BYD'=>'BYD','Chana'=>'Chana','Chevrolet'=>'Chevrolet','Chrysler'=>'Chrysler','Citroen'=>'Citroen','Daewoo'=>'Daewoo','Daihatsu'=>'Daihatsu','Dodge'=>'Dodge','Fiat'=>'Fiat','Ford'=>'Ford','Great Wall'=>'Great Wall','Honda'=>'Honda','Hyundai'=>'Hyundai','Jeep'=>'Jeep','Kia'=>'Kia','Lada'=>'Lada','Land Rover'=>'Land Rover','Mahindra'=>'Mahindra','Mazda'=>'Mazda','Mercedes Benz'=>'Mercedes Benz','MG'=>'MG','Mini'=>'Mini','Mitsubishi'=>'Mitsubishi','Nissan'=>'Nissan','Peugeot'=>'Peugeot','Porsche'=>'Porsche','Renault'=>'Renault','Seat'=>'Seat','Skoda'=>'Skoda','Ssang Young'=>'Ssang Young','Subaru'=>'Subaru','Suzuki'=>'Suzuki','Toyota'=>'Toyota','Volkswagen'=>'Volkswagen','Volvo'=>'Volvo','Zotye'=>'Zotye','Otra'=>'Otra'],'Motocicletas' =>['AKT'=>'AKT','Aprilia'=>'Aprilia','Auteco'=>'Auteco','Bajaj'=>'Bajaj','BMW'=>'BMW','Ducati'=>'Ducati','Harley Davidson'=>'Harley Davidson','Honda'=>'Honda','Kawasaki'=>'Kawasaki','Kymco'=>'Kymco','KTM'=>'KTM','Royal Enfield'=>'Royal Enfield','Suzuki'=>'Suzuki','Triumph'=>'Triumph','Vespa'=>'Vespa','Yamaha'=>'Yamaha','Otra'=>'Otra'],'Bicicletas' =>['Bicicleta'=>'Bicicleta','Bicimotor'=>'Bicicleta a Motor'],],null, ['class'=>'form-control','style'=>'width:100%'])!!}
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('modelo', 'Modelo de tu Vehiculo')!!}
                {!!Form::text ('modelo', null, ['class'=>'form-control', 'style'=>'width:100%', 'placeholder'=>'Modelo del Vehiculo Ej: Aveo - Mazda 3 - etc'])!!}
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('color', 'Selecciona el color de tu vehiculo' , ['class'=>'form-label'])!!}
                {!!Form::select('color',['Color del Vehiculo' =>['Amarillo'=>'Amarillo', 'Azul'=>'Azul','Blanco'=>'Blanco','Beige'=>'Beige','Cafe'=>'Café','Celeste'=>'Celeste','Crema'=>'Crema','Dorado'=>'Dorado','Esmeralda'=>'Esmeralda','Fucsia'=>'Fucsia','Granate'=>'Granate','Gris'=>'Gris','Limon'=>'Limón','Marron'=>'Marron','Morado'=>'Morado','Naranja'=>'Naranja','Negro'=>'Negro','Plata'=>'Plata','Rojo'=>'Rojo','Verde'=>'Verde'],],null, ['class'=>'form-control','style'=>'width:100%'])!!}
              </div>
            </div>

            <div class="col-md-4" >
              <div class="form-group has-float-label mb-4">
                {!!Form::label('parqueadero', 'Tiene servicio de Parqueadero?', ['class'=>'form-label', 'style'=>'width:100%'])!!}
                {!!Form::select('parqueadero',['0'=>'NO', '1'=>'SI'],null, ['class'=>'form-control','style'=>'width:100%'])!!}
              </div>
            </div>


            <div id= "mostrardatosparqueadero" class="col-md-8">
              <div class="row">
                <div class="col-md-6 form-group">
                  {!!Form::label('tipo_parqueadero', 'Tipo de Parqueadero', ['class'=>'form-label', 'style'=>'width:100%'])!!}
                  {!!Form::label('comunal', 'Comunal', ['class'=>'form-label'])!!}
                  {!!Form::radio('tipo_parqueadero','Comunal', ['class'=>'radio radio-success'])!!}
                  {!!Form::label('privado', 'Privado', ['class'=>'form-label'])!!}
                  {!!Form::radio('tipo_parqueadero','Privado')!!}
                </div>
                <div class="col-md-6">
                  <div class="form-group has-float-label mb-4">
                    {!!Form::label('numero_parqueadero','Número de Parqueadero', ['class'=>'form-label'])!!}
                    {!!Form::text('numero_parqueadero', null, ['class'=>'form-control', 'placeholder'=>'Ingrese el # de parqueadero'])!!}
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                {!!Form::submit('Actualizar', ['class'=>'btn btn-primary'])!!}
                {!!link_to_route('usuario.clubmotor.index', $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-danger'])!!}

              </div>
            </div>
            {!!Form::close()!!}

          </div>
        </div>
      </div>

    </div>
  </div>
</div>

@endsection

@section ('footer')
@include ('layout.footer')
{!!Html::script('build/assets/js/script/parqueadero.js')!!}
@stop

