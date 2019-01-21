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
				<div class="card-body ">
					<h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold">Nuevo</span> Anuncio Publicitario- Bono de Descuento</h3>
					<h4 class="text-info" style="text-align: center">Podrás crear anuncios publicitarios promocionando servicios y productos cubriendo los interés de tu comunidad. </h4>
					<br>
					{!!Form::open(['route'=>'administrador.usuarios.store','method'=>'POST'])!!}
					<div class="row">
						<div class="col-md-4">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('rol', 'Tipo de Usuario/Rol')!!}
								<select class="form-group form-control" data-init-plugin="select2" id="rol" name="rol">
									<optgroup label="Tipo de Usuario / Rol">
										<option value="ResidenteUsuario">Residente-Usuario</option>
									</optgroup>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group has-float-label mb-4">

								{!!Form::label('identificacion', 'Identificación')!!}
								{!!Form::text ('identificacion', null, ['class'=>'form-control', 'placeholder'=>'Ingresa tu número de identificación'])!!}
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group ">
								<div class="radio radio-success">
									<label style="width: 100%">Sexo</label>
									<input type="radio" checked="checked" value="Femenino" name="genero" id="femenino">
									<label for="femenino">Femenino</label>
									<input type="radio" value="Masculino" name="genero" id="masculino">
									<label for="masculino">Masculino</label>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('nombres', 'Nombres')!!}
								{!!Form::text ('nombres', null, ['class'=>'form-control', 'placeholder'=>'Ingresa su Nombre'])!!}
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('apellidos', 'Apellidos')!!}
								{!!Form::text ('apellidos', null, ['class'=>'form-control', 'placeholder'=>'Ingresa sus Apellidos'])!!}
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('fecha_nacimiento', 'Fecha de Nacimiento')!!}
								{!!Form::date ('fecha_nacimiento', null, ['class'=>'form-control'])!!}
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('email', 'Correo Electrónico')!!}
								{!!Form::email ('email', null, ['class'=>'form-control', 'placeholder'=>'ejemplo@msglobal.com'])!!}
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('telefono','Teléfono')!!}
								{!!Form::text('telefono', null, ['class'=>'form-control'])!!}
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('celular', 'Celular')!!}
								{!!Form::text('celular', null, ['class'=>'form-control'])!!}
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('conjunto', 'Conjunto Residencial')!!}
								<select class="full-width form-control" data-init-plugin="select2" id="conjunto" name="conjunto">
									<optgroup label="Asigne un Conjunto Residencial">
										@foreach ($data as $conjunto)
										<option value="{{$conjunto->id}}">{{$conjunto->nombre}}</option>
										@endforeach
									</optgroup>
								</select>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('zona', 'Zona-Unidad')!!}
								<select class="full-width form-control" data-init-plugin="select2" id="zona" name="zona">
									<optgroup label="Seleccione una Unidad">
										<option value="" selected disabled>Seleccione una zona</option>
										@foreach($conjunto->zonas as $zonas)
										<option value="{{ $zonas->id}}">{{ $zonas->tipo }} {{ $zonas->zona }}</option>
										@endforeach
									</optgroup>
								</select>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('apartamento', 'Apartamento')!!}
								<select class="full-width form-control" id="apartamento" name="apartamento">
									<optgroup label="Seleccione un Apartamento ">
									</optgroup>
								</select>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<div class="radio radio-success">
									<div style="width: 100%">
										<label>Tipo</label>
									</div>
									<input type="radio" checked="checked" value="true" name="propietario" id="yes">
									<label for="yes">Propietario</label>
									<input type="radio"  value="false" name="propietario" id="no">
									<label for="no">Arrendatario</label>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('Usuario')!!}
								{!!Form::text ('username', null, ['class'=>'form-control', 'placeholder'=>'Crea un usuario'])!!}
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('Clave o Password')!!}
								{!!Form::password ('password', ['class'=>'form-control', 'placeholder'=>'Introduce una contraseña'])!!}
							</div>
						</div>

					</div>

					{!!Form::submit('Crear', ['class'=>'btn btn-primary'])!!}

					{!!link_to_route('administrador.usuarios.index', $title = 'Cancelar', $parameters = '', $attributes = ['class'=>'btn btn-danger'])!!}

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



@section('specific_js')

{!!Html::script('build/assets/js/script/listaraptos.js')!!}

@stop