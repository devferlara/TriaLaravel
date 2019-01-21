@extends('layout.admin')

@section ('meta')
<meta name="viewport" content="width=device-width, initial-scale=1">
@stop

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
				<div class="card-body">
					<h3 class="p-b-5 text-primary" style="text-align:center;">
						<span class="semi-bold">Actualizar</span>
						Usuario
					</h3>
					<br>

					{!!Form::model($usuario,['route'=> ['superadmin.usuarios.update',$usuario->id],'method'=>'PUT'])!!}

					<div class="row">
						<div class="col-md-6">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('rol', 'Tipo de Usuario/Rol' )!!}
								{!!Form::select('rol',['SuperAdmin'=>'Super Administrador', 'Administrador'=>'Administrador Conjunto', 'ResidenteUsuario'=>'Residente-Usuario', 'Socio'=>'Socio'],null,['class'=>'form-control'])!!}
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group has-float-label mb-4 ">
								{!!Form::label('identificacion', 'Identificación')!!}
								{!!Form::text ('identificacion', null, ['class'=>'form-control'])!!}
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('genero', 'Genero')!!}
								{!!Form::select('genero', ['Femenino'=>'Femenino', 'Masculino'=>'Masculino'],null,['class'=>'form-control'])!!}
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('nombres', 'Nombres')!!}
								{!!Form::text ('nombres', null, ['class'=>'form-control'])!!}
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('apellidos', 'Apellidos')!!}
								{!!Form::text ('apellidos', null, ['class'=>'form-control'])!!}
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
								{!!Form::email ('email', null, ['class'=>'form-control'])!!}
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
					{!!Form::submit('Actualizar', ['class'=>'btn btn-primary'])!!}
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
@stop
