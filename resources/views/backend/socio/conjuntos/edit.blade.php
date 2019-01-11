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
                		<h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold"> Actualizar </span> Conjunto </h3>
            			</br>
                		<h5 class="text-info">Actualiza el conjunto completando el siguiente Formulario ¡Es fácil, recuerda que todos los campos son requeridos *.! </h5>
            		</div>
            	<div class="panel panel-body" style="padding:20px;">
					{!!Form::model($conjunto,['route'=> ['administrador.conjuntos.update',$conjunto->id],'method'=>'PUT','files'=>'true'])!!}
					<div class="form-inline">
						<div class="form-group" style="width:50%;">
							{!!Form::label('tipo','Tipo de Propiedad',['class'=>'form-control'])!!}
							{!!Form::select('tipo',['Apartamentos'=>'Apartamentos', 'Bodegas'=>'Bodegas', 'Casas'=>'Casas', 'Locales'=>'Locales', 'Oficinas'=>'Oficinas'])!!}
						</div>
						<div class="form-group">
							{!!Form::label('nit', 'NIT', ['class'=>'form-control'])!!}
							{!!Form::text ('nit', null, ['class'=>'form-control'])!!}
						</div>
					</div>
					<div class="form-group">
						{!!Form::label('nombre', 'Nombre', ['class'=>'form-control'])!!}
						{!!Form::text ('nombre', null, ['class'=>'form-control'])!!}
					</div>
					<div class="form-inline">
						<div class="form-group col-xs-6-md-4">
							{!!Form::label('pais', 'Pais' , ['class'=>'form-control' , 'style'=>'width:100%'])!!}
							{!!Form::select('pais',['Colombia'=>'Colombia'])!!}
						</div>
						<div class="form-group col-xs-6-md-4">
							{!!Form::label('ciudad', 'Ciudad', ['class'=>'form-control' , 'style'=>'width:100%'])!!}
							{!!Form::select('ciudad',['Bogota'=>'Bogotá', 'Barranquilla'=>'Barranquilla', 'Bucaramanga'=>'Bucaramanga','Cali'=>'Cali', 'Cartagena'=>'Cartagena', 'Funza'=>'Funza', 'Medellin'=>'Medellín', 'Mosquera'=>'Mosquera'])!!}
						</div>
						<div class="form-group col-xs-6-md-4" >
							{!!Form::label('localidad', 'Localidad', ['class'=>'form-control' , 'style'=>'width:100%'])!!}
							{!!Form::text('localidad', null, ['class'=>'form-control', 'style'=>'width:100%'])!!}
						</div>
						<div class="form-group col-xs-6-md-4">
							{!!Form::label('barrio','Barrio', ['class'=>'form-control', 'style'=>'width:100%'])!!}
							{!!Form::text('barrio', null, ['class'=>'form-control','style'=>'width:100%'])!!}
						</div>
					</div>
					<div class="form-group" style="margin-top:10px;" >
						{!!Form::label('direccion','Dirección', ['class'=>'form-control', 'style'=>'width:100%'])!!}
						{!!Form::text('direccion', null, ['class'=>'form-control','style'=>'width:100%'])!!}			
					</div>
					<div class="form-inline">
						<div class="form-group col-xs-6-md-4">
							{!!Form::label('telefono', 'Teléfono' , ['class'=>'form-control' , 'style'=>'width:100%'])!!}
							{!!Form::text('telefono', null, ['class'=>'form-control','style'=>'width:100%'])!!}
						</div>
						<div class="form-group col-xs-6-md-4">
							{!!Form::label('estrato', 'Estrato', ['class'=>'form-control' , 'style'=>'width:100%'])!!}
							{!!Form::select('estrato',['Uno'=>'Uno', 'Dos'=>'Dos', 'Tres'=>'Tres','Cuatro'=>'Cuatro', 'Cinco'=>'Cinco', 'Seis'=>'Seis'])!!}
						</div>
						<div class="form-group col-xs-6-md-4" >
							{!!Form::label('telefono_cuadrante', 'Teléfono Cuadrante', ['class'=>'form-control' , 'style'=>'width:100%'])!!}
							{!!Form::text('telefono_cuadrante', null, ['class'=>'form-control', 'style'=>'width:100%'])!!}
						</div>
					</div>
						<div class="form-group" style="margin-top:10px;">
							{!!Form::label('horario_administracion','Horario Administración', ['class'=>'form-control', 'style'=>'width:100%'])!!}
							{!!Form::text('horario_administracion', null, ['class'=>'form-control','style'=>'width:100%'])!!}
						</div>
					<div class="form-inline">
					<div class="form-group">
						{!!Form::label('map_latitud', 'Latitud Mapa', ['class'=>'form-control', 'style'=>'width:100%'])!!}
						{!!Form::text ('map_latitud', null, ['class'=>'form-control','style'=>'width:100%'])!!}
					</div>
					<div class="form-group">
						{!!Form::label('map_longitud', 'Longitud Mapa', ['class'=>'form-control', 'style'=>'width:100%'])!!}
						{!!Form::text ('map_longitud', null, ['class'=>'form-control', 'style'=>'width:100%'])!!}
					</div>
					</div>

					<div class="form-group" style="margin-top:10px;">
						{!!Form::label('banner_conjunto','Cargar Banner Conjunto', ['class'=>'form-control', 'style'=>'width:100%'])!!}
						{!!Form::file('banner_conjunto', null, ['class'=>'btn btn-success', 'style'=>'width:100%'])!!}
					</div>

					<div class="form-group" style="margin-top:10px;">
						{!!Form::label('img_perfil','Cargar Imagén Perfil', ['class'=>'form-control', 'style'=>'width:100%'])!!}
						{!!Form::file('img_perfil', null ,  ['class'=>'btn btn-success', 'style'=>'width:100%'])!!}
					</div>
		
					<div class="form-group" style="margin-top:10px;" >
						{!!Form::submit('Actualizar', ['class'=>'btn btn-primary'])!!}
						{!!link_to_route('administrador.conjuntos.index', $title = 'Cancelar', $parameters = '', $attributes = ['class'=>'btn btn-danger'])!!}
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