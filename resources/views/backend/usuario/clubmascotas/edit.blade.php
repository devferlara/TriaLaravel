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
            Mascota
          </h3>
          <h4 class="text-info text-center">Nuestras mascotas son parte importante de la familia y la comunidad, por tal razón queremos tenerlos en cuenta. ¡Ahora que ya estas registrado, solo debes actualizar cuantas veces quieras. *.!</h4>
          <br>

          {!!Form::model($mascota,['route'=> ['usuario.clubmascotas.update', $mascota->id],'method'=>'PUT', 'files'=>'true'])!!}
          <div class="row">

            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('tipo', 'Tipo de Mascota' )!!}
                {!!Form::select('tipo',['Gato'=>'Gato', 'Perro'=>'Perro'],null, ['class'=>'form-control'])!!}
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('nombre', 'Nombre de tu Mascota')!!}
                {!!Form::text('nombre', null, ['class'=>'form-control', 'style'=>'width:100%', 'placeholder'=>'Ingresa el nombre de tu Mascota'])!!}
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group" >
                {!!Form::label('genero', 'Genero de tu Mascota', ['class'=>'form-label', 'style'=>'width:100%'])!!}
                {!!Form::label('hembra', 'Hembra', ['class'=>'form-label'])!!}
                {!!Form::radio('genero','Hembra', ['class'=>'radio radio-success'])!!}
                {!!Form::label('macho', 'Macho', ['class'=>'form-label'])!!}
                {!!Form::radio('genero','Macho')!!}
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('raza', 'Selecciona la raza de tu mascota' , ['class'=>'form-label'])!!}
                {!!Form::select('raza',['Perros' =>['Akita'=>'Akita', 'Australian Silky Terrier'=>'Australian Silky Terrier','Basenji'=>'Basenji','Basset Hound'=>'Basset Hound','Beagle'=>'Beagle','Bernes de la Montaña'=>'Bernes de la Montaña','Border Collie'=>'Border Collie','Boxer'=>'Boxer','Bull terrier'=>'Bull terrier','Bulldog'=>'Bulldog','Bull Mastiff'=>'Bull Mastiff','Caniche'=>'Caniche','Chihuahua'=>'Chihuahua','Chow Chow'=>'Chow Chow','Criollo'=>'Criollo','Cocker'=>'Cocker','Dalmata'=>'Dalmata','Doberman'=>'Doberman','Dogo'=>'Dogo','Fila'=>'Fila','Fox terrier'=>'Fox terrier','Galgo'=>'Galgo','Golden Retriever'=>'Golden Retriever','Gran Danes'=>'Gran Danés','Husky Siberiano'=>'Husky Siberiano','Jack Russell terrier'=>'Jack Russell terrier','Labrador'=>'Labrador','Mastin'=>'Mastin','Pastor Aleman'=>'Pastor Alemán','Pastor Belga'=>'Pastor Belga','Pastor Collie'=>'Pastor Collie','Pekines'=>'Pekines','Perdiguero'=>'Perdiguero','Pinscher'=>'Pinscher','Pitbull'=>'Pitbull','Pudel'=>'Pudel','Pug'=>'Pug','Rottweiler'=>'Rottweiler','Samoyedo'=>'Samoyedo','San Bernardo'=>'San Bernardo','Schnauzer'=>'Schnauzer','Setter'=>'Setter','Shar Pei'=>'Shar Pei','Shih Tzu'=>'Shih Tzu','Springer'=>'Springer','Terranova'=>'Terranova','Yorkshire terrier'=>'Yorkshire terrier'],'Gatos' =>['Abisinio'=>'Abisinio','Angora'=>'Angora','Abisinio'=>'Abisinio','Azul Ruso'=>'Azul Ruso','Bengala'=>'Bengala','Bobtail'=>'Bobtail','Bombay'=>'Bombay','Burmes'=>'Burmes','Criollo'=>'Criollo','Egipcio'=>'Egipcio','Himalayo'=>'Himalayo','Korat'=>'Korat','Ocicat'=>'Ocicat','Persa'=>'Persa','Ragdoll'=>'Ragdoll','Siames'=>'Siames','Snowshoe'=>'Snowshoe']],null, ['class'=>'form-control'])!!}
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
                {!!Form::label('si', 'SI', ['class'=>'form-label'])!!}
                {!!Form::radio('vacunas','1', ['class'=>'radio radio-success'])!!}
                {!!Form::label('no', 'NO', ['class'=>'form-label'])!!}
                {!!Form::radio('vacunas','0')!!}
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                {!!Form::label('img_mascota','Cambiar la imagen de tu mascota', ['class'=>'form-label'])!!}
                {!!Form::file('img_mascota')!!}
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group" style="text-align:center;">
                {!!Form::submit('Actualizar', ['class'=>'btn btn-primary'])!!}
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