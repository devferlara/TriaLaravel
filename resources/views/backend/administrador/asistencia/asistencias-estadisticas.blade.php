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
				<div class="card-body ">
					<h1>Evento: <strong>{{$nombre_evento[0]->nombre}}</strong></h1>
					<h6><strong>Personas que van asistir: {{count($datos)}}</strong></h6>
					<div class="table-responsive">
						<table class="data-table responsive nowrap tabla_bonos_estilos" id="datos">
							<thead>
								<tr>
									<th style="width: auto;">Nombre</th>
									<th style="width: auto;">Email</th>
									<th style="width: auto;">Telefono</th>
								</tr>
							</thead>
							<tbody>

								@foreach ($datos as $dato)
								<tr>
									<td class="v-align-middle">{{$dato->nombres}} {{$dato->apellidos}}</td>
									<td class="v-align-middle">{{$dato->email}} </td>
									<td class="v-align-middle">{{$dato->telefono}} </td>

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
