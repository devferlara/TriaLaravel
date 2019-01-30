@extends('layout.admin')

@section('sidebar')
@include('backend.menu.superadmin')
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
					<h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold">Nuevo</span> Usuario</h3>
					<h4 class="text-info" style="text-align: center">Crear tus usuarios administradores y residentes completando el siguiente Formulario ¡Es fácil, recuerda que todos los campos son requeridos *.! </h4>
					<br>
					{!!Form::open(['route'=>'superadmin.usuarios.store','method'=>'POST'])!!}

					<div class="row">
						<div class="col-md-4">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('rol', 'Tipo de Usuario/Rol' )!!}

								<select class="form-control" data-init-plugin="select2" id="rol" name="rol">
									<optgroup label="Tipo de Usuario / Rol">
										<option value="SuperAdmin">Super Administrador</option>
										<option value="Administrador">Administrador Conjunto</option>
										<option value="ResidenteUsuario">Residente-Usuario</option>
										<option value="Socio">Socio</option>
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
							<div class="radio radio-success">
								<input type="radio" checked="checked" value="Femenino" name="genero" id="femenino">
								<label for="femenino">Femenino</label>
								<input type="radio" value="Masculino" name="genero" id="masculino">
								<label for="masculino">Masculino</label>
							</div>
						</div>



						<div class="col-md-4">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('nombres', 'Nombres')!!}
								{!!Form::text ('nombres', null, ['class'=>'form-control', 'placeholder'=>'Ingresa su Nombre'])!!}
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('apellidos', 'Apellidos')!!}
								{!!Form::text ('apellidos', null, ['class'=>'form-control', 'placeholder'=>'Ingresa sus Apellidos'])!!}
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('fecha_nacimiento', 'Fecha de Nacimiento')!!}
								{!!Form::date ('fecha_nacimiento', null, ['class'=>'form-control'])!!}
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('email', 'Correo Electrónico')!!}
								{!!Form::email ('email', null, ['class'=>'form-control', 'placeholder'=>'ejemplo@TriaGroup.com'])!!}
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('telefono','Teléfono')!!}
								{!!Form::text('telefono', null, ['class'=>'form-control'])!!}
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('celular', 'Celular')!!}
								{!!Form::text('celular', null, ['class'=>'form-control'])!!}
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('conjunto', 'Conjunto Residencial')!!}
								{{--*/ $conjuntosA[0]="Por favor seleccione una opcion"; foreach($conjuntos as $key=>$con){$conjuntosA[$key]=$con;}/*--}}
								{!!Form::select('conjunto', $conjuntosA, null, ['class' => 'form-control', 'id' => 'conjunto'])!!}
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('zona', 'Zona-Unidad')!!}
								{!!Form::select('zona', ['placeholder' => 'selecciona'], null, ['class' => 'form-control', 'id' => 'zona'])!!}
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('apartamento', 'Apartamento')!!}
								<select class="full-width form-control" id="apartamento" name="apartamento">
									<optgroup label="Seleccione un Apartamento ">
									</optgroup>
								</select>
							</div>
						</div>

						<div class="col-md-4">
							<div class="radio radio-success">
								<input type="radio" checked="checked" value="true" name="propietario" id="yes">
								<label for="yes">Propietario</label>
								<input type="radio"  value="false" name="propietario" id="no">
								<label for="no">Arrendatario</label>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('Usuario')!!}
								{!!Form::text ('username', null, ['class'=>'form-control', 'placeholder'=>'Crea un usuario'])!!}
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('Clave o Password')!!}
								{!!Form::password ('password', ['class'=>'form-control', 'placeholder'=>'Introduce una contraseña'])!!}
							</div>
						</div>

					</div>

					{!!Form::submit('Crear', ['class'=>'btn btn-primary'])!!}

					{!!link_to_route('superadmin.usuarios.index', $title = 'Cancelar', $parameters = '', $attributes = ['class'=>'btn btn-danger'])!!}

					{!!Form::close()!!}
				</div>
			</div>
		</div>
	</div>
</div>


@endsection



@section ('footer')

@include ('layout.footer')
{!!Html::script('build/assets/js/script/listarzonas.js?v=1')!!}
{!!Html::script('build/assets/js/script/listaraptos.js?v=1')!!}
@stop

