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
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div class="container-fluid">
	<div class="row">
		@include ('errors.errors')
		@include ('errors.request')
		@include ('errors.success')

		
		
		<div class="col-md-12">
			<div class="card mb-4">
				<div class="card-body">

					@foreach ($encuestas as $encuesta)
					<h1 style="margin:0">Encuesta: <strong>{{$encuesta['Nombre']}}</strong></h1>
					<h3 style="margin-bottom:40px">Descripción: <strong>{{$encuesta['Descripcion']}}</strong></h3>
					@endforeach
					

					@foreach ($padre as $dato)
					

					<div class="col-md-8" style="margin-bottom:40px">
						<h6>Pregunta: <strong>{{$dato['nombre_pregunta']}}</strong></h6>
						
						<div id="{{$dato['id_pregunta']}}"></div>

						<script type="text/javascript">

							google.charts.load('current', {packages: ['corechart', 'bar']});
							google.charts.setOnLoadCallback(drawBasic);

							function drawBasic() {

								var data = google.visualization.arrayToDataTable([

									['Element', '', { role: '#145388' }],

									@foreach ($dato['datos'] as $datos_numero)
									['{{$datos_numero->respuesta}}', {{$datos_numero->total}}, '#145388'], 
									@endforeach

									]);

								var chart = new google.visualization.ColumnChart(
									document.getElementById("{{$dato['id_pregunta']}}"));

								chart.draw(data);
							}

						</script>


						@else
						<strong>En el momento ninguna persona ha respondido</strong>
						@endif
						

					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>




	@stop

	@section('footer')
	@include('layout.footer')
	{!!Html::script('vendor/ckeditor/ckeditor.js')!!}
	@stop




