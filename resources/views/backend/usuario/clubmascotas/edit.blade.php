@extends('layout.admin')

@section ('meta')
    <meta name="viewport" content="width=device-width, initial-scale=1">
@stop
<!-- Create General Section Sidebar -->
@section('sidebar')
    <!-- Include the menu -->
    @include('backend.menu.usuario')
@endsection
        <!-- Create General Section Header -->
@section('head')
    <!-- Include the profile header--> 
    @include ('layout.head')
@endsection

@section ('content')
<div class="page-content-wrapper">
    <div class="content">
    @include ('errors.success')
	@include ('errors.request')
	@include ('errors.errors')			
		<div class="col-md-1"></div>

			<div class="panel-group col-md-10">
				<div class="panel panel-info">
					<div class="panel-heading">
                        <i class="fa fa-paw" style="font-size: 50px;"></i>
                		<h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold">Actualizar tu </span> Mascota</h3>
            			</br>
                		<h5 class="text-info">Nuestras mascotas son parte importante de la familia y la comunidad, por tal razón queremos tenerlos en cuenta. ¡Ahora que ya estas registrado, solo debes actualizar cuantas veces quieras. *.! </h5>
            		</div>
            	<div class="panel panel-body" style="padding:30px;">
					{!!Form::model($mascota,['route'=> ['usuario.clubmascotas.update', $mascota->id],'method'=>'PUT', 'files'=>'true'])!!}
					<div class="form-inline">
						<div class="form-group">
							{!!Form::label('tipo', 'Tipo de Mascota' , ['class'=>'form-label', 'style'=>'width:100%'])!!}
                            {!!Form::select('tipo',['Gato'=>'Gato', 'Perro'=>'Perro'],null, ['style'=>'width:100%'])!!}
						</div>
						<div class="form-group">
							{!!Form::label('nombre', 'Nombre de tu Mascota', ['class'=>'form-label', 'style'=>'width:100%'])!!}
							{!!Form::text('nombre', null, ['class'=>'form-control', 'style'=>'width:100%', 'placeholder'=>'Ingresa el nombre de tu Mascota'])!!}
						</div>
                        <div class="form-group" style="text-align:center;">
                            {!!Form::label('genero', 'Genero de tu Mascota', ['class'=>'form-label', 'style'=>'width:100%'])!!}
                            {!!Form::label('hembra', 'Hembra', ['class'=>'form-label'])!!}
                            {!!Form::radio('genero','Hembra', ['class'=>'radio radio-success'])!!}
                            {!!Form::label('macho', 'Macho', ['class'=>'form-label'])!!}
                            {!!Form::radio('genero','Macho')!!}
                        </div>
					</div>
					<div class="form-group" style="margin-top:20px;">
						{!!Form::label('raza', 'Selecciona la raza de tu mascota' , ['class'=>'form-label'])!!}
                        {!!Form::select('raza',[
                            'Perros' =>[
                            'Akita'=>'Akita', 
                            'Australian Silky Terrier'=>'Australian Silky Terrier',
                            'Basenji'=>'Basenji',
                            'Basset Hound'=>'Basset Hound',
                            'Beagle'=>'Beagle',
                            'Bernes de la Montaña'=>'Bernes de la Montaña',
                            'Border Collie'=>'Border Collie',
                            'Boxer'=>'Boxer',
                            'Bull terrier'=>'Bull terrier',
                            'Bulldog'=>'Bulldog',
                            'Bull Mastiff'=>'Bull Mastiff',
                            'Caniche'=>'Caniche',
                            'Chihuahua'=>'Chihuahua',
                            'Chow Chow'=>'Chow Chow',
                            'Criollo'=>'Criollo',
                            'Cocker'=>'Cocker',
                            'Dalmata'=>'Dalmata',
                            'Doberman'=>'Doberman',
                            'Dogo'=>'Dogo',
                            'Fila'=>'Fila',
                            'Fox terrier'=>'Fox terrier',
                            'Galgo'=>'Galgo',
                            'Golden Retriever'=>'Golden Retriever',
                            'Gran Danes'=>'Gran Danés',
                            'Husky Siberiano'=>'Husky Siberiano',
                            'Jack Russell terrier'=>'Jack Russell terrier',
                            'Labrador'=>'Labrador',
                            'Mastin'=>'Mastin',
                            'Pastor Aleman'=>'Pastor Alemán',
                            'Pastor Belga'=>'Pastor Belga',
                            'Pastor Collie'=>'Pastor Collie',
                            'Pekines'=>'Pekines',
                            'Perdiguero'=>'Perdiguero',
                            'Pinscher'=>'Pinscher',
                            'Pitbull'=>'Pitbull',
                            'Pudel'=>'Pudel',
                            'Pug'=>'Pug',
                            'Rottweiler'=>'Rottweiler',
                            'Samoyedo'=>'Samoyedo',
                            'San Bernardo'=>'San Bernardo',
                            'Schnauzer'=>'Schnauzer',
                            'Setter'=>'Setter',
                            'Shar Pei'=>'Shar Pei',
                            'Shih Tzu'=>'Shih Tzu',
                            'Springer'=>'Springer',
                            'Terranova'=>'Terranova',
                            'Yorkshire terrier'=>'Yorkshire terrier'],
                            'Gatos' =>[
                            'Abisinio'=>'Abisinio',
                            'Angora'=>'Angora',
                            'Abisinio'=>'Abisinio',
                            'Azul Ruso'=>'Azul Ruso',
                            'Bengala'=>'Bengala',
                            'Bobtail'=>'Bobtail',
                            'Bombay'=>'Bombay',
                            'Burmes'=>'Burmes',
                            'Criollo'=>'Criollo',
                            'Egipcio'=>'Egipcio',
                            'Himalayo'=>'Himalayo',
                            'Korat'=>'Korat',
                            'Ocicat'=>'Ocicat',
                            'Persa'=>'Persa',
                            'Ragdoll'=>'Ragdoll',
                            'Siames'=>'Siames',
                            'Snowshoe'=>'Snowshoe'
                            ]],null, ['style'=>'width:100%']
                            )!!}
					</div>

                    <div class="form-inline">
                        <div class="form-group">
                            {!!Form::label('edad', 'Edad de tu Mascota', ['class'=>'form-label', 'style'=>'width:100%'])!!}
                            {!!Form::text ('edad', null, ['class'=>'form-control', 'style'=>'width:100%', 'placeholder'=>'Edad en años Ej: 1 Año'])!!}
                        </div>
                        <div class="form-group" style="text-align:center;">
                            {!!Form::label('vacunas', 'Tu Mascota esta vacunada?', ['class'=>'form-label', 'style'=>'width:100%'])!!}
                            {!!Form::label('si', 'SI', ['class'=>'form-label'])!!}
                            {!!Form::radio('vacunas','1', ['class'=>'radio radio-success'])!!}
                            {!!Form::label('no', 'NO', ['class'=>'form-label'])!!}
                            {!!Form::radio('vacunas','0')!!}
                        </div>
                    </div>

					<div class="form-group" style="margin-top:20px;">
						{!!Form::label('img_mascota','Cambiar la imagen de tu mascota', ['class'=>'form-label'])!!}
						{!!Form::file('img_mascota', ['class'=>'btn btn-success'])!!}
					</div>

					<div class="form-group" style="text-align:center;">
						{!!Form::submit('Actualizar', ['class'=>'btn btn-primary'])!!}
						{!!link_to_route('usuario.clubmascotas.index', $title = 'Cancelar', $parameters = '', $attributes = ['class'=>'btn btn-danger'])!!}
					    {!!Form::close()!!}
					</div>
				</div>
			</div>
		<div class="col-md-1"></div>
	</div>
	<div class="col-md-12">
		<hr>
	</div>
</div>
</div>
@endsection

@section ('footer')
 @include ('layout.footer')
@stop