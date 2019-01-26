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
    <div class="col-lg-12 col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold">Registra</span> Vehiculo</h3>
          <h4 class="text-info" style="text-align: center">Tienes Vehiculo y quieres registrarlo. En el Club Motor HGV queremos tenerlos en cuenta. ¡Es fácil registralo, recuerda que todos los campos son requeridos *.! </h4>
          <br>
          {!!Form::open(['route'=>'usuario.clubmotor.store','method'=>'POST'])!!}
          <div class="row">

            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('tipo', 'Tipo de Vehiculo')!!}
                <select class="form-control" data-init-plugin="select2" id="tipo" name="tipo" style="width:100%;">
                  <optgroup label="Tipo de Mascota">
                    <option value="Automovil">Automóvil</option>
                    <option value="Bicicleta">Bicicleta</option>
                    <option value="Bicimotor">Bicicleta a Motor</option>
                    <option value="Camioneta">Camioneta</option>
                    <option value="Motocicleta">Motocicleta</option>
                  </optgroup>
                </select>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('placa', 'Placa del Vehiculo')!!}
                {!!Form::text ('placa', null, ['class'=>'form-control', 'style'=>'width:100%', 'placeholder'=>'Ingresa la placa'])!!}
              </div>
            </div>


            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('cantidad', 'Selecciona la cantidad de vehiculos' , ['class'=>'form-label'])!!}
                <select class="form-control" data-init-plugin="select2" id="cantidad" name="cantidad" style="width:100%">
                  <optgroup label="Cantidad">
                    <option value="0">Selecciona</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                  </optgroup>
                </select>
              </div>
            </div>


            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('marca', 'Selecciona la marca de tu vehiculo' , ['class'=>'form-label'])!!}
                <select class="form-control" data-init-plugin="select2" id="marca" name="marca" style="width:100%;">
                  <optgroup label="Marca de tu Vehiculo">
                    <option value="0">Selecciona</option>
                    <option value="Audi">Audi</option>
                    <option value="BMW">BMW</option>
                    <option value="Brilliance">Brilliance</option>
                    <option value="BYD">BYD</option>
                    <option value="Chana">Chana</option>
                    <option value="Chevrolet">Chevrolet</option>
                    <option value="Chrysler">Chrysler</option>
                    <option value="Citroen">Citroen</option>
                    <option value="Daewoo">Daewoo</option>
                    <option value="Daihatsu">Daihatsu</option>
                    <option value="Dodge">Dodge</option>
                    <option value="Fiat">Fiat</option>
                    <option value="Ford">Ford</option>
                    <option value="Great Wall">Great Wall</option>
                    <option value="Honda">Honda</option>
                    <option value="Hyundai">Hyundai</option>
                    <option value="Jeep">Jeep</option>
                    <option value="Kia">Kia</option>
                    <option value="Lada">Lada</option>
                    <option value="Land Rover">Land Rover</option>
                    <option value="Mahindra">Mahindra</option>
                    <option value="Mazda">Mazda</option>
                    <option value="Mercedes Benz">Mercedez Benz</option>
                    <option value="MG">MG</option>
                    <option value="Mini">Mini</option>
                    <option value="Mitsubishi">Mitsubishi</option>
                    <option value="Nissan">Nissan</option>
                    <option value="Peugeot">Peugeot</option>
                    <option value="Porsche">Porsche</option>
                    <option value="Renault">Renault</option>
                    <option value="Seat">Seat</option>
                    <option value="Skoda">Skoda</option>
                    <option value="Ssang Young">Ssang Young</option>
                    <option value="Subaru">Subaru</option>
                    <option value="Suzuki">Suzuki</option>
                    <option value="Toyota">Toyota</option>
                    <option value="Volkswagen">Volkswagen</option>
                    <option value="Volvo">Volvo</option>
                    <option value="Zotye">Zotye</option>
                    <option value="Otra">Otra</option>
                  </optgroup>
                  <optgroup label="Marca de tu Motocicleta">
                    <option value="AKT">AKT</option>
                    <option value="Aprilia">Aprilia</option>
                    <option value="Auteco">Auteco</option>
                    <option value="Bajaj">Bajaj</option>
                    <option value="BMW">BMW</option>
                    <option value="Ducati">Ducati</option>
                    <option value="Harley Davidson">Harley Davidson</option>
                    <option value="Honda">Honda</option>
                    <option value="Kawasaki">Kawasaki</option>
                    <option value="Kymco">Kymco</option>
                    <option value="KTM">KTM</option>
                    <option value="Royal Enfield">Royal Enfield</option>
                    <option value="Suzuki">Suzuki</option>
                    <option value="Triumph">Triumph</option>
                    <option value="Vespa">Vespa</option>
                    <option value="Yamaha">Yamaha</option>
                    <option value="Otra">Otra</option>
                  </optgroup>
                  <optgroup label="Bicicleta">
                    <option value="Bicicleta">Bicicleta</option>
                  </optgroup>
                </select>
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
                {!!Form::label('color', 'Selecciona el color de tu vehiculo')!!}
                <select class="form-control" data-init-plugin="select2" id="color" name="color" style="width:100%;">
                  <optgroup label="Color del Vehiculo">
                    <option value="0">Selecciona</option>
                    <option value="Amarillo">Amarillo</option>
                    <option value="Azul">Azul</option>
                    <option value="Blanco">Blanco</option>
                    <option value="Beige">Beige</option>
                    <option value="Cafe">Café</option>
                    <option value="Celeste">Celeste</option>
                    <option value="Crema">Crema</option>
                    <option value="Dorado">Dorado</option>
                    <option value="Esmeralda">Esmeralda</option>
                    <option value="Fucsia">Fucsia</option>
                    <option value="Granate">Granate</option>
                    <option value="Gris">Gris</option>
                    <option value="Limon">Limon</option>
                    <option value="Marron">Marron</option>
                    <option value="Morado">Morado</option>
                    <option value="Naranja">Naranja</option>
                    <option value="Negro">Negro</option>
                    <option value="Plata">Plata</option>
                    <option value="Rojo">Rojo</option>
                    <option value="Verde">Verde</option>
                  </optgroup>
                </select>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('parqueadero', 'Tiene servicio de Parqueadero?')!!}
                <select class="form-control" data-init-plugin="select2" id="parqueadero" name="parqueadero" style="width:100%">
                  <option value="0">NO</option>
                  <option value="1">SI</option>
                </select>
              </div>
            </div>

            <div id= "mostrardatosparqueadero" class="col-md-8" >
              <div class="row">
                <div class="col-md-6 form-group" >
                  {!!Form::label('tipo_parqueadero', 'Tipo de Parqueadero', ['class'=>'form-label', 'style'=>'width:100%'])!!}
                  <div class="radio radio-success">
                    <input type="radio" value="Comunal" name="tipo_parqueadero" id="comunal" checked>
                    <label for="comunal">Comunal</label>
                    <input type="radio" value="Privado" name="tipo_parqueadero" id="privado">
                    <label for="privado">Privado</label>
                  </div>
                </div>
                <div class="col-md-6" >
                  <div class="form-group has-float-label mb-4">
                    {!!Form::label('numero_parqueadero','Número de Parqueadero', ['class'=>'form-label'])!!}
                    {!!Form::text('numero_parqueadero', null, ['class'=>'form-control', 'placeholder'=>'Ingrese el # de parqueadero'])!!}
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group col-md-12" style="margin-top:20px;">
              <p class="text-primary">* Acepto que con el registro de Club Motor recibire información, publicidad y promociones con los datos de mis vehiculos, los cuales estaran disponibles para los administradores del Conjunto Residencial y el uso en la plataforma</p>
              {!!Form::label('registrado','Acepto el registro y las condiciones del mismo', ['class'=>'form-label'])!!}
              {!!Form::checkbox('registrado', '1')!!}
            </div>

            <div class="form-group col-md-12" style="padding:20px;">
              {!!Form::submit('Registrar', ['class'=>'btn btn-primary'])!!}
              {!!link_to_route('usuario.clubmotor.index', $title = 'Cancelar', $parameters = '', $attributes = ['class'=>'btn btn-danger'])!!}
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

