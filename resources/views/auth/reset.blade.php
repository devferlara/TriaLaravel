@extends('layout.admin')
@section('meta')
    <html lang="es">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>Tria Group Aplicativo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="apple-touch-icon" href="pages/ico/60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="pages/ico/76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="pages/ico/120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="pages/ico/152.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="Ingreso a plataforma de Administración MS Global" name="description"/>
    <meta content="Administraciones MS Global" name="author"/>
@endsection
@section ('content')
@include ('errors.errors')
@include ('errors.request')
@include ('errors.success')

<div class="login-wrapper ">
	<div class="bg-pic">
        <!-- START Background Pic-->
        <img src="{{ asset('build/assets/img/Login.jpg') }}" data-src="{{ asset('build/assets/img/Login.jpg') }}" data-src-retina="{{ asset('build/assets/img/Login.jpg')}}" alt="" class="lazy">
        <!-- END Background Pic-->
        <!-- START Background Caption-->
        <div class="bg-caption pull-bottom sm-pull-bottom text-white p-l-20 m-b-20">
        
        </div>
        <!-- END Background Caption-->
	</div>
	<div class="login-container bg-white">
		<div class="p-l-50 m-l-20 p-r-50 m-r-20 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">
			<img src="{{ asset('home/images/LogoTria.png') }}" alt="logo" data-src="{{ asset('home/images/LogoTria.png') }}" data-src-retina="home/images/LogoTria.png') }}" class="logo-ico" style="width: 60%;">
			<p class="p-t-35">Recuperar Contraseña</p>
			<form method="POST" action="/password/reset">
				{!! csrf_field() !!}
				<input type="hidden" name="token" value="{{ $token }}">
				<div class="form-group">
					<label>Email</label>
					<input type="email" name="email" class="form-control" placeholder="Ingresa tu email" value="{{ old('email') }}" />
				</div>
				<div class="form-group">
					<label>Contraseña</label>
					<input type="password" name="password" class="form-control" />
				</div>
				<div class="form-group">
					<label>Confirmar Contraseña</label>
					<input type="password" name="password_confirmation" class="form-control" />
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Recuperar</button>
				</div>
			</form>
		</div>
		
	</div>
			
    
</div>
@stop
