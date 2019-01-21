@extends('layout.admin')

@section ('meta')
<meta name="viewport" content="width=device-width, initial-scale=1">
@stop
<!-- Create General Section Sidebar -->
@section('sidebar')
@if(Auth::user()->rol == 'Administrador')

<!-- Include the menu -->
@include('backend.menu.administrador')


@elseif(Auth::user()->rol == 'SuperAdmin')

<!-- Include the menu -->
@include('backend.menu.superadmin')

@endif

@endsection
<!-- Create General Section Header -->
@section('head')
<!-- Include the profile header--> 
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
					<h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold">Nuevo</span> text</h3>
					<h4 class="text-info" style="text-align: center">Crear el conjunto completando el siguiente Formulario ¡Es fácil, recuerda que todos los campos son requeridos *.! </h4>
					<br>
					@if(Auth::user()->rol == 'Administrador')
					{!!Form::open(['route'=> 'administrador.conjuntos.store','method'=>'POST', 'files'=>'true'])!!}
					@elseif(Auth::user()->rol == 'SuperAdmin')
					{!!Form::open(['route'=> 'superadmin.conjuntos.store','method'=>'POST', 'files'=>'true'])!!}
					@endif
					<div class="row">
						<div class="col-md-4">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('tipo','Tipo de Propiedad')!!}
								<select class="full-width form-control" style="margin-bottom:8px;" data-init-plugin="select2" id="tipo" name="tipo" style="width: 100%">
									<optgroup label="Tipo de Propiedad">
										<option value="Apartamentos">Apartamentos</option>
										<option value="Bodegas">Bodegas</option>
										<option value="Casas">Casas</option>
										<option value="Locales">Locales</option>
										<option value="Oficinas">Oficinas</option>
									</optgroup>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('nit', 'NIT')!!}
								{!!Form::text ('nit', null, ['class'=>'form-control', 'placeholder'=>'Ingresa el número de NIT'])!!}
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('nombre', 'Nombre')!!}
								{!!Form::text ('nombre', null, ['class'=>'form-control', 'placeholder'=>'Ingresa el Nombre del Conjunto'])!!}
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('pais', 'Pais' )!!}
								<select class="form-group form-control" data-init-plugin="select2" id="pais" name="pais" style="width:100%;">
									<option value="" selected disabled>Seleccione un país</option>
									<optgroup label="Paises">
										@foreach($paises as $pais)
										<option value="{{$pais->Codigo}}">{{$pais->Pais}}</option>
										@endforeach
									</optgroup>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('ciudad', 'Ciudad')!!}
								<select class=" form-control" data-init-plugin="select2" id="ciudad" name="ciudad" style="width:100%;">
									<optgroup label="Escoge una Ciudad">

									</optgroup>
								</select>
							</div>
						</div>
						<div class="col-md-3" >
							<div class="form-group has-float-label mb-4">
								{!!Form::label('localidad', 'Localidad')!!}
								{!!Form::text('localidad', null, ['class'=>'form-control', 'style'=>'width:100%', 'placeholder'=>'Ingrese una localidad'])!!}
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('barrio','Barrio')!!}
								{!!Form::text('barrio', null, ['class'=>'form-control','style'=>'width:100%', 'placeholder'=>'Ingrese el nombre del barrio'])!!}
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group has-float-label mb-4" >
								{!!Form::label('direccion','Dirección')!!}
								{!!Form::text('direccion', null, ['class'=>'form-control','style'=>'width:100%', 'placeholder'=>'Ingrese la dirección del conjunto'])!!}			
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('telefono', 'Teléfono')!!}
								{!!Form::text('telefono', null, ['class'=>'form-control','style'=>'width:100%', 'placeholder'=>'Ingrese el teléfono'])!!}
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('estrato', 'Estrato')!!}
								<select class="form-control" data-init-plugin="select2" id="estrato" name="estrato" style="width:100%;">
									<optgroup label="Escoge un Estrato">
										<option value="Uno">Uno</option>
										<option value="Dos">Dos</option>
										<option value="Tres">Tres</option>
										<option value="Cuatro">Cuatro</option>
										<option value="Cinco">Cinco</option>
										<option value="Seis">Seis</option>
									</optgroup>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group has-float-label mb-4" >
								{!!Form::label('telefono_cuadrante', 'Teléfono Cuadrante')!!}
								{!!Form::text('telefono_cuadrante', null, ['class'=>'form-control', 'style'=>'width:100%', 'placeholder'=>'Ingrese el teléfono del cuadrante'])!!}
							</div>
						</div>


						<div class="col-md-4">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('horario_administracion','Horario Administración')!!}
								{!!Form::text('horario_administracion', null, ['class'=>'form-control','style'=>'width:100%', 'placeholder'=>'Horario Admin. Ejemplo: Lunes a Viernes de 8 AM a 5 PM'])!!}
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('map_latitud', 'Latitud Mapa')!!}
								{!!Form::text ('map_latitud', null, ['class'=>'form-control', 'placeholder'=>'Ingresa el Nombre del Conjunto', 'style'=>'width:100%'])!!}
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('map_longitud', 'Longitud Mapa')!!}
								{!!Form::text ('map_longitud', null, ['class'=>'form-control', 'placeholder'=>'Ingresa el Nombre del Conjunto', 'style'=>'width:100%'])!!}
							</div>
						</div>
					</div>
					<div class="form-group" style="margin-top:10px;" >
						{!!Form::submit('Crear', ['class'=>'btn btn-primary'])!!}
						{!!link_to_route('superadmin.conjuntos.index', $title = 'Cancelar', $parameters = '', $attributes = ['class'=>'btn btn-danger'])!!}
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

@stop

@section ('specific_js')

{!!Html::script('build/assets/js/script/listarciudades.js?v=1')!!}


@stop