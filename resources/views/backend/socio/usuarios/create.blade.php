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

                		<h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold">Nuevo</span> Usuario</h3>

            			</br>

                		<h5 class="text-info">Crear tus usuarios residentes completando el siguiente Formulario ¡Es fácil, recuerda que todos los campos son requeridos *.! </h5>

            		</div>

            	<div class="panel panel-body" style="padding:20px;">

					{!!Form::open(['route'=>'administrador.usuarios.store','method'=>'POST'])!!}

					<div class="form-inline">

						<div class="form-group">

							{!!Form::label('rol', 'Tipo de Usuario/Rol' , ['class'=>'form-control'])!!}

							<select class="form-group" data-init-plugin="select2" id="rol" name="rol">

                                <optgroup label="Tipo de Usuario / Rol">

                                    <option value="ResidenteUsuario">Residente-Usuario</option>
                                    <option value="Socio">Socio</option>

                                </optgroup>

                            </select>

						</div>

						<div class="form-group">

							{!!Form::label('identificacion', 'Identificación', ['class'=>'form-control'])!!}

							{!!Form::text ('identificacion', null, ['class'=>'form-control', 'placeholder'=>'Ingresa tu número de identificación'])!!}

						</div>

						<div class="form-group">

							<div class="radio radio-success">

                            <input type="radio" checked="checked" value="Femenino" name="genero" id="femenino">

                            <label for="femenino">Femenino</label>

                            <input type="radio" value="Masculino" name="genero" id="masculino">

                            <label for="masculino">Masculino</label>

                        	</div>

						</div>

					</div>

					<div class="form-group">

						{!!Form::label('nombres', 'Nombres', ['class'=>'form-control'])!!}

						{!!Form::text ('nombres', null, ['class'=>'form-control', 'placeholder'=>'Ingresa su Nombre'])!!}

					</div>

					<div class="form-group">

						{!!Form::label('apellidos', 'Apellidos', ['class'=>'form-control'])!!}

						{!!Form::text ('apellidos', null, ['class'=>'form-control', 'placeholder'=>'Ingresa sus Apellidos'])!!}

					</div>

					<div class="form-inline">

						<div class="form-group">

							{!!Form::label('fecha_nacimiento', 'Fecha de Nacimiento', ['class'=>'form-control'])!!}

							{!!Form::date ('fecha_nacimiento', null, ['class'=>'form-control'])!!}

						</div>

						<div class="form-group">

							{!!Form::label('email', 'Correo Electrónico', ['class'=>'form-control'])!!}

							{!!Form::email ('email', null, ['class'=>'form-control', 'placeholder'=>'ejemplo@triagroup.com'])!!}

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

						{!!Form::label('conjunto', 'Conjunto Residencial', ['class'=>'form-control'])!!}

						<select class="full-width" data-init-plugin="select2" id="conjunto" name="conjunto">

                                <optgroup label="Asigne un Conjunto Residencial">

                                	@foreach ($data as $conjunto)

                                	<option value="{{$conjunto->id}}">{{$conjunto->nombre}}</option>

                                	@endforeach

                                </optgroup>

                        </select>

                    </div>

					<div id="mostrarzonayapartamento">

					<div class="form-group">

						{!!Form::label('zona', 'Zona-Unidad', ['class'=>'form-control'])!!}

						<select class="full-width" data-init-plugin="select2" id="zona" name="zona">

                                <optgroup label="Seleccione una Unidad">

                                    @foreach($conjunto->zonas as $zonas)

                                    <option value="{{ $zonas->id}}">{{ $zonas->tipo }} {{ $zonas->zona }}</option>

                                    @endforeach

                                </optgroup>

                         </select>

					</div>

					<div class="form-group">

						{!!Form::label('apartamento', 'Apartamento', ['class'=>'form-control'])!!}

						<select class="full-width form-control" id="apartamento" name="apartamento">

                                <optgroup label="Seleccione un Apartamento ">

                                </optgroup>

                         </select>

					</div>

					<div class="form-group">

						<div class="radio radio-success">

                            <input type="radio" checked="checked" value="true" name="propietario" id="yes">

                            <label for="yes">Propietario</label>

                            <input type="radio"  value="false" name="propietario" id="no">

                            <label for="no">Arrendatario</label>

                        </div>

					</div>

					</div>

					<div class="form-group">

						{!!Form::label('Usuario')!!}

						{!!Form::text ('username', null, ['class'=>'form-control', 'placeholder'=>'Crea un usuario'])!!}

					</div>

					<div class="form-group">

						{!!Form::label('Clave o Password')!!}

						{!!Form::password ('password', ['class'=>'form-control', 'placeholder'=>'Introduce una contraseña'])!!}

					</div>

						{!!Form::submit('Crear', ['class'=>'btn btn-primary'])!!}

						{!!link_to_route('administrador.usuarios.index', $title = 'Cancelar', $parameters = '', $attributes = ['class'=>'btn btn-danger'])!!}

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



@section('specific_js')

	{!!Html::script('build/assets/js/script/listaraptos.js')!!}

@stop