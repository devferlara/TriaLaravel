@extends('layout.mensajes')

<!-- Create General Section Sidebar -->
@section('sidebar')
<!-- Include the menu -->
@include('backend.menu.administrador')
@stop

<!-- Create General Section Header -->
@section('head')
<!-- Include the profile header -->
@include('layout.head')

@stop

@section('css')
@stop
@section ('content')

<div class="container-fluid">
	<div class="row">
		@include ('errors.errors')
		@include ('errors.request')
		@include ('errors.success')
		
		<div class="col-md-12">
			<div class="card mb-4">
				<div class="card-body">
					<h1>Crear encuesta</h1>
					{!!Form::open(['route'=>'administrador.encuestas.store','method'=>'POST'])!!}
					<div class="row"> 
						{!!Form::hidden ('id_conjunto', $conjunto->first()->id, ['class'=>'form-control'])!!}
						<div class="col-md-3">
							<div class="form-group has-float-label mb-4" >
								<label for="archivo" class="form-label">Nombre</label>
								{!!Form::text ('nombre', null, ['required'=>'required','class'=>'form-control', 'placeholder'=>'Ingresa su Nombre'])!!}
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group has-float-label mb-4" >
								<label for="archivo" class="form-label">Descripción</label>
								{!!Form::text ('descripcion', null, ['required'=>'required','class'=>'form-control', 'placeholder'=>'Ingresa su Nombre'])!!}
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group has-float-label mb-4" >
								<label for="archivo" class="form-label">Fecha limite</label>
								{!!Form::date ('fecha_limite', null, ['required'=>'required','class'=>'form-control'])!!}
							</div>
						</div>
						
						<div class="form-group has-float-label mb-4 col-md-3" >
							{!!Form::submit('Crear encuesta', ['class'=>'btn btn-primary'])!!}
						</div>
					</div>
					{!!Form::close()!!}	
				</div>
			</div>
		</div>
		

		<div class="col-md-12">
			<div class="card mb-4">
				<div class="card-body ">
					<h1>Encuestas programadas</h1>
					<div class="table-responsive">
						<table class="data-table responsive nowrap tabla_bonos_estilos" id="datos">
							<thead>
								<tr>
									<th style="width: auto;">Nombre</th>
									<th style="width: auto;">Descripción</th>
									<th style="width: auto;">Fecha limite</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>

								@foreach ($encuestas_conjuntos as $encuestas_hotel)
								<tr>
									<td class="v-align-middle">{{$encuestas_hotel->Nombre}}</td>
									<td class="v-align-middle">{{$encuestas_hotel->Descripcion}}</td>
									<td class="v-align-middle">{{$encuestas_hotel->fecha_limite}}</td>
									<td>
										<a href="preg/{{$encuestas_hotel->id}}" class="btn btn-secondary btn-xs mb-1" data-toggle="tooltip" data-placement="bottom" data-original-title="Agregar pregunta">
											<i class="simple-icon-note"></i>
										</a>

										<a href="estadistic/{{$encuestas_hotel->id}}" class="btn btn-success btn-xs mb-1" data-toggle="tooltip" data-placement="bottom" data-original-title="Ver estadisticas">
											<i class="simple-icon-chart"></i>
										</a>

										<a href="encuestas/delete-encuesta/{{$encuestas_hotel->id}}" class="btn btn-danger btn-xs mb-1" data-toggle="tooltip" data-placement="bottom" data-original-title="Eliminar">
											<i class="simple-icon-trash"></i>
										</a>

									</td>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						
					</div>
					
				</div>
			</div>
		</div>
	</div>
	
</div>



@stop

@section('footer')
@include('layout.footer')
{!!Html::script('vendor/ckeditor/ckeditor.js')!!}
@stop
