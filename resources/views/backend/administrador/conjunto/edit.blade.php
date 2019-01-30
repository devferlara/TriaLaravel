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


<div class="container-fluid">
	<div class="row">
		@include ('errors.success')
		@include ('errors.request')
		@include ('errors.errors')
		<div class="col-lg-12 col-md-12">
			<div class="card mb-4">
				<div class="card-body ">
					<h3 class="p-b-5 text-primary" style="text-align:center;">
						<span class="semi-bold">Actualizar</span>
						Conjunto
					</h3>
					<h4 class="text-info">Actualiza el conjunto completando el siguiente Formulario �Es f�cil, recuerda que todos los campos son requeridos *.!</h4>
					<br>

					{!!Form::model($conjunto,['route'=> ['administrador.conjuntos.update',$conjunto->id],'method'=>'PUT','files'=>'true'])!!}
					<div class="row">
						<div class="col-md-4">
							<div class="form-group form-group has-float-label mb-4">
								{!!Form::label('tipo','Tipo de Propiedad')!!}
								{!!Form::select('tipo',['Apartamentos'=>'Apartamentos', 'Bodegas'=>'Bodegas', 'Casas'=>'Casas', 'Locales'=>'Locales', 'Oficinas'=>'Oficinas'],null,['class'=>'form-control'])!!}
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group form-group has-float-label mb-4">
								{!!Form::label('nit', 'NIT')!!}
								{!!Form::text ('nit', null, ['class'=>'form-control'])!!}
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('nombre', 'Nombre')!!}
								{!!Form::text ('nombre', null, ['class'=>'form-control'])!!}
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('pais', 'Pais' )!!}
								<select class="form-control" data-init-plugin="select2" id="pais" name="pais" style="width:100%;">
									<option value="" selected disabled>Seleccione un pa�s</option>
									<optgroup label="Paises">
										@foreach($paises as $pais)
										<option value="{{$pais->Codigo}}" <?= $conjunto->pais == $pais->Pais?'selected':''?>>{{$pais->Pais}}</option>
										@endforeach
									</optgroup>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('ciudad', 'Ciudad' )!!}
								<select class="form-control" data-init-plugin="select2" id="ciudad" name="ciudad" style="width:100%;">

									<optgroup label="Ciudades">
										@foreach($ciudades as $ciudad)
										<option value="{{$ciudad->Ciudad}}" <?= $conjunto->ciudad == $ciudad->Ciudad?'selected':''?>>{{$ciudad->Ciudad}}</option>
										@endforeach
									</optgroup>
								</select>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group has-float-label mb-4" >
								{!!Form::label('localidad', 'Localidad')!!}
								{!!Form::text('localidad', null, ['class'=>'form-control', 'style'=>'width:100%'])!!}
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('barrio','Barrio')!!}
								{!!Form::text('barrio', null, ['class'=>'form-control','style'=>'width:100%'])!!}
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group has-float-label mb-4" >
								{!!Form::label('direccion','Direccion')!!}
								{!!Form::text('direccion', null, ['class'=>'form-control','style'=>'width:100%'])!!}
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('telefono', 'Telefono')!!}
								{!!Form::text('telefono', null, ['class'=>'form-control','style'=>'width:100%'])!!}
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('estrato', 'Estrato')!!}
								{!!Form::select('estrato',['Uno'=>'Uno', 'Dos'=>'Dos', 'Tres'=>'Tres','Cuatro'=>'Cuatro', 'Cinco'=>'Cinco', 'Seis'=>'Seis'], null, ['class'=>'form-control'])!!}
							</div>
						</div>


						<div class="col-md-4">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('telefono_cuadrante', 'Telefono Cuadrante')!!}
								{!!Form::text('telefono_cuadrante', null, ['class'=>'form-control', 'style'=>'width:100%'])!!}
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('horario_administracion','Horario Administracion')!!}
								{!!Form::text('horario_administracion', null, ['class'=>'form-control','style'=>'width:100%'])!!}
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('map_latitud', 'Latitud Mapa')!!}
								{!!Form::text ('map_latitud', null, ['class'=>'form-control','style'=>'width:100%'])!!}
							</div>
						</div>


						<div class="col-md-4">
							<div class="form-group has-float-label mb-4">
								{!!Form::label('map_longitud', 'Longitud Mapa')!!}
								{!!Form::text ('map_longitud', null, ['class'=>'form-control', 'style'=>'width:100%'])!!}
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group" >
								{!!Form::label('banner_conjunto','Cargar Banner Conjunto')!!}
								<div style="width: 100%">
									{!!Form::file('banner_conjunto', null, ['class'=>'btn btn-success', 'style'=>'width:100%'])!!}
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group" >
								{!!Form::label('img_perfil','Cargar Imagen Perfil')!!}
								<div style="width: 100%">
									{!!Form::file('img_perfil', null ,  ['class'=>'btn btn-success', 'style'=>'width:100%'])!!}
								</div>
							</div>
						</div>
					</div>

					<div class="form-group" style="margin-top:10px;" >
						{!!Form::submit('Actualizar', ['class'=>'btn btn-primary'])!!}
						{!!link_to_route('administrador.conjuntos.index', $title = 'Cancelar', $parameters = '', $attributes = ['class'=>'btn btn-danger'])!!}

					</div>
					{!!Form::close()!!}

				</div>
			</div>
		</div>


	</div>
</div>

@endsection

@section ('footer')
@include ('layout.footer')
{!!Html::script('build/assets/js/script/listarciudades.js?v=1')!!}
@stop
