@extends ('layout.principal')



@section ('meta')

    <meta charset="UTF-8">

    <meta name="description" content="">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <meta http-equiv-"X-UA-Compatible" content="IE=edge"/>

<style>
.arvin-section-wrapper{
	padding-top:130px !important;
}
.arvin-main-menu{

	background:#4692c6 !important; 
	color:white !important; 
	margin-top:0px !important;

}
</style>
@stop



@section ('nav-bar')

<nav class="navbar arvin-main-menu" role="navigation">



@stop
</nav>



@section ('content')

<div style="clear:both"></div>
<section class="arvin-section-wrapper">
<div class="col-md-6 col-md-offset-3" >
@include ('errors.errors')
@include ('errors.request')
@include ('errors.success')

<h1 style="text-align:center">Registro de Nuevo Administrador</h1>
 
           
{!!Form::open(['route'=>'adminStore','method'=>'POST'])!!}


						<div class="form-group">

							{!!Form::label('identificacion', 'Identificacion', ['class'=>'form-control'])!!}

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


					<div class="form-group">

						{!!Form::label('nombres', 'Nombres', ['class'=>'form-control'])!!}

						{!!Form::text ('nombres', null, ['required'=>'required','class'=>'form-control', 'placeholder'=>'Ingresa su Nombre'])!!}

					</div>

					<div class="form-group">

						{!!Form::label('apellidos', 'Apellidos', ['class'=>'form-control'])!!}

						{!!Form::text ('apellidos', null, ['required'=>'required','class'=>'form-control', 'placeholder'=>'Ingresa sus Apellidos'])!!}

					</div>

					<div class="form-inline">

						<div class="form-group">

							{!!Form::label('fecha_nacimiento', 'Fecha de Nacimiento', ['class'=>'form-control'])!!}

							{!!Form::date ('fecha_nacimiento', null, ['required'=>'required','class'=>'form-control'])!!}

						</div>

						<div class="form-group">

							{!!Form::label('email', 'Correo Electronico', ['class'=>'form-control'])!!}

							{!!Form::email ('email', null, ['required'=>'required','class'=>'form-control', 'placeholder'=>'ejemplo@TriaGroup.com'])!!}

						</div>

					</div>	



					<div class="form-group">

						{!!Form::label('Clave')!!}

						{!!Form::password ('password', ['required'=>'required','class'=>'form-control', 'placeholder'=>'Introduce una clave'])!!}

					</div>

					<div class="form-group">

						{!!Form::label('Confirmar Clave')!!}

						{!!Form::password ('password2', ['required'=>'required','class'=>'form-control', 'placeholder'=>'Confirma la clave'])!!}

					</div>

					<div class="form-group">

						{!!Form::label('telefono', 'telefono', ['class'=>'form-control'])!!}

						{!!Form::text ('telefono', null, ['required'=>'required','class'=>'form-control', 'placeholder'=>'Ingrese su telefono de contacto'])!!}

					</div>

					<div class="form-group">

						{!!Form::label('celular', 'Celular', ['class'=>'form-control'])!!}

						{!!Form::text ('celular', null, ['required'=>'required','class'=>'form-control', 'placeholder'=>'Ingrese su numero Celular'])!!}

					</div>

						{!!Form::submit('Crear', ['class'=>'btn btn-primary'])!!}

						<a href="{{ route('home1') }}" class="btn btn-danger">Cancelar</a>
</div>
					{!!Form::close()!!}
 </div>
<div style="clear:both"></div>
</section>
@stop