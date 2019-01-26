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
          <h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold">Registra</span> Mascota</h3>
          <h4 class="text-info" style="text-align: center">Nuestras mascotas son parte importante de la familia y la comunidad, por tal razón queremos tenerlos en cuenta. ¡Es fácil registrarlos, recuerda que todos los campos son requeridos *.! </h4>
          <br>

          {!!Form::open(['route'=>'usuario.clubmascotas.store','method'=>'POST', 'files'=>'true'])!!}
          <div class="row">

            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('tipo', 'Tipo de Mascota' )!!}
                <select class="form-control" data-init-plugin="select2" id="tipo" name="tipo" >
                  <optgroup label="Tipo de Mascota">
                    <option value="Gato">Gato</option>
                    <option value="Perro">Perro</option>
                  </optgroup>
                </select>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('nombre', 'Nombre de tu Mascota')!!}
                {!!Form::text ('nombre', null, ['class'=>'form-control', 'style'=>'width:100%', 'placeholder'=>'Ingresa el nombre de tu Mascota'])!!}
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group" >
                {!!Form::label('genero', 'Genero de tu Mascota', ['class'=>'form-label', 'style'=>'width:100%'])!!}
                <div class="radio radio-success">
                  <input type="radio" value="Hembra" name="genero" id="hembra">
                  <label for="hembra">Hembra</label>
                  <input type="radio" value="Macho" name="genero" id="macho">
                  <label for="macho">Macho</label>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('raza', 'Selecciona la raza de tu mascota' , ['class'=>'form-label'])!!}
                <select class="form-control" data-init-plugin="select2" id="raza" name="raza" style="width:100%;">
                  <optgroup label="Caninos">
                    <option value="Akita">Akita</option>
                    <option value="Australian Silky Terrier">Australian Silky Terrier</option>
                    <option value="Basenji">Basenji</option>
                    <option value="Basset Hound">Basset Hound</option>
                    <option value="Beagle">Beagle</option>
                    <option value="Bernes de la Montaña">Bernes de la Montaña</option>
                    <option value="Border Collie">Border Collie</option>
                    <option value="Boxer">Boxer</option>
                    <option value="Bull terrier">Bull terrier</option>
                    <option value="Bulldog">Bulldog</option>
                    <option value="Bull Mastiff">Bull Mastiff</option>
                    <option value="Caniche">Caniche</option>
                    <option value="Chihuahua">Chihuahua</option>
                    <option value="Chow Chow">Chow Chow</option>
                    <option value="Criollo">Criollo</option>
                    <option value="Cocker">Cocker</option>
                    <option value="Dalmata">Dalmata</option>
                    <option value="Doberman">Doberman</option>
                    <option value="Dogo">Dogo</option>
                    <option value="Fila">Fila</option>
                    <option value="Fox terrier">Fox terrier</option>
                    <option value="Galgo">Galgo</option>
                    <option value="Golden Retriever">Golden Retriever</option>
                    <option value="Gran Danes">Gran Danés</option>
                    <option value="Husky Siberiano">Husky Siberiano</option>
                    <option value="Jack Russell terrier">Jack Russell terrier</option>
                    <option value="Labrador">Labrador</option>
                    <option value="Mastin">Mastin</option>
                    <option value="Pastor Aleman">Pastor Alemán</option>
                    <option value="Pastor Belga">Pastor Belga</option>
                    <option value="Pastor Collie">Pastor Collie</option>
                    <option value="Pekines">Pekines</option>
                    <option value="Perdiguero">Perdiguero</option>
                    <option value="Pinscher">Pinscher</option>
                    <option value="Pitbull">Pitbull</option>
                    <option value="Pudel">Pudel</option>
                    <option value="Pug">Pug</option>
                    <option value="Rottweiler">Rottweiler</option>
                    <option value="Samoyedo">Samoyedo</option>
                    <option value="San Bernardo">San Bernardo</option>
                    <option value="Schnauzer">Schnauzer</option>
                    <option value="Setter">Setter</option>
                    <option value="Shar Pei">Shar Pei</option>
                    <option value="Shih Tzu">Shih Tzu</option>
                    <option value="Springer">Springer</option>
                    <option value="Terranova">Terranova</option>
                    <option value="Yorkshire terrier">Yorkshire terrier</option>
                  </optgroup>
                  <optgroup label="Felinos">
                    <option value="Abisinio">Abisinio</option>
                    <option value="Angora">Angora</option>
                    <option value="Azul Ruso">Azul Ruso</option>
                    <option value="Bengala">Bengala</option>
                    <option value="Bobtail">Bobtail</option>
                    <option value="Bombay">Bombay</option>
                    <option value="Burmes">Burmes</option>
                    <option value="Criollo">Criollo</option>
                    <option value="Egipcio">Egipcio</option>
                    <option value="Himalayo">Himalayo</option>
                    <option value="Korat">Korat</option>
                    <option value="Ocicat">Ocicat</option>
                    <option value="Persa">Persa</option>
                    <option value="Ragdoll">Ragdoll</option>
                    <option value="Siames">Siames</option>
                    <option value="Snowshoe">Snowshoe</option>
                  </optgroup>
                </select>
              </div>
            </div>


            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('edad', 'Edad de tu Mascota')!!}
                {!!Form::text ('edad', null, ['class'=>'form-control', 'style'=>'width:100%', 'placeholder'=>'Edad en años Ej: 1 Año'])!!}
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group" >
                {!!Form::label('vacunas', 'Tu Mascota esta vacunada?', ['class'=>'form-label', 'style'=>'width:100%'])!!}
                <div class="radio radio-success">
                  <input type="radio"  value="1" name="vacunas" id="yes">
                  <label for="yes">SI</label>
                  <input type="radio"  value="0" name="vacunas" id="no">
                  <label for="no">NO</label>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group" style="margin-top:20px;">
                {!!Form::label('img_mascota','Carga una imagen de tu mascota', ['class'=>'form-label'])!!}
                {!!Form::file('img_mascota')!!}
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group" style="margin-top:20px;">
                <p class="text-primary">* Acepto que con el registro de Club Mascotas recibire información, publicidad y promociones con los datos de mis mascotas, los cuales estaran disponibles para los administradores del Conjunto Residencial y el uso en la plataforma</p>
                {!!Form::label('registrado','Acepto el registro y las condiciones del mismo', ['class'=>'form-label'])!!}
                {!!Form::checkbox('registrado', '1')!!}
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group" style="text-align:center;">
                {!!Form::submit('Registrar', ['class'=>'btn btn-primary'])!!}
                {!!link_to_route('usuario.clubmascotas.index', $title = 'Cancelar', $parameters = '', $attributes = ['class'=>'btn btn-danger'])!!}

              </div>
            </div>
          </div>
          {!!Form::close()!!}
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section ('footer')
@include ('layout.footer')
@stop
