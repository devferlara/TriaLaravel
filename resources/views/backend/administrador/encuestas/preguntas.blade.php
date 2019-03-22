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
					<h1>Encuesta: <strong>{{$nombre_de_la_encuesta}}</strong></h1>
					{!!Form::open(['action'=> ['PreguntasController@store'],'method'=>'POST'])!!}
					<div class="row">
						<div class="col-md-9">
							<div class="form-group has-float-label mb-4 " >
								<label for="archivo" class="form-label">Nueva pregunta</label>
								{!!Form::text ('pregunta', null, ['required'=>'required','class'=>'form-control', 'placeholder'=>'Ingresa su Nombre'])!!}
							</div>
						</div>
						<div class="col-md-3">
							<input type="hidden" name="id_encuesta" value="{{$id_}}">
							<div class="form-group has-float-label mb-4 col-md-3" >
								{!!Form::submit('Crear pregunta', ['class'=>'btn btn-primary'])!!}
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
					<h1>Preguntas</h1>
					<div class="table-responsive">
						<table class="data-table responsive nowrap tabla_bonos_estilos" id="datos">
							<thead>
								<tr>
									<th style="width: auto;">Pregunta</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>

								@foreach ($encuestas_conjuntos as $encuestas_preguntas)
								<tr>
									<td class="v-align-middle">{{$encuestas_preguntas->pregunta}}</td>
									<td>
										<a href="/administrador/resp/{{$encuestas_preguntas->id}}" class="btn btn-secondary btn-xs mb-1" data-toggle="tooltip" data-placement="bottom" data-original-title="Agregar respuesta">
											<i class="simple-icon-note"></i>
										</a>

										<a href="/administrador/Preg/delete/{{$encuestas_preguntas->id}}" class="btn btn-danger btn-xs mb-1" data-toggle="tooltip" data-placement="bottom" data-original-title="Eliminar">
											<i class="simple-icon-trash"></i>
										</a>
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