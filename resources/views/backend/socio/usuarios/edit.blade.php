@extends('layout.admin')



@section ('meta')

    <meta name="viewport" content="width=device-width, initial-scale=1">

@stop

<!-- Create General Section Sidebar -->

@section('sidebar')

    <!-- Include the menu -->

    @include('backend.menu.administrador')

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

                		<h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold">Actualizar</span> Usuario</h3>

            		</div>

            	<div class="panel panel-body" style="padding:20px;">

					{!!Form::model($usuario,['route'=> ['administrador.usuarios.update',$usuario->id],'method'=>'PUT'])!!}

					<div class="form-inline">

						<div class="form-group">

							{!!Form::label('rol', 'Tipo de Usuario/Rol' , ['class'=>'form-control'])!!}

							{!!Form::select('rol',['Administrador'=>'Administrador Conjunto','Socio'=>'Socio'])!!}

						</div>

						<div class="form-group">

							{!!Form::label('identificacion', 'Identificación', ['class'=>'form-control'])!!}

							{!!Form::text ('identificacion', null, ['class'=>'form-control'])!!}

						</div>

						<div class="form-group">

							{!!Form::label('genero', 'Genero' , ['class'=>'form-control'])!!}

							{!!Form::select('genero', ['Femenino'=>'Femenino', 'Masculino'=>'Masculino'])!!}

						</div>

					</div>

					<div class="form-group">

						{!!Form::label('nombres', 'Nombres', ['class'=>'form-control'])!!}

						{!!Form::text ('nombres', null, ['class'=>'form-control'])!!}

					</div>

					<div class="form-group">

						{!!Form::label('apellidos', 'Apellidos', ['class'=>'form-control'])!!}

						{!!Form::text ('apellidos', null, ['class'=>'form-control'])!!}

					</div>



					<div class="form-inline">

						<div class="form-group">

							{!!Form::label('fecha_nacimiento', 'Fecha de Nacimiento', ['class'=>'form-control'])!!}

							{!!Form::date ('fecha_nacimiento', null, ['class'=>'form-control'])!!}

						</div>



						<div class="form-group">

							{!!Form::label('email', 'Correo Electrónico', ['class'=>'form-control'])!!}

							{!!Form::email ('email', null, ['class'=>'form-control'])!!}

						</div>

					</div>	



					<div class="form-group">

						{!!Form::label('telefono','Teléfono', ['class'=>'form-control'])!!}

						{!!Form::text('telefono', null, ['class'=>'form-control'])!!}

					</div>



					<div class="form-group">

						{!!Form::label('celular', 'Celular', ['class'=>'form-control'])!!}

						{!!Form::text('celular', null, ['class'=>'form-control'])!!}

					</div>



					<div class="form-group">

						{!!Form::label('Usuario')!!}

						{!!Form::text ('username', null, ['class'=>'form-control', 'placeholder'=>'Crea un usuario'])!!}

					</div>



					<div class="form-group">

						{!!Form::label('Clave o Password')!!}

						{!!Form::password ('password', ['class'=>'form-control', 'placeholder'=>'Introduce una contraseña'])!!}

					</div>



						{!!Form::submit('Actualizar', ['class'=>'btn btn-primary'])!!}

						{!!link_to_route('administrador.usuarios.index', $title = 'Cancelar', $parameters = '', $attributes = ['class'=>'btn btn-danger'])!!}

					{!!Form::close()!!}

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

@endsection



@section ('footer')

 @include ('layout.footer')

@stop



@section ('specific_js')



@stop