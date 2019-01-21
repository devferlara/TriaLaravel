
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
				<div class="col-12 col-md-10 mx-auto my-auto padding_login_movil">
					<div class="card auth-card ">
						<div class="position-relative image-side " style="background-image: url({{ asset('build/assets/imagenes/login-balloon.jpg') }}">

							<p class=" text-white h2">MAGIC IS IN THE DETAILS</p>

							<p class="white mb-0">
								Please use your credentials to login.
								<br>If you are not a member, please
								<a href="#" class="white">register</a>.
							</p>
						</div>
						<div class="form-side ">
							<img src="{{ asset('build/assets/img/logo_login.png') }}">
							<h6 class="mb-4" style="font-weight: bold">Recover password</h6>
							<form method="POST" action="/password/email">
								{!! csrf_field() !!}
								<div class="form-group has-float-label mb-4">
									<label>Email</label>
									<input type="email" name="email" class="form-control" placeholder="Ingresa tu email" value="{{ old('email') }}" />
								</div>

								<div class="form-group">
									<button type="submit" class="btn btn-primary">Recuperar</button>
								</div>
							</form>
							{!!link_to('/login', $title = 'Volver al Login', $attributes = null, $secure = null)!!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	{!!Html::script('build/assets/js_new/vendor/jquery-3.3.1.min.js')!!}
	{!!Html::script('build/assets/js_new/vendor/bootstrap.bundle.min.js')!!}
	{!!Html::script('build/assets/js_new/dore.script.js')!!}
	{!!Html::script('build/assets/js_new/scripts.js')!!}

</body>

</html>