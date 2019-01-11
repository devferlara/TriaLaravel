@extends ('layout.admin')

@section('meta')
    <html lang="es">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>Login - Tria Group Aplicativo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="apple-touch-icon" href="pages/ico/60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="pages/ico/76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="pages/ico/120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="pages/ico/152.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="Ingreso a plataforma de Administración Tria Group" name="description"/>
    <meta content="Administraciones Tria Group" name="author"/>
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
    		<img src="{{ asset('home/images/LogoTria.png') }}" alt="logo" data-src="{{ asset('home/images/LogoTria.png') }}" data-src-retina="{{ asset('home/images/LogoTria.png') }}" class="logo-ico" style="width: 60%;">
    		<p class="p-t-35">Ingresa tus datos de acceso</p>
{!!Form::open(['route'=>'login.store','method'=>'POST'])!!}
	<div class="form-group">
	{!!Form::label('Usuario')!!}
	{!!Form::text('username', null , ['class'=> 'form-control','placeholder' => 'Ingresa tu usuario'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('Contraseña')!!}
		{!!Form::password('password', ['class'=>'form-control', 'placeholder'=>'Ingresa tu contraseña'])!!}
	</div>
	<div class="form-group">
	{!!Form::submit('Ingresar', ['class'=>'btn btn-primary'])!!}
	</div>
{!!Form::close()!!}
{!!link_to('password/email', $title = 'Olvidaste tu contraseña?', $attributes = null, $secure = null)!!}
<br><br>
{!!link_to('/', $title = 'Volver a la pagina principal', $attributes = null, $secure = null)!!}
			<div class="pull-bottom sm-pull-bottom">
                <div class="m-b-30 p-r-80 sm-m-t-20 sm-p-r-15 sm-p-b-20 clearfix">
                    <div class="col-sm-9 no-padding m-t-10">
                        <h5><small>
                        Antes de crear su cuenta, por favor lea la politica y privacidad en el siguiente link <a href="/politicas" class="text-info">Politicas y Privacidad</a></small>
                        </h5>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
@stop