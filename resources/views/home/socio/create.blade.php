
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Dore jQuery</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	{!!Html::style('build/assets/font/iconsmind/style.css')!!}
	{!!Html::style('build/assets/font/simple-line-icons/css/simple-line-icons.css')!!}
	{!!Html::style('build/assets/css_new/vendor/bootstrap.min.css')!!}
	{!!Html::style('build/assets/css_new/estilos.css')!!}
	{!!Html::style('build/assets/css_new/vendor/bootstrap-float-label.min.css')!!}
	{!!Html::style('build/assets/css_new/vendor/bootstrap-datepicker3.min.css')!!}
	{!!Html::style('build/assets/css_new/main.css')!!}

</head>

<body class="background show-spinner login_estilos_css">
	<div class="fixed-background" style="background-image: url({{ asset('build/assets/img/login.jpg') }})"></div>

	<main>
		@include ('errors.errors')
		@include ('errors.request')
		@include ('errors.success')
		<div class="container">
			<div class="row h-100">
				<div class="col-12 col-md-8 mx-auto my-auto padding_login_movil width_register">
					<div class="card auth-card ">
						
						<div class="form-side ">
							<div>
								<img src="{{ asset('build/assets/img/logo_login.png') }}">
								<h6 class="mb-4" style="font-weight: bold">Registro de Nuevo Socio</h6>


								
								{!!Form::open(['route'=>'socioStore','method'=>'POST'])!!}


								<div class="form-group has-float-label mb-4">
									{!!Form::label('identificacion', 'Identificacion')!!}
									{!!Form::text ('identificacion', null, ['required'=>'required','class'=>'form-control', 'placeholder'=>'Ingresa tu numero de identificacion'])!!}
								</div>

								<div class="form-group">
									<div class="radio radio-success">
										<input type="radio" checked="checked" value="Femenino" name="genero" id="femenino">
										<label for="femenino">Femenino</label><br>
										<input type="radio" value="Masculino" name="genero" id="masculino">
										<label for="masculino">Masculino</label>
									</div>
								</div>


								<div class="form-group has-float-label mb-4">
									{!!Form::label('nombres', 'Nombres')!!}
									{!!Form::text ('nombres', null, ['required'=>'required','class'=>'form-control', 'placeholder'=>'Ingresa su Nombre'])!!}
								</div>

								<div class="form-group has-float-label mb-4">
									{!!Form::label('apellidos', 'Apellidos')!!}
									{!!Form::text ('apellidos', null, ['required'=>'required','class'=>'form-control', 'placeholder'=>'Ingresa sus Apellidos'])!!}
								</div>

								<div class="form-group has-float-label mb-4">
									{!!Form::label('fecha_nacimiento', 'Fecha de Nacimiento')!!}
									{!!Form::date ('fecha_nacimiento', null, ['required'=>'required','class'=>'form-control'])!!}
								</div>

								<div class="form-group has-float-label mb-4">
									{!!Form::label('email', 'Correo Electronico')!!}
									{!!Form::email ('email', null, ['required'=>'required','class'=>'form-control', 'placeholder'=>'ejemplo@TriaGroup.com'])!!}
								</div>

								

								<div class="form-group has-float-label mb-4">
									{!!Form::label('Clave')!!}
									{!!Form::password ('password', ['required'=>'required','class'=>'form-control', 'placeholder'=>'Introduce una clave'])!!}
								</div>

								<div class="form-group has-float-label mb-4">
									{!!Form::label('Confirmar Clave')!!}
									{!!Form::password ('password2', ['required'=>'required','class'=>'form-control', 'placeholder'=>'Confirma la clave'])!!}
								</div>

								<div class="form-group has-float-label mb-4">
									{!!Form::label('Telefono')!!}
									{!!Form::text ('telefono',null, ['required'=>'required','class'=>'form-control', 'placeholder'=>'Telefono de contacto'])!!}
								</div>

								<div class="form-group has-float-label mb-4">
									{!!Form::label('Celular')!!}
									{!!Form::text ('celular',null, ['required'=>'required','class'=>'form-control', 'placeholder'=>'Numero celular'])!!}
								</div>

								<div class="form-group has-float-label mb-4">
									{!!Form::label('Numero de cuotas pagadas')!!}
									{!!Form::text ('coutas', null, ['required'=>'required','class'=>'form-control', 'placeholder'=>'ingrese el numero de cuotas'])!!}
								</div>

								<div class="form-group">

									<div class="radio radio-success">

										<input type="radio" checked="checked" value="representacion" name="tipo" id="representacion">

										<label for="representacion">Representacion</label><br>

										<input type="radio" value="asociado" name="tipo" id="asociado">

										<label for="asociado">Asociado</label>

									</div>

								</div>


								{!!Form::submit('Crear', ['class'=>'btn btn-primary'])!!}

								<a href="{{ route('home1') }}" class="btn btn-danger">Cancelar</a>
							</div>
							{!!Form::close()!!}
							<br>
							{!!link_to('/login', $title = 'Volver al Login', $attributes = null, $secure = null)!!}
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

</main>
{!!Html::script('build/assets/js_new/vendor/jquery-3.3.1.min.js')!!}
{!!Html::script('build/assets/js_new/vendor/bootstrap.bundle.min.js')!!}
{!!Html::script('build/assets/js_new/dore.script.js')!!}
{!!Html::script('build/assets/js_new/vendor/bootstrap-datepicker.js')!!}
{!!Html::script('build/assets/js_new/scripts.js')!!}

</body>

</html>
