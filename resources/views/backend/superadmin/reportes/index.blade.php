@extends('layout.admin')

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
				<div class="card-body ">
					<h1>Conjuntos activos</h1>
					<table class="table table-bordered" id="datos_conjuntos_ubicacion">
						<thead class="info">
							<th style="width: auto;">Pais</th>
							<th style="width: auto;">Ciudad</th>
							<th style="width: auto;">Numero de Conjuntos</th>
						</thead>
					</table>
				</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="card mb-4">
				<div class="card-body ">
					<h1>Total de Conjuntos</h1>
					<table class="table table-bordered" id="datos_total_conjuntos">

						<thead class="info">
							<th style="width: auto;">Numero de conjuntos</th>
							<th style="width: auto;">Costo del Conjunto </th>
							<th style="width: auto;">Total Costo Global </th>
						</thead>
						<tbody>
							<td class="v-align-middle">{{$total_conjuntos}}</td>
							<td class="v-align-middle">$250 USD</td>
							<td class="v-align-middle">${{$total_conjuntos * 250 }} USD</td>
						</tbody>
					</table>
				</div>
			</div>
		</div>



	</div>
</div>
@endsection

@section ('footer')
@include ('layout.footer')
{!!Html::script('build/assets/js/script/listaraptos.js')!!}
{!!Html::script('build/assets/js/perfil_socio.js')!!}
@stop

