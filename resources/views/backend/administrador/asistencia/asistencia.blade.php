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
					<h1>Crear evento</h1>
					{!!Form::open(['action'=> ['AsistenciasController@store'],'method'=>'POST'])!!}
					<div class="row">
						<div class="col-md-9">
							<div class="form-group has-float-label mb-4 " >
								<label for="archivo" class="form-label">Evento</label>
								{!!Form::text ('evento', null, ['required'=>'required','class'=>'form-control', 'placeholder'=>'Ingresa su Nombre'])!!}
							</div>
						</div>
						<div class="col-md-3">
							<input type="hidden" name="id_conjunto" value="{{$conjunto->first()->id}}">
							<div class="form-group has-float-label mb-4 col-md-3" >
								{!!Form::submit('Crear evento', ['class'=>'btn btn-primary'])!!}
							</div>
						</div>
					</div>
					{!!Form::close()!!}  
				</div>
			</div>
		</div>
		

		<div class="col-md-12">
			<div class="card mb-4">
				<div class="card-body ">
					<h1>Eventos programadas</h1>
					<div class="table-responsive">
						<table class="data-table responsive nowrap tabla_bonos_estilos" id="datos">
							<thead>
								<tr>
									<th style="width: auto;">Nombre</th>
									<th>Estado</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>

								@foreach ($asistencias_conjuntos as $asistencias)
								<tr>
									<td class="v-align-middle">{{$asistencias->Nombre}}</td>
									<td class="v-align-middle">
										@if($asistencias->Active == 1)
										Activo
										@else
										terminado
										@endif

									</td>
									<td>
										<a href="asistencia/ver/{{$asistencias->id}}" class="btn btn-success btn-xs mb-1" data-toggle="tooltip" data-placement="bottom" data-original-title="terminar">
											<i class="simple-icon-eye"></i>
										</a>
										@if($asistencias->Active == 2)
										@else
										
										<a href="asistencia/terminar/{{$asistencias->id}}" class="btn btn-secondary btn-xs mb-1" data-toggle="tooltip" data-placement="bottom" data-original-title="terminar">
											<i class="simple-icon-control-pause"></i>
										</a>

										<a href="asistencia/eliminar/{{$asistencias->id}}" class="btn btn-danger btn-xs mb-1" data-toggle="tooltip" data-placement="bottom" data-original-title="Eliminar">
											<i class="simple-icon-trash"></i>
										</a>
										@endif
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
