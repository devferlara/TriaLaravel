@extends('layout.admin')

@section ('meta')
    <meta name="viewport" content="width=device-width, initial-scale=1">
@stop
<!-- Create General Section Sidebar -->
@section('sidebar')
    <!-- Include the menu -->
    @include('backend.menu.superadmin')
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
                		<h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold"> Nuevo</span> Conjunto </h3>
            			</br>
                		<h5 class="text-info">Crear el conjunto completando el siguiente Formulario ¡Es fácil, recuerda que todos los campos son requeridos *.! </h5>
            		</div>
            	<div class="panel panel-body" style="padding:20px;">
					{!!Form::open(['route'=>'superadmin.conjuntos.store','method'=>'POST', 'files'=>'true'])!!}
					<div class="form-inline">
						<div class="form-group" style="width:50%;">
							{!!Form::label('tipo','Tipo de Propiedad',['class'=>'form-control'])!!}
							<select class="full-width" style="margin-bottom:8px;" data-init-plugin="select2" id="tipo" name="tipo">
                                <optgroup label="Tipo de Propiedad">
                                    <option value="Apartamentos">Apartamentos</option>
                                    <option value="Bodegas">Bodegas</option>
                                    <option value="Casas">Casas</option>
                                    <option value="Locales">Locales</option>
                                    <option value="Oficinas">Oficinas</option>
                                </optgroup>
                            </select>
						</div>
						<div class="form-group">
							{!!Form::label('nit', 'NIT', ['class'=>'form-control'])!!}
							{!!Form::text ('nit', null, ['class'=>'form-control', 'placeholder'=>'Ingresa el número de NIT'])!!}
						</div>
					</div>
					<div class="form-group">
						{!!Form::label('nombre', 'Nombre', ['class'=>'form-control'])!!}
						{!!Form::text ('nombre', null, ['class'=>'form-control', 'placeholder'=>'Ingresa el Nombre del Conjunto'])!!}
					</div>
					<div class="form-inline">
						<div class="form-group col-xs-6-md-4">
							{!!Form::label('pais', 'Pais' , ['class'=>'form-control' , 'style'=>'width:100%'])!!}
							<select class="form-group" data-init-plugin="select2" id="pais" name="pais" style="width:100%;">
                                <optgroup label="Escoge un Pais">
                                    <option value="Colombia">Colombia</option>
                                </optgroup>
                            </select>
						</div>
						<div class="form-group col-xs-6-md-4">
							{!!Form::label('ciudad', 'Ciudad', ['class'=>'form-control' , 'style'=>'width:100%'])!!}
							<select class="" data-init-plugin="select2" id="ciudad" name="ciudad" style="width:100%;">
                                <optgroup label="Escoge una Ciudad">
                                    <option value="Bogota">Bogotá</option>
                                    <option value="Barranquilla">Barranquilla</option>
                                    <option value="Bucaramanga">Bucaramanga</option>
                                    <option value="Cali">Cali</option>
                                    <option value="Cartagena">Cartagena</option>
                                    <option value="Funza">Funza</option>
                                    <option value="Medellin">Medellín</option>
                                    <option value="Medellin">Mosquera</option>
                                </optgroup>
                            </select>
						</div>
						<div class="form-group col-xs-6-md-4" >
							{!!Form::label('localidad', 'Localidad', ['class'=>'form-control' , 'style'=>'width:100%'])!!}
							{!!Form::text('localidad', null, ['class'=>'form-control', 'style'=>'width:100%', 'placeholder'=>'Ingrese una localidad'])!!}
						</div>
						<div class="form-group col-xs-6-md-4">
							{!!Form::label('barrio','Barrio', ['class'=>'form-control', 'style'=>'width:100%'])!!}
							{!!Form::text('barrio', null, ['class'=>'form-control','style'=>'width:100%', 'placeholder'=>'Ingrese el nombre del barrio'])!!}
						</div>
					</div>
					<div class="form-group" style="margin-top:10px;" >
						{!!Form::label('direccion','Dirección', ['class'=>'form-control', 'style'=>'width:100%'])!!}
						{!!Form::text('direccion', null, ['class'=>'form-control','style'=>'width:100%', 'placeholder'=>'Ingrese la dirección del conjunto'])!!}			
					</div>
					<div class="form-inline">
						<div class="form-group col-xs-6-md-4">
							{!!Form::label('telefono', 'Teléfono' , ['class'=>'form-control' , 'style'=>'width:100%'])!!}
							{!!Form::text('telefono', null, ['class'=>'form-control','style'=>'width:100%', 'placeholder'=>'Ingrese el teléfono'])!!}
						</div>
						<div class="form-group col-xs-6-md-4">
							{!!Form::label('estrato', 'Estrato', ['class'=>'form-control' , 'style'=>'width:100%'])!!}
							<select class="" data-init-plugin="select2" id="estrato" name="estrato" style="width:100%;">
                                <optgroup label="Escoge un Estrato">
                                    <option value="Uno">Uno</option>
                                    <option value="Dos">Dos</option>
                                    <option value="Tres">Tres</option>
                                    <option value="Cuatro">Cuatro</option>
                                    <option value="Cinco">Cinco</option>
                                    <option value="Seis">Seis</option>
                                </optgroup>
                            </select>
						</div>
						<div class="form-group col-xs-6-md-4" >
							{!!Form::label('telefono_cuadrante', 'Teléfono Cuadrante', ['class'=>'form-control' , 'style'=>'width:100%'])!!}
							{!!Form::text('telefono_cuadrante', null, ['class'=>'form-control', 'style'=>'width:100%', 'placeholder'=>'Ingrese el teléfono del cuadrante'])!!}
						</div>
					</div>
						<div class="form-group" style="margin-top:10px;">
							{!!Form::label('horario_administracion','Horario Administración', ['class'=>'form-control', 'style'=>'width:100%'])!!}
							{!!Form::text('horario_administracion', null, ['class'=>'form-control','style'=>'width:100%', 'placeholder'=>'Horario Admin. Ejemplo: Lunes a Viernes de 8 AM a 5 PM'])!!}
						</div>
					<div class="form-inline">
					<div class="form-group">
						{!!Form::label('map_latitud', 'Latitud Mapa', ['class'=>'form-control', 'style'=>'width:100%'])!!}
						{!!Form::text ('map_latitud', null, ['class'=>'form-control', 'placeholder'=>'Ingresa el Nombre del Conjunto', 'style'=>'width:100%'])!!}
					</div>
					<div class="form-group">
						{!!Form::label('map_longitud', 'Longitud Mapa', ['class'=>'form-control', 'style'=>'width:100%'])!!}
						{!!Form::text ('map_longitud', null, ['class'=>'form-control', 'placeholder'=>'Ingresa el Nombre del Conjunto', 'style'=>'width:100%'])!!}
					</div>
					</div>
					<div class="form-group" style="margin-top:10px;" >
						{!!Form::submit('Crear', ['class'=>'btn btn-primary'])!!}
						{!!link_to_route('superadmin.conjuntos.index', $title = 'Cancelar', $parameters = '', $attributes = ['class'=>'btn btn-danger'])!!}
						{!!Form::close()!!}			
					</div>


				</div>
			</div>
		</div>
		<div class="col-md-1"></div>
	</div>
</div>
@endsection

@section ('footer')
 @include ('layout.footer')
@stop