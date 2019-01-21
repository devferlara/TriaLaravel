<!DOCTYPE html>
<html>
<head>
 
	<title>TRIA- Propiedad Horizontal</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	{!!Html::style('build/assets/font/iconsmind/style.css')!!}
	{!!Html::style('build/assets/font/simple-line-icons/css/simple-line-icons.css')!!}
	{!!Html::style('build/assets/css_new/vendor/bootstrap.min.css')!!}
	{!!Html::style('build/assets/css_new/estilos.css')!!}
	{!!Html::style('build/assets/css_new/vendor/perfect-scrollbar.css')!!}
	{!!Html::style('build/assets/css_new/main.css')!!}

</head>
<body id="app-container" class="menu-default show-spinner">
	<nav class="navbar fixed-top">
		<div class="d-flex align-items-center navbar-left">
			<a href="#" class="menu-button d-none d-md-block">
				<svg class="main" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 17">
					<rect x="0.48" y="0.5" width="7" height="1" />
					<rect x="0.48" y="7.5" width="7" height="1" />
					<rect x="0.48" y="15.5" width="7" height="1" />
				</svg>
				<svg class="sub" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17">
					<rect x="1.56" y="0.5" width="16" height="1" />
					<rect x="1.56" y="7.5" width="16" height="1" />
					<rect x="1.56" y="15.5" width="16" height="1" />
				</svg>
			</a>

			<a href="#" class="menu-button-mobile d-xs-block d-sm-block d-md-none">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 17">
					<rect x="0.5" y="0.5" width="25" height="1" />
					<rect x="0.5" y="7.5" width="25" height="1" />
					<rect x="0.5" y="15.5" width="25" height="1" />
				</svg>
			</a>
		</div>


		<a class="navbar-logo" href="Dashboard.Default.html">
			<img class="logo_principal_admin" src="{{ asset('build/assets/img/logo_login.png') }}" >
		</a>

		<div class="navbar-right">
			<div class="header-icons d-inline-block align-middle">

				<button class="header-icon btn btn-empty d-none d-sm-inline-block" type="button" id="fullScreenButton">
					<i class="simple-icon-size-fullscreen"></i>
					<i class="simple-icon-size-actual"></i>
				</button>

			</div>

			<div class="user d-inline-block">
				<button class="btn btn-empty p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span class="name">{{ Auth::user()->nombres }} {{ Auth::user()->apellidos }}</span>
					<span>
						<img src="{{ asset('build/assets/img/profiles/user.png') }}" alt="" data-src="{{ asset('build/assets/img/profiles/user.png') }}" data-src-retina="{{ asset('build/assets/img/profiles/user.png') }}" width="32" height="32">
					</span>
				</button>

				<div class="dropdown-menu dropdown-menu-right mt-3">
					<a class="dropdown-item" href="#">Support</a>
					<a class="dropdown-item" href="#">Sign out</a>
				</div>
			</div>
		</div>
	</nav>

	<div class="sidebar">
		<div class="main-menu">
			<div class="scroll">
				<ul class="list-unstyled">

					<li>
						<a href="/superadmin">
							<i class="simple-icon-home"></i> Inicio
						</a>
					</li>
					<li class="active">
						<a href="#ui">
							<i class="simple-icon-folder-alt"></i> Gestionar
						</a>
					</li>

					<li>
						<a href="#menu">
							<i class="iconsmind-Globe"></i> Actividad
						</a>
					</li>

					<li>
						<a href="#configurador">
							<i class="iconsmind-Folder-Settings"></i> Configurador
						</a>
					</li>

				</ul>
			</div>
		</div>

		<div class="sub-menu sub_menu_estilos">
			<div class="scroll">
				<ul class="list-unstyled" data-link="ui">
					<li class="titulo_en_sub_menu">
						Propiedad
					</li>
					<hr>
					<li>
						<a href="{{url('/superadmin/conjuntos')}}">
							<i class="iconsmind-Hotel"></i> Conjuntos
						</a>
					</li>

					<li>
						<a href="{{url('/superadmin/zonas')}}">
							<i class="iconsmind-Map-Marker2"></i> Zonas
						</a>
					</li>

					<li>
						<a href="{{url('/superadmin/apartamentos')}}">
							<i class="iconsmind-Home-3"></i> Apartamentos
						</a>
					</li>

					<li class="titulo_en_sub_menu">
						Pagos
					</li>
					<hr>
					<li>
						<a href="{{url('/superadmin/pagosmembresias')}}">
							<i class="simple-icon-badge"></i> Membresias
						</a>
					</li>

					<li>
						<a target="_blank" href="{{url('/superadmin/pagosanuncios')}}">
							<i class="iconsmind-Add"></i> Anuncios
						</a>
					</li>

					<hr style="margin-top: 20px;">

					<li class="titulo_en_sub_menu">
						<a target="_blank" href="{{url('/superadmin/usuarios')}}">
							<i class="simple-icon-people"></i> Usuarios
						</a>
					</li>
					
					

					

				</ul>

				<ul class="list-unstyled" data-link="menu">
					<li class="titulo_en_sub_menu">
						Descuentos
					</li>
					<hr>
					<li>
						<a href="{{url('/superadmin/publicidad/bonos')}}">
							<i class="iconsmind-Dollar"></i> Bonos de Descuento
						</a>
					</li>

					<li>
						<a href="{{url('/superadmin/publicidad/clubmascotas')}}">
							<i class="iconsmind-Sea-Dog"></i> Club Mascotas
						</a>
					</li>

					<li>
						<a href="{{url('/superadmin/publicidad/clubmotor')}}">
							<i class="iconsmind-Car-3"></i> Club Motor
						</a>
					</li>

					<hr style="margin-top: 20px;">

					<li class="titulo_en_sub_menu">
						<a target="_blank" href="{{url('/superadmin/anuncios')}}">
							<i class="iconsmind-Add"></i> Anuncios
						</a>
					</li>

					<hr style="margin-top: 20px;">

					<li class="titulo_en_sub_menu">
						<a target="_blank" href="{{url('/superadmin/mensajes')}}">
							<i class="simple-icon-envelope-letter"></i> Mensajes
						</a>
					</li>

					<hr style="margin-top: 20px;">

					<li class="titulo_en_sub_menu">
						<a target="_blank" href="{{url('/superadmin/bancos')}}">
							<i class="iconsmind-Dollar-Sign2"></i> Bancos
						</a>
					</li>

				</ul>

				<ul class="list-unstyled" data-link="configurador">
					<li class="titulo_en_sub_menu">
						<a target="_blank" href="{{url('/superadmin/conceptos')}}">
							<i class="iconsmind-Conference"></i> Concepto Publicitario
						</a>
					</li>

					<hr style="margin-top: 20px;">

					<li class="titulo_en_sub_menu">
						<a target="_blank" href="{{url('/superadmin/valores')}}">
							<i class="iconsmind-Dollar-Sign"></i> Valores
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<main>
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<h1>Inicio</h1>
				</div>
			</div>

			<div class="row">

				<div class="col-6 text-center">

					<div class="card mb-4">
						<div class="card-body ">
							<img class="logo_index_admin"  src="{{ asset('build/assets/img/logo_login.png') }}" >
						</div>
					</div>
					
				</div>

				<div class="col-6">
					<h6 style="font-weight: bold">BIENVENIDO(A) {{ Auth::user()->nombres }}</h6>
					<h1>Plataforma TRIA</h1>
					<p class="list-item-heading mb-4">Bienvenido! Desde esta sección podrás administrar todo el aplicativo TRIA, donde tendras disponible herramientas para crear conjuntos, usuarios, bonos, noticias y demás funcionalidades que tiene el aplicativo. Fácil y sin complicaciones podras acceder a información detallada para que tengas un control total!</p>
				</div>


			</div>
		</div>
	</main>

</body>
</html>

{!!Html::script('build/assets/js_new/vendor/jquery-3.3.1.min.js')!!}
{!!Html::script('build/assets/js_new/vendor/bootstrap.bundle.min.js')!!}
{!!Html::script('build/assets/js_new/vendor/perfect-scrollbar.min.js')!!}
{!!Html::script('build/assets/js_new/vendor/mousetrap.min.js')!!}
{!!Html::script('build/assets/js_new/dore.script.js')!!}
{!!Html::script('build/assets/js_new/scripts.js')!!}